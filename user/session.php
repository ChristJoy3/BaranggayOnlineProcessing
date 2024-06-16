<?php
session_start();

function checkSession() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login-form.php");
        exit();
    }
}

function isLoggedIn() {
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function checkAdmin() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 1) {
        header("Location: login-form.php");
        exit();
    }
}


function isAdmin() {

    if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        return true;
    } else {
        return false;
    }
}
?>

