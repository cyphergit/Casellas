<?php
session_start();

include '../conf.inc.php';
include '../includes/functions.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal = $_POST['postal'];
$mobile = $_POST['mobile'];
$landline = $_POST['landline'];
$bday = AusToStandardDate($_POST['bday']);
$dine = $_POST['dine'];
$rate = $_POST['rate'];
$recommend = $_POST['recommend'];
$recoreason = $_POST['reason'];
$reason = "Casellas - VIP Registration";
$fullname = $fname . ' ' . $lname;
$cur_date = date("y-m-d h:m:s");

if (IsInjected($email)) {
    echo "<img src='images/result-error.jpg'/><br/>";
    echo "<span class='error'>Error encountered. Please try again.</span>";
    exit();
}

$countUser = "SELECT COUNT(Email) FROM Customers WHERE Email = '$email'";
$countResult = mysql_fetch_array(mysql_query($countUser));

if ($countResult[0] == 0) {
    $customerIdCount = "SELECT UserCustomerID FROM IDCounters";
    $newCustomerId = getIdCount($customerIdCount);
    $updateIdCounter = "UPDATE IDCounters SET UserCustomerID = '$newCustomerId'";
    mysql_query($updateIdCounter);

    $registerCustomer = "INSERT INTO Customers (CustomersID, Email, Firstname, Lastname, Middlename, AddressStreet, AddressCity,  AddressState, AddressCountry, AddressPostal, BirthDate, LandlineNum, MobileNum, NewsletterSubscription, DateJoined, TimeStamp)
        VALUES ('$newCustomerId', '$email', '$fname', '$lname', '', '$street', '$city', '$state', '', '$postal', '$bday', '$landline', '$mobile', '1', '$cur_date', '$cur_date')";
    mysql_query($registerCustomer);

    $registerUserCredential = "INSERT INTO UserLogin (UserNumber, UserName, Password, SystemLevel, CreatedBy, Timestamp, Status)
        VALUES ('$newCustomerId', '$email', AES_ENCRYPT('default','casellas'), '3', 'Customer', '$cur_date', '1')";
    mysql_query($registerUserCredential);
    //mysql_close($db_connect);

    $subject = $reason;
    $emailFrom = $email;
    $ccTo = "info@casellas.com.au";
    $emailTo = "admin@$domain";

    //Email to administrators
    $body = "<html>";
    $body .= "<body>";
    $body .= "<div>";

    $body .= "<h2>$reason</h2>";
    $body .= "<h3>New Member Details</h3>";
    $body .= "<p>";
    $body .= "<b>Member Name:</b> <em>$fullname</em><br/>";
    $body .= "<b>E-mail Address:</b> <em>$email</em><br/>";
    $body .= "<b>Address:</b> <em>$street $city, $state</em><br/>";
    $body .= "<b>Postal Code:</b> <em>$postal</em><br/>";
    $body .= "<b>Mobile no.:</b> <em>$mobile</em><br/>";
    $body .= "<b>Landline no.:</b> <em>$landline</em><br/>";
    $body .= "<b>Date of Birth:</b> <em>$bday</em><br/>";

    if ($dine == 'Yes') {
        $body .= "<b>Have you dine with us before?</b> <em>$dine</em><br/>";
        $body .= "<b>How did you rate your experience?</b> <em>$rate</em><br/>";
        $body .= "<b>Would you recommend us?</b> <em>$recommend</em><br/>";
        
        if ($recommend == 'No') {
            $body .= "<b>Reason why not recommend us:</b> <em>$recoreason</em><br/>";
        }
        
    } else {
        $body .= "<b>Have you dine with us before?</b> <em>$dine</em><br/>";
    }

    $body .= "</p>";

    $body .= "</div>";
    $body .= "</body>";
    $body .= "</html>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: $company<$emailFrom>\r\n";
    $headers .= "Cc: $ccTo\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $adminSent = mail($emailTo, $subject, $body, $headers);

    //Email to new VIP members
    $body = "<html>";
    $body .= "<body>";
    $body .= "<div>";

    $body .= "<p>Hi $fname,</p>";
    $body .= "<p>";
    $body .= "<strong>Welcome! You have successfully registered to our website, $company. </strong>";
    $body .= "</p>";    
    $body .= "<p>";
    $body .= "As a member, your are legible to join our VIP membership program which includes peridocal newsletters, offers
        and emails to the email address you provided during your registration.";
    $body .= "</p>";
    $body .= "<p>";
    $body .= "As a special birthday bonus to all our members, you will receive a Complimentary Meal* email prior to your birth month,
            which will be valid for when you book for you and your friends on your special day, as this amazing offer, we will keep you up to date
            with exclusive news and events.";
    $body .= "</p>";
    $body .= "<p>";
    $body .= "You are free to opt out of this at any time by clicking
        <a href='http://www.casellas.com.au/index.php?pg=unsubscribe' target='_blank'>unsubscribe me.</a>";
    $body .= "</p>";
    $body .= "<p>";
    $body .= "Should you have any questions you want to clarify, please do not hesitate to communicate with us via
        email <a href='mailto:info@casellas.com.au'>info@casellas.com.au</a>.";
    $body .= "</p>";
    $body .= "<p>";
    $body .= "Thank you and we look forward to seeing you again soon!,<br/><br/>";
    $body .= "The Team @ Casellas - Wine - Tapas - Grill";
    $body .= "</p>";
    $body .= "</div>";
    $body .= "</body>";
    $body .= "</html>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: $company<$emailTo>\r\n";
    $headers .= "Cc: $ccTo\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $memberSent = mail($email, $subject, $body, $headers);

    if ($adminSent == false && $memberSent == false) {
        echo "<img src='images/result-error.jpg'/><br/>";
        echo "<span class='error'>There is an error in your registration. Please try again!</span>";
    } else {
        echo "<img src='images/result-success.jpg'/><br/>";
        echo "<span class='success'>VIP Registration - Success!</span>";
    }
} else {
    echo "<img src='images/result-error.jpg'/><br/>";
    echo "<span class='error'>Sorry! You're a registered member already.</span>";
}