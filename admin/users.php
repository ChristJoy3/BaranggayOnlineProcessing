<?php
include_once('session.php');
checkSession();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
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
            padding: 20px;
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
        .table-responsive {
            margin-top: 20px;
        }
        .table {
            color: #000000;
        }
        .table th, .table td {
            border-color: #dee2e6;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin-panel.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="paper-transaction.php"><i class="fas fa-file-alt"></i> Transactions</a>
        <a href="users.php"><i class="fas fa-users"></i> Users</a>
        <a href="/barrangayonlineprocessing/user/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>
    <div class="main-content">
    <div class="container mt-4">
        <h2 class="mb-4">Users</h2>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">User List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once "Database.php";
                            include_once "../user/user.php";
                           
                            
                            $database = new Database();
                            $db = $database->getConnection();
                            $user = new User($db);
                            
                            $users = $user->getAllUsers();
                            
                            if ($users && $users->rowCount() > 0) {
                                while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                    echo "<td>
                                            <form action='delete-user.php' method='post' class='d-inline'>
                                                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
