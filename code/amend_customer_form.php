<?php
include 'DBconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amend Customer | GMS</title>
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
    <script>
        function validateForm() {
            let name = document.getElementById("customer_name").value;
            let email = document.getElementById("customer_email").value;
            let phone = document.getElementById("customer_telephone").value;
            let address = document.getElementById("customer_address").value;
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let phonePattern = /^\d{10,15}$/;

            if (name.trim() === "" || email.trim() === "" || address.trim() === "") {
                alert("Please fill in all required fields.");
                return false;
            }
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (phone.trim() !== "" && !phonePattern.test(phone)) {
                alert("Please enter a valid phone number (10-15 digits).");
                return false;
            }
            return confirm("Are you sure you want to save the changes? (Y/N)");
        }
    </script>
</head>
<body>
    <main class="main_form_container">
        <div class="div">
            <div class="form_title">
                <h1>Amend Customer</h1>
            </div>
            <form action="amend_customer.php" method="post" id="form" class="form" onsubmit="return validateForm()">
                
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
                
                <!-- Form Fields -->
                <div class="inputMain">
                    <label for="customer_name">Customer's Name:</label>
                    <input type="text" id="customer_name" name="Name" required>
                </div>
                <div class="inputMain">
                    <label for="customer_email">Email:</label>
                    <input type="email" id="customer_email" name="E_Mail" required>
                </div>
                <div class="inputMain">
                    <label for="customer_telephone">Telephone:</label>
                    <input type="text" id="customer_telephone" name="Telephone">
                </div>
                <div class="inputMain">
                    <label for="customer_address">Address:</label>
                    <input type="text" id="customer_address" name="Address">
                </div>
                
                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Save Changes" class="formButton">
                </div>

                 <!-- success /error message will show here -->
            <p id="message"></p>

            </form>
        </div>
    </main>
</body>
</html>