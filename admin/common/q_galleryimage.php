<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');
include('../class/ImageResize.php');

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$pImageFile = form($_POST['imageFile']);

$fileLocation = "original";
$fileThumbLoc = "thumbs";

$cur_date = date("y-m-d h:m:s");

//STORAGE FILE LOCATION
$target_path = "../../images/gallery/$fileLocation/";
$thumb_path = "../../images/gallery/$fileThumbLoc/";

//CALL PROCESSES
switch ($process) {
    case "Add":
        $lastid = "SELECT ImageID FROM IDCounters";

        $newid = getIdCount($lastid);
        $newid = str_pad($newid, 3, "0", STR_PAD_LEFT);

        $filename = basename($_FILES['uploadedfile']['name']);
        $fileExt = getFileExtension($filename);

        $newFilename = "gallery";
        $newFilename = $newFilename . "-" . $newid . "." . $fileExt;

        $target_path = $target_path . $newFilename;
        $thumb_path = $thumb_path . $newFilename;

        if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            if (!copy($target_path, $thumb_path)) {
                echo "Failed to copy $newFilename to gallery thumbnail folder";
            }

            //RESIZE TO ORIGINAL IMAGE REQUIRED SIZE
            list($width, $height) = getimagesize($target_path);

            $origfileResize = new ResizeImage();
            $origfileResize->load($target_path);

            chmod($target_path, 0644);

            if ($width > $height) {
                $origfileResize->resizeToWidth(600);
            } else {
                $origfileResize->resizeToHeight(600);
            }

            $origfileResize->save($target_path);

            //RESIZE ORIGINAL IMAGE TO THUMBNAIL
            $thumbfileResize = new ResizeImage();
            $thumbfileResize->load($thumb_path);
            $thumbfileResize->resize(150, 100);
            $thumbfileResize->save($thumb_path);

            chmod($thumb_path, 0644);

            //STORE TO DATABASE
            mysql_query("BEGIN");

            $query1 = "UPDATE IDCounters SET ImageID = '$newid'";
            $exec_query1 = mysql_query($query1);

            $query2 = "INSERT INTO Gallery (ImageID, FileName, FileOrigLoc, FileThumbLoc, DateAdded, Status)";
            $query2 .= "VALUES ('$newid', '$newFilename', '$fileLocation', '$fileThumbLoc', '$cur_date', '1')";
            $exec_query2 = mysql_query($query2);

            if (($exec_query1) && ($exec_query2)) {

                mysql_query("COMMIT");
                echo "<script type='text/javascript'>alert('Image Successfully Added!');window.location='$site_host/admin/index.php?pg=gallery'</script>";
            } else {

                mysql_query("ROLLBACK");

                $target_path = $target_path . $pImageFile;
                $thumb_path = $thumb_path . $pImageFile;

                unlink($target_path) or die("Error: File Not Existing in Gallery Original folder!");
                unlink($thumb_path) or die("Error: File Not Existing in Gallery Thumbs folder!");

                die("Database Error!") or die(mysql_error());
            }

            mysql_close($db_connect); // Closes the connection.
        } else {

            echo "<script type='text/javascript'>alert('There was an error uploading the file, please check the file size and try again!');window.location='$site_host/admin/index.php?pg=gallery_image_upload'</script>";
        }

        break;

    case "Delete":
        $target_path = $target_path . $pImageFile;
        $thumb_path = $thumb_path . $pImageFile;

        unlink($target_path) or die("Error: File Not Existing in Gallery Original folder!");
        unlink($thumb_path) or die("Error: File Not Existing in Gallery Thumbs folder!");

        mysql_query("DELETE FROM Gallery WHERE ImageID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Image File Deleted!\");window.location=\"$site_host/admin/index.php?pg=gallery\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>