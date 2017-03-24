<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$accountField = (object) array(
            'process' => $_POST['Process'],
            'username' => $_POST['txtUsername'],
            'password' => $_POST['txtPassword'],
            'email' => $_POST['txtUEmail'],
            'systemlevel' => $_POST['selULevel'],
            'newpassword' => $_POST['txtUNewPass'],
            'oldpassword' => $_POST['txtPassword'],
            'entryid' => $_POST['EntryID']
);

switch ($accountField->process) {
    case "Add":
        $fetchCustomerId = "SELECT UserCustomerID FROM IDCounters";
        $newId = getIdCount($fetchCustomerId);

        $countUserLogin = "SELECT COUNT(UserName) FROM UserLogin WHERE Username = '$accountField->username'
            AND Password = AES_ENCRYPT('$accountField->password','$key') AND Status = '1' LIMIT 1";
        $countResult = mysql_fetch_array(mysql_query($countUserLogin));
        $count = $countResult[0];

        if ($count != 0) {
            echo "<script type=\"text/javascript\">alert(\"Account Already Exist! Please try again.\");window.location=\"../index.php?pg=useraccount&p=c\"</script>";
        } else {
            $updateIdCounter = "UPDATE IDCounters SET UserCustomerID = '$newId'";
            $executeToUpdateId = mysql_query($updateIdCounter);

            $insertToUserlogin = "INSERT INTO UserLogin (UserNumber, UserName, Password, SystemLevel, CreatedBy, Timestamp, Status)
                VALUES ($newId, '$accountField->username', AES_ENCRYPT('$accountField->password','$key'), '1', 'Administrator', now(), '1')";
            $executeToInsertUser = mysql_query($insertToUserlogin);

            $insertToCustomer = "INSERT INTO Customers (CustomersID, Email, Firstname, Lastname, BirthDate, NewsletterSubscription)
                VALUES ($newId, '$accountField->username', 'Administrator', 'Account', '0000-00-00', '0')";
            $executeToInsertCustomer = mysql_query($insertToCustomer);

            if ((!$executeToUpdateId) && (!$executeToInsertUser) && (!$executeToInsertCustomer)) {
                die("Database Error!") or die(mysql_error());
            } else {
                echo "<script type='text/javascript'>alert('New Account Created!');window.location='../index.php?pg=useraccount'</script>";
            }
        }
        break;

    case "Update":
        if ($accountField->newpassword == "" || $accountField->newpassword == null) {
            $accountField->newpassword = $accountField->oldpassword;
        } else {
            $new_password = $accountField->newpassword;
        }
        //UPDATE DATABASE
        $updateUser = "UPDATE UserLogin SET UserName = '$accountField->email', Password = AES_ENCRYPT('$new_password','$key'),
            SystemLevel = '$accountField->systemlevel' WHERE UserNumber = '$accountField->entryid'";
        $executeToUser = mysql_query($updateUser);

        $updateCustomer = "UPDATE Customers SET Email = '$accountField->email' WHERE CustomersID = '$accountField->entryid'";
        $executeToCustomer = mysql_query($updateCustomer);

        if ((!$executeToUser) && (!$executeToCustomer)) {
            die("Database Error!") or die(mysql_error());
        } else {
            echo "<script type='text/javascript'>alert('Your account has been updated! You are required to login for your updates to take effect.');window.location='admin/f_logout.php'</script>";
        }
        break;

    case "Delete":
        mysql_query("UPDATE UserLogin SET Status = '2' WHERE UserNumber = '$accountField->entryid'") or die(mysql_error());
        echo "<script type='text/javascript'>alert('Account Deleted!');window.location='../index.php?pg=useraccount'</script>";
        break;
}
?>