<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];

$cEmail = $_POST['txtCEmail'];
$cLastname = $_POST['txtCLastname'];
$cFirstname = $_POST['txtCFirstname'];
$cMiddlename = $_POST['txtCMiddlename'];

$cBirthdate = trim($_POST['txtCBirthdate']);
$cBirthdate = AusToStandardDate($cBirthdate);

$cStreet = $_POST['txtCStreet'];
$cCity = $_POST['txtCCity'];
$cCountry = $_POST['txtCCountry'];
$cPostal = $_POST['txtCPostal'];

$cLandline = $_POST['txtCLandline'];
$cMobile = $_POST['txtCMobile'];

$cSubscribe = $_POST['txtCSubscription'];
$cSubscribe = intval($cSubscribe);

$entryID = $_POST['EntryID'];

$cur_date = date("y-m-d h:m:s");

switch ($process) {
    case "Add":
        $sql = "SELECT UserCustomerID FROM IDCounters";

        $newid = getIdCount($sql);

        mysql_query("UPDATE IDCounters SET UserCustomerID = '$newid'");

        mysql_query("INSERT INTO Customers (CustomersID, Email, Firstname, Lastname, Middlename, AddressStreet, AddressCity, AddressCountry, AddressPostal, BirthDate, LandlineNum, MobileNum, NewsletterSubscription, DateJoined, TimeStamp)
              VALUES ('$newid','$cEmail','$cFirstname','$cLastname','$cMiddlename','$cStreet','$cCity','$cCountry','$cPostal','$cBirthdate','$cLandline','$cMobile','$cSubscribe',now(), now())") or die(mysql_error());

        mysql_query("INSERT INTO UserLogin (UserNumber, UserName, Password, SystemLevel, CreatedBy, Timestamp, Status)
              VALUES ('$newid','$cEmail',AES_ENCRYPT('default','style'),'3','Administrator',now(),'1')") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"New Customer Created!\");window.location=\"../index.php?pg=customers\"</script>";
        break;

    case "Update":

        mysql_query("UPDATE Customers SET Firstname = '$cFirstname', Lastname = '$cLastname',  Middlename = '$cMiddlename',
            AddressStreet = '$cStreet', AddressCity = '$cCity', AddressCountry = '$cCountry', AddressPostal = '$cPostal',
            BirthDate = '$cBirthdate', MobileNum = '$cMobile', LandlineNum = '$cLandline', TimeStamp = now(), NewsletterSubscription = '$cSubscribe'
            WHERE CustomersID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Customer Record Updated!\");window.location=\"../index.php?pg=customers\"</script>";
        break;

    case "Delete":

        mysql_query("DELETE FROM Customers WHERE CustomersID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Customer Successfully Deleted!\");window.location=\"../index.php?pg=customers\"</script>";
        break;
}
?>