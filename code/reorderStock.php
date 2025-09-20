<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: This file is responsible for reordering stock items.
-->
<?php
// reorderStock.php
include 'DBconnection.php';

try {
    $sql = "SELECT Stock_Item.Stock_ID, Stock_Item.Description, Stock_Item.Stock_Quantity, 
                   Stock_Item.Reorder_Level, Stock_Item.Reorder_Quantity, Stock_Item.Cost_Price, 
                   Stock_Item.Retail_Price, Supplier.Name, Supplier.Supplier_ID
            FROM Stock_Item 
            INNER JOIN Supplier ON Stock_Item.Supplier_ID = Supplier.Supplier_ID";

    $result = $con->query($sql);

    if ($result) {
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr class='table-row' data-supplier-id='{$row['Supplier_ID']}'>";
                echo "<td>" . htmlspecialchars($row['Stock_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Stock_Quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Reorder_Level']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Reorder_Quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Cost_Price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Retail_Price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                echo "<td><button onclick='selectItem(\"{$row['Stock_ID']}\", \"{$row['Supplier_ID']}\", {$row['Reorder_Quantity']})'>
                        Select
                      </button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No stock items found</td></tr>";
        }
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='9'>Database error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>