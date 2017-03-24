<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');
include('../class/ImageResize.php');

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$pImageFile = form($_POST['imageFile']);

$fileLocation = "images_articles";

$cur_date = date("y-m-d h:m:s");

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";

//CALL PROCESSES
switch ($process) {
    case "Add":
        $newid = "article_img";

        $filename = basename($_FILES['uploadedfile']['name']);
        $fileExt = getFileExtension($filename);

        $newFilename = date("mdyhis");
        $newFilename = $newid . "_" . $newFilename . "." . $fileExt;

        $target_path = $target_path . $newFilename;

        $fileaccess = $target_path;

        if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            mysql_query("INSERT INTO NewsletterImage (ImageFile,ImageLocation) VALUES ('$newFilename','$fileLocation')") or die(mysql_error());

            //RESIZE TO ORIGINAL IMAGE REQUIRED SIZE
            list($width, $height) = getimagesize($target_path);

            $origfileResize = new ResizeImage();
            $origfileResize->load($target_path);

            chmod($fileaccess, 0644);

            if ($width > $height) {
                $origfileResize->resizeToWidth(200);
            } else {
                $origfileResize->resizeToHeight(200);
            }

            $origfileResize->save($target_path);

            echo "<script type=\"text/javascript\">alert(\"Image Successfully Added!\");window.location=\"../index.php?pg=newsletter_image\"</script>";
        } else {

            echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"../index.php?pg=newsletter_image_create\"</script>";
        }

        break;

    case "Delete":
        $target_path = $target_path . $pImageFile;

        unlink($target_path) or die("Error: File Not Existing!");

        mysql_query("DELETE FROM NewsletterImage WHERE ImageID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Image File Deleted!\");window.location=\"../index.php?pg=newsletter_image\"</script>";

        break;
}
?>