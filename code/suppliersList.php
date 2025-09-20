<?php
include 'DBconnection.php';
$sql = "SELECT `Supplier_ID`, `Name`, `Address`, `Telephone`, `Email`, `web_url` FROM `Supplier` WHERE `Delete_Flag` = '0' ;";
$result = $con->query($sql);
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
?>

            <div class="form_title">
                <h2 class="heading">List of Active Suppliers</h2>
            </div>

            <div class="supplier_table_conatainer">

                <table class="table">
                    <tr class="table-column">
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Email Address</th>
                        <th>Website Address</th>
                    </tr>
                    <?php
                    if (!empty($row)) {

                        foreach ($row  as $rs) {


                            echo "
                           <tr class='table_row'>
                               <td>  {$rs['Supplier_ID']}  </td>
                               <td>  {$rs['Name']}         </td>
                               <td>  {$rs['Address']}      </td>
                               <td>  {$rs['Telephone']}    </td>
                               <td>  {$rs['Email']}        </td>
                               <td>  {$rs['web_url']}        </td>
                          </tr> ";
                        }
                    } else {

                        echo "
                        <tr>
                        <td><h2>No Records Available Yet ComeBack later!</h2></td>
                        </tr> 
                             ";
                    }

                    ?>
                </table>
            </div>