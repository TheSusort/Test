<?php

/**
 * Assignment 6 - course user management
 * 
 * This file contains the implementation of the site's functionality.
 */

/**
 * Login
 */
function login() {
    global $page, $page_errors, $page_info;

    $student_no = isset($_POST['student_no']) ? $_POST['student_no'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";

    if ($student_no != "" && $email != "") {

        // @todo 
        // Add admin login here
		if($student_no = ADMIN_USER && $email = ADMIN_PASSWORD) {
			$is_admin = 1;
			$page = "student_list";

		}
        $student_data = __get_student_data($student_no, $email);
        if (isset($student_data)) {
            // save all variables to the session
            foreach ($student_data as $key => $value) {
                $_SESSION[$key] = $value;
            }
            $page = "profile";
        } else {
	    $page_errors[] = "Invalid student no or email!";
        }
    }
}

/**
 * Logout
 */
function logout() {
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
    // redirect to main page
    header("Location: index.php");
    exit();
}

/**
 * Checks if there is a logged in user
 */
function is_logged_in() {
    return (isset($_SESSION['student_no']));
}

/**
 * Is the logged-in user an administrator
 */
function is_admin() {
    // @todo
    // Complete this to return true if the logged in user is an admin
	if($is_admin) return true;
    else return false;
}

/**
 * Check if all input fields are filled in correctly
 */
function __check_input($name, $email, $student_no, $user_unix, $user_codecademy, $user_github) {
    $errors = array();
    if (strlen($name) == 0) {
        $errors[] = "Name is empty!";
    }
    if (strlen($student_no) == 0) {
        $errors[] = "Student number is empty!";
    } else if (strlen($student_no) != 6) {
        $errors[] = "Invalid student number!";
    }
    if (strlen($email) == 0) {
        $errors[] = "Email is empty!";
    } else if (substr($email, -6) != "uis.no") {
        $errors[] = "Not an uis.no email address!";
    }
    if (strlen($user_unix) == 0) {
        $errors[] = "Unix username is empty!";
    }
    if (strlen($user_codecademy) == 0) {
        $errors[] = "Codecademy username is empty!";
    }
    if (strlen($user_github) == 0) {
        $errors[] = "Github username is empty!";
    }

    return $errors;
}

/**
 * Get all student data for a $student_no, $email combination.
 * Return all stored database fields in an array or null if it's an invalid combination.
 */
function __get_student_data($student_no, $email) {
    global $mysql, $page_errors;

    $query = "SELECT * FROM students WHERE student_no=" . mysqli_real_escape_string($mysql, $student_no)
            . " AND email='" . mysqli_real_escape_string($mysql, $email) . "'";
    if ($result = mysqli_query($mysql, $query)) {
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $data;
    }
    return null;
}

/**
 * Check if a user exists with this email or student_no or user_*
 */
function __is_user($student_no, $email, $user_unix, $user_codecademy, $user_github) {
    global $mysql;

    $stmt = $mysql->prepare("SELECT student_no FROM students WHERE student_no=? OR name=? OR email=? "
            . "OR user_unix=? OR user_codecademy=? OR user_github=?");
    $stmt->bind_param('isssss', $student_no, $name, $email, $user_unix, $user_codecademy, $user_github);
    $stmt->execute();
    $stmt->bind_result($res);
    $is_result = $stmt->fetch(); // are there any records returned
    $stmt->close();

    return $is_result;
}

/**
 * Save the user data to the mysql table.
 * Return true if the insertion was executed without problems, otherwise return false.
 */
function __save_to_db($name, $student_no, $email, $user_unix, $user_codecademy, $user_github) {
    global $mysql;

    // prepare sql statement that is protected against sql injection
    // see http://php.net/manual/en/mysqli-stmt.bind-param.php
    $stmt = $mysql->prepare("INSERT INTO students (student_no, name, email, user_unix, "
            . "user_codecademy, user_github) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $student_no, $name, $email, $user_unix, $user_codecademy, $user_github);

    // execute prepared statement
    $stmt->execute();
    $inserted = $stmt->affected_rows;
    // close statement
    $stmt->close();

    return $inserted == 1;
}

/**
 * Signup
 */
function signup() {
    global $smarty, $page, $page_errors, $page_info, $page_title;

    $step = isset($_POST['step']) ? $_POST['step'] : 0;
    $name = "";
    $email = "";
    $student_no = "";
    $user_unix = "";
    $user_codecademy = "";
    $user_github = "";

    // form is submitted
    if ($step == 1) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $student_no = $_POST['student_no'];
        $user_unix = $_POST['user_unix'];
        $user_codecademy = $_POST['user_codecademy'];
        $user_github = $_POST['user_github'];

        // input check
        $page_errors = __check_input($name, $email, $student_no, $user_unix, $user_codecademy, $user_github);
        // no input error
        if (count($page_errors) == 0) {
            // check if the user exists
            if (__is_user($student_no, $email, $user_unix, $user_codecademy, $user_github)) {
                $page_errors[] = "A user with these credentials already exists!";
            } else {
                $saved = __save_to_db($name, $student_no, $email, $user_unix, $user_codecademy, $user_github);
                if (!$saved) {
                    $page_errors[] = "Error saving into the database!";
                } else {
                    // show login page
                    $page = "login";
                    $page_info = "You have succesfully signed up. You can log in now.";
                }
            }
        }

        // if there are any problems, we display the form again
        if (count($page_errors) > 0) {
            $step = 0;
        }
    }

    // displaying the form
    if ($step == 0) {
        // remembering previously filled in values
        // (this is the same as having $smarty->assign(...) for each variable separately)
        $smarty->assign(array(
            "name" => $name,
            "email" => $email,
            "student_no" => $student_no,
            "user_unix" => $user_unix,
            "user_codecademy" => $user_codecademy,
            "user_github" => $user_github
        ));
        $page = "signup";
        $page_title = "sign-up";
    }
}

/**
 * Show profile for the logged in user
 */
function show_profile() {
    global $smarty, $page, $page_title;

    $smarty->assign(array(
        "name" => $_SESSION['name'],
        "email" => $_SESSION['email'],
        "student_no" => $_SESSION['student_no'],
        "user_unix" => $_SESSION['user_unix'],
        "user_codecademy" => $_SESSION['user_codecademy'],
        "user_github" => $_SESSION['user_github']
    ));

    $page = "profile";
    $page_title = "student profile";
}

/**
 * Listing students
 */
function list_students() {
    global $mysql, $smarty, $page, $page_title;

    // @todo
    // Get a list of students using mysql, pass the results to smarty
    // and update student_list.tpl to display the results
    $query = "SELECT student_no FROM students";
    if ($result = mysqli_query($mysql, $query)) {
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $data;
    }
	foreach($data as $studs) {
	
		$list = $list. '<tr>
							<td> {$name} </td>
							<td> {$email} </td>
							<td> {$student_no} </td>
							<td> {$user_unix} </td>
							<td> {user_codecademy} </td>
							<td> {$user_github} </td>
						</tr>';
						
		$smarty->assign(array(
			"list" => $list,
            "name" => $name,
            "email" => $email,
            "student_no" => $student_no,
            "user_unix" => $user_unix,
            "user_codecademy" => $user_codecademy,
            "user_github" => $user_github
        ));
		
	}
	
    $page = "student_list";
    $page_title = "student list";
}

function info_page() {
	global $page, $page_title;
	$page = "info";
	$page_title = "info page";
}
?>