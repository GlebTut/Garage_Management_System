<?php
include 'DBconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Commence Job | GMS</title>
  <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css"/>
  <script>
    function confirmCommence() {
      return confirm("Are you sure you want to commence this job?");
    }

    function fetchJobDetails(jobId) {
      if (!jobId) {
        document.getElementById("job_details").innerHTML = "";
        return;
      }
      fetch(`fetch_job_details.php?job_id=${jobId}`)
        .then(response => response.text())
        .then(html => {
          document.getElementById("job_details").innerHTML = html;
        });
    }
  </script>
</head>
<body>
<main class="main_form_container">
  <div class="div">
    <div class="form_title">
      <h1>Commence Job</h1>
    </div>
    <form action="Commence_job.php" method="post" class="form" onsubmit="return confirmCommence()">

      <div class="inputMain">
        <label for="job_id">Select Job:</label>
        <select name="Job_ID" id="job_id" class="drop_down_list" required onchange="fetchJobDetails(this.value)">
          <option value="">--- Select Job ---</option>
          <?php
          $stmt = $con->query("SELECT Job_ID FROM Job WHERE Status IS NULL OR Status != 'Commenced'");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['Job_ID']}'>{$row['Job_ID']}</option>";
          }
          ?>
        </select>
      </div>

      <div id="job_details" class="inputMain">
        <!-- Job details will be loaded here dynamically -->
      </div>

      <div class="inputMain">
        <label for="Mechanic_ID">Lead Mechanic:</label>
        <select name="Mechanic_ID" id="Mechanic_ID" class="drop_down_list" required>
          <option value="">--- Select Mechanic ---</option>
          <?php
          $stmt = $con->query("SELECT Mechanic_ID, Name FROM Mechanics");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['Mechanic_ID']}'>{$row['Name']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="inputMain">
        <label for="Model">Vehicle Model:</label>
        <input type="text" name="Model" id="vehicle_model" required>
      </div>

      <div class="inputMain">
        <label for="registration">Registration Number:</label>
        <input type="text" name="Registration_Num" id="registration" required>
      </div>

      <div class="inputMain">
        <label for="mileage">Current Mileage:</label>
        <input type="number" name="Mileage" id="mileage" required>
      </div>

      <div class="inputMain">
        <label for="instructions">Additional Instructions:</label>
        <textarea name="Instructions" id="instructions" rows="4" placeholder="Enter any special instructions"></textarea>
      </div>

      <div class="form_buttons">
        <input type="reset" value="Cancel" class="formButton">
        <input type="submit" value="Commence Job" class="formButton">
      </div>

       <!-- success /error message will show here -->
       <p id="message"></p>

    </form>
  </div>
</main>
</body>
</html>
