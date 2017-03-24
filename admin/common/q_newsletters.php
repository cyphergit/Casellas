<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];
$nTitle = trim(addslashes($_POST['txtNTitle']));
$nItemCount = $_POST['icounter'];
$entryID = $_POST['EntryID'];
$cur_date = date("y-m-d h:m:s");

switch ($process) {
    case "Add":
        $sql = "SELECT NewsletterID FROM IDCounters";

        $newid = getIdCount($sql);

        mysql_query("UPDATE IDCounters SET NewsletterID = '$newid'");

        mysql_query("INSERT INTO Newsletter (NewsletterID, NewsletterName, Status)
                VALUES ('N$newid','$nTitle','1')") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"A new Newsletter was successfully created!\");window.location=\"../index.php?pg=newsletter\"</script>";

        break;

    case "Update":
        mysql_query("UPDATE Newsletter SET NewsletterName = '$nTitle' WHERE NewsletterID = '$entryID'") or die(mysql_error());

        $rs_nitem = mysql_query("SELECT * FROM NewsletterItem WHERE NewsletterID = '$entryID'") or die(mysql_error());
        $iCount = mysql_num_rows($rs_nitem);

        if ($iCount == 0) {

            for ($i = 1; $i <= $nItemCount; $i++) {

                if (isset($_REQUEST["txtArticle$i"])) {
                    $itemVal = $_REQUEST["txtArticle$i"];
                }
                mysql_query("INSERT INTO NewsletterItem (NewsletterID, Type, Title) VALUE ('$entryID','Article','$itemVal')") or die(mysql_error());
            }
        } else {

            mysql_query("DELETE FROM NewsletterItem WHERE NewsletterID = '$entryID'") or die(mysql_error());

            for ($i = 1; $i <= $nItemCount; $i++) {

                if (isset($_REQUEST["txtArticle$i"])) {
                    $itemVal = $_REQUEST["txtArticle$i"];
                }
                mysql_query("INSERT INTO NewsletterItem (NewsletterID, Type, Title) VALUE ('$entryID','Article','$itemVal')") or die(mysql_error());
            }
        }

        echo "<script type=\"text/javascript\">alert(\"Newsletter Updated!\");window.location=\"../index.php?pg=newsletter\"</script>";

        break;

    case "Delete":
        mysql_query("UPDATE Newsletter SET Status = '2' WHERE NewsletterID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Newsletter Deleted!\");window.location=\"../index.php?pg=newsletter\"</script>";

        break;
}
?>