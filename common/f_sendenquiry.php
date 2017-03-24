<?php
session_start();

include '../conf.inc.php';
include '../includes/functions.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$fullname = $firstname. " ". $lastname;
$contactno = $_POST['contactno'];
$email = $_POST['email'];
$reason = $_POST['reason'];
$subject = $_POST['subject'];
$reservation_date = $_POST['date'];
$time = $_POST['time'];
$guest = $_POST['guest'];
$message = $_POST['message'];
$nSubscription = $_POST['subscription'];

if (IsInjected($email) && IsInjected($subject)) {
    echo "<img src='images/result-error.jpg'/><br/>";
    echo "<span class='error'>There is an error in your registration. Please try again!</span>";
    exit();
}

if ($nSubscription == "" || $nSubscription == null) { $nSubscription = 0; }

$emailFrom = $email;
$replyTo = $email;
$ccTo = "info@casellas.com.au";
//$ccTo = "cypherit.testmail@gmail.com";
$emailTo = "admin@$domain";
//$emailTo = "cypherit.testmail@gmail.com";

$body = "<html>";
$body .= "<body>";
$body .= "<div>";

$body .= "<h2>$company - $reason</h2>";
$body .= "<h3>Personal Details</h3>";
$body .= "<p>";
$body .= "<b>Customer Name:</b> <em>$fullname</em><br/>";
$body .= "<b>E-mail Address:</b> <em>$email</em><br/>";
$body .= "<b>Contact No.:</b> <em>$contactno</em><br/>";
$body .= "</p>";
$body .= "<p>";
$body .= "<b>Subject:</b> <em>$subject</em><br/><br/>";

if ($reason == 'Reservation') {
    $body .= "<p>";
    $body .= "<b>Reservation Date:</b> <em>$reservation_date</em><br/>";
    $body .= "<b>Time:</b> <em>$time</em><br/>";
    $body .= "<b>Number of Guest:</b> <em>$guest</em><br/>";
    $body .= "</p>";
}

$body .= "<b>Message/Comment:</b><br/><br/> <em>$message</em><br/>";
$body .= "</p>";

$body .= "</div>";
$body .= "</body>";
$body .= "</html>";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: $company - $reason<$emailFrom>\r\n";
$headers .= "Cc: $ccTo\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

if ($nSubscription == 1) {

    $sql_existing = "SELECT Email FROM Customers WHERE Email = '$email'";
    $r_existing = mysql_query($sql_existing) or die(mysql_error());

    $num_rows = mysql_num_rows($r_existing);
    $count = $num_rows;

    if ($count >= 1) {

        $emailSent = mail($emailTo, $subject, $body, $headers);
        if (!$emailSent) {
            echo "<img src='images/result-error.jpg'/><br/>";
            echo "<span class='error'>There is an error encountered. Please try again!</span>";
            
        } else {
            echo "<img src='images/result-success.jpg'/><br/>";
            echo "<span class='success'>Enquiry Sent!</span>";
        }
        
    } else {

        $sql = "SELECT UserCustomerID FROM IDCounters";
        $newid = GetIDCount($sql);

        mysql_query("UPDATE IDCounters SET UserCustomerID = '$newid'") or die(mysql_error());

        mysql_query("INSERT INTO Customers (CustomersID, Email, Firstname, Lastname, LandlineNum, NewsletterSubscription,DateJoined)
    VALUES ('$newid','$email','$firstname','$lastname','$contactno','1',now())") or die(mysql_error());

        mysql_query("INSERT INTO UserLogin (UserNumber, UserName, Password, SystemLevel, CreatedBy, Timestamp, Status)
    VALUES ('$newid','$email',AES_ENCRYPT('default','casellas'),'3','Customer',now(),'1')") or die(mysql_error());

        mail($emailTo, $subject, $body, $headers);

        //NEWSLETTER SUBSCRIPTION
        $emailFrom = "admin@$domain";
        //$emailFrom = "cypherit.testmail@gmail.com";
        $emailTo = $email;

        $subject = "Newsletter Subscription";

        $body = "<html>";
        $body .= "<body>";
        $body .= "<div>";

        $body .= "<h2>$company - Newsletter Subscription</h2>";
        $body .= "<p>";
        $body .= "Dear ". ucfirst($firstname) .",";
        $body .= "<br/><br/>";
        $body .= "<p>";
        $body .= "You have successfully subscribed to our Newsletter by checking the subscribe checkbox from our Online Enquiry form. ";
        $body .= "From now on, we will keep you posted from any updates, promos, and events that will happen at $company. ";
        $body .= "If by any case you would like to unsubscibe from our newsletter, just click <a href='$site_host/index.php?pg=unsubscribe' target='_blank'>here.</a>";
        $body .= "</p>";
        $body .= "Thank you and Regards,<br/><br/>";
        $body .= "$company - Administrator";
        $body .= "</p>";

        $body .= "</div>";
        $body .= "</body>";
        $body .= "</html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From: $company - Newsletter Subscription<no-reply@$domain'>\r\n";
        $headers .= "Bcc: $emailTo\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        mail($emailTo, $subject, $body, $headers);

        //NEW MEMBER NOTICE
        $emailFrom = "admin@$domain";
        //$emailFrom = "cypherit.testmail@gmail.com";
        $emailTo = $emailFrom;

        $subject = "New Member Notice";

        $body = "<html>";
        $body .= "<body>";
        $body .= "<div>";

        $body .= "<h2>$company - New Mailing Member</h2>";
        $body .= "<p>";
        $body .= "Dear Administrator,";
        $body .= "<br/><br/>";
        $body .= "<p>";
        $body .= "New member ($email) has been added to the company newsletter mailing list. ";
        $body .= "To see the added member, click <a href='$site_host/admin'>here</a> to visit the administrator site.";
        $body .= "</p>";
        $body .= "Thank you and Regards,<br/><br/>";
        $body .= "$company - Administrator";
        $body .= "</p>";

        $body .= "</div>";
        $body .= "</body>";
        $body .= "</html>";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From: $company - Newsletter Subscription<newsletter@$domain\r\n";
        $headers .= "Cc: $ccTo\r\n";
        $headers .= "Bcc: $emailTo\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        if ($reason != '' || $reason != null) {
            $emailSent = mail("no-reply@$domain", $subject, $body, $headers);
            if (!$emailSent) {
                echo "<img src='images/result-error.jpg'/><br/>";
                echo "<span class='error'>There is an error encountered. Please try again!</span>";

            } else {
                echo "<img src='images/result-success.jpg'/><br/>";
                echo "<span class='success'>Enquiry Sent!</span>";                
                //echo "<script type=\"text/javascript\">alert(\"Your message was sent successfully. Please give us an ample time to attend to your enquiry and will endevour to provide you with feedback as soon as possible. Thank you.\"); window.location=\"../index.php\"</script>";                
            }
        }
    }
} 
else 
{
    if ($reason != "" || $reason != null) {
        $emailSent = mail($emailTo, $subject, $body, $headers);
        if (!$emailSent) {
            echo "<img src='images/result-error.jpg'/><br/>";
            echo "<span class='error'>There is an error encountered. Please try again!</span>";
            
        } else {
            echo "<img src='images/result-success.jpg'/><br/>";
            echo "<span class='success'>Enquiry Sent!</span>";
        }
    }
}