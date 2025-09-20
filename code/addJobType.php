<?php
include 'DBconnection.php';

// Initialize variables for job type details
$jobTypeName = '';
$description = '';
$price = '';
$leadMechanic = '';  // Changed variable name

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $jobTypeName = $_POST['Job_Type_Name'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];
    $leadMechanic = $_POST['Lead_Mechanic_ID'];  // We will insert the mechanic's name, not ID

    // Check if lead mechanic is selected
    if (empty($leadMechanic)) {
        echo "<h2>Error: You must select a Lead Mechanic.</h2>";
    } else {
        try {
            // Insert the new job type into the database (with mechanic name instead of ID)
            $insert = $con->prepare("INSERT INTO `Job_Type` (`Job_Type_Name`, `Description`, `Price`, `Lead_Mechanic`) 
                                     VALUES (:Job_Type_Name, :Description, :Price, :Lead_Mechanic)");

            // Bind parameters
            $insert->bindParam(':Job_Type_Name', $jobTypeName, PDO::PARAM_STR);
            $insert->bindParam(':Description', $description, PDO::PARAM_STR);
            $insert->bindParam(':Price', $price, PDO::PARAM_INT);  // Ensure price is an integer
            $insert->bindParam(':Lead_Mechanic', $leadMechanic, PDO::PARAM_STR);  // Bind mechanic's name

            // Execute the query
            if ($insert->execute()) {
                echo "<h2>Job Type added successfully!</h2>";
            } else {
                echo "<h2>Error occurred while adding the Job Type.</h2>";
            }
        } catch (PDOException $e) {
            echo "<h2>Database error: " . htmlspecialchars($e->getMessage()) . "</h2>";
        }
    }
}
?>