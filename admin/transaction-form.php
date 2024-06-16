<?php
include_once('session.php');
checkSession();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paper Transaction Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">
    <h2 class="mb-4">Submit Paper Transaction</h2>
    <form action="generate-tracking.php" method="post" id="paperTransactionForm">
        <div class="mb-3">
            <label for="tracking_code" class="form-label">Tracking Code:</label>
            <input type="text" class="form-control" id="tracking_code" name="tracking_code" readonly required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="service_type" class="form-label">Service Type</label>
            <select class="form-select" id="service_type" name="service_type" required>
                <option value="" disabled selected>Select service type</option>
                <option value="Certificate of Residency">Certificate of Residency</option>
                <option value="Brgy. Permit">Brgy. Business Permit</option>
                <option value="Certificate of Residency">Certificate of Residency</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="pickup_date" class="form-label">Pickup Date:</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>
        <div class="mb-3">
            <label for="date_requested" class="form-label">Date Requested:</label>
            <input type="date" class="form-control" id="date_requested" name="date_requested" required>
        </div>
        <div class="mb-3">
            <label for="purpose " class="form-label">Purpose</label>
            <input type="text" class="form-control" id="purpose" name="purpose" required>
        </div>

        <button type="button" class="btn btn-primary" onclick="generateTrackingCode()">Generate Tracking Code</button>
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="../user/index.php" class="btn btn-secondary" type="button">Back</a>
    </form>

    <div id="formDataDisplay"></div>
</div>

<script>
    function generateTrackingCode() {
        // Call backend PHP script to generate tracking code
        fetch('generate-tracking.php')
            .then(response => response.text())
            .then(trackingCode => {
                document.getElementById('tracking_code').value = trackingCode;
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
