<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$pName = form($_POST['txtFName']);
$pDesc = nl2br($_POST['txtFDesc']);
$pDocFile = form($_POST['docFile']);
$pUpdatedDocFile = form($_POST['txtUpdateDocFile']);

$pUploadConfirm = form($_POST['NewFile']);

$fileLocation = "downloadables";

$cur_date = date("y-m-d h:m:s");

//STORAGE FILE LOCATION
$target_path = "../../downloadables/";

//CALL PROCESSES
switch ($process) {
    case "Add":
        $sql = "SELECT FileID FROM IDCounters";

        $newid = getIdCount($sql);

        $filename = basename($_FILES['uploadedfile']['name']);
        $fileExt = getFileExtension($filename);

        $newFilename = date("mdyhis");
        $newFilename = $newid . "_" . $newFilename . "." . $fileExt;

        $target_path = $target_path . $newFilename;

        if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            mysql_query("UPDATE IDCounters SET FileID = '$newid'");

            mysql_query("INSERT INTO downloadables (FileID,Filename,FileTitle,FileDesc,FileLocation,Status,DateAdded) VALUES ('F$newid','$newFilename','$pName','$pDesc','$fileLocation','1','$cur_date')") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"File Successfully Added!\");window.location=\"$site_host/admin/index.php?pg=downloads\"</script>";
        } else {

            echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=downloads_create\"</script>";
        }

        break;

    case "Update":
        if ($pUploadConfirm == "1") {

            $target_path = $target_path . $pUpdatedDocFile;

            unlink($target_path) or die("error");

            $filename = basename($_FILES['uploadedfile']['name']);
            $fileExt = getFileExtension($filename);

            $newFilename = $pUpdatedDocFile . "." . $fileExt;

            if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

                mysql_query("UPDATE Downloadables 
                           SET FileTitle  = '$pName'
                           , FileDesc     = '$pDesc'
                           , Filename     = '$pUpdatedDocFile'
                           WHERE FileID = '$entryID'") or die(mysql_error());
            } else {
                echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=downloads\"</script>";
            }
        } else {

            mysql_query("UPDATE Downloadables 
                    SET FileTitle = '$pName'
                      , FileDesc = '$pDesc'
                      , Filename = '$pUpdatedDocFile'
                    WHERE FileID = '$entryID'") or die(mysql_error());
        }

        mysql_close($db_connect); // Closes the connection.          

        break;

    case "Delete":
        $target_path = $target_path . $pDocFile;

        unlink($target_path) or die("error");

        mysql_query("DELETE FROM Downloadables WHERE FileID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"File Deleted!\");window.location=\"$site_host/admin/index.php?pg=downloads\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>