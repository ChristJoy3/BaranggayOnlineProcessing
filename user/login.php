<?php
session_start();
include '../admin/Database.php';
include 'user.php';

$host = "192.250.235.45";
$username = "dfoiwidm_BaranggayOnlineProcessing";
$password = "BaranggayOnlineProcessing";
$database = "dfoiwidm_BaranggayOnlineProcessing";

$db = new Database($host, $username, $password, $database);
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
   
    $loggedInUser = $user->login($email, $password);

    if ($loggedInUser) {
        // Authentication successful, set session variables
        $_SESSION["username"] = $loggedInUser['username'];
        $_SESSION["email"] = $loggedInUser['email'];  
        $_SESSION["user_id"] = $loggedInUser['id']; 
        $_SESSION["role"] = $loggedInUser['role']; 
        $_SESSION["loggedin"] = true;
        
        if ($loggedInUser['role'] == 0) {
            header("Location: Dashboard.php");
        } else {
            header("Location: /BarrangayOnlineProcessing/admin/admin-panel.php");
        }
        exit();
    } else {
        // Authentication failed
        $_SESSION["error_message"] = "Incorrect email or password";
        header("Location: login-form.php?error=1");
        exit();
    }
}
?>