<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier|GMS</title>
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">
    <style>
        /* Add this to your CSS file */
        select.drop_down_list option {
            color: black !important;
            font-size: 16px !important;
        }
    </style>
</head>

<body>
    <main class="main_form_container">
        <div class="div">
            <div class="form_title">
                <h1>Add New Booking</h1>
            </div>
            <form action="AddNewBooking.php" method="post" id="form" class="bookingform form">

                <!-- DropDown For customer -->
                <div class="inputMain">
                    <label for="Customer">Customer:</label>
                    <select class="drop_down_list customer_select_in_booking" name="customer_id" id="Customer" data_file_link="fetch.php" data_value="Customer_ID" data_text="Name" required>
                        <option value="">---Select Customer---</option>
                    </select>
                </div>

                <!-- DropDown For job type -->
                <div class="inputMain">
                    <label for="Job_Type">Job Type:</label>
                    <select class="drop_down_list job_type_select_in_booking" name="job_type_id[]" id="Job_Type" data_file_link="fetch.php" data_value="Job_Type_ID" data_text="Job_Type_Name" multiple required>
                        <option value="">---Select Job Type---</option>
                    </select>
                </div>
                <!-- Booking Date -->
                <div class="inputMain">
                    <label for="booking_date">Booking Date: </label>
                    <input type="date" id="booking_date" name="booking_date" required>
                </div>


                <!-- Vehicle Information -->
                <fieldset class="inputMain">
                    <legend>Vehicle Information</legend>

                    <!-- Model -->
                    <div class="inputMain">
                        <label for="vehicle_model">Vehicle Model:</label>
                        <input type="number" id="vehicle_model" placeholder="Enter vehicle model" name="vehicle_model" required>
                    </div>

                    <!-- Registration Number -->
                    <div class="inputMain">
                        <label for="reg_num">Registration Number: </label>
                        <input type="text" id="reg_num" placeholder="Enter Registration Number" name="registration_num" required>
                    </div>

                    <!-- Mileage -->
                    <div class="inputMain">
                        <label for="mile_age">Current Mileage: </label>
                        <input type="number" id="mile_age" placeholder="Enter Vehicle's Mileage" name="mile_age" required>
                    </div>

                    <!-- Details -->
                    <div class="inputMain">
                        <label for="supplier_address">Details: </label>
                        <textarea type="text" id="supplier_address" placeholder="Enter Details of booking" name="details"></textarea>
                    </div>
                </fieldset>

                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Add Booking" class="formButton">
                </div>

                <!-- Success/Error Message -->
                <p id="message"></p>
            </form>
        </div>
    </main>
</body>

</html>