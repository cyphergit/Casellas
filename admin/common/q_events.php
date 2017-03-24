<?php

include('../../conf.inc.php');
include('../includes/cypher_functions.php');

$process = $_POST['Process'];
$entryID = $_POST['EntryID'];

$eTitle = trim(addslashes($_POST['txtETitle']));
$eDesc = trim(addslashes($_POST['txtEDesc']));
$eVenue = trim(addslashes($_POST['txtEVenue']));

$eDate = trim($_POST['txtEDate']);
$eDate = AusToStandardDate($eDate);

$cur_date = date("y-m-d h:m:s");

//CALL PROCESSES
switch ($process) {
    case "Add":

        $lastid = "SELECT EventID FROM IDCounters";

        $newid = getIdCount($lastid);

        mysql_query("UPDATE IDCounters SET EventID = '$newid'");

        $newid = "E$newid";

        mysql_query("INSERT INTO Events (EventID, EventTitle, EventDesc, EventDate, EventVenue, Status)
                    VALUES ('$newid','$eTitle', '$eDesc', '$eDate','$eVenue','1')") or die(mysql_error());

        echo "<script type='text/javascript'>alert('A new Event was successfully created!');window.location='$site_host/admin/index.php?pg=events'</script>";

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Update":

        mysql_query("UPDATE Events SET EventTitle = '$eTitle', EventDesc = '$eDesc', EventDate = '$eDate', EventVenue = '$eVenue' WHERE EventID = '$entryID'") or die(mysql_error());

        echo "<script type='text/javascript'>alert('Event was successfully updated!');window.location='$site_host/admin/index.php?pg=events'</script>";

        mysql_close($db_connect); // Closes the connection.

        break;

    case "Delete":
        mysql_query("UPDATE Events SET Status = '2' WHERE EventID = '$entryID'") or die(mysql_error());

        echo "<script type='text/javascript'>alert('Event Deleted!');window.location='$site_host/admin/index.php?pg=events'</script>";

        mysql_close($db_connect); // Closes the connection.

        break;
}
?>