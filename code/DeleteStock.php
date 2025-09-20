<?php 
session_start();
include 'DBconnection.php';

try {
    // Get the POST data
    $stock_id = $_POST['delid'];
    $description = $_POST['deldesc'];
    $stock_qty = $_POST['delstockq'];
    $reorder_qty = $_POST['delreorderq'];
    $cost_price = $_POST['delcost'];
    $retail_price = $_POST['delretail'];
    $supplier_id = $_POST['delsupplier'];
    $status = $_POST['delstatus'];

    // Prepare the update statement with PDO
    $sql = "UPDATE Stock_Item 
            SET Status = 1 
            WHERE Stock_ID = :stock_id 
            AND Stock_Quantity = 0 
            AND Reorder_Quantity = 0";
    
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        // Set session variables for success message
        $_SESSION["Stock_ID"] = $stock_id;
        $_SESSION["Description"] = $description;
        $_SESSION["delete_success"] = true;
        $_SESSION["delete_message"] = "Successfully deleted stock item: $description";
    } else {
        $_SESSION["delete_success"] = false;
        $_SESSION["delete_message"] = "Item not deleted - either it has stock quantity or reorder quantity";
    }

    // Redirect back
    header('Location: DeleteStock.html.php');
    exit();
    
} catch (PDOException $e) {
    // Log error and show message
    error_log("Delete error: " . $e->getMessage());
    $_SESSION["error"] = "Error deleting item. Please try again.";
    header('Location: DeleteStock.html.php');
    exit();
}
?>