<?php
include 'DBconnection.php';

$sql = "SELECT jt.Job_Type_ID, jt.Job_Type_Name, jt.Description, jt.Price, m.Mechanic_Name AS Lead_Mechanic 
        FROM Job_Type jt 
        LEFT JOIN Mechanics m ON jt.Lead_Mechanic = m.Mechanic_ID 
        WHERE jt.Delete_Flag = '0'";
$result = $con->query($sql);
$row = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="suppliers_list_container_heading">
  <h2 class="heading">List of Active Job Types</h2>
</div>

<div class="supplier_table_conatainer">
  <table class="table">
    <tr class="table-column">
      <th>Job Type ID</th>
      <th>Job Type Name</th>
      <th>Description</th>
      <th>Base Price</th>
      <th>Lead Mechanic</th>
    </tr>
    <?php
    if (!empty($row)) {
        foreach ($row as $rs) {
            echo "
            <tr class='table_row'>
              <td>{$rs['Job_Type_ID']}</td>
              <td>{$rs['Job_Type_Name']}</td>
              <td>{$rs['Description']}</td>
              <td>{$rs['Price']}</td>
              <td>{$rs['Lead_Mechanic']}</td>
            </tr>";
        }
    } else {
        echo "
        <tr>
          <td colspan='5'><h2>No Records Available Yet, Come Back Later!</h2></td>
        </tr>";
    }
    ?>
  </table>
</div>