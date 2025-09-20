<!--
    Student: Gleb Tutubalin C00290944
    Date:    20.02.2025
    Description: Creating a new invoice from a supplier and adding it to the database
-->
<?php
include 'DBconnection.php'; // Database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting the values from the form
    $supplier_id = $_POST['supplier_id'];
    $invoice_reference_number = $_POST['invoice_reference_number'];
    $invoice_date = $_POST['invoice_date'];
    $invoice_amount = $_POST['invoice_amount'];
try {
    // insert the new invoice into the database
    $insert = $con->prepare("INSERT INTO `Invoice`(`Supplier_ID`, `Invoice_Ref`, `Invoice_Date`, `Amount`) 
    VALUES (:supplier_id, :invoice_reference_number, :invoice_date, :invoice_amount)");

    // Bind the parameters
    $insert->bindParam(':supplier_id', $supplier_id);
    $insert->bindParam(':invoice_reference_number', $invoice_reference_number);
    $insert->bindParam(':invoice_date', $invoice_date);
    $insert->bindParam(':invoice_amount', $invoice_amount);

    // Execute the query
    if($insert->execute())
        {
        echo "<h2>New invoice was added successfully.</h2>";

        }
    else
        {
        echo "error occur during inserting data to database.";
        error_log("Dtabase Error: ".print_r($insert->errorInfo(),true));
        }

} 
    catch (PDOException $e) 
        {
        echo("Databse error: ".$e->getMessage());
        error_log("database error: ".$e->getMessage());
    }
}
?>