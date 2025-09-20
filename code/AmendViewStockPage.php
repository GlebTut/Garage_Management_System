<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amend / View Stock Item</title>
    <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
    <style>
        select.drop_down_list option {
            color: black !important;
            font-size: 16px !important;
        }
        .success-message {
            color: green;
            padding: 10px;
            margin: 10px 0;
        }
        .error-message {
            color: red;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <main class="amend_stock_main_conatainer">
        <section class="amend_stock_section_container">
            <form action="AmendViewStock.php" method="post" id="stockForm" class="form">
                <label for="Stock_Item">Stock Item List:</label>
                <select class="drop_down_list" id="Stock_Item" name="Stock_ID" required>
                    <option value="">---Select Stock Item---</option>
                    <?php
                    include 'DBconnection.php';
                    $stmt = $con->query("SELECT Stock_ID, Description FROM Stock_Item WHERE Status = 0");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$row['Stock_ID'].'">'.$row['Description'].' (ID: '.$row['Stock_ID'].')</option>';
                    }
                    ?>
                </select>

                <!-- Stock ID -->
                <div class="inputMain">
                    <label for="id">Stock ID</label>
                    <input type="text" id="id" name="Stock_ID" readonly>
                </div>

                <!-- Description -->
                <div class="inputMain">
                    <label for="Description">Description</label>
                    <input type="text" id="Description" name="Description" required>
                </div>

                <!-- Stock Quantity -->
                <div class="inputMain">
                    <label for="Stock_Quantity">Stock Quantity</label>
                    <input type="number" id="Stock_Quantity" name="Stock_Quantity" required min="0">
                </div>

                <!-- Reorder Level -->
                <div class="inputMain">
                    <label for="Reorder_Level">Reorder Level</label>
                    <input type="number" id="Reorder_Level" name="Reorder_Level" required min="0">
                </div>

                <!-- Reorder Quantity -->
                <div class="inputMain">
                    <label for="Reorder_Quantity">Reorder Quantity</label>
                    <input type="number" id="Reorder_Quantity" name="Reorder_Quantity" required min="0">
                </div>

                <!-- Cost Price -->
                <div class="inputMain">
                    <label for="Cost_Price">Cost Price</label>
                    <input type="number" id="Cost_Price" name="Cost_Price" required step="0.01" min="0">
                </div>

                <!-- Retail Price -->
                <div class="inputMain">
                    <label for="Retail_Price">Retail Price</label>
                    <input type="number" id="Retail_Price" name="Retail_Price" required step="0.01" min="0">
                </div>

                <!-- Supplier ID -->
                <div class="inputMain">
                    <label for="Supplier_ID">Supplier ID</label>
                    <input type="text" id="Supplier_ID" name="Supplier_ID" readonly>
                </div>

                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Update" class="formButton">
                </div>
            </form>

            <?php include 'StockList.php'; ?>
        </section>
    </main>

    <script>
        document.getElementById('Stock_Item').addEventListener('change', function() {
            const stockId = this.value;
            if (!stockId) return;
            
            fetch('getStockItem.php?id=' + stockId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id').value = data.Stock_ID;
                    document.getElementById('Description').value = data.Description;
                    document.getElementById('Stock_Quantity').value = data.Stock_Quantity;
                    document.getElementById('Reorder_Level').value = data.Reorder_Level;
                    document.getElementById('Reorder_Quantity').value = data.Reorder_Quantity;
                    document.getElementById('Cost_Price').value = data.Cost_Price;
                    document.getElementById('Retail_Price').value = data.Retail_Price;
                    document.getElementById('Supplier_ID').value = data.Supplier_ID;
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('stockForm').addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to update this stock item?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>