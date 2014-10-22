<?php

/**
 * Assignment 6 - course user management
 * 
 * This file is the main entry point to the website.
 */
require("inc/config.inc.php");
require("inc/functions.inc.php");

// init Smarty
require(SMARTY_PATH . "/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->setTemplateDir(PROJECT_DIR . "/smarty/templates");
$smarty->setCompileDir(PROJECT_DIR . "/smarty/templates_c");
$smarty->setCacheDir(PROJECT_DIR . "/smarty/cache");
$smarty->setConfigDir(PROJECT_DIR . "/smarty/configs");

// init MySQL
$mysql = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
if (mysqli_connect_errno($mysql)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// init session
session_start();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

// common variables shown on all pages
$page = "";
$page_title = "login";
$page_errors = array();
$page_info = "";

switch ($action) {
    case "login":
        login();
        break;
    case "logout":
        logout();
        break;
    case "signup":
        signup();
        break;
    default:
        break;
}

$logged_in = is_logged_in();
$is_admin = 0;

// if the user is logged in
if ($logged_in) {
    // @todo
    // Add displaying the info page upon action=info for logged in users
    if($action="info"){
		info_page();
	}
    $is_admin = is_admin();
    // for admins, list students
    if ($is_admin) {
        list_students();
    }
    // for students, show their profile
    else {
        show_profile();
    }
}

$smarty->assign(array(
    "course_code" => COURSE_CODE,
    "course_name" => COURSE_NAME,
    "page" => $page,
    "page_title" => $page_title,
    "page_errors" => $page_errors,
    "page_info" => $page_info,
    "logged_in" => $logged_in,
    "is_admin" => $is_admin
));
$smarty->display("index.tpl");

mysqli_close($mysql);
?>