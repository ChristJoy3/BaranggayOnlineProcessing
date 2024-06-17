<?php
session_start();
include '../admin/Database.php';
include 'user.php';


$host = "localhost";
$username = "dfoiwidm_BaranggayOnlineProcessing";
$password = "BaranggayOnlineProcessing";
$database = "dfoiwidm_BaranggayOnlineProcessing";


$db = new Database($host, $username, $password, $database);

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($user->register($username, $email, $password)) {
        
        header("Location: login-form.php");
        exit();
    } else {
        
        header("Location: register-form.php?error=2");
        exit();
    }
}

?>
