<?php
include_once "Transaction.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracking_code']) && isset($_POST['status'])) {
    $transaction = new Transaction();
    $tracking_code = $_POST['tracking_code'];
    $status = $_POST['status'];

    if ($transaction->updateTransactionStatus($tracking_code, $status)) {
        echo "<script>alert('Transaction status updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating transaction status.');</script>";
    }
}

echo "<script>window.location.replace('admin-panel.php');</script>";
?>
