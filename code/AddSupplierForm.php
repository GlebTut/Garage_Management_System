<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier|GMS</title>
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
</head>

<body>
    <main class="main_form_container">
        <div class="div">
        <div class="form_title">
            <h1>Add Suppiler</h1>
        </div>
        <form action="AddSupplier.php" method="post" id="form" class="form">

            <!-- name -->
             <div class="inputMain">
            <label for="supplier_name">Supplier's Name: </label>
            <input type="text" id="supplier_name" placeholder="Enter supplier's name" name="name" required>
            </div>


            <!-- Email -->
             <div class="inputMain">
            <label for="supplier_email">Supplier's Email: </label>
            <input type="email" id="supplier_email" placeholder="Enter supplier's email" name="email" required>
            </div>

            <!--  telephone-->
              <div class="inputMain">
            <label for="supplier_telephone">Supplier's Telephone: </label>
            <input type="text" id="supplier_telephone" placeholder="Enter supplier's Telephone" name="telephone" required>
            </div>

            <!-- Address -->
             <div class="inputMain">
            <label for="supplier_address">Supplier's Address: </label>
            <input type="text" id="supplier_address" placeholder="Enter supplier's address" name="address" required>
            </div>

<!-- Website URL -->
<div class="inputMain">
                    <label for="web_url">Website URL: </label>
                    <input type="url" id="web_url" placeholder="Enter website URL, https://example.com" name="web_url" >
                </div>

            <!-- Form Buttons -->
            <div class="form_buttons">
                <input type="reset" value="Cancel" class="formButton">
                <input type="submit" value="Add Supplier" class="formButton">
            </div>
            <!-- success /error message will show here -->
            <p id="message"></p>
        </form>
        </div>
    </main>
    <script src="./Assets/js/supplierFormValidation.js"></script>
<script src="./Assets/js/supplierFormValidation.js"></script>
</body>

</html>