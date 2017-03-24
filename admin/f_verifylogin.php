<?php

include 'includes/cypher_functions.php';

$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];
$tbl_name = "UserLogin";
$account_type = $_POST['txtType'];

verifyLogin($username, $password, $tbl_name, $account_type);
