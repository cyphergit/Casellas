<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];

$sCName = form($_POST['txtSCName']);
$cName = form($_POST['selCategory']);
$sCDesc = trim(addslashes($_POST['txtSCDesc']));

$entryID = $_POST['EntryID'];

$cur_date = date("y-m-d h:m:s");

switch ($process) {
    case "Add":
        $sql = "SELECT SubcategoryID FROM IDCounters";

        $newid = getIdCount($sql);

        mysql_query("UPDATE IDCounters SET SubcategoryID = '$newid'");

        mysql_query("INSERT INTO Product_Subcategory (SubCategoryID, SubCategoryName, CategoryID, Description, Status)
                VALUES ('SC0$newid','$sCName','$cName','$sCDesc','1')") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"A new Product Subcategory was successfully created!\");window.location=\"$site_host/admin/index.php?pg=subcategory\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":
        mysql_query("UPDATE Product_Subcategory SET
                          SubCategoryName = '$sCName',
                          CategoryID = '$cName',
                          Description = '$sCDesc'
                       WHERE SubCategoryID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Subcategory Updated!\");window.location=\"$site_host/admin/index.php?pg=subcategory\"</script>";
        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        mysql_query("UPDATE Product_Subcategory SET Status = '2' WHERE SubcategoryID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Subcategory Deleted!\");window.location=\"$site_host/admin/index.php?pg=subcategory\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>