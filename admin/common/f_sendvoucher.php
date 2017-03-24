<?php
include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$vnsql = "SELECT VoucherNo FROM IDCounters";

$vouchno = getIdCount($vnsql);
$n_vouchno = str_pad($vouchno, 5, "0", STR_PAD_LEFT);

$mailDateFrom = AusToStandardDate($_POST['txtDateRangeFrom']);
$mailDateTo = AusToStandardDate($_POST['txtDateRangeTo']);
$mailOption = $_POST['txtMailingVal'];
$mailVoucherVal = $_POST['selVoucher'];
$mailSpecific = $_POST['txtMembersEmail'];

$voucher_parts = explode("-", $mailVoucherVal);
$vTemplateID = $voucher_parts[0];
$vTemplateName = $voucher_parts[1];

$doc_type = "Voucher";
$emailFrom = 'admin@casellas.com.au';
$subject = 'Casellas Wine - Tapas - Grill - '.$vTemplateName;

if ($mailOption == "1") {    
    $vc_mail_sql = "SELECT  Customers.CustomersID as Cid
                , Customers.Email as Email
                , Customers.Firstname as Fname
                , Customers.Lastname as Lname
            FROM  Customers, UserLogin 
            WHERE  Customers.CustomersID = UserLogin.UserNumber
            AND UserLogin.SystemLevel = '3'            
            AND Customers.Email <> ' '
            AND UserLogin.Status = '1'
            AND DATE_FORMAT(Customers.BirthDate, '%m')
            BETWEEN DATE_FORMAT('$mailDateFrom','%m')
            AND DATE_FORMAT('$mailDateTo','%m')";
    
    $vc_mail_rs = mysql_query($vc_mail_sql);
    
    while ($vc_mail_row = mysql_fetch_array($vc_mail_rs)) {        
        $vc_member_id = trim($vc_mail_row['Cid']);
        $vc_member_email = trim($vc_mail_row['Email']);
        $vc_member_fname = trim($vc_mail_row['Fname']);
        $vc_member_lname = trim($vc_mail_row['Lname']);
        
        $member_eaddress =  $vc_member_email;
        $member_fullname = $vc_member_fname." ".$vc_member_lname;

        $m_check_sql = "SELECT * FROM Distribution_List WHERE MemberID = '$vc_member_id' AND DocDistributed = '$vTemplateID' ";        
        $m_check_rs = mysql_query($m_check_sql);        
        $m_check_count = mysql_num_rows($m_check_rs);
        
        if ($m_check_count != 1) {        
//        $emailTo = trim($member_eaddress);
//        
//        $body = "Dear $member_fullname,";
//        $body .= "";
//        
//        $headers = "MIME-Version: 1.0\r\n";
//        $headers .= "From: Casellas Wine - Tapas - Grill<$emailFrom>\r\n";
//        $headers .= "Bcc: $emailTo\r\n";
//        
//        mail('Undisclosed Recipient<no-reply@casellas.com.au>', $subject, $body, $headers);
            
            $to_dislist_sql = "INSERT INTO Distribution_List (DocDistributed, DocID, MemberID, DistributionStatus, DistributionDate, Status)
                    VALUES ('$doc_type', '$vTemplateID', '$vc_member_id', '1', now(), '1')";
            
            mysql_query($to_dislist_sql);
            
            echo "<script type='text/javascript'>alert('$member_eaddress - voucher sent!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('voucher(s) already sent!');</script>";
            exit();
        }        
    }
    
} else {
    $set_of_eaddress = explode(',',trim(str_replace(';', ',', $mailSpecific)));
    
    foreach ($set_of_eaddress as $specific_email) {        
        $vc_specific_sql = "SELECT * FROM Customers WHERE Email = '$specific_email'";
        $vc_specific_rs = mysql_query($vc_specific_sql);
        
        while ($vc_specific_row = mysql_fetch_array($vc_specific_rs)) {
            $vc_specific_id = trim($vc_specific_row['CustomersID']);
            $vc_specific_email = $vc_specific_row['Email'];
            $vc_specific_fname =  $vc_specific_row['Firstname'];
            $vc_specific_lname = $vc_specific_row['Lastname'];
            
            $vc_specific_eaddress =  $vc_specific_email;
            $vc_specific_fullname = $vc_specific_fname." ".$vc_specific_lname;
            
            $sp_check_sql = "SELECT * FROM Distribution_List WHERE MemberID = '$vc_specific_id' AND DocDistributed = '$vTemplateID' ";        
            $sp_check_rs = mysql_query($sp_check_sql);        
            $sp_check_count = mysql_num_rows($sp_check_rs);
        
            if ($sp_check_count != 1) {        
    //        $emailTo = trim($member_eaddress);
    //        
    //        $body = "Dear $member_fullname,";
    //        $body .= "";
    //        
    //        $headers = "MIME-Version: 1.0\r\n";
    //        $headers .= "From: Casellas Wine - Tapas - Grill<$emailFrom>\r\n";
    //        $headers .= "Bcc: $emailTo\r\n";
    //        
    //        mail('Undisclosed Recipient<no-reply@casellas.com.au>', $subject, $body, $headers);

                $to_dislist_sql = "INSERT INTO Distribution_List (DocDistributed, DocID, MemberID, DistributionStatus, DistributionDate, Status)
                        VALUES ('$doc_type', '$vTemplateID', '$vc_specific_id', '1', now(), '1')";

                mysql_query($to_dislist_sql);

                echo "<script type='text/javascript'>alert('$vc_specific_eaddress - voucher sent!');</script>";
            } else {
                echo "<script type='text/javascript'>alert('voucher(s) already sent!');</script>";
                exit();
            }
        }        
    }
}

//query to get voucher content
//$vc_query = "SELECT * FROM Vouchers WHERE VoucherTemplateID = '$vTemplateID'";
//$vc_rs = mysql_query($vc_query);

//echo $mailAll;

//while ($vc_row = mysql_fetch_array($vc_rs)) {}
//echo "<script type='text/javascript'>alert('Casellas Wine - Tapas - Grill - Voucher Sent!'); window.location='$site_host/admin/index.php?pg=distribute_voucher'</script>";
?>