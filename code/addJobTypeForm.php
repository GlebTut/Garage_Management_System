<?php
// Include the database connection
include 'DBconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job Type | GMS</title>
	<link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
</head>
	 <style>
        /* Add this to your CSS file */
        select.drop_down_list option {
            color: black !important;
            font-size: 16px !important;
        }
    </style>
<body>
    <main class="main_form_container">
        <div class="form_wrapper">
            <div class="form_title">
                <h1>Add Job Type</h1>
            </div>
            <form action="addJobType.php" method="post" id="form" class="form">
                <p>
                    <label for="Lead_Mechanic_ID">Lead Mechanic:</label>
                    <select name="Lead_Mechanic_ID" id="Lead_Mechanic_ID" required>
                        <option value="" disabled selected>Select Lead Mechanic</option>
                        <?php
                        // Fetch mechanics from the database
                        try {
                            // Corrected query
                            $sql = "SELECT `Mechanic_ID`, `Mechanic_Name` FROM Mechanics WHERE `Deleted_Flag` = 0";
                            $stmt = $con->prepare($sql);
                            $stmt->execute();

                            // Fetch all mechanics
                            $mechanics = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if ($mechanics) {
                                // Output each mechanic as an option in the select dropdown
                                foreach ($mechanics as $row) {
                                    echo '<option value="' . htmlspecialchars($row['Mechanic_ID']) . '">' . htmlspecialchars($row['Mechanic_Name']) . '</option>';
                                }
                            } else {
                                echo "<option value=''>No active mechanics available</option>";
                            }
                        } catch (PDOException $e) {
                            // Handle error and display message if the query fails
                            echo "<option value=''>Error fetching mechanics: " . htmlspecialchars($e->getMessage()) . "</option>";
                        }
                        ?>
                    </select>
                </p>
                <div class="inputMain">
                    <p>
                        <label for="Job_Type_Name">Job Type Name:</label>
                        <input type="text" name="Job_Type_Name" id="Job_Type_Name" required/>
                    </p>
                </div>
                <div class="inputMain">
                    <p>
                        <label for="Description">Description:</label>
                        <input type="text" name="Description" id="Description" required/>
                    </p>
                </div>
                <div class="inputMain">
                    <p>
                        <label for="Price">Base Price:</label>
                        <input type="text" name="Price" id="Price" required pattern="\d+(\.\d{2})?" title="Please enter a valid price (e.g., 100 or 100.00)"/>
                    </p>
                </div>
                <div class="form_button">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Add Job Type" class="formButton">
                </div>
                <p id="message"></p>
            </form>
        </div>
    </main>
</body>
</html>
