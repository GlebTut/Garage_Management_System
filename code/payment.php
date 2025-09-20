<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: This file is responsible for processing payments for suppliers.
-->
<?php
include 'DBconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_id = $_POST['supplier_id'];

    try {
        // Getting all unpaid invoices for the selected supplier
        $stmt = $con->prepare("SELECT `Invoice_Ref`, `Amount`, `Invoice_ID` FROM `Invoice` WHERE `Supplier_ID` = ? AND `Status` = 'ISSUED'");
        $stmt->execute([$supplier_id]);
        $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($invoices)) {
            $total_amount = 0;

            foreach ($invoices as $invoice) {
                $total_amount += $invoice['Amount'];
            }

            // Inserting a new payment record
            $stmt = $con->prepare("INSERT INTO `Payment` (`Date_Of_Payment`, `Total_Price`) VALUES (NOW(), ?)");
            $stmt->execute([$total_amount]);

            // Get the last inserted Payment_ID
            $payment_id = $con->lastInsertId();

            // Updating the status of the invoices to paid and setting the Payment_ID
            $stmt = $con->prepare("UPDATE `Invoice` SET `Status` = 'PAID', `Payment_ID` = ? WHERE `Supplier_ID` = ? AND `Status` = 'ISSUED'");
            $stmt->execute([$payment_id, $supplier_id]);

            // Generating the letter to the supplier
            $stmt = $con->prepare("SELECT `Name`, `Address` FROM `Supplier` WHERE `Supplier_ID` = ?");
            $stmt->execute([$supplier_id]);
            $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($supplier) {
                echo "<div style='font-family: Arial, sans-serif; line-height: 1.6;'>";
                echo "<p style='text-align: right;'>Gerry’s Garage,<br>High Street,<br>Carlow<br>" . date("Y-m-d") . "</p>";
                echo "<p>" . htmlspecialchars($supplier['Name']) . ",<br>" . nl2br(htmlspecialchars($supplier['Address'])) . "</p>";
                echo "<p>Enclosed please find cheque for <strong>total amount</strong> in payment of the following invoices:</p>";
                echo "<table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>";
                echo "<thead>";
                echo "<tr style='background-color: #f2f2f2;'>";
                echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Your Invoice Reference</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px; text-align: left;'>Amount</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($invoices as $invoice) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($invoice['Invoice_Ref']) . "</td>";
                    echo "<td style='border: 1px solid #ddd; padding: 8px;'>€" . htmlspecialchars(number_format($invoice['Amount'], 2)) . "</td>";
                    echo "</tr>";
                }

                echo "<tr style='font-weight: bold;'>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>Total Payment</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>€" . htmlspecialchars(number_format($total_amount, 2)) . "</td>";
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
                echo "<p style='margin-top: 20px;'>Yours sincerely,<br><br>xxxxxxxxxxxxxxxxxxxxxx<br>Manager</p>";
                echo "</div>";
            } else {
                echo "Supplier not found.";
            }
        } else {
            echo "No unpaid invoices found for the selected supplier.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>