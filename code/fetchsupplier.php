<?php 
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // check if the Supplier is select or not
    if (!isset($_POST['supplier_id'])) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Supplier ID is required"]);
        exit;
    }
        $supplier_id = $_POST['supplier_id'];
    try {
        // this is SQL Query for fetch the Supplier details , here i used named placeholder instead of direct insert the variable
        $fetch_supplier = $con->prepare("SELECT `Supplier_ID`, `Name`, `Address`, `Telephone`, `Email`, `web_url` FROM `Supplier` WHERE `Supplier_ID` =:supplier_id;");
        $fetch_supplier->bindParam(':supplier_id',$supplier_id);

$fetch_supplier->execute();
        $row = $fetch_supplier->fetch(PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if (!$row) {
            // Set the content type to JSON
            echo json_encode(["error"=>"No record found"]);
        }
        else{
            echo json_encode($row);
        }
    }
    // its a catch clock to display error with error details ,
    catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(["error"=>"Databse Error".$e->getMessage()]);
    }
    
    
    
}
// if the action method is  not POST then it shows below line
else {
    header('Content-Type: application/json');
    echo json_encode(["error"=>"invalid action method"]);
    
}

?>

