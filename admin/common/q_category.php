<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];

$cName = form($_POST['txtCName']);
$cDesc = trim(addslashes($_POST['txtCDesc']));

$entryID = $_POST['EntryID'];

$cur_date = date("y-m-d h:m:s");

switch ($process) {
    case "Add":
        $sql = "SELECT CategoryID FROM IDCounters";

        $newid = getIdCount($sql);

        mysql_query("UPDATE IDCounters SET CategoryID = '$newid'");

        mysql_query("INSERT INTO Product_Category (CategoryID, CategoryName, Description, Status)
                VALUES ('C0$newid','$cName','$cDesc','1')") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"A new Product Category was successfully created!\");window.location=\"$site_host/admin/index.php?pg=category\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":
        mysql_query("UPDATE Product_Category SET CategoryName = '$cName', Description = '$cDesc' WHERE CategoryID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Product Category was successfully updated!\");window.location=\"$site_host/admin/index.php?pg=category\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        mysql_query("UPDATE Product_Category SET Status = '2' WHERE CategoryID = '$entryID'") or die(mysql_error());

        echo "<script type=\"text/javascript\">alert(\"Category Deleted!\");window.location=\"$site_host/admin/index.php?pg=category\"</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>