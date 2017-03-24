<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');
include('../class/ImageResize.php');

$process = $_POST['Process'];

$bName = trim(addslashes($_POST['txtBName']));
$bCode = form($_POST['txtBCode']);
//$bDesc = addslashes(nl2br($_POST['txtBDesc']));
$bDesc = trim(addslashes($_POST['txtBDesc']));
$bSideLinkText = form($_POST['txtBSideLinkText']);
$bSideLinkURL = form($_POST['txtBSideLinkURL']);
$bWebsite = form($_POST['txtBWebsite']);

$entryID = $_POST['EntryID'];
$fileLocation = "brand_logo";
$cur_date = date("y-m-d h:m:s");
$confirmation = $_POST['txtLogoUpdate'];

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";

//CALL PROCESS
switch ($process) {
    case "Add":
        if ($confirmation == "1") {
            $logoName = $bCode;
            $filename = basename($_FILES['brandLogo']['name']);
            $fileExt = FetchExtension($filename);
            $newLogoName = "logo-" . $bCode . "." . $fileExt;
            $target_path = $target_path . $newLogoName;

            if (rename($_FILES['brandLogo']['tmp_name'], $target_path)) {
                $file_target = "../../$fileLocation/$newLogoName";
                chmod($file_target, 0644);

                //RESIZE TO LOGO SIZE
                list($width, $height) = getimagesize($file_target);

                $origfileResize = new ResizeImage();
                $origfileResize->load($file_target);

                if ($width > $height) {
                    //AUTO HEIGHT
                    $origfileResize->resizeToWidth(140);
                } else {
                    //AUTO WIDTH
                    $origfileResize->resizeToHeight(140);
                }

                $origfileResize->save($file_target);

                mysql_query("INSERT INTO Brand (BrandName, BrandCode, Description, Status, SideLinkText, SideLinkURL, BrandWebsite, BrandLogo, LogoLocation)
                  VALUES ('$bName','$bCode','$bDesc','1','$bSideLinkText','$bSideLinkURL','$bWebsite','$newLogoName','$fileLocation')") or die(mysql_error());

                echo "<script type=\"text/javascript\">alert(\"A new Brand was successfully created!\");window.location=\"$site_host/admin/index.php?pg=brand\"</script>";
            } else {
                echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=brand&p=c\"</script>";
            }
        } else {
            mysql_query("INSERT INTO Brand (BrandName, BrandCode, Description, Status, SideLinkText, SideLinkURL, BrandWebsite, BrandLogo, LogoLocation)
                  VALUES ('$bName','$bCode','$bDesc','1','$bSideLinkText','$bSideLinkURL','$bWebsite','$newLogoName','$fileLocation')") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"A new Brand was successfully created!\");window.location=\"$site_host/admin/index.php?pg=brand\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":
        $q = "SELECT BrandLogo FROM Brand WHERE BrandID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $brandLogo = $row[0];

        if ($confirmation == "1") {

            if ($brandLogo == null || $brandLogo == "") {
                $logoName = $bCode;
                $filename = basename($_FILES['brandLogo']['name']);
                $fileExt = FetchExtension($filename);
                $newLogoName = "logo-" . $bCode . "." . $fileExt;
                $target_path = $target_path . $newLogoName;

                if (rename($_FILES['brandLogo']['tmp_name'], $target_path)) {
                    $file_target = "../../$fileLocation/$newLogoName";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(140);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(140);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=brand&amp;p=c\"</script>";
                }
            } else {
                //REMOVE EXISTING LOGO
                $deleteLogo = $brandLogo;
                $target_path = $target_path . $deleteLogo;
                unlink($target_path) or die("error");

                //COPY NEW LOGO
                $logoName = $bCode;
                $filename = basename($_FILES['brandLogo']['name']);
                $fileExt = FetchExtension($filename);
                $newLogoName = "logo-" . $logoName . "." . $fileExt;
                $target_path = "../../$fileLocation/";
                $target_path = $target_path . $newLogoName;

                if (rename($_FILES['brandLogo']['tmp_name'], $target_path)) {
                    $file_target = "../../$fileLocation/$newLogoName";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(140);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(140);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=brand&amp;p=c\"</script>";
                }
            }

            mysql_query("UPDATE Brand SET BrandName = '$bName', Description = '$bDesc', SideLinkText = '$bSideLinkText', SideLinkURL = '$bSideLinkURL', BrandWebsite = '$bWebsite', BrandLogo = '$newLogoName', LogoLocation = '$fileLocation' WHERE BrandID = '$entryID'") or die(mysql_error());
            echo "<script type=\"text/javascript\">alert(\"Brand was successfully updated!\");window.location=\"$site_host/admin/index.php?pg=brand\"</script>";
        } else {

            mysql_query("UPDATE Brand SET BrandName = '$bName', Description = '$bDesc', SideLinkText = '$bSideLinkText', SideLinkURL = '$bSideLinkURL', BrandWebsite = '$bWebsite', BrandLogo = '$brandLogo', LogoLocation = '$fileLocation' WHERE BrandID = '$entryID'") or die(mysql_error());
            echo "<script type=\"text/javascript\">alert(\"Brand was successfully updated!\");window.location=\"$site_host/admin/index.php?pg=brand\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        $q = "SELECT BrandLogo FROM Brand WHERE BrandID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $deleteLogo = $row[0];
        $target_path = $target_path . $deleteLogo;
        unlink($target_path) or die("error");

        //mysql_query("UPDATE Brand SET Status = '2' WHERE BrandID = '$entryID'") or die (mysql_error());

        mysql_query("DELETE FROM Brand WHERE BrandID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Brand Deleted!\");window.location=\"$site_host/admin/index.php?pg=brand\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>