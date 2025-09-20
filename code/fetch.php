<?php 
include 'DBconnection.php';

$response = [
    'customer' => [],
    'supplier'  => [],
    'job_type'  => [],
    'stock_item'  => []
];




// drop down for ustomer
try {
    $Customer = $con->prepare("SELECT `Customer_ID`, `Name` FROM `Customer` WHERE `Delete_Flag` = '0';");
    $Customer->execute();
    $response['customer'] = $Customer->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    
    error_log("Database Error while fetching dropdown".$e->getMessage());
    echo json_encode([]); // Return empty array on error
}


//Drop Down For Supplier 
try {
    $Supplier = $con->prepare("SELECT `Supplier_ID`, `Name` FROM `Supplier` WHERE `Delete_Flag` = '0' ;");
    $Supplier->execute();
    $response['supplier'] = $Supplier->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    
    error_log("Database Error while fetching dropdown".$e->getMessage());
    echo json_encode([]); // Return empty array on error
}


// drop down for job type
 try {
     $jobtype = $con->prepare("SELECT `Job_Type_ID`, `Job_Type_Name` FROM `Job_Type` WHERE `Delete_Flag` = '0' ;");
     $jobtype->execute();
     $response['job_type'] = $jobtype->fetchAll(PDO::FETCH_ASSOC);
 } catch (PDOException $e) {
     error_log("Database Error while fetching dropdown".$e->getMessage());
     echo json_encode([]);
 }


// drop down for stock item
// thagts everything in this file then go to admindashboard.js 
try {
    $stockitem = $con->prepare("SELECT `Stock_ID`, `Description` FROM `Stock_Item` WHERE `Status` = '0';;");
    $stockitem->execute();
    $response['stock_item'] = $stockitem->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database Error while fetching dropdown".$e->getMessage());
    echo json_encode([]);
}


// Set the content type to JSON
header('Content-Type: application/json');

echo json_encode($response);


?>

