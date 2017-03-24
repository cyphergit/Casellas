<?php

include '../conf.inc.php';

$username = $_POST['email'];
$reason = "Unsubscribe";

$countUser = "SELECT COUNT(Email)  FROM Customers WHERE Email = '$username' AND NewsletterSubscription = '1'";
$countResult = mysql_fetch_array(mysql_query($countUser));

if ($countResult[0] == 1) {
    $updateCustomerInfo = "UPDATE Customers SET NewsletterSubscription = '0' WHERE Email = '$username'";
    mysql_query($updateCustomerInfo);

    $emailFrom = "admin@$domain";
    $emailTo = $username;
    $subject = "$company - $reason";

    $body = "<html>";
    $body .= "<body>";
    $body .= "<div>";

    $body .= "<h2>$company - $reason</h2>";
    $body .= "<p>";
    $body .= "Dear User,";
    $body .= "<br/><br/>";
    $body .= "<p>";
    $body .= "You have successfully unsubscribed to $company. If by any case you would like to subscribe back, ";
    $body .= "please feel free to email us by clicking <a href='mailto:$emailFrom'>here</a>.";
    $body .= "</p>";
    $body .= "Regards,<br/><br/>";
    $body .= "$company - Administrator";
    $body .= "</p>";

    $body .= "</div>";
    $body .= "</body>";
    $body .= "</html>";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: $company - $reason<no-reply@$domain>\r\n";
    //$headers .= "Bcc: $emailTo\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    $sent = mail($emailTo, $subject, $body, $headers);

    if ($sent == false) {
        ?>
        <img src='images/result-error.jpg'/><br/>
        <span class='error'>Error in unsubscribing. Please try it again.</span>
        <?php

    } else {
        ?>
        <img src='images/result-success.jpg'/><br/>
        <span class='success'>Your request was sent successfully. You may check your inbox for the details.</span>
        <?php

    }
} else {
    ?>
    <img src='images/result-error.jpg'/><br/>
    <span class='error'>You had already unsubscribe.</span>
    <?php

}