<?php
include './DBconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Description = $_POST['Description'];
    $Stock_Quantity = $_POST['Stock_Quantity'];
    $Reorder_QUantity = $_POST['Reorder_Quantity'];
    $Cost_Price = $_POST['Cost_Price'];
    $Retail_Price = $_POST['Retail_Price']
try {
    
    $insert = $con->prepare("INSERT INTO `Stock Item`(`Description`, `Stock_Quantity`, `Reorder_Quantity`, `Cost_Price`, `Retail_Price`) 
    VALUES (:Description, :Stock_Quantity, :Reorder_Quantity, :Cost_Price, :Retail_Price )");


    $insert->bindParam(':Description', $Description);
    $insert->bindParam(':Stock_Quantity', $Stock_Quantity);
    $insert->bindParam(':Reorder_Quantity', $Reorder_Quantity);
    $insert->bindParam(':Cost_Price', $Cost_Price);
    $insert->bindParam(':Retail_Price', $Cost_Price);


    if($insert->execute())
        {
        echo "<h2>Data is inseeted to database successfully.</h2>";

        }
    else
        {
        echo "error occur during inserting data to database.";
        error_log("Dtabase Error: ".print_r($insert->errorInfo(),true));
        }

} 
    catch (PDOException $e) 
        {
        echo("Databse error: ".$e->getMessage());
        error_log("database error: ".$e->getMessage());
    }
}
?>