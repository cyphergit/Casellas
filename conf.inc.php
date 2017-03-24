<?php
include 'config/config.php';
include 'classes/CypherDesign.php';
include 'classes/CypherDesignDB.php';

//Company Details
$config = new Config();
$company = $config->company();
$domain = $config->domain();

//Database
$conn = new DatabaseConfig();
$conn->Dbsettings('localhost', 'root', 'sa', 'Casellas');
//$conn->Dbsettings('localhost', 'bunbury0_admin', 'masteradmin', 'bunbury0_casellas');
$conn->Dbconnect();

//Host
$site_host = $config->host("local");

//Directories
$images_dir = $config->fileDir("image");
$article_dir = $config->fileDir("article");
$files_dir = $config->fileDir("file");

// SQL Prevention Function
function form($data) { // Prevents SQL Injection
        global $db_connect;
        $ereg_data = ereg_replace("[\'\")(;|`,<>]", "", $data);
        $n_data = mysql_real_escape_string(trim($ereg_data), $db_connect);

        return stripslashes($n_data);
}