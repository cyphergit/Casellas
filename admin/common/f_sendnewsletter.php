<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$mailAll = $_POST['txtCMailingList'];
$mailSpecific = $_POST['txtMembersEmail'];
$mailOption = $_POST['txtMailingVal'];
$mailNewsletter = $_POST['selNewsletter'];
$cur_date = date("F Y");
$cur_year = date("Y");

if ($mailOption == "1") {
    $emailTo = $mailAll;
} else {
    $emailTo = $mailSpecific;
}

$sql = "SELECT Newsletter.NewsletterName, NewsletterItem.Title, NewsletterArticle.ArticleContent, NewsletterArticle.ArticleID
          FROM Newsletter, NewsletterItem, NewsletterArticle
          WHERE Newsletter.NewsletterID = NewsletterItem.NewsletterID
          AND NewsletterItem.Title = NewsletterArticle.ArticleTitle
          AND Newsletter.NewsletterName = '$mailNewsletter'
          ORDER BY NewsletterArticle.ArticleID DESC";

$rs = mysql_query($sql);
//$row = mysql_fetch_array($rs);
//$emailFrom = 'admin@casellas.com.au';
$emailFrom = "newsletter@$domain";
$subject = "$company: Newsletter";

$body = "<html>";
$body .= "<head>";
$body .= "</head>";
$body .= "<body style='background-color: #fff; color: #000; font-size: 12px; font-family: Calibri;'>";
$body .= "<table style='width: 600px; border: solid 1px #ccc;'>";
$body .= "<tr>";
$body .= "<td>";
$body .= "<div style='background-color: #746761; border-bottom: solid 1px #332c2a; padding: 0px 8px 8px 8px;'>";
$body .= "<a href='$site_host' title='$site_host/' style='border: none; color: #7e7e7e;'>";
$body .= "<img src='$site_host/images/nletter_heading2.gif' alt='$company' title='$company' style='border: none;'/>";
$body .= "</a>";
$body .= "</div>";
$body .= "<div style='min-height: 500px; padding: 8px 8px 8px 18px; margin-bottom: 8px;'>";
$body .= "<div style='border-bottom: solid 1px #999; padding: 0px 0px 4px 0px;'>";
$body .= "<h2 style='margin-top: 0px; margin-bottom: 4px; color: #332c2a;'>$mailNewsletter</h2>";
$body .= "<span style='color: #000;'><em>$company Member | $cur_date</em></span>";
$body .= "</div>";

while ($row = mysql_fetch_array($rs)) {

    $aTitle = $row[1];
    $aContent = $row[2];
    $aID = $row[3];
    $aContent = stripslashes($aContent);

    $body .= "<div style='padding-bottom: 4px;border-bottom: dotted 1px #ccc;'>";
    $body .= "<h1 style='color: #332c2a;'>";
    $body .= "<a href='$site_host/index.php?pg=article&aid=$aID' target='_blank' title='$aTitle' style='color: #332c2a; text-decoration: none;'>$aTitle</a>";
    $body .= "</h1>";

    $body .= "<p style='text-align: justify;'>$aContent <a href='$site_host/index.php?pg=article&aid=$aID' target='_blank' title='$aTitle' style='font-weight: bold;'>Read More</a></p>";

    $body .= "</div>";
}

$body .= "</div>";
$body .= "<div style='background-color: #746761; color: #fff; border-top: dotted 1px #999;'>";
$body .= "<div style='padding: 8px 8px 4px 8px;'>";
$body .= "To unsubscribe from future emails, please click here <a href='$site_host/index.php?pg=unsubscribe' title='Unsubscribe Here' style='color: #fff;'>here</a>.";
$body .= "</div>";
$body .= "<div style='padding: 8px 8px 8px 8px;'>";
$body .= "© $cur_year $company. All Rights Reserved.";
$body .= "</div>";
$body .= "</div>";
$body .= "</td>";
$body .= "</tr>";
$body .= "<table>";
$body .= "</body>";
$body .= "</html>";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: $company<$emailFrom>\r\n";
$headers .= "Bcc: $emailTo\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$emailSent = mail("Undisclosed Recipient<no-reply@$domain>", $subject, $body, $headers);

if (!$emailSent) {
    echo "<script type='text/javascript'>alert('Error encountered sending newsletter. Please try again!'); window.location='../index.php?pg=newsletter_send'</script>";
} else {
    echo "<script type='text/javascript'>alert('$company - Newsletter Sent!'); window.location='../index.php?pg=newsletter_send'</script>";
}
?>