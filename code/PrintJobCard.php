<?php
include 'DBconnection.php';

if (isset($_POST['Job_ID'])) {
    $job_id = $_POST['Job_ID'];

    $stmt = $con->prepare("SELECT J.Job_ID, J.Booking_ID, JT.Description AS Job_Description, M.Name AS Mechanic_Name,
        B.Vehicle_Model, B.Registration_Num, B.Mileage, B.Instructions, 
        C.Name AS Customer_Name, C.Address
        FROM Job J
        JOIN Booking B ON J.Booking_ID = B.Booking_ID
        JOIN Job_Types JT ON J.Job_Type_ID = JT.Job_Type_ID
        JOIN Mechanics M ON J.Mechanic_ID = M.Mechanic_ID
        JOIN Customer C ON B.Customer_ID = C.Customer_ID
        WHERE J.Job_ID = :job_id");

    $stmt->bindParam(':job_id', $job_id);
    $stmt->execute();
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($job):
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Job Card - Job #<?php echo $job['Job_ID']; ?></title>
    <style>
        body { font-family: Arial; padding: 30px; }
        h1 { border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .section { margin-bottom: 20px; }
        label { font-weight: bold; }
        .box { border: 1px solid #ccc; padding: 10px; margin-top: 5px; }
    </style>
</head>
<body>
<h1>Job Card</h1>

<div class='section'>
    <label>Job ID:</label> <?php echo $job['Job_ID']; ?><br>
    <label>Booking ID:</label> <?php echo $job['Booking_ID']; ?><br>
    <label>Job Type:</label> <?php echo $job['Job_Description']; ?><br>
    <label>Lead Mechanic:</label> <?php echo $job['Mechanic_Name']; ?>
</div>

<div class='section'>
    <label>Customer Name:</label> <?php echo $job['Customer_Name']; ?><br>
    <label>Address:</label> <?php echo $job['Address']; ?>
</div>

<div class='section'>
    <label>Vehicle Model:</label> <?php echo $job['Model']; ?><br>
    <label>Registration No:</label> <?php echo $job['Registration_Num']; ?><br>
    <label>Mileage:</label> <?php echo $job['Mileage']; ?> km
</div>

<div class='section'>
    <label>Customer Instructions:</label>
    <div class='box'><?php echo nl2br($job['Instructions']); ?></div>
</div>

<div class='section'>
    <label>Mechanic Notes:</label>
    <div class='box' style='height: 150px;'>(to be filled manually)</div>
</div>

<div class='section'>
    <label>Parts Used:</label>
    <div class='box' style='height: 100px;'>(to be filled manually)</div>
</div>

<script>window.print();</script>
</body>
</html>
<?php
    else:
        echo "<p>Job not found.</p>";
    endif;
} else {
    echo "<p>No Job ID provided.</p>";
}
?>