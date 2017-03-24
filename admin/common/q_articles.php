<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];

$aTitle = trim(addslashes($_POST['txtATitle']));
$aContent = trim(addslashes($_POST['txtAContent']));
$aAuthor = $_POST['txtAAuthor'];

$entryID = $_POST['EntryID'];

$cur_date = date("y-m-d h:m:s");

switch ($process) {
    case "Add":
        $sql = "SELECT ArticleID FROM IDCounters";

        $newid = getIdCount($sql);

        mysql_query("UPDATE IDCounters SET ArticleID = '$newid'");

        mysql_query("INSERT INTO NewsletterArticle (ArticleID, ArticleTitle, ArticleContent, ArticleAuthor, DatePublished, Status)
                VALUES ('A$newid','$aTitle','$aContent','$aAuthor',now(),'1')") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"A new Article was successfully created!\");window.location=\"../index.php?pg=articles\"</script>";

        break;

    case "Update":
        mysql_query("UPDATE NewsletterArticle SET ArticleTitle = '$aTitle', ArticleAuthor = '$aAuthor', ArticleContent = '$aContent', DatePublished = now() WHERE ArticleID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Article Successfully Updated!\");window.location=\"../index.php?pg=articles\"</script>";

        break;

    case "Delete":
        mysql_query("UPDATE NewsletterArticle SET Status = '2' WHERE ArticleID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Article Deleted!\");window.location=\"../index.php?pg=articles\"</script>";

        break;
}
?>