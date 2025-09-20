<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: This file is responsible for creating an order for the selected supplier and stock items.
-->
<?php
// Connection to the database
include 'DBconnection.php';

// Check if the form was submitted
// If the form was submitted, create the order and display the reorder letter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start a transaction
        $con->beginTransaction();

        // Get supplier details
        $supplierId = $_POST['supplier_id'];
        $stmt = $con->prepare("SELECT * FROM Supplier WHERE Supplier_ID = ?");
        $stmt->execute([$supplierId]);
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the supplier exists
        if (!$supplier) {
            throw new Exception("Supplier not found.");
        }

        // Create order
        $orderStmt = $con->prepare("INSERT INTO `Order` (Supplier_ID, Order_Date, Delivery_Date) VALUES (?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 14 DAY))");
        $orderStmt->execute([$supplierId]);
        // Get the last inserted Order_ID
        $orderId = $con->lastInsertId();

        // Add order items
        foreach ($_POST['stock_ids'] as $key => $stockId) {
            $quantity = $_POST['quantities'][$key];

            // Insert order item
            $itemStmt = $con->prepare("INSERT INTO `Stock_Item/Order` (Order_ID, Stock_ID, Quantity) VALUES (?, ?, ?)");
            $itemStmt->execute([$orderId, $stockId, $quantity]);
        }

        $con->commit();

        // Generate reorder letter
        echo "<div style='font-family: Arial, sans-serif; line-height: 1.6;'>";
        echo "<p style='text-align: right;'>Gerry’s Garage,<br>High Street,<br>Carlow<br>" . date("Y-m-d") . "</p>";
        echo "<p>" . htmlspecialchars($supplier['Name']) . ",<br>" . nl2br(htmlspecialchars($supplier['Address'])) . "</p>";
        echo "<p><strong>Order Number:</strong> " . htmlspecialchars($orderId) . "</p>";
        echo "<p>Please supply the following stock item(s):</p>";
        echo "<table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>";
        echo "<thead>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Stock</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Item Description</th>";
        echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Quantity</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Fetch stock item details
        foreach ($_POST['stock_ids'] as $key => $stockId) {
            $quantity = $_POST['quantities'][$key];
            $stockStmt = $con->prepare("SELECT Description FROM Stock_Item WHERE Stock_ID = ?");
            $stockStmt->execute([$stockId]);
            $stock = $stockStmt->fetch(PDO::FETCH_ASSOC);

            echo "<tr>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($stockId) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($stock['Description']) . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($quantity) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "<p style='margin-top: 20px;'>Yours sincerely,<br><br>xxxxxxxxxxxxxxxxxxxxxx<br>Stock Controller</p>";
        echo "</div>";

    } catch (PDOException $e) {
        // Rollback the transaction if an error occurred
        $con->rollBack();
        die("Order creation failed: " . $e->getMessage());
    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        $con->rollBack();
        die("Order creation failed: " . $e->getMessage());
    }
}
?>