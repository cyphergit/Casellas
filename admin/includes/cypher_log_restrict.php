<?php
include('../conf.inc.php');
session_start();

if ($_SESSION['logged'] != 1) {
    echo "<script type=\"text/javascript\">window.location=\"index.php?pg=login&t=a\"</script>";
} else {
    echo "<div id='LogPanel'>";
    echo "<div id='Login-Register'>";
    echo "<a href=\"index.php?pg=accountsettings\">Account Settings</a>";
    echo "<a href=\"f_logout.php\" style='border-left: solid 1px #fff'>Logout</a>";
    echo "</div>";
    echo "</div>";
}