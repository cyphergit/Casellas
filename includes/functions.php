<?php
function title() {
    $config = new Config();
    $casellas = new Cypher();
    
    $name = $config->company();
    $page = $casellas->get_page_name();
    $page_name = $page ." ". $name;
    
    echo $page_name;
}

// Throw new ID
function getIdCount($counter_val) {
    $rs = mysql_query($counter_val);
    $row_id = mysql_fetch_array($rs);
    $getidcount = $row_id[0];
    $newidcount = $getidcount + 1;

    return $newidcount;
}

// Verify user credentials
function verifyLogin($username, $password, $tbl_name, $account_type) {
    include('../conf.inc.php');

    $stripped_username = stripslashes($username);
    $stripped_password = stripslashes($password);
    $q_username = mysql_real_escape_string($stripped_username);
    $q_password = mysql_real_escape_string($stripped_password);

    $keyword = "casellas";

    $sql = "SELECT * FROM $tbl_name WHERE UserName = '$q_username' and Password = AES_ENCRYPT('$q_password','$keyword') LIMIT 1";
    $result = mysql_query($sql);

    $row = mysql_fetch_array($result);
    $userid = $row[0];
    $username = $row[1];
    $password = $row[2];
    $system_level = $row[3];

    $count = mysql_num_rows($result);

    session_start();

    if ($count == 1) {
        $admin_log_page = "index.php?pg=login&t=a";
        $user_log_page = "index.php?pg=login&t=u";
        //$admin_log_page = "$site_host/admin/index.php?pg=login&t=a";
        //$user_log_page = "$site_host/account/index.php?pg=login&t=u";

        if ($account_type == 'a') {
            if ($system_level == 1) {
                $_SESSION['username'] = $q_username;
                $_SESSION['userid'] = $userid;
                $_SESSION['status'] = $system_level;
                $_SESSION['account_type'] = $account_type;
                $_SESSION['logged'] = 1;

                //header("location:$site_host/admin/index.php?pg=home");
                header("location:index.php?pg=home");
            } else {
                $_SESSION['status'] = 0;
                $_SESSION['logged'] = 0;

                echo "<script type=\"text/javascript\">alert(\"Adminsitrative Account Doesn't Exist. Please try again.\");window.location=\"$admin_log_page\"</script>";
            }
        }

        if ($account_type == 'u') {
            if ($system_level == 3) {
                $_SESSION['username'] = $q_username;
                $_SESSION['userid'] = $userid;
                $_SESSION['status'] = $system_level;
                $_SESSION['account_type'] = $account_type;
                $_SESSION['logged'] = 1;

                //header("location:$site_host/account/index.php?pg=home");
                header("location:index.php?pg=home");
            } else {
                $_SESSION['status'] = 0;
                $_SESSION['logged'] = 0;

                echo "<script type=\"text/javascript\">alert(\"Account Doesn't Exist. Please try again.\");window.location=\"$user_log_page\"</script>";
            }
        }
    } else {
        $prevPage = $_SERVER['HTTP_REFERER'];
        echo "<script type=\"text/javascript\">alert(\"Invalid user name and password. Please try again.\");window.location=\"$prevPage\"</script>";
    }
}

function moduleUpdate( $urlString, $buttonId, $buttonClass, $css, $redirectPage, $buttonValue, $recId) {    
    $href = $urlString.$redirectPage."&p=u&rec=".$recId;
    $id = $buttonId;
    $class = $buttonClass;
    $style = $css;
    
    echo "<a id='$id' href='$href' style='$style' class='$class'>$buttonValue</a>";    
}

function moduleCancel( $urlString, $buttonId, $buttonClass, $css, $redirectPage, $buttonValue ) {    
    $href = $urlString.$redirectPage;
    $id = $buttonId;
    $class = $buttonClass;
    $style = $css;
    
    echo "<a id='$id' href='$href' style='$style' class='$class'>$buttonValue</a>";    
}

// Get current page
function getCurPageURL() {
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }

    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }

    return $pageURL;
}

function logOut() {
    include('../conf.inc.php');

    session_start();
    $_SESSION['logged'] = 0;
    $_SESSION['account_type'] = '';
    session_destroy();

    if ($_SESSION['status'] == 1) {
        header("location:index.php?pg=home");
        //echo "<script type=\"text/javascript\">window.location=\"$site_host/admin\"</script>";
    } else if ($_SESSION['status'] == 3) {
        header("location:index.php?pg=home");
        //echo "<script type=\"text/javascript\">window.location=\"$site_host/account\"</script>";
    }
}

function StringLookUp($haystack, $needle) {
    $pos = strpos($haystack, $needle);
    return $pos;
}

// Get page name
function getPageName() {
    $spacer = array("_");

    $pageName = $_GET[pg];
    $trimmed_pageName = trim(str_replace($spacer, " ", $pageName));
    //$updated_pageName = ucwords(strtolower($trimmed_pageName));
    $updated_pageName = $trimmed_pageName;

    if ($updated_pageName != null) {
        //echo "$updated_pageName |";
        echo $updated_pageName;
    }
}

// Throw footer date
function getFooterDate($y) {
    $year_created = $y;
    $cur_year = date('Y');

    if ($year_created != $cur_year) {
        echo "&copy; $year_created - $cur_year";
    } else {
        echo "&copy; $year_created";
    }
}

// Get file extension
function getFileExtension($filename) {
    $filename = strtolower($filename);
    $exts = split("[/\\.]", $filename);
    $n = count($exts) - 1;
    $n_exts = $exts[$n];

    return $n_exts;
}

// Australian date to standard date format
function AusToStandardDate($date) {
    $date = explode('/', $date);
    $d = $date[0];
    $m = $date[1];
    $y = $date[2];
    $formattedDate = "$y-$m-$d";
    $standard_date = date($formattedDate);

    return $standard_date;
}

function StandardDateToAus($date) {
    $date = explode('-', $date);
    $y = $date[0];
    $m = $date[1];
    $d = $date[2];
    $formattedDate = "$d/$m/$y";
    $AusDate = date($formattedDate);
    
    return $AusDate;
}

// Break tags to spaces
function br2space($string) {
    $stripped_string = strip_tags($string, '<br>');
    $preg_string = preg_replace('/<br[^>]*>/', ' ', $stripped_string);
    $n_string = preg_replace('/[\ ]+/', ' ', $preg_string);

    return $n_string;
}

// Required fields
function requiredField($field) {
    if ($field == null || $field == "") {
        $field = "<span style='color: red;'>MISSING, PLEASE PROVIDE</span>";
        return trim($field);
    } else {
        return trim($field);
    }
}

//Counter Inject
function IsInjected($str) {
    $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
}