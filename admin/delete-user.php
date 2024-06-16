<?php

include_once "../user/user.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Initialize database connection
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    // Sanitize input to avoid SQL injection
    $id = htmlspecialchars($_POST['id']);

    // Attempt to delete the user
    if ($user->deleteUser($id)) {
        echo "<script>alert('User deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting user.');</script>";
    }
}

echo "<script>window.location.replace('users.php');</script>";
?>
