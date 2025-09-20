<?php
include 'DBconnection.php';

$sql = "SELECT Stock_ID, Description, Stock_Quantity, Reorder_Level, Reorder_Quantity,
        Cost_Price, Retail_Price, Supplier_ID FROM Stock_Item WHERE Status = 0";
$result = $con->query($sql);
$items = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="stock_list_container_heading">
    <h2 class="heading">List of Current Stock Items</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="<?php echo $_SESSION['message_type'] === 'success' ? 'success-message' : 'error-message'; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
    <?php endif; ?>
</div>

<div class="stock_table_conatainer">
    <table class="table">
        <tr class="table-column">
            <th>Stock ID</th>
            <th>Description</th>
            <th>Stock Quantity</th>
            <th>Reorder Level</th>
            <th>Reorder Quantity</th>
            <th>Cost Price</th>
            <th>Retail Price</th>
            <th>Supplier ID</th>
        </tr>
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <tr class="table_row">
                    <td><?php echo htmlspecialchars($item['Stock_ID']); ?></td>
                    <td><?php echo htmlspecialchars($item['Description']); ?></td>
                    <td><?php echo htmlspecialchars($item['Stock_Quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['Reorder_Level']); ?></td>
                    <td><?php echo htmlspecialchars($item['Reorder_Quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['Cost_Price']); ?></td>
                    <td><?php echo htmlspecialchars($item['Retail_Price']); ?></td>
                    <td><?php echo htmlspecialchars($item['Supplier_ID']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8"><h2>No records available!</h2></td>
            </tr>
        <?php endif; ?>
    </table>
</div>