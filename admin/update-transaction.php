<?php
include_once "Transaction.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tracking_code'])) {
    $transaction = new Transaction();
    $tracking_code = $_POST['tracking_code'];
    $name = $_POST['name'];
    $service_type = $_POST['service_type'];
    $pickup_date = $_POST['pickup_date'];
    $date_requested = $_POST['date_requested'];
    $status = $_POST['status'];

    if ($transaction->updateTransaction($tracking_code, $name, $service_type, $pickup_date, $date_requested, $status)) {
        echo "<script>alert('Transaction updated successfully.');</script>";
        echo "<script>window.location.replace('edit-transaction.php?tracking_code=$tracking_code');</script>";
    } else {
        echo "<script>alert('Error updating transaction.');</script>";
    }
}
?>
