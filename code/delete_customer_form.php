<?php
include 'DBconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer | GMS</title>
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this customer? (Y/N)");
        }
    </script>
</head>
<body>
    <main class="main_form_container">
        <div class="div">
            <div class="form_title">
                <h1>Delete Customer</h1>
            </div>
            <form action="delete_customer.php" method="post" id="form" class="form" onsubmit="return confirmDeletion()">
                
                <!-- Select Customer -->
                <div class="inputMain">
                    <label for="customer_id">Select Customer:</label>
                    <select class="drop_down_list" name="Customer_ID" id="customer_id" required>
                        <option value="">---Select Customer---</option>
                        <?php
                        $query = "SELECT Customer_ID, Name FROM Customer WHERE Delete_Flag = 0 ORDER BY Name ASC";
                        foreach ($con->query($query) as $row) {
                            echo "<option value='{$row['Customer_ID']}'>{$row['Name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Delete Customer" class="formButton">
                </div>

                 <!-- success /error message will show here -->
            <p id="message"></p>

            </form>
        </div>
    </main>
</body>
</html>