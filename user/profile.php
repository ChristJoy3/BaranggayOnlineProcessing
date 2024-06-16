<?php
session_start();

// Include necessary files and initialize variables
include '../admin/Database.php'; // Adjust path as necessary
include 'User.php'; // Adjust path as necessary
include 'UploadHandler.php'; // Adjust path as necessary

// Assuming the upload.php script saves the uploaded file path in session
$uploadedFilePath = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'https://placehold.co/150';

// Initialize User and Database classes
$db = new Database("localhost", "root", "", "system");
$user = new User($db);

try {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $userId = $user->getUserIdByUsername($username);
    } else {
        echo "No username found in session.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Handle profile picture update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_picture'])) {
    $uploadHandler = new UploadHandler();
    try {
        // Upload the file and get the file path
        $uploadedFilePath = $uploadHandler->upload($_FILES['profile_picture'], $username);
        // Store the file path in the database
        $uploadHandler->storeFilePathInDatabase($username, $uploadedFilePath);
        // Update session with new file path
        $_SESSION['profile_picture'] = $uploadedFilePath;
        // Redirect to profile page
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Handle profile picture delete
if (isset($_POST['delete_profile_picture'])) {
    try {
        $user->deleteProfilePicture($username);
        unset($_SESSION['profile_picture']);
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-zinc-800 p-4">
    <div class="bg-zinc-700 text-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h2 class="text-center text-2xl font-bold mb-4">User Profile</h2>
        <div class="flex flex-col items-center">
            <img class="w-24 h-24 rounded-full mb-4" src="<?php echo $uploadedFilePath; ?>" alt="Profile Picture">
            <p class="text-lg mb-4"><?php echo $_SESSION['username']; ?></p>

            <!-- Form for uploading profile picture -->
            <form action="profile.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center mb-4">
                <label for="profile_picture" class="block mb-2">Choose a profile picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-2">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg w-full">Upload Picture</button>
            </form>

            <!-- Form for deleting profile picture -->
            <form action="profile.php" method="post" class="mb-4">
                <input type="hidden" name="delete_profile_picture" value="true">
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg w-full">Delete Picture</button>
            </form>

            <a href="dashboard.php" class="bg-zinc-500 text-white py-2 px-4 rounded-lg w-full">Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
