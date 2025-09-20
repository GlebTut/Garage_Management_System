<?php
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Display the POST data for debugging
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Retrieve form values
    $job_type_id   = $_POST['job_type_id'];
    $job_type_name = $_POST['job_type_name'];
    $description   = $_POST['description'];
    $price         = $_POST['price'];
    $lead_mechanic = $_POST['lead_mechanic'];
    
    // Ensure a job type is selected
    if (!$job_type_id) {
        echo "<h2>Please select a Job Type</h2>";
        exit();
    }
    
    try {
        // Update the Job_Type record
        $update = $con->prepare("UPDATE `Job_Type` 
                                 SET `Job_Type_Name` = :name, 
                                     `Description` = :description, 
                                     `Price` = :price, 
                                     `Lead_Mechanic` = :lead_mechanic 
                                 WHERE `Job_Type_ID` = :id");
        $update->bindParam(':id', $job_type_id);
        $update->bindParam(':name', $job_type_name);
        $update->bindParam(':description', $description);
        $update->bindParam(':price', $price);
        $update->bindParam(':lead_mechanic', $lead_mechanic);
        
        if ($update->execute()) {
            echo "<h2>Data is updated in the database successfully.</h2>";
        } else {
            echo "<h2>Error during updating data in the database!</h2>";
            error_log("Database Error: " . print_r($update->errorInfo(), true));
        }
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
    }
}
?>