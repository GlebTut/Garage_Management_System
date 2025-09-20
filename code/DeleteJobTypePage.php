<?php
include 'DBconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Job Type</title>
  <link rel="stylesheet" href="./Assets/css/Admindashboard.css">
  <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
</head>
<style>
  select.drop_down_list option {
      color: black !important;
      font-size: 16px !important;
  }
</style>
<body>
  <main class="delete_supplier_main_conatainer">
    <section class="suppliers_list_section_container">
      <!-- Header & Form for Deleting Job Type -->
      <form action="./DeleteJobType.php" method="post" id="form">
        <section class="header_section">
          <header class="delete_supplierheader">
            <ul>
              <li>
                <label for="Job_Type_ID">Job Type List:</label>
                <select class="drop_down_list" name="Job_Type_ID" id="Job_Type_ID" data_file_link="fetchJobTypes.php" data_value="Job_Type_ID" data_text="Job_Type_Name">
                  <option value="">---Select Job Type---</option>
                  <?php
                  // Populate the dropdown with active job types
                  $sql = "SELECT Job_Type_ID, Job_Type_Name FROM Job_Type WHERE Delete_Flag = '0'";
                  $result = $con->query($sql);
                  if ($result) {
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='{$row['Job_Type_ID']}'>{$row['Job_Type_Name']}</option>";
                      }
                  }
                  ?>
                </select>
              </li>
              <li>
                <input type="submit" name="delete" value="Delete Job Type">
              </li>
            </ul>
            <!-- Message display area -->
            <p id="message">
              <?php
              // If any messages are passed via GET (from processing), display them.
              if(isset($_GET['error_message'])) echo "<span style='color:red;'>" . $_GET['error_message'] . "</span>";
              if(isset($_GET['success_message'])) echo "<span style='color:green;'>" . $_GET['success_message'] . "</span>";
              if(isset($_GET['message'])) echo "<span>" . $_GET['message'] . "</span>";
              ?>
            </p>
          </header>
        </section>
      </form>
      
      <!-- Include the list of active job types -->
      <?php include 'JobTypeList.php'; ?>
      
    </section>
  </main>
</body>
</html>