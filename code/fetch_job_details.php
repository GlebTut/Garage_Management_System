<?php
include 'DBconnection.php';

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    $stmt = $con->prepare("SELECT 
        J.Job_ID, 
        J.Job_Type_ID, 
        JT.Description AS Job_Description,
        B.Booking_ID, 
        B.Customer_ID, 
        B.Model, 
        B.Registration_Num, 
        B.Mileage, 
        B.Instructions, 
        B.Origin_Date, 
        B.Booking_Date 
    FROM Job J
    JOIN Booking B ON J.Booking_ID = B.Booking_ID
    JOIN Job_Type JT ON J.Job_Type_ID = JT.Job_Type_ID
    WHERE J.Job_ID = :job_id");

    $stmt->bindParam(':job_id', $job_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <h3>Job & Booking Details</h3>
        <div class="job-detail-box">
            <p><strong>Job Type ID:</strong> <?= $data['Job_Type_ID']; ?> — <?= $data['Job_Description']; ?></p>
            <p><strong>Booking ID:</strong> <?= $data['Booking_ID']; ?></p>
            <p><strong>Customer ID:</strong> <?= $data['Customer_ID']; ?></p>
            <p><strong>Vehicle Model:</strong> <?= $data['Model']; ?></p>
            <p><strong>Registration Number:</strong> <?= $data['Registration_Num']; ?></p>
            <p><strong>Mileage:</strong> <?= $data['Mileage']; ?> km</p>
            <p><strong>Instructions:</strong> <?= nl2br($data['Instructions']); ?></p>
            <p><strong>Origin Date:</strong> <?= $data['Origin_Date']; ?></p>
            <p><strong>Booking Date:</strong> <?= $data['Booking_Date']; ?></p>
        </div>

        <?php
    } else {
        echo "<p style='color:red;'>No details found for the selected job.</p>";
    }
} else {
    echo "<p style='color:red;'>No Job ID provided.</p>";
}
?>