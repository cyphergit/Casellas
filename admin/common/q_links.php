<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');
include('../class/ImageResize.php');

$process = $_POST['Process'];

$lName = trim(addslashes($_POST['txtLName']));
$lCode = form($_POST['txtLCode']);
//$lDesc = addslashes(nl2br($_POST['txtLDesc']));
$lDesc = trim(addslashes($_POST['txtLDesc']));
$lWebsite = form($_POST['txtLWebsite']);

$entryID = $_POST['EntryID'];
$fileLocation = "link_logo";
$cur_date = date("y-m-d h:m:s");
$confirmation = $_POST['txtLogoUpdate'];

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";

//CALL PROCESS
switch ($process) {
    case "Add":
        if ($confirmation == "1") {
            $logoName = $lCode;
            $filename = basename($_FILES['linkLogo']['name']);
            $fileExt = getFileExtension($filename);
            $newLogoName = "m-" . $lCode . "." . $fileExt;
            $target_path = $target_path . $newLogoName;

            if (rename($_FILES['linkLogo']['tmp_name'], $target_path)) {
                $file_target = "../../$fileLocation/$newLogoName";
                chmod($file_target, 0644);

                //RESIZE TO LOGO SIZE
                list($width, $height) = getimagesize($file_target);

                $origfileResize = new ResizeImage();
                $origfileResize->load($file_target);

                if ($width > $height) {
                    //AUTO HEIGHT
                    $origfileResize->resizeToWidth(102);
                } else {
                    //AUTO WIDTH
                    $origfileResize->resizeToHeight(70);
                }

                $origfileResize->save($file_target);

                mysql_query("INSERT INTO Link (LinkName, LinkCode, Description, Status, LinkURL, LinkLogo, LogoLocation)
                  VALUES ('$lName','$lCode','$lDesc','1','$lWebsite','$newLogoName','$fileLocation')") or die(mysql_error());

                echo "<script type=\"text/javascript\">alert(\"A new Link was successfully created!\");window.location=\"$site_host/admin/index.php?pg=link\"</script>";
            } else {
                echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=link&p=c\"</script>";
            }
        } else {
            mysql_query("INSERT INTO Link (LinkName, LinkCode, Description, Status, LinkURL, LinkLogo, LogoLocation)
                  VALUES ('$lName','$lCode','$lDesc','1','$lWebsite','$newLogoName','$fileLocation')") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"A new Link was successfully created!\");window.location=\"$site_host/admin/index.php?pg=link\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":
        $q = "SELECT LinkLogo FROM Link WHERE LinkID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $linkLogo = $row[0];

        if ($confirmation == "1") {

            if ($linkLogo == null || $linkLogo == "") {
                $logoName = $bCode;
                $filename = basename($_FILES['linkLogo']['name']);
                $fileExt = getFileExtension($filename);
                $newLogoName = "m-" . $lCode . "." . $fileExt;
                $target_path = $target_path . $newLogoName;

                if (rename($_FILES['linkLogo']['tmp_name'], $target_path)) {
                    $file_target = "../../$fileLocation/$newLogoName";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(102);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(70);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=link&amp;p=c\"</script>";
                }
            } else {
                //REMOVE EXISTING LOGO
                $deleteLogo = $linkLogo;
                $target_path = $target_path . $deleteLogo;
                unlink($target_path) or die("error");

                //COPY NEW LOGO
                $logoName = $lCode;
                $filename = basename($_FILES['linkLogo']['name']);
                $fileExt = getFileExtension($filename);
                $newLogoName = "m-" . $logoName . "." . $fileExt;
                $target_path = "../../$fileLocation/";
                $target_path = $target_path . $newLogoName;

                if (rename($_FILES['linkLogo']['tmp_name'], $target_path)) {
                    $file_target = "../../$fileLocation/$newLogoName";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(102);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(70);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=link&amp;p=c\"</script>";
                }
            }

            mysql_query("UPDATE Link SET LinkName = '$lName', Description = '$lDesc', LinkURL = '$lWebsite', LinkLogo = '$newLogoName', LogoLocation = '$fileLocation' WHERE LinkID = '$entryID'") or die(mysql_error());
            echo "<script type=\"text/javascript\">alert(\"Link was successfully updated!\");window.location=\"$site_host/admin/index.php?pg=link\"</script>";
        } else {

            mysql_query("UPDATE Link SET LinkName = '$lName', Description = '$lDesc', LinkURL = '$lWebsite', LinkLogo = '$newLogoName', LogoLocation = '$fileLocation' WHERE LinkID = '$entryID'") or die(mysql_error());
            echo "<script type=\"text/javascript\">alert(\"Link was successfully updated!\");window.location=\"$site_host/admin/index.php?pg=link\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        $q = "SELECT LinkLogo FROM Link WHERE LinkID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $deleteLogo = $row[0];
        $target_path = $target_path . $deleteLogo;
        unlink($target_path) or die("error");

        //mysql_query("UPDATE Link SET Status = '2' WHERE LinkID = '$entryID'") or die (mysql_error());

        mysql_query("DELETE FROM Link WHERE LinkID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Link Deleted!\");window.location=\"$site_host/admin/index.php?pg=link\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>