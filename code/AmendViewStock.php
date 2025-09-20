<?php 
session_start();
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $update = $con->prepare("UPDATE Stock_Item SET 
            Description = :Description,
            Stock_Quantity = :Stock_Quantity,
            Reorder_Level = :Reorder_Level,
            Reorder_Quantity = :Reorder_Quantity,
            Cost_Price = :Cost_Price, 
            Retail_Price = :Retail_Price,
            Supplier_ID = :Supplier_ID 
            WHERE Stock_ID = :Stock_ID");
        
        $update->execute([
            ':Stock_ID' => $_POST['Stock_ID'],
            ':Description' => $_POST['Description'],
            ':Stock_Quantity' => $_POST['Stock_Quantity'],
            ':Reorder_Level' => $_POST['Reorder_Level'],
            ':Reorder_Quantity' => $_POST['Reorder_Quantity'],
            ':Cost_Price' => $_POST['Cost_Price'],
            ':Retail_Price' => $_POST['Retail_Price'],
            ':Supplier_ID' => $_POST['Supplier_ID']
        ]);

        if ($update->rowCount() > 0) {
            $_SESSION['message'] = "Stock Item updated successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "No changes made or item not found";
            $_SESSION['message_type'] = "error";
        }
    } catch (PDOException $e) {
        error_log("Database Error: ".$e->getMessage());
        $_SESSION['message'] = "Error updating stock item";
        $_SESSION['message_type'] = "error";
    }
    
    header('Location: AmendViewStockPage.php');
    exit();
}
?>