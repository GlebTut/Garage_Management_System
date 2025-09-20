<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: Displaying a list of unpaid invoices from suppliers
-->
<?php
// Connection to the database
include 'DBconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpaid Invoices Report</title>
    <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
</head>
<body>
	<main class="delete_supplier_main_container">
        <section class="suppliers_list_section_container">
            <div class="form_title">
                <h2>List of Unpaid Invoices</h2>
            </div>
            <!-- Sorting buttons -->
            <form method="get" action="unpaidInvoicesReport.php" id="form">
                <button type="submit" name="sort_by" value="date" <?php if (!isset($_GET['sort_by']) || $_GET['sort_by'] == 'date') echo 'disabled'; ?>>Date</button>
                <button type="submit" name="sort_by" value="supplier" <?php if (isset($_GET['sort_by']) && $_GET['sort_by'] == 'supplier') echo 'disabled'; ?>>Supplier</button></div>
            </form>
            
            <!-- Table with the invoices -->
            <div class="supplier_table_conatainer">
                <table class="table">
                    <tr class="table-column">
                        <th>Supplier’s Invoice Reference</th>
                        <th>Date of Invoice</th>
                        <th>Supplier Name</th>
                        <th>Amount of Invoice</th>
                        <th>Our Invoice Number</th>
                    </tr>
                    <!-- Displaying the invoices -->
                    <?php include 'unpaidInvoices.php'; ?>
                </table>
            </div>            
        </section>
    </main>
</body>
</html>