<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');
include('../class/ImageResize.php');

$process = $_POST['Process'];

$pName = trim(addslashes($_POST['txtPName']));
$pBrand = form($_POST['selPBrand']);
//$pDesc = addslashes(nl2br($_POST['txtPDesc']));
$pDesc = trim(addslashes($_POST['txtPDesc']));
$pCategory = form($_POST['selPCategory']);
$pSubcategory = form($_POST['selPSubcategory']);
$pQuantity = form($_POST['txtPQuantity']);
$pPrice = form($_POST['txtPPrice']);
$pDiscount = form($_POST['txtPDiscount']);

$entryID = $_POST['EntryID'];
$fileLocation = "images_products";
$cur_date = date("y-m-d h:m:s");
$confirmation = $_POST['txtUploadFile'];

//STORAGE FILE LOCATION
$target_path = "../../$fileLocation/";

//CALL PROCESS
switch ($process) {
    case "Add":
        $sql = "SELECT ProductID FROM IDCounters";
        $newid = getIdCount($sql);

        $b_sql = "SELECT BrandCode FROM Brand WHERE BrandID = '$pBrand'";
        $b_rs = mysql_query($b_sql);
        $b_row = mysql_fetch_array($b_rs);
        $code = $b_row[0];
        $new_pid = $code . "P" . $newid;

        if ($confirmation == "1") {

            $filename = basename($_FILES['uploadedfile']['name']);
            $fileExt = getFileExtension($filename);
            $newFilename = $code . "P" . $newid . "." . $fileExt;
            $target_path = $target_path . $newFilename;

            if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

                $file_target = "../../$fileLocation/$newFilename";
                chmod($file_target, 0644);

                //RESIZE TO LOGO SIZE
                list($width, $height) = getimagesize($file_target);

                $origfileResize = new ResizeImage();
                $origfileResize->load($file_target);

                if ($width > $height) {
                    //AUTO HEIGHT
                    $origfileResize->resizeToWidth(640);
                } else {
                    //AUTO WIDTH
                    $origfileResize->resizeToHeight(640);
                }

                $origfileResize->save($file_target);

                mysql_query("UPDATE IDCounters SET ProductID = '$newid'");

                mysql_query("INSERT INTO Product (ProductID, BrandID, ProductName, ProductImage, FileLocation, Description, CategoryID, SubCategoryID, Quantity, Price, Discount, Status)
                VALUES ('$new_pid', '$pBrand', '$pName', '$newFilename', '$fileLocation', '$pDesc', '$pCategory', '$pSubcategory', '$pQuantity', '$pPrice', '$pDiscount', '1')") or die(mysql_error());

                echo "<script type=\"text/javascript\">alert(\"A new Product was successfully added!\");window.location=\"$site_host/admin/index.php?pg=products&p=c\"</script>";
            } else {
                echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=products&p=c\"</script>";
            }
        } else {

            mysql_query("UPDATE IDCounters SET ProductID = '$newid'");

            mysql_query("INSERT INTO Product (ProductID, BrandID, ProductName, ProductImage, FileLocation, Description, CategoryID, SubCategoryID, Quantity, Price, Discount, Status)
              VALUES ('$new_pid', '$pBrand', '$pName', '$newFilename', '$fileLocation', '$pDesc', '$pCategory', '$pSubcategory', '$pQuantity', '$pPrice', '$pDiscount', '1')") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"A new Product was successfully added!\");window.location=\"$site_host/admin/index.php?pg=products&p=c\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":
        $q = "SELECT ProductImage FROM Product WHERE ProductID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $productImage = $row[0];

        $b_sql = "SELECT BrandCode FROM Brand WHERE BrandID = '$pBrand'";
        $b_rs = mysql_query($b_sql);
        $b_row = mysql_fetch_array($b_rs);
        $code = $b_row[0];

        if ($confirmation == "1") {

            if ($productImage == null || $productImage == "") {
                $newid = $entryID;
                $filename = basename($_FILES['uploadedfile']['name']);
                $fileExt = getFileExtension($filename);
                $newFilename = $code . "P" . $newid . "." . $fileExt;
                $target_path = $target_path . $newFilename;

                if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {

                    $file_target = "../../$fileLocation/$newFilename";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(640);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(640);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=products&p=c\"</script>";
                }
            } else {
                //REMOVE EXISTING IMAGE
                $deleteImage = $productImage;
                $target_path = $target_path . $deleteImage;
                unlink($target_path) or die("error");

                //COPY NEW PRODUCT IMAGE
                $newid = $entryID;
                $filename = basename($_FILES['uploadedfile']['name']);
                $fileExt = getFileExtension($filename);
                $newFilename = $newid . "." . $fileExt;
                $target_path = "../../$fileLocation/";
                $target_path = $target_path . $newFilename;

                if (rename($_FILES['uploadedfile']['tmp_name'], $target_path)) {
                    $file_target = "../../$fileLocation/$newFilename";
                    chmod($file_target, 0644);

                    //RESIZE TO LOGO SIZE
                    list($width, $height) = getimagesize($file_target);

                    $origfileResize = new ResizeImage();
                    $origfileResize->load($file_target);

                    if ($width > $height) {
                        //AUTO HEIGHT
                        $origfileResize->resizeToWidth(640);
                    } else {
                        //AUTO WIDTH
                        $origfileResize->resizeToHeight(640);
                    }

                    $origfileResize->save($file_target);
                } else {
                    echo "<script type=\"text/javascript\">alert(\"There was an error uploading the file, please check the file size and try again!\");window.location=\"$site_host/admin/index.php?pg=products&p=u\"</script>";
                }
            }

            mysql_query("UPDATE Product SET ProductName = '$pName', BrandID = '$pBrand', Description = '$pDesc', CategoryID = '$pCategory', SubcategoryID = '$pSubcategory', Quantity = '$pQuantity', Price = '$pPrice', 
              Discount = '$pDiscount', ProductImage = '$newFilename', FileLocation = '$fileLocation' WHERE ProductID = '$entryID'") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"Product Successfully Updated!\");window.location=\"$site_host/admin/index.php?pg=products\"</script>";
        } else {

            mysql_query("UPDATE Product SET ProductName = '$pName', BrandID = '$pBrand', Description = '$pDesc', CategoryID = '$pCategory', SubcategoryID = '$pSubcategory', Quantity = '$pQuantity', Price = '$pPrice', 
              Discount = '$pDiscount', ProductImage = '$productImage', FileLocation = '$fileLocation' WHERE ProductID = '$entryID'") or die(mysql_error());

            echo "<script type=\"text/javascript\">alert(\"Product Successfully Updated!\");window.location=\"$site_host/admin/index.php?pg=products\"</script>";
        }

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        $q = "SELECT ProductImage FROM Product WHERE ProductID = '$entryID'";
        $rs = mysql_query($q) or die(mysql_error());
        $row = mysql_fetch_array($rs);

        $deleteImage = $row[0];
        $target_path = $target_path . $deleteImage;
        unlink($target_path) or die("error");

        //mysql_query("UPDATE Product SET Status = '2' WHERE ProductID = '$entryID'") or die (mysql_error());

        mysql_query("DELETE FROM Product WHERE ProductID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Product Deleted!\");window.location=\"$site_host/admin/index.php?pg=products\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>