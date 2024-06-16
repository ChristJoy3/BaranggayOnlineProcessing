<?php
session_start();
include '../admin/Database.php'; 
include 'user.php'; 
include 'UploadHandler.php'; 



$host = "192.250.235.45";
$username = "dfoiwidm_BaranggayOnlineProcessing";
$password = "BaranggayOnlineProcessing";
$database = "dfoiwidm_BaranggayOnlineProcessing";

$db = new Database($host, $username, $password, $database);
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Handle profile picture upload
    $uploadHandler = new UploadHandler();
    $uploadedFilePath = $uploadHandler->upload($_FILES['profile_picture'], $username);

    if ($user->register($username, $email, $password, $uploadedFilePath)) {
        // Registration successful
        header("Location: login-form.php");
        exit();
    } else {
        // Registration failed
        header("Location: register-form.php?error=2");
        exit();
    }
}
?>
