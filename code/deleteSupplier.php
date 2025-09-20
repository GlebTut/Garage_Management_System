<?php

include './DBconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['supplier_id'])) {
                $supplier_id = $_POST['supplier_id'];
                // echo"the supplier id is selec".$supplier_id;
                try {
                        // unpain invoices checking
                        $check_invoice = $con->prepare("SELECT COUNT(*) FROM `Invoice` WHERE `Supplier_ID` =:id AND `Status` = 'ISSUED' ;");
                        $check_invoice->bindParam(':id',$supplier_id);
                        $check_invoice->execute();
                        $unpaid_invoice = $check_invoice->fetchColumn();

                        // open orders checking
                        // $check_order = $con->prepare("SELECT COUNT(*) FROM `Order` WHERE `Supplier_ID` =:id `Status`= '0' ;");
                        // $check_order->bindParam(':id', $supplier_id);
                        // $check_order->execute();
                        // $open_order = $check_order->fetchColumn();

                        if ($unpaid_invoice > 0) {
                                echo "<h2>Cannot delete supplier - they have unpaid invoices.</h2>";
                            } 
                        //     elseif ($open_order > 0) {
                        //         echo "<h2>Cannot delete supplier - they have open orders.</h2>";
                        //     }
                             else {
                                // update delete flag status 
                                $update_delete_flag = $con->prepare("UPDATE `Supplier` SET  `Delete_Flag`='1' WHERE `Supplier_ID` =:id ;");
                                $update_delete_flag->bindParam(':id', $supplier_id);



                                if ($update_delete_flag->execute()) {
                                        // header("location:AdminDashboard.php");
                                        echo "<h2>Supplier is deleted successfully.</h2>";
                                } else {
                                        echo "Error during deleting supplier!";
                                        error_log("Database Error: " . print_r($update->errorInfo(), true));
                                }
                        }
                } catch (PDOException $e) {
                        error_log("Database Error: " . $e->getMessage());
                }
        }
} else {
        echo "please select a supplier";
}
