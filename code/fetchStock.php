<?php 
include 'DBconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // check if the Supplier is select or not
    if (!isset($_POST['stock_id'])) {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Stock ID is required"]);
        exit;
    }
        $stock_id = $_POST['stock_id'];
    try {
        // this is SQL Query for fetch the stock details , here i used named placeholder instead of direct insert the variable
        $fetch_stock = $con->prepare("SELECT `Stock_ID`, `Description`, `Stock_Quantity`, `Supplier_ID` FROM `Stock_Item` WHERE `Stock_ID` =stock_id ;");
        $fetch_stock->bindParam(':stock_id',$stock_id);

$fetch_stock->execute();
        $row = $fetch_stock->fetch(PDO::FETCH_ASSOC);
        
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

