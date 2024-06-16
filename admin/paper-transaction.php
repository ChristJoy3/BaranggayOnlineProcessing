<?php
include_once('session.php');
checkSession();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Paper Transactions</title>
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
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .form-inline {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }
        .form-inline .form-select,
        .form-inline .btn {
            margin: 5px 0;
            
        }

        .action-forms {
            display: flex;
            align-items: center;
        }
        .action-forms form {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin-panel.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="paper-transaction.php"><i class="fas fa-file-alt"></i> Transactions</a>
        <a href="users.php"><i class="fa-solid fa-users"></i> User</a>
        <a href="/barrangayonlineprocessing/user/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>
    <div class="main-content">
    <div class="container mt-4">
        <h2 class="mb-4">Paper Transactions</h2>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transactions</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class ="table-primary">
                                <th scope = "col">Tracking Code</th>
                                <th scope = "col">Name</th>
                                <th scope = "col">Service Type</th>
                                <th scope = "col">Pickup Date</th>
                                <th scope = "col">Date Requested</th>
                                <th scope = "col">Status</th>
                                <th scope = "col">Action</th>
                            <tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once "Transaction.php";
                            $transaction = new Transaction();
                            $result = $transaction->getAllTransactions();
                            if ($result && $result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['tracking_code']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['service_type']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['pickup_date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['date_requested']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>
                                            <form action='update-status.php' method='post' class='d-inline'>
                                                <input type='hidden' name='tracking_code' value='" . htmlspecialchars($row['tracking_code']) . "'>
                                                <select name='status' class='form-select form-select-sm mb-2'>
                                                    <option value='pending'" . ($row['status'] == 'pending' ? ' selected' : '') . ">Pending</option>
                                                    <option value='ready to pick-up'" . ($row['status'] == 'ready to pick-up' ? ' selected' : '') . ">Ready to pick-up</option>
                                                </select>
                                                <button type='submit' class='btn btn-primary btn-sm'>Update</button>
                                            </form>
                                            <form action='delete-transaction.php' method='post' class='d-inline'>
                                                <input type='hidden' name='tracking_code' value='" . htmlspecialchars($row['tracking_code']) . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No transactions found.</td></tr>";
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
