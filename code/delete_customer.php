<?php
include 'DBconnection.php'; // Ensure you have a database connection file


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['Customer_ID'];

    // Check if the customer has pending bookings
    $stmt = $con->prepare("SELECT COUNT(*) AS count FROM Booking WHERE Customer_ID = ? AND Status NOT IN ('Completed', 'Cancelled')");
    $stmt->execute([$customer_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "<p style='color: red;'>Customer cannot be deleted as there are pending bookings.</p>";
    } else {
        $stmt = $con->prepare("UPDATE Customer SET Delete_Flag = 1 WHERE Customer_ID = ?");
        if ($stmt->execute([$customer_id])) {
            echo "<p style='color: green;'>Customer marked as deleted.</p>";
        } else {
            echo "<p style='color: red;'>Error deleting customer.</p>";
        }
    }
}
?>