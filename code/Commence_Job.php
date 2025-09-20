<?php
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['Job_ID'];
    $job_type_id = $_POST['Job_Type_ID'];
    $booking_id = $_POST['Booking_ID'];
    $mechanic_id = $_POST['Mechanic_ID'];
    $vehicle_model = $_POST['Vehicle_Model'];
    $registration = $_POST['Registration_Num'];
    $mileage = $_POST['Mileage'];
    $instructions = $_POST['Instructions'];

    try {
        $checkStmt = $con->prepare("SELECT Status FROM Job WHERE Job_ID = :job_id");
        $checkStmt->bindParam(':job_id', $job_id);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['Status'] === 'Commenced') {
            echo "<p style='color: red;'>This job has already been commenced.</p>";
        } else {
            // Update Booking
            $updateBooking = $con->prepare("UPDATE Booking 
                SET Model = :model, 
                    Registration_Number = :reg, 
                    Mileage = :mileage, 
                    Instructions = :instructions, 
                    Status = 'Commenced' 
                WHERE Booking_ID = :booking_id");
            $updateBooking->bindParam(':model', $vehicle_model);
            $updateBooking->bindParam(':reg', $registration);
            $updateBooking->bindParam(':mileage', $mileage);
            $updateBooking->bindParam(':instructions', $instructions);
            $updateBooking->bindParam(':booking_id', $booking_id);
            $updateBooking->execute();

            // Update Job
            $updateJob = $con->prepare("UPDATE Job 
                SET Job_Type_ID = :job_type_id, 
                    Mechanic_ID = :mechanic_id, 
                    Status = 'In Progress' 
                WHERE Job_ID = :job_id");
            $updateJob->bindParam(':job_type_id', $job_type_id);
            $updateJob->bindParam(':mechanic_id', $mechanic_id);
            $updateJob->bindParam(':job_id', $job_id);
            $updateJob->execute();

            echo "<p style='color: green;'>Job successfully commenced and booking updated.</p>";
            echo "<form method='post' action='print_job_card.php' target='_blank'>
                    <input type='hidden' name='Job_ID' value='$job_id'>
                    <input type='submit' value='Print Job Card' class='formButton'>
                  </form>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>