<?php
include_once ('session.php');
checkAdmin();




include_once '../admin/Database.php';
include_once '../user/user.php';


$host = "dfoiwidm";
$username = "dfoiwidm_BaranggayOnlineProcessing";
$password = "8xDT2fy;4LM4b(";
$database = "dfoiwidm_BaranggayOnlineProcessing";

$db = new Database($host, $username, $password, $database);

//For user Count
$user = new User($db);

$userCount = $user->getUserCount();
//For transaction count
$transactionCount = $user->getPaperTransactionCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
        }
        .sidebar {
            height: 100vh;
            width: 150px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgb(33, 25, 109);
            color: #ffffff;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 14px;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575d63;
        }
        .main-content {
            margin-left: 150px;
            padding: 5px;
            background-color: #ffffff;
        }
        .navbar {
            margin-left: 150px;
            background-color: rgb(33, 25, 109);
            color: #ffffff;
        }
        .navbar a {
            color: #ffffff;
        }
        .card {
            margin-top: 20px;
            background-color: #ffffff;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin-panel.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="paper-transaction.php"><i class="fas fa-file-alt"></i> Transactions</a>
        <a href="users.php"><i class="fa-solid fa-users"></i> User</a>
        <a href="../user/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card text-center">
                    <div class="card-header">
                        <h4>Total Users</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="display-4"><?php echo $userCount; ?></h1>
                    </div>
                    <div class="card-footer text-muted">
                        <small>As of <?php echo date("Y-m-d H:i:s"); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card text-center">
                    <div class="card-header">
                        <h4>Total Paper Transactions</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="display-4"><?php echo $transactionCount; ?></h1>
                    </div>
                    <div class="card-footer text-muted">
                        <small>As of <?php echo date("Y-m-d H:i:s"); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
