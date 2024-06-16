<?php
include_once "Transaction.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracking_code'])) {
    $transaction = new Transaction();
    $tracking_code = $_POST['tracking_code'];

    if ($transaction->deleteTransaction($tracking_code)) {
        echo "<script>alert('Transaction deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting transaction.');</script>";
    }
}

echo "<script>window.location.replace('admin-panel.php');</script>";
?>
