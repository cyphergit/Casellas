<?php

include '../../conf.inc.php';
include '../includes/cypher_functions.php';
include '../class/ImageResize.php';

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$vOccasion = trim(addslashes($_POST['selVOccasion']));
$vName = trim(addslashes($_POST['txtVName']));
$vContent = trim(addslashes($_POST['txtVContent']));
$vOrientation = trim(addslashes($_POST['txtVOrientation']));
$vContentAlign = trim(addslashes($_POST['txtVCAlignment']));

$vImageFile = $_POST['imageFile'];
$vUpdatedImgFile = $_POST['txtUpdateImgFile'];
$vUploadConfirm = $_POST['txtUploadFile'];

$thumbLocation = "images/voucher/thumbs";
$fileLocation = "images/voucher";

$cur_date = date("y-m-d h:m:s");

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";
$thumb_path = "../../$thumbLocation/";

//CALL PROCESS
switch ($process) {
    case "Add":
        $sql = "SELECT VoucherTemplateID FROM IDCounters";

        $newid = getIdCount($sql);
        $newid = str_pad($newid, 3, "0", STR_PAD_LEFT);

        $new_vid = "V" . $newid;

        $filename = basename($_FILES['uploadedfile']['name']);
        $fileExt = getFileExtension($filename);

        $newFilename = "V" . $newid . "." . $fileExt;

        $target_path = $target_path . $newFilename;
        $thumb_path = $thumb_path . $newFilename;

        $fileaccess = $target_path;
        $thumbfileaccess = $thumb_path;

        if (file_exists($target_path) && file_exists($thumb_path)) {
            unlink($target_path) or die("error");
            unlink($thumb_path) or die("error");
        }

        if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

            if (!copy($target_path, $thumb_path)) {
                echo "Failed to copy $newFilename to gallery thumbnail folder";
            }

            list($width, $height) = getimagesize($thumb_path);

            $thumbfileResize = new ResizeImage();
            $thumbfileResize->load($thumb_path);

            if ($width > $height) {
                $thumbfileResize->resizeToWidth(230);
            } else {
                $thumbfileResize->resizeToHeight(230);
            }

            $thumbfileResize->save($thumb_path);

            chmod($fileaccess, 0644);
            chmod($thumbfileaccess, 0644);

            mysql_query("UPDATE IDCounters SET VoucherTemplateID = '$newid'");

            mysql_query("INSERT INTO Vouchers (VoucherTemplateID, Occasion, VoucherName, VoucherContent, VoucherContentAlignment, TemplateOrientation, TemplateFile, TemplateLocation, TemplateThumbLoc, Status)
                        VALUES ('$new_vid', '$vOccasion', '$vName', '$vContent', '$vContentAlign', '$vOrientation', '$newFilename', '$fileLocation', '$thumbLocation', '1')") or die(mysql_error());

            echo "<script type='text/javascript'>alert('A new Voucher was successfully created!');window.location='$site_host/admin/index.php?pg=voucher'</script>";
        } else {
            echo "<script type='text/javascript'>alert('There was an error uploading the file, please check the file size and try again!');window.location='$site_host/admin/index.php?pg=voucher'</script>";
        }

        break;

    case "Update":
        if ($vUploadConfirm == 1) {

            $target_path = $target_path . $vUpdatedImgFile;
            $thumb_path = $thumb_path . $vUpdatedImgFile;

            if (file_exists($target_path) && file_exists($thumb_path)) {
                unlink($target_path) or die("error");
                unlink($thumb_path) or die("error");
            }

            $filename = basename($_FILES['uploadedfile']['name']);
            $fileExt = getFileExtension($filename);

            if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

                if (!copy($target_path, $thumb_path)) {
                    echo "Failed to copy $newFilename to gallery thumbnail folder";
                }

                list($width, $height) = getimagesize($thumb_path);

                $thumbfileResize = new ResizeImage();
                $thumbfileResize->load($thumb_path);

                if ($width > $height) {
                    $thumbfileResize->resizeToWidth(230);
                } else {
                    $thumbfileResize->resizeToHeight(230);
                }

                $thumbfileResize->save($thumb_path);

                $file_target = "../../$fileLocation/$vImageFile";
                $thumb_target = "../../$thumbLocation/$vImageFile";

                chmod($file_target, 0644);
                chmod($thumb_target, 0644);

                mysql_query("UPDATE Vouchers
                      SET VoucherName = '$vName', Occasion = '$vOccasion', VoucherContent = '$vContent', VoucherContentAlignment = '$vContentAlign'
                        , TemplateOrientation = '$vOrientation', TemplateFile = '$vUpdatedImgFile', TemplateLocation = '$fileLocation', TemplateThumbLoc = '$thumbLocation'
                        WHERE VoucherTemplateID = '$entryID'") or die(mysql_error());

                echo "<script type=\"text/javascript\">alert(\"Voucher Successfully Updated!\");window.location=\"$site_host/admin/index.php?pg=voucher\"</script>";
            } else {
                echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=voucher\"</script>";
            }
        } else {

            mysql_query("UPDATE Vouchers
                  SET VoucherName = '$vName', Occasion = '$vOccasion', VoucherContent = '$vContent', VoucherContentAlignment = '$vContentAlign'
                    , TemplateOrientation = '$vOrientation', TemplateFile = '$vUpdatedImgFile', TemplateLocation = '$fileLocation', TemplateThumbLoc = '$thumbLocation'
                    WHERE VoucherTemplateID = '$entryID'") or die(mysql_error());
        }

        echo "<script type=\"text/javascript\">alert(\"Voucher Successfully Updated!\");window.location=\"$site_host/admin/index.php?pg=voucher\"</script>";

        break;

    case "Delete":
        $q = "SELECT TemplateFile FROM Vouchers WHERE VoucherTemplateID = '$entryID'";

        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $vDeleteImgFile = $row[0];

        $target_path = $target_path . $vDeleteImgFile;
        $thumb_path = $thumb_path . $vDeleteImgFile;

        if (file_exists($target_path) && file_exists($thumb_path)) {
            unlink($target_path) or die("error");
            unlink($thumb_path) or die("error");
        }

        mysql_query("DELETE FROM Vouchers WHERE VoucherTemplateID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Voucher Deleted!\");window.location=\"../index.php?pg=voucher\"</script>";

        break;
}