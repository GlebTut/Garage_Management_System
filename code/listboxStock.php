<?php
// Database connection
include 'DBconnection.php';

try {
    // Query to get all stock items
    $sql = "SELECT * FROM Stock_Item WHERE Status = 0";
    $stmt = $con->query($sql);
    
    // Create the dropdown list
    echo "<select id='stockList' onchange='populate()'>";
    echo "<option value=''>Select a stock item</option>";

    // Fetch the data and populate the list box
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $Stock_ID = $row['Stock_ID'];
        $Description = $row['Description'];
        $Stock_Quantity = $row['Stock_Quantity'];
        $Reorder_Quantity = $row['Reorder_Quantity'];
        $Cost_Price = $row['Cost_Price'];
        $Retail_Price = $row['Retail_Price'];
        $Supplier_ID = $row['Supplier_ID'];
        $Status = $row['Status'];

        $stockDetails = "$Stock_ID|$Description|$Stock_Quantity|$Reorder_Quantity|$Cost_Price|$Retail_Price|$Supplier_ID|$Status";
        echo "<option value='$stockDetails'>$Description</option>";
    }

    echo "</select>";
    
} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}
?>