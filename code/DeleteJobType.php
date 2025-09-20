<?php
include 'DBconnection.php';

// If you have your job type functions in a separate file, include them here:
// include 'jobTypeFunctions.php';

// For this example, we define the two needed functions inline:
function check_upcoming_jobs($con, $job_type_id) {
    $sql = "SELECT 1 FROM Booking 
            WHERE job_type_id = :job_type_id 
              AND Booking_Date > NOW() 
              AND Status = 1";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':job_type_id', $job_type_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

function mark_job_type_as_deleted($con, $job_type_id) {
    $sql = "UPDATE Job_Type SET Delete_Flag = 1 WHERE Job_Type_ID = :job_type_id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':job_type_id', $job_type_id, PDO::PARAM_INT);
    return $stmt->execute();
}

// Initialize messages and flag
$error_message = $success_message = $message = "";
$confirm_deletion = false;
$job_type_id = "";

// Process the initial delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['Job_Type_ID'])) {
    $job_type_id = $_POST['Job_Type_ID'];
    if (empty($job_type_id)) {
        $error_message = "Please select a Job Type.";
    } else {
        if (check_upcoming_jobs($con, $job_type_id)) {
            $error_message = "This Job Type cannot be deleted because it is part of an upcoming booking.";
        } else {
            $confirm_deletion = true;
        }
    }
}

// Process the confirmation step
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && isset($_POST['Job_Type_ID'])) {
    $job_type_id = $_POST['Job_Type_ID'];
    if ($_POST['confirm'] === 'Y') {
        if (mark_job_type_as_deleted($con, $job_type_id)) {
            $success_message = "Job Type has been successfully deleted.";
        } else {
            $error_message = "Error occurred while deleting the Job Type.";
        }
    } else {
        $message = "Deletion cancelled.";
    }
}

// If any messages exist, redirect back to the page with messages in the query string.
if (!empty($error_message) || !empty($success_message) || !empty($message)) {
    $params = http_build_query([
        'error_message' => $error_message,
        'success_message' => $success_message,
        'message' => $message
    ]);
    header("Location: DeleteJobTypePage.php?$params");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Delete Job Type</title>
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
      <?php
      // If deletion needs confirmation, display the confirmation form here.
      if ($confirm_deletion) {
          echo "<h2>Are you sure you want to delete this Job Type?</h2>";
          echo "<form action='DeleteJobType.php' method='post'>
                  <input type='hidden' name='Job_Type_ID' value='$job_type_id'>
                  <label>
                    <input type='radio' name='confirm' value='Y' required> Yes
                  </label>
                  <label>
                    <input type='radio' name='confirm' value='N' required> No
                  </label>
                  <input type='submit' value='Confirm'>
                </form>";
      }
      ?>
    </section>
  </main>
</body>
</html>