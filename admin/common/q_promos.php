<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$pName = form($_POST['txtPName']);
$pDesc = nl2br($_POST['txtPDesc']);
$pImageFile = $_POST['imageFile'];

$fileLocation = "images_promos";

$cur_date = date("y-m-d h:m:s");

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";

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

            mysql_query("INSERT INTO Promos (PromoName,PromoBanner,Description,FileLocation,Status) VALUES ('$pName','$newFilename','$pDesc','$fileLocation','1')") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"Promo Successfully Added!\");window.location=\"$site_host/admin/index.php?pg=promos\"</script>";
        } else {

            echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=promos_create\"</script>";
        }

        break;

    case "Update":
        mysql_query("UPDATE Promos 
                       SET PromoName = '$pName'
                       , Description = '$pDesc' 
                       WHERE PromoID = '$entryID'") or die(mysql_error());

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        $target_path = $target_path . $pImageFile;

        unlink($target_path) or die("error");

        mysql_query("DELETE FROM Promos WHERE PromoID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Promo Deleted!\");window.location=\"$site_host/admin/index.php?pg=promos\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>