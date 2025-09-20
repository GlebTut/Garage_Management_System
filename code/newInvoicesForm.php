<!--
    Student: Gleb Tutubalin C00290944
    Date:    02.2025
    Description: Creating a new invoice from a supplier and adding it to the database
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Invoice|GMS</title>
    <link rel="stylesheet" href="./Assets/css/invoicesForm.css">
</head>
<body>
    <main class="main_form_container">
        <div class="div">
        <div class="form_title">
            <h1>New Invoice from Supplier</h1>
        </div>
        <!-- Form for adding a new invoice -->
        <form method="post" action="AddNewInvoices.php" id="form" class="form" onsubmit="return validateForm()">
        
        <!-- Select the supplier -->
        <div class="inputMain">
        <label for="supplier_id">Supplier:</label>
        <select name="supplier_id" id="supplier_id" class="inputMain">
            <?php
            include 'DBconnection.php';
            // Getting all suppliers from the database
            try {
                // Selecting all suppliers that are not deleted
                $select = $con->prepare("SELECT `Supplier_ID`, `Name`, `Address` FROM `Supplier` WHERE `Delete_Flag`=0");
                // Executing the query
                $select->execute();
                // Fetching the result
                $result = $select->fetchAll(PDO::FETCH_ASSOC);

                // Displaying the suppliers in the dropdown
                if ($result) {
                    foreach ($result as $row) {
                        echo "<option value='" . $row["Supplier_ID"] . "'>" . $row["Name"] . " - " . $row["Address"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Suppliers are not found</option>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </select>
        </div>

        <!-- Reference Number -->
        <div class="inputMain">
        <label for="invoice_reference_number">Reference Number:</label>
        <input type="text" name="invoice_reference_number" id="invoice_reference_number" placeholder="Enter reference number" required pattern="[A-Za-z0-9]+" title="Only letters and numbers are allowed">
        </div>
        
        <!-- Date of Invoice -->
        <div class="inputMain">
        <label for="invoice_date">Date of Invoice:</label>
        <input type="date" name="invoice_date" id="invoice_date" required>
        </div>  

        <!-- Amount of Invoice -->
        <div class="inputMain">
        <label for="invoice_amount">Amount of Invoice:</label>
        <input type="number" name="invoice_amount" id="invoice_amount" placeholder="Enter amount" required>
        </div>  

        <!-- Form Buttons -->
        <div class="form_buttons">
            <input type="reset" value="Cancel" class="formButton">
            <input type="submit" value="Add Invoice" class="formButton">
        </div>
        <!-- success /error message will show here -->
        <p id="message"></p>
    </form>
    </div>
</main>
<script>
    // Setting the current date as the default value for the date field
    document.addEventListener("DOMContentLoaded", function() {
        let dateField = document.getElementById("invoice_date");
        let today = new Date().toISOString().split('T')[0];
        dateField.value = today;
    });

    // Validation for the date field and confirmation message
    function validateForm() {
        let dateField = document.getElementById("invoice_date");
        let selectedDate = new Date(dateField.value);
        let today = new Date();

        // Ensure the selected date is not in the future
        if (selectedDate > today) {
            alert("The date of the invoice cannot be in the future.");
            return false;
        }

        // Show confirmation message
        return confirm("Are you sure you want to submit this invoice?");
    }
</script>
</body>
</html>