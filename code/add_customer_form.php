<?php
include 'DBconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer | GMS</title>
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
            return true;
        }
    </script>
</head>
<body>
    <main class="main_form_container">
        <div class="div">
            <div class="form_title">
                <h1>Add Customer</h1>
            </div>
            <form action="add_customer.php" method="post" id="form" class="form" onsubmit="return validateForm()">
                
                <!-- Name -->
                <div class="inputMain">
                    <label for="customer_name">Customer's Name:</label>
                    <input type="text" id="customer_name" placeholder="Enter customer's name" name="Name" required>
                </div>

                <!-- Email -->
                <div class="inputMain">
                    <label for="customer_email">Customer's Email:</label>
                    <input type="email" id="customer_email" placeholder="Enter customer's email" name="E_Mail" required>
                </div>

                <!-- Telephone -->
                <div class="inputMain">
                    <label for="customer_telephone">Customer's Telephone:</label>
                    <input type="text" id="customer_telephone" placeholder="Enter customer's telephone" name="Telephone">
                </div>

                <!-- Address -->
                <div class="inputMain">
                    <label for="customer_address">Customer's Address:</label>
                    <input type="text" id="customer_address" placeholder="Enter customer's address" name="Address">
                </div>
                
                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Add Customer" class="formButton">
                </div>

                 <!-- success /error message will show here -->
            <p id="message"></p>
            </form>
        </div>
    </main>
</body>
</html>