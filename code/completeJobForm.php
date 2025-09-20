<?php
// completeJobForm.php
include 'DBconnection.php';

// Updated query: selecting jobs in progress and joining with the Job_Type table.
// Replace 'Job_Type_Name' with the actual column name in your Job_Type table that holds the job name.
$stmt = $con->prepare("SELECT j.Job_ID, jt.Job_Type_Name AS Job_Name 
                       FROM Job j 
                       JOIN Job_Type jt ON j.Job_Type_ID = jt.Job_Type_ID
                       WHERE j.Status IS NULL OR j.Status = '' OR j.Status = '0'");
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If no job_id is provided, show the listbox for job selection.
if (!isset($_GET['job_id'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Job for Completion | GMS </title>
	<link rel="stylesheet" href="./Assets/css/ShowSuppliers.css"/>
</head>
<body>
    <h1>Select a Job to Complete</h1>
    <?php if (count($jobs) > 0): ?>
        <form method="GET" action="completeJobForm.php">
            <select name="job_id" required>
                <option value="">--Select a job--</option>
                <?php foreach ($jobs as $job): ?>
                    <option value="<?php echo htmlspecialchars($job['Job_ID']); ?>">
                        <?php echo "Job ID: " . htmlspecialchars($job['Job_ID']) . " - " . htmlspecialchars($job['Job_Name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Select Job">
        </form>
    <?php else: ?>
        <p>No jobs in progress.</p>
    <?php endif; ?>
</body>
</html>
<?php
    exit();
}

// If a job_id is provided, display the job completion form.
$job_id = $_GET['job_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Complete Job - Job ID: <?php echo htmlspecialchars($job_id); ?></title>
    <script>
        // Function to add additional spare part rows.
        function addSparePartRow() {
            var table = document.getElementById("sparePartsTable");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = '<input type="text" name="spare_part_stock[]" required>';
            cell2.innerHTML = '<input type="number" name="spare_part_qty[]" required min="1">';
        }
    </script>
</head>
<body>
    <h1>Complete Job - Job ID: <?php echo htmlspecialchars($job_id); ?></h1>
    <form method="POST" action="completeJob.php">
        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job_id); ?>">
        <label for="time_taken">Total Time Taken (in minutes):</label>
        <input type="number" name="time_taken" id="time_taken" required min="1"><br><br>

        <h2>Spare Parts Used</h2>
        <table id="sparePartsTable" border="1">
            <tr>
                <th>Stock Number</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <td><input type="text" name="spare_part_stock[]" required></td>
                <td><input type="number" name="spare_part_qty[]" required min="1"></td>
            </tr>
        </table>
        <br>
        <button type="button" onclick="addSparePartRow()">Add Another Spare Part</button>
        <br><br>
        <input type="submit" name="complete_job" value="Complete Job">
    </form>
</body>
</html>
