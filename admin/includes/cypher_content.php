<?php

if (isset($_GET['pg']) && $_GET['pg'] != "") {
    $pg = $_GET['pg'];
    if (file_exists('pages/' . $pg . '.php')) {
        @include ('pages/' . $pg . '.php');
    } elseif (!file_exists('pages/' . $pg . '.php')) {
        echo 'Page you are requesting doesn´t exist';
    }
} else {
    @include ('pages/home.php');
}