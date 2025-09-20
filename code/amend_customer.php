<?php
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $con->prepare("UPDATE Customer SET Name = :name, Address = :address, Telephone = :telephone, E_Mail = :email WHERE Customer_ID = :customer_id AND Delete_Flag = 0");
        
        $stmt->bindParam(':customer_id', $_POST['Customer_ID']);
        $stmt->bindParam(':name', $_POST['Name']);
        $stmt->bindParam(':address', $_POST['Address']);
        $stmt->bindParam(':telephone', $_POST['Telephone']);
        $stmt->bindParam(':email', $_POST['E_Mail']);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Customer details updated successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error updating customer.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
    }
}
?>