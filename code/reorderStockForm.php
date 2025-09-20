<!--
    Student: Gleb Tutubalin C00290944
    Date:    03.2025
    Description: This file is responsible for reordering stock items.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reorder Stock</title>
    <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
    <style>
        .disabled-row {
            opacity: 0.5; /* Make the row appear faded */
            pointer-events: none; /* Prevent interaction with the row */
        }
    </style>
</head>
<body>
    <main class="delete_supplier_main_container">
        <section class="suppliers_list_section_container">
            <div class="form_title">
                <h2>Reorder Stock</h2>
            </div>
            <!-- Stock Listing -->
            <div class="supplier_table_conatainer">
                <table class="table">
                    <tr class="table-column">
                        <th>Stock Number</th>
                        <th>Stock Description</th>
                        <th>Qty in Stock</th>
                        <th>Reorder Level</th>
                        <th>Reorder Qty</th>
                        <th>Cost Price</th>
                        <th>Retail Price</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                    <?php include 'reorderStock.php'; ?>
                </table>
            </div>
            <!-- Current Order Section -->
            <div id="current-order">
                <h2>Current Reorder Items</h2>
                <form action="createOrder.php" method="POST" id="form" class="form">
                    <div id="selected-items"></div>
                    <input type="hidden" name="supplier_id" id="supplier-id">
                    <!--<button type="button" onclick="addMoreItems()" id="add-more" disabled>Add More Items</button>-->
                    <button type="submit">Generate Order</button>
                </form>
            </div>
        </section>
    </main>
    <script>
        // JavaScript code to handle the reorder stock form
        let selectedSupplierId = null;
        // Get all stock rows
        const stockRows = document.querySelectorAll('tr[data-supplier-id]');

        // Add event listeners to the select buttons
        function selectItem(stockId, supplierId, suggestedQty) {
            if (!selectedSupplierId) {
                selectedSupplierId = supplierId;
                document.getElementById('supplier-id').value = supplierId;
                //document.getElementById('add-more').disabled = false;
                filterSupplierRows(supplierId); // Show only the selected supplier's stock items
            }

            // Prompt the user to enter the quantity
            let qty = prompt(`Enter order quantity (Suggested: ${suggestedQty})`, suggestedQty);

            // Validate the input quantity
            if (qty !== null) {
                qty = parseInt(qty, 10); // Convert the input to an integer
                if (isNaN(qty) || qty <= 0) {
                    // If the input is not a valid positive number, show an alert and return
                    alert("Please enter a valid positive number for the quantity.");
                    return;
                }
                addToOrder(stockId, qty, supplierId);// Add the selected item to the order
            }
        }

        function filterSupplierRows(supplierId) {
            stockRows.forEach(row => {
                const selectButton = row.querySelector('button'); // Get the "Select" button in the row
                if (row.dataset.supplierId !== supplierId) {
                    // Disable the button for rows that do not match the selected supplier
                    selectButton.disabled = true;
                    row.classList.add('disabled-row'); // Optional: Add a visual indicator for disabled rows
                } else {
                    // Enable the button for rows that match the selected supplier
                    selectButton.disabled = false;
                    row.classList.remove('disabled-row'); // Remove the visual indicator
                }
            });
        }

        // Add the selected item to the order
        function addToOrder(stockId, qty, supplierId) {
            const container = document.getElementById('selected-items');
            const existingInput = container.querySelector(`input[name="stock_ids[]"][value="${stockId}"]`);

            // Check if the supplier ID matches the selected supplier
            if (supplierId !== selectedSupplierId) {
                alert("You cannot add items from a different supplier. Please select items from the same supplier.");
                return; // Exit the function without adding the item
            }

            if (existingInput) {
                // If the stock ID already exists, update the quantity
                const quantityInput = existingInput.nextElementSibling; // Get the corresponding quantity input
                const currentQty = parseInt(quantityInput.value, 10); // Get the current quantity
                const newQty = currentQty + qty;
                quantityInput.value = newQty;

                // Update the displayed quantity
                const displayDiv = quantityInput.nextElementSibling;
                displayDiv.textContent = `Stock #${stockId} - Quantity: ${newQty}`;
            } else {
                // If the stock ID does not exist, add a new entry
                container.innerHTML += `
                    <input type="hidden" name="stock_ids[]" value="${stockId}">
                    <input type="hidden" name="quantities[]" value="${qty}">
                    <div>Stock #${stockId} - Quantity: ${qty}</div>`;
            }
        }

        // Add more items to the order
        function addMoreItems() {
            filterSupplierRows(selectedSupplierId);
        }

        // Add confirmation before form submission
        document.getElementById('form').addEventListener('submit', function (event) {
            const confirmation = confirm("Are you sure you want to submit this order?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if the user cancels
            }
        });
    </script>
</body>
</html>