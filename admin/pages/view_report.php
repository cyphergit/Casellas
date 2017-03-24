<?php
include('../../conf.inc.php');

$report_request = $_GET['r'];

if ($report_request == 'nc') {
    $report_header = "Current Distributed Newsletters To Members";
}

if ($report_request == 'np') {
    $report_header = "Previous Distributed Newsletters To Members";
}

if ($report_request == 'nu') {
    $report_header = "Members who did not received Newsletters";
}

if ($report_request == 'vc') {
    $report_header = "Current Distributed Vouchers To Members";
}

if ($report_request == 'vp') {
    $report_header = "Previous Distributed Vouchers To Members";
}

if ($report_request == 'vu') {
    $report_header = "Members who did not received Vouchers";
}

function displayReportResults($rr) {
    if ($rr == 'nc') {
        $q = "SELECT
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                    , Distribution_List.DistributionDate as DistributionDate
                    , Distribution_List.DocDistributed as Document
                FROM
                    Customers, Distribution_List
                WHERE
                    Distribution_List.DocDistributed = 'Newsletter'
                AND Customers.CustomersID = Distribution_List.MemberID
                ORDER BY
                    Customers.Lastname ASC";

        return $q;
    }

    if ($rr == 'np') {
        $q = "SELECT
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                    , Distribution_Posted.DistributionDate as DistributionDate
                    , Distribution_Posted.DocDistributed as Document
                FROM
                    Customers, Distribution_Posted
                WHERE
                    Distribution_Posted.DocDistributed = 'Newsletter'
                AND Customers.CustomersID = Distribution_Posted.MemberID
                ORDER BY
                    Customers.Lastname ASC";

        return $q;
    }

    if ($rr == 'nu') {
        $q = "SELECT 
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                FROM 
                    Customers, UserLogin
                WHERE 
                    Customers.CustomersID = UserLogin.UserNumber
                AND UserLogin.SystemLevel = '3'
                AND UserLogin.Status = '1'
                AND NOT EXISTS
                    (SELECT Distribution_List.MemberID
                    FROM Distribution_List
                    WHERE Distribution_List.MemberID = Customers.CustomersID
                    AND Distribution_List.DocDistributed = 'Newsletter')
                ORDER BY
                    Customers.Lastname ASC";

        return $q;
    }

    if ($rr == 'vc') {
        $q = "SELECT
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                    , Distribution_List.DistributionDate as DistributionDate
                    , Distribution_List.DocDistributed as Document
                FROM
                    Customers, Distribution_List
                WHERE
                    Distribution_List.DocDistributed = 'Voucher'
                AND Customers.CustomersID = Distribution_List.MemberID
                ORDER BY
                    Distribution_List.DistributionDate,
                    Customers.Lastname ASC";

        return $q;
    }

    if ($rr == 'vp') {
        $q = "SELECT
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                    , Distribution_Posted.DistributionDate as DistributionDate
                    , Distribution_Posted.DocDistributed as Document
                FROM
                    Customers, Distribution_Posted
                WHERE
                    Distribution_Posted.DocDistributed = 'Voucher'
                AND Customers.CustomersID = Distribution_Posted.MemberID
                ORDER BY
                    Customers.Lastname ASC";

        return $q;
    }

    if ($rr == 'vu') {
        $q = "SELECT 
                    Customers.CustomersID as ID
                    , Customers.Firstname as Firstname
                    , Customers.Lastname as Lastname
                    , Customers.Email as Email
                FROM 
                    Customers, UserLogin
                WHERE 
                    Customers.CustomersID = UserLogin.UserNumber
                AND UserLogin.SystemLevel = '3'
                AND UserLogin.Status = '1'
                AND NOT EXISTS
                    (SELECT Distribution_List.MemberID
                    FROM Distribution_List
                    WHERE Distribution_List.MemberID = Customers.CustomersID
                    AND Distribution_List.DocDistributed = 'Voucher')
                ORDER BY
                    Customers.Lastname ASC";

        return $q;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../../styles/Report.css" type="text/css" />
        <title><?php echo $report_header; ?></title>
    </head>
    <body>
        <div id="distribution-report">
            <h4>
                Casellas - Wine - Tapas - Grill <br/>
                <?php echo $report_header; ?> <br/>
                as of
                <?php echo date('d/m/Y'); ?>
            </h4>
            <div class="report-table">
                <div class="report-table-head">
                    <div class="report-table-row">
                        <div class="label-head">Customer ID</div>
                        <div class="label-head">Last Name</div>
                        <div class="label-head">First Name</div>
                        <div class="label-head">E-mail</div>
                        <div class="label-head">Distribution Date</div>
                        <div class="label-head">Document Type</div>
                    </div>
                </div>
                <div class="report-table-head">
                    <?php
                    $query = displayReportResults($report_request);
                    $rs = mysql_query($query);

                    while ($r = mysql_fetch_array($rs)) {
                        echo "<div class='report-table-row'>";
                        echo "<div>$r[ID]</div>";
                        echo "<div>$r[Lastname]</div>";
                        echo "<div>$r[Firstname]</div>";
                        echo "<div>$r[Email]</div>";
                        echo "<div>$r[DistributionDate]</div>";
                        echo "<div>$r[Document]</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>