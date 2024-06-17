<?php
include_once "Transaction.php";

$transaction = new Transaction();

// Check if tracking code generation is requested (GET request)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Generate and return a tracking code
    $trackingCode = $transaction->generateTrackingCode();
    echo $trackingCode;
    exit;
}

// If POST request, handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trackingCode = $_POST['tracking_code'];
    $name = $_POST['name'];
    $service_type = $_POST['service_type'];
    $pickup_date = $_POST['pickup_date'];
    $date_requested = $_POST['date_requested'];
    $purpose = $_POST['purpose'];

    if ($transaction->createPaperTransaction($trackingCode, $name, $service_type, $pickup_date, $date_requested, $purpose)) {
        echo "<script>alert('Paper transaction created successfully! Tracking code: $trackingCode');</script>";
        echo "<script>window.location.replace('../user/Dashboard.php');</script>";
    } else {
        echo "<script>alert('Error creating paper transaction.');</script>";
        echo "<script>window.location.replace('index.php');</script>";
    }
} else {
    echo "<script>window.location.replace('index.php');</script>";
}
?>
