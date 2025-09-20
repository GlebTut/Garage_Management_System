<?php 
include 'DBconnection.php';
// include 'fetch_customer.php' ;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // this lines shows what data sent to to server for adding i  database , these lines are used during debugging. <pre> is a HTML tag who converts the content/data into readable format and structure.
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $customer_id = $_POST['customer_id'];
    $vehicle_model = $_POST['vehicle_model'];
    $registration_num = $_POST['registration_num'];
    $mile_age = $_POST['mile_age'];
    $form_date =date("y-m-d");
    $booking_date = $_POST['booking_date'];
    $details = $_POST['details'];
    
    
    // $job_type_ids is the array who stores the multiple ids of job types as we set its name in form as name=job_type_id[].
    $job_type_ids = $_POST['job_type_id'];
    
    // make sure the job_type_ids array should not me empty
    if (empty($job_type_ids)) {
        echo"<h2>Please select atleast one job type.</h2>";
        exit();
    }
    try {
        // begin transaction is sequence in database operations that work as a single unit all operation in the transaction work as a single unit.
        // if All the operatons/queries successfull then commit into the database.
        // if the each of the operation/query failes ,catch the transaction by calling  rollBack() funcation, to prevent insert any data to database 
        $con->beginTransaction();
        // this query for booking table
        $insert = $con->prepare("INSERT INTO `Booking`(`Customer_ID`, `Model`, `Registration_Number`, `Mileage`, `Details`, `Origin_Date`, `Booking_Date`) 
        VALUES (:customer_id, :vehicle_model, :registration_num, :mile_age, :details, :form_date, :booking_date) ");
        $insert->bindParam(':customer_id',$customer_id);
        $insert->bindParam(':vehicle_model',$vehicle_model);
        $insert->bindParam(':registration_num',$registration_num);
        $insert->bindParam(':mile_age',$mile_age);
        $insert->bindParam(':details',$details);
        $insert->bindParam(':form_date',$form_date);
        $insert->bindParam(':booking_date',$booking_date);

        if ($insert->execute()) {

        // fetch booking ID from database 
        //the lastInsertId() is the PHP predefined function for retrieve/fetch the latest Auto generate (value) column from table that is AUTO generated,this function just return the AUTO generated column/ID/any Auto genrated data  , if the the column data is not AUTO generated then it returns false.
        $booking_id = $con->lastInsertId();

             // this query for adding job type_id and booking_id to job table
        $insert_to_job = $con->prepare("INSERT INTO `Job`( `Booking_ID`, `Job_Type_ID`) VALUES (:booking_id,:job_type_id) ;");
// execute query for inserting into job table
foreach($job_type_ids as $job_type_id){
    $insert_to_job->bindParam(':job_type_id',$job_type_id);
    $insert_to_job->bindParam(':booking_id',$booking_id);
    $insert_to_job->execute();
}


$con->commit();

            echo "<h2>Data is inserted to database Successfully.</h2>";
        }
        else{
            echo"Error during inserting data into Database!";
            error_log("Databse Error: ".print_r($insert->errorInfo(),true));
        }
    } catch (PDOException $e) {
        $con->rollBack();
        error_log("Databse Error: ".$e->getMessage());

    }
}

?>