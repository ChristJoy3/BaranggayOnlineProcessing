<?php
session_start();
include '../admin/Database.php'; // Include your database connection file
include 'user.php';
include 'UploadHandler.php'; // Include your User class file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

$username = $_SESSION['username']; // Get the username from session

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_picture'])) {
    $uploadHandler = new UploadHandler();

    try {
        $uploadedFilePath = $uploadHandler->upload($_FILES['profile_picture'], $username);

        // Update profile_picture in session
        $_SESSION['profile_picture'] = $uploadedFilePath;

        // Redirect to profile.php after successful upload
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
        // Redirect back to profile.php with error message
        header("Location: profile.php?error=" . urlencode($error));
        exit;
    }
} else {
    // Redirect to profile.php if accessed without POST data
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-screen flex flex-col items-center justify-center bg-zinc-100 dark:bg-zinc-800">
    <h1 class="text-2xl font-bold text-zinc-800 dark:text-white mb-4">Upload Profile Picture</h1>
    <div class="bg-white dark:bg-zinc-700 p-4 rounded-lg shadow-md">
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center">
            <input type="file" name="profile_picture" accept="image/*" class="mb-4 mx-auto">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Upload Picture</button>
        </form>
    </div>
</div>
</body>
</html>