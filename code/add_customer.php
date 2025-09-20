<?php
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $con->prepare("INSERT INTO Customer (Name, Address, Telephone, E_Mail, Delete_Flag) VALUES (:name, :address, :telephone, :email, 0)");
        
        $stmt->bindParam(':name', $_POST['Name']);
        $stmt->bindParam(':address', $_POST['Address']);
        $stmt->bindParam(':telephone', $_POST['Telephone']);
        $stmt->bindParam(':email', $_POST['E_Mail']);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Customer added successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error adding customer.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
    }
}
?>