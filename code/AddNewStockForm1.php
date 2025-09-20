<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Stock Item|GMS</title>
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
</head>

<body>
    <main class="main_form_container">
        <div class="div">
        <div class="form_title">
            <h1>Add New Stock Item</h1>
        </div>
        <form action="AddNewStock1.php" method="post" id="form" class="form">

            <!-- Description -->
             <div class="inputMain">
            <label for="Description">Description: </label>
            <input type="text" id="sDescription" placeholder="Enter a description of the new stock item" name="Description" required>
            </div>


            <!-- Stock Quantity -->
             <div class="inputMain">
            <label for="Stock_Quantity">Stock Quantity: </label>
            <input type="text" id="Stock_Quantity" placeholder="Enter the quantity of stock" name="Stock_Quantity" required>
            </div>

            <!-- Reorder Quantity -->
              <div class="inputMain">
            <label for="Reorder_Quantity">Reorder Quantity: </label>
            <input type="text" id="Reorder_Quantity" placeholder="Enter the reorder quantity for the stock item" name="Reorder_Quantity" required>
            </div>

            <!-- Cost Price -->
             <div class="inputMain">
            <label for="Cost_Price">Cost Price: </label>
            <input type="text" id="Cost_Price" placeholder="Enter the cost price of the new stock item" name="Cost_Price" required>
            </div>

            <!-- Retail Price -->
            <div class="inputMain">
            <label for="Retail_Price">Retail Price: </label>
            <input type="text" id="Retail_Price" placeholder="Enter the retail price of the new stock item" name="Retail_Price" required>
            </div>

            <!-- Form Buttons -->
            <div class="form_buttons">
                <input type="reset" value="Cancel" class="formButton">
                <input type="submit" value="Add New Stock Item" class="formButton">
            </div>
            <!-- success /error message will show here -->
            <p id="message"></p>
        </form>
        </div>
    </main>
    <script src="./Assets/js/NewStockValidation.js"></script>
</body>

</html>