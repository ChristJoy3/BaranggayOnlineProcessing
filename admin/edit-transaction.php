
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
            background-color: black;
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
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#contact" class="menu-btn">Contact Us</a></li>
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
<body>
    <section>
    <div class="container">
        <h2 class="mb-4 text-center">Edit Transaction</h2>
        <?php
        include_once "Transaction.php";

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tracking_code'])) {
            $transaction = new Transaction();
            $result = $transaction->searchTransaction($_GET['tracking_code']);

            if ($result && $result->rowCount() > 0) {
                $transactionData = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                <form action="update-transaction.php" method="post">
                    <input type="hidden" name="tracking_code" value="<?php echo htmlspecialchars($transactionData['tracking_code']); ?>">
                    <input type="hidden" name="status" value="<?php echo htmlspecialchars($transactionData['status']); ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($transactionData['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="service_type">Service Type:</label>
                        <input type="text" class="form-control" id="service_type" name="service_type" value="<?php echo htmlspecialchars($transactionData['service_type']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pickup_date">Pickup Date:</label>
                        <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="<?php echo htmlspecialchars($transactionData['pickup_date']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="date_requested">Date Requested:</label>
                        <input type="date" class="form-control" id="date_requested" name="date_requested" value="<?php echo htmlspecialchars($transactionData['date_requested']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <input type="text" class="form-control" id="purpose" name="purpose" value="<?php echo htmlspecialchars($transactionData['purpose']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update</button>
                </form>
                <?php
            } else {
                echo "<p>No transaction found with the provided tracking code.</p>";
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </section>
    <footer>
        <span>Edited by: <a href="#">Team Bangan</a> | <span class="far fa-copyright"></span> 2024 All rights reserved.</span>
    </footer>   
</body>
</html>
