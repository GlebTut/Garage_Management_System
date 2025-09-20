<?php
include 'DBconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amend Job Type</title>
  <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
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
  <main class="delete_supplier_main_conatainer">
    <section class="suppliers_list_section_container">
      <!-- Optional header section -->
      <section class="header_section">
        <h1>Amend Job Type</h1>
      </section>
      
      <!-- Form to amend a job type -->
      <form action="./AmendJobType.php" method="post" id="form" class="form">
        <label for="JobType">Job Type List:</label>
        <select data-amend-jobtype-dropdown="JobType" class="drop_down_list" name="job_type_id" id="JobType" data_file_link="fetchJobTypes.php" data_value="Job_Type_ID" data_text="Job_Type_Name">
          <option value="">---Select Job Type---</option>
          <?php
          // Populate the dropdown from the Job_Type table.
          $sql = "SELECT Job_Type_ID, Job_Type_Name FROM Job_Type WHERE Delete_Flag = '0'";
          $result = $con->query($sql);
          if ($result) {
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value='{$row['Job_Type_ID']}'>{$row['Job_Type_Name']}</option>";
              }
          }
          ?>
        </select>
        
        <!-- Job Type ID (read-only) -->
        <div class="inputMain">
          <label for="job_type_id_display">Job Type ID: </label>
          <input type="text" id="job_type_id_display" placeholder="Job Type ID" name="job_type_id_display" readonly>
        </div>
        
        <!-- Job Type Name -->
        <div class="inputMain">
          <label for="job_type_name">Job Type Name: </label>
          <input type="text" id="job_type_name" placeholder="Enter job type name" name="job_type_name">
        </div>
        
        <!-- Description -->
        <div class="inputMain">
          <label for="description">Description: </label>
          <input type="text" id="description" placeholder="Enter description" name="description">
        </div>
        
        <!-- Base Price -->
        <div class="inputMain">
          <label for="price">Base Price: </label>
          <input type="number" id="price" placeholder="Enter base price" name="price">
        </div>
        
        <!-- Lead Mechanic -->
        <div class="inputMain">
          <label for="lead_mechanic">Lead Mechanic: </label>
          <select class="drop_down_list" name="lead_mechanic" id="lead_mechanic">
            <option value="">---Select Lead Mechanic---</option>
            <?php
            $sql2 = "SELECT Mechanic_ID, Mechanic_Name FROM Mechanics WHERE Deleted_Flag = '0'";
            $result2 = $con->query($sql2);
            if ($result2) {
                while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row2['Mechanic_ID']}'>{$row2['Mechanic_Name']}</option>";
                }
            }
            ?>
          </select>
        </div>
        
        <!-- Form Buttons -->
        <div class="form_buttons">
          <input type="reset" value="Cancel" class="formButton">
          <input type="submit" value="Update Info" class="formButton">
        </div>
        
        <!-- Success/Error Message -->
        <p id="message"></p>
      </form>
      
      <!-- Include the job types list -->
      <?php include 'JobTypeList.php'; ?>
    </section>
  </main>
</body>
</html>