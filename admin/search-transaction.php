<?php
include_once "Transaction.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tracking_code'])) {
    $transaction = new Transaction();
    $tracking_code = $_GET['tracking_code'];

    $result = $transaction->searchTransaction($tracking_code);

    if ($result && $result->rowCount() > 0) {
        $transactionData = $result->fetch(PDO::FETCH_ASSOC);
        // Display transaction details
        echo "<pre>";
        print_r($transactionData);
        echo "</pre>";
    } else {
        echo "<script>alert('Transaction not found.');</script>";
        echo "<script>window.location.replace('search.php');</script>";
    }
} else {
    echo "<script>window.location.replace('search.php');</script>";
}
?>
