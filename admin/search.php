<?php
include_once('session.php');
checkSession();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../user/stylesheets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <style>
        .dropdown {
            display: inline-block;
        }
        .dropdown button {
            background-color: none;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .dropdown a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
        }
        .dropdown .content {
            display: none;
            position: absolute;
            background-color: none;
            min-width: 100px;
            box-shadow: 5px black;
        }
        .dropdown:hover .content {
            display: block;
        }
        .dropdown a:hover {
            background-color: none;
        }
        .prof {
            color: white;
        }
        nav {
            background-color: black;
        }
        .content a {
            background-color: transparent;
        }
        .dropdown-item {
            display: none;
        }
        .navbar .max-width {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .max-width {
            max-width: 1300px;
            padding: 0 80px;
            margin: auto;
        }
        .navbar .menu a {
            color: white;
            text-decoration: none;
            padding: 1px 5px;
        }
        .navbar .menu a:hover {
            text-decoration: none;
        }
        .navbar .menu li {
            display: inline-block;
            margin-right: 10px;
        }
        .navbar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }
        .navbar .logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        .logo a {
            text-decoration: none;
        }
    </style>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#"><span>BOP SYSTEM</span></a></div>
            <ul class="menu">
                <li><a href="../user/Dashboard.php" class="menu-btn">Home</a></li>
                <li><a href="../user/Dashboard.php #about" class="menu-btn">About</a></li>
                <li><a href="../user/Dashboard.php #services" class="menu-btn">Services</a></li>
                <li><a href="/../user/Dashboard.php #contact" class="menu-btn">Contact Us</a></li>
                <li><a href="search-transaction.php" class="menu-btn">Track My Request</a></li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="menu-btn">
                            <?php
                                if (isset($_SESSION['username'])) {
                                    echo 'Hi, ' . $_SESSION['username'];
                                } else {
                                    echo 'Session is not working.'; 
                                }
                            ?>
                        </a>
                        <div class="content">
                            <a href="editprofile.php">Profile</a>
                            <a href="../user/logout.php">Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

</head>
<body>
    <section>
    <div class="container mt- mb-4 d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 600px;">
            <h2 class="mb-4 text-center">Search Transaction</h2>
            <form action="search.php" method="get">
                <div class="mb-3">
                    <label for="tracking_code" class="form-label">Enter Tracking Code:</label>
                    <input type="text" class="form-control" id="tracking_code" name="tracking_code" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </form>


            <div class="mt-4">
                <?php
                include_once "Transaction.php";

                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tracking_code'])) {
                    $transaction = new Transaction();
                    $result = $transaction->searchTransaction($_GET['tracking_code']);

                    if ($result && $result->rowCount() > 0) {
                        $transactionData = $result->fetch(PDO::FETCH_ASSOC);
                        echo "<h4>Transaction Details:</h4>";
                        echo "<table class='table table-bordered'>
                                <tr><th>Tracking Code</th><td>" . htmlspecialchars($transactionData['tracking_code']) . "</td></tr>
                                <tr><th>Name</th><td>" . htmlspecialchars($transactionData['name']) . "</td></tr>
                                <tr><th>Service Type</th><td>" . htmlspecialchars($transactionData['service_type']) . "</td></tr>
                                <tr><th>Pickup Date</th><td>" . htmlspecialchars($transactionData['pickup_date']) . "</td></tr>
                                <tr><th>Date Requested</th><td>" . htmlspecialchars($transactionData['date_requested']) . "</td></tr>
                                <tr><th>Purpose</th><td>" . htmlspecialchars($transactionData['purpose']) . "</td></tr>
                                <tr><th>Status</th><td>" . htmlspecialchars($transactionData['status']) . "</td></tr>
                              </table>";
                        echo "<a href='edit-transaction.php?tracking_code=" . htmlspecialchars($transactionData['tracking_code']) . "' class='btn btn-warning'>Edit</a> ";
                        echo "<form action='delete-transaction.php' method='post' style='display:inline-block;'>
                                <input type='hidden' name='tracking_code' value='" . htmlspecialchars($transactionData['tracking_code']) . "'>
                              </form>";
                    } else {
                        echo "<p>No transaction found with the provided tracking code.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            </section>
            <footer>
        <span>Edited by: <a href="#">Team Bangan</a> | <span class="far fa-copyright"></span> 2024 All rights reserved.</span>
    </footer>
</body>
</html>
