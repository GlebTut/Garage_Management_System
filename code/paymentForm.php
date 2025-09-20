<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: This file is responsible for processing payments to suppliers.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment to Suppliers</title>
    <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">    
    <script>
        function confirmSubmission() {
            return confirm("Are you sure you want to process this payment?");
        }
    </script>
</head>
<body>
    <main class="delete_supplier_main_conatainer">
        <div class="form-title">
            <h1>Payment to Suppliers</h1>
        </div>

        <!-- Combined Form -->
        <form method="post" action="" id="paymentForm" class="form" onsubmit="return confirmSubmission();">
            <label for="supplier_id">Supplier:</label>
            <select name="supplier_id" id="supplier_id" class="drop_down_list" required onchange="this.form.submit()">
                <option value="" disabled selected>--Select--</option> <!-- Default option -->
                <?php
                include 'DBconnection.php';
                // Getting all suppliers from the database
                try {
                    $select = $con->prepare("SELECT `Supplier_ID`, `Name`, `Address` FROM `Supplier` WHERE `Delete_Flag` = 0");
                    $select->execute();
                    $result = $select->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        foreach ($result as $row) {
                            // Pre-select the supplier if the form was submitted
                            $selected = (isset($_POST['supplier_id']) && $_POST['supplier_id'] == $row["Supplier_ID"]) ? "selected" : "";
                            echo "<option value='" . htmlspecialchars($row["Supplier_ID"]) . "' $selected>" . htmlspecialchars($row["Name"]) . " - " . htmlspecialchars($row["Address"]) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No suppliers found</option>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . htmlspecialchars($e->getMessage());
                }
                ?>
            </select><br><br>
        </form>

        <?php
        // Check if the form was submitted and the supplier was selected
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supplier_id'])) {
            $supplier_id = $_POST['supplier_id']; // Get the supplier ID from the form submission

            // Getting all unpaid invoices for the selected supplier
            try {
                $stmt = $con->prepare("SELECT `Invoice_Ref`, `Amount` FROM `Invoice` WHERE `Supplier_ID` = ? AND `Status` = 'ISSUED'");
                $stmt->execute([$supplier_id]);
                $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display the unpaid invoices
                if (!empty($invoices)) {
                    $total_amount = 0;

                    // Calculate the total amount of unpaid invoices
                    foreach ($invoices as $invoice) {
                        $total_amount += $invoice['Amount'];
                    }

                    // Generating the letter to the supplier
                    $stmt = $con->prepare("SELECT `Name`, `Address` FROM `Supplier` WHERE `Supplier_ID` = ?");
                    $stmt->execute([$supplier_id]);
                    $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Display the unpaid invoices
                    if ($supplier) {
                        echo "<div class='form_title'>";
                        echo "<h2 class='heading'>Unpaid Invoices for " . htmlspecialchars($supplier['Name']) . "</h2>";
                        echo "</div>";
                        echo "<div class='supplier_table_conatainer'>";
                        echo "<table class='table' border='1' style='width: 100%; border-collapse: collapse;'>";
                        echo "<tr class='table-column'><th>Your Invoice Reference</th><th>Amount</th></tr>";
                        foreach ($invoices as $invoice) {
                            echo "<tr class='table-row'><td>" . htmlspecialchars($invoice['Invoice_Ref']) . "</td><td>" . htmlspecialchars($invoice['Amount']) . "</td></tr>";
                        }
                        echo "<tr class='table-column'><td><strong>Total Payment</strong></td><td><strong>" . htmlspecialchars($total_amount) . "</strong></td></tr>";
                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "<p>Supplier not found.</p>";
                    }
                } else {
                    echo "<p>No unpaid invoices found for the selected supplier.</p>";
                }
            } catch (PDOException $e) {
                // Display an error message if there was an error fetching the invoices
                echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        ?>

        <!-- New form to execute payment.php -->
        <div class="form_buttons">
            <form method="post" action="payment.php" onsubmit="return confirmSubmission();" id="processPaymentForm" class="form">
                <input type="hidden" name="supplier_id" value="<?php echo isset($supplier_id) ? htmlspecialchars($supplier_id) : ''; ?>">
                <input type="submit" value="Process Payment" class="formButton">
            </form>
        </div>
    </main>
</body>
</html>