<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: Displaying a list of unpaid invoices from suppliers
-->
<?php
// Connection to the database
include 'DBconnection.php';

try {
    // Defining the sorting order
    $order_by = "Invoice_Date ASC, Amount DESC"; // Default sorting order
    if (isset($_GET['sort_by'])) {
        if ($_GET['sort_by'] == 'supplier') {
            $order_by = "Supplier.Name ASC, Invoice_Date ASC"; // Fixed column name
        }
    }

    // Getting all unpaid invoices
    $sql = "SELECT Invoice.`Invoice_Ref`, Invoice.`Invoice_Date`, Supplier.`Name`, Invoice.`Amount`, Invoice.`Invoice_ID`
            FROM `Invoice`
            JOIN `Supplier` ON Invoice.`Supplier_ID` = Supplier.`Supplier_ID`
            WHERE Invoice.`Status` = 'ISSUED'
            ORDER BY $order_by";
    // Executing the query
    $result = $con->query($sql);

    if ($result) {
        // Displaying the table with the invoices
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr class='table_row'>";
                echo "<td>" . htmlspecialchars($row['Invoice_Ref']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Invoice_Date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Invoice_ID']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No unpaid invoices found</td></tr>";
        }
    } else {
        echo "An error occurred while fetching data from the database.";
        error_log("Database Error: " . print_r($con->errorInfo(), true));
    }
} catch (PDOException $e) {
    echo("Database error: " . $e->getMessage());
    error_log("Database error: " . $e->getMessage()); // Fixed typo in variable name
}
?>