<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GMS|Admin Dashboard</title>
    <link rel="stylesheet" href="./Assets/css/Admindashboard.css" />

    <link rel="stylesheet" href="./Assets/css/sidebar.css">

    <script src="https://kit.fontawesome.com/0cd0283581.js" crossorigin="anonymous"></script>
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
</head>

<body>
    <!-- main container with display grip to handle the layout of page -->
    <main class="main_container">
        <?php include 'header.php';
        ?>
        <?php include 'sidebar.php';
        ?>


        <!-- main dashboard content -->
        <main class="admin_dashboard_main">


            <!-- dashboard section -->
            <section class="dashboard_content_Section" id="dashboard_content">
                <div class="dashboard_main_container">
                    <!-- weekly booking income container -->
                    <div class="top_dashboard">

                        <!-- income -->
                        <div class="graph_container gc1">


                            <div class="income_status">
                                <div class="income_status_sub_container">

                                    <h2 class="income"><i class="fa-solid fa-coins icon currency"></i>
                                        874,98
                                    </h2>
                                    <p><span>-0.5%</span>from last week</p>
                                </div>


                                <div id="graph_container1"></div>
                            </div>



                        </div>

                        <!-- customer  -->
                        <div class="graph_container gc2">


                            <div class="income_status">
                                <div class="income_status_sub_container">

                                    <h2 class="income"><i class="fa-solid fa-users  currency"></i>

                                        874,98
                                    </h2>
                                    <p><span>+0.5%</span>from last week</p>
                                </div>


                                <div id="graph_container2"></div>
                            </div>



                        </div>

                        <!-- income -->
                        <div class="graph_container gc3">


                            <div class="income_status">
                                <div class="income_status_sub_container">

                                    <h2 class="income"><i class="fa-solid fa-truck icon currency"></i>
                                        </i>
                                        12
                                    </h2>
                                    <p><span>-0.5%</span>from last week</p>
                                </div>


                                <div id="graph_container3"></div>
                            </div>



                        </div>

                    </div>
                </div>


                <main class="recent_booking_main_conatiner">
                    <!--  yaha se
                ise change krna hai bad me booking recent booking show krwani hai idher , ye supplier list wese hi lgai hai iski jga idher sort by list ae gi  -->

                    <!-- yaha tk -->


                    <section class="recent_booking_section_container">

                        <div class="heading_container">
                            <h2 class="heading">Recent Booking</h2>
                        </div>

                        <div class="booking_table_container">
                            <table class="table">
                                <tr class="table-column">
                                    <th>No</th>
                                    <th>BOoking</th>
                                    <th>Customers</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Mechanic ID </th>
                                </tr>

                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>



                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>



                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>

                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>



                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>



                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>



                                <tr>
                                    <td>01</td>
                                    <td>23-10-1990 <p class="booking_id">
                                            #045
                                        </p>
                                    </td>
                                    <td>Mushi <p class="cust_id">#01</p>
                                    </td>
                                    <td>23</td>
                                    <td>Pending</td>
                                    <td>91.98</td>
                                </tr>




                            </table>

                        </div>
                    </section>
                </main>
            </section>
            <!-- suppiler form container here we will show form dynamically -->
            <div id="dynamicDisplayForms"></div>
        </main>

    </main>
    <script src="./Assets/js/side_bar.js"></script>
    <script src="./Assets/js/admin_dashboard.js"></script>
    <script src="./Assets/js/supplierFormValidation.js"></script>
	<script src="./Assets/js/newInvoicesFormValidation.js"></script>


</body>

</html>