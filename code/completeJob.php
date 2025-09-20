<?php
// completeJob.php
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_job'])) {
    $job_id = $_POST['job_id'];
    $time_taken = $_POST['time_taken'];
    $spare_parts_stock = $_POST['spare_part_stock']; // Array of stock numbers.
    $spare_parts_qty = $_POST['spare_part_qty'];     // Array of corresponding quantities.

    try {
        // Begin transaction for atomicity.
        $con->beginTransaction();

        // 1. Update the Job table: set the time taken and mark the job as 'Completed'
        $stmt = $con->prepare("UPDATE Job SET Time_Taken = ?, Status = 'Completed' WHERE Job_ID = ?");
        $stmt->execute([$time_taken, $job_id]);

        // 2. Process each spare part used.
        for ($i = 0; $i < count($spare_parts_stock); $i++) {
            $stock_id = trim($spare_parts_stock[$i]);
            $quantity = intval($spare_parts_qty[$i]);

            if ($stock_id !== '' && $quantity > 0) {
                // Manually generate a unique Job_Part_ID.
                $stmtMax = $con->query("SELECT COALESCE(MAX(Job_Part_ID), 0) AS max_id FROM Job_Parts");
                $row = $stmtMax->fetch(PDO::FETCH_ASSOC);
                $newJobPartID = $row['max_id'] + 1;

                // Insert into Job_Parts.
                $stmtInsert = $con->prepare("INSERT INTO Job_Parts (Job_Part_ID, Job_ID, Stock_ID, Quantity) VALUES (?, ?, ?, ?)");
                $stmtInsert->execute([$newJobPartID, $job_id, $stock_id, $quantity]);

                // Update the Stock_Item table to deduct the used quantity.
                $stmtUpdate = $con->prepare("UPDATE Stock_Item SET Stock_Quantity = Stock_Quantity - ? WHERE Stock_ID = ?");
                $stmtUpdate->execute([$quantity, $stock_id]);
            }
        }

        // Commit the transaction.
        $con->commit();

        // Redirect to a payment or confirmation page.
        header("Location: payment.php?job_id=" . urlencode($job_id));
        exit();
    } catch (Exception $e) {
        // Roll back the transaction if an error occurs.
        $con->rollBack();
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    // If accessed directly, redirect back to the form.
    header("Location: completeJobForm.php");
    exit();
}
?>
