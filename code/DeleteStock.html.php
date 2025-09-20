<?php session_start();
?>
<html>
<head>
<head>
<link rel="stylesheet" type="text/css" href="" />
    <link rel="stylesheet" href="./Assets/css/ShowSuppliers.css">

</head>
</head>
<body>
<main class="main_form_container">
        <div class="div">
<div class="form_title">
               
<h1>Delete a Stock Item</h1>
<!--<h4>Please select a stock item and then click the delete button</h4> -->
            </div>
<script>
function populate() {
    var sel = document.getElementById("stockList");
    var result = sel.options[sel.selectedIndex].value;
    var stockDetails = result.split('|');
    
    // Ensure that all the fields are populated correctly
    document.getElementById("display").innerHTML = "The details of the selected stock item are: " + result;
    
    document.getElementById("delid").value = stockDetails[0]; 
    document.getElementById("deldesc").value = stockDetails[1];
    document.getElementById("delstockq").value = stockDetails[2]; 
    document.getElementById("delreorderq").value = stockDetails[3]; 
    document.getElementById("delcost").value = stockDetails[4]; 
    document.getElementById("delretail").value = stockDetails[5]; 
    document.getElementById("delsupplier").value = stockDetails[6]; 
    document.getElementById("delstatus").value = stockDetails[7]; 

    // Set the hidden fields too (although these values are redundant with the visible ones)
    document.getElementById("hidden_delid").value = stockDetails[0];
    document.getElementById("hidden_deldesc").value = stockDetails[1];
    document.getElementById("hidden_delstockq").value = stockDetails[2];
    document.getElementById("hidden_delreorderq").value = stockDetails[3];
    document.getElementById("hidden_delcost").value = stockDetails[4];
    document.getElementById("hidden_delretail").value = stockDetails[5];
    document.getElementById("hidden_delsupplier").value = stockDetails[6];
    document.getElementById("hidden_delstatus").value = stockDetails[7];
}



function confirmCheck()
{
    var response;
    response = confirm('Are you sure you want to delete this Stock Item?');
    if (response)
    {
        document.getElementById("deldesc").disabled = false;
        document.getElementById("delstockq").disabled = false;
        document.getElementById("delreorderq").disabled = false;
        document.getElementById("delcost").disabled = false;
        document.getElementById("delretail").disabled = false;
        document.getElementById("delsupplier").disabled = false;
        document.getElementById("delstatus").disabled = false;
        return true;
    }
    else
    {
        populate();
        return false;
    }
}
</script>

<p id = "display"></p>


<form name="deleteForm" action="DeleteStock.php" onsubmit="return confirmCheck()" method="post" class="bookingform form" id="form">

<div class="inputMain">

<?php include 'listboxStock.php'; ?>
                </div>



<div class="inputMain">
    <label for="delid">Stock ID</label>
    <input type="text" name="delid" id="delid" readonly>
    <input type="hidden" name="hidden_delid" id="hidden_delid"> 
                </div>


<div class="inputMain">
    <label for="deldesc">Description</label>
    <input type="text" name="deldesc" id="deldesc" readonly>
    <input type="hidden" name="hidden_delname" id="hidden_delname"> 
                </div>


<div class="inputMain">
    <label for="delstockq">Stock Quantity</label>
    <input type="text" name="delstockq" id="delstockq" readonly>
    <input type="hidden" name="hidden_delstockq" id="hidden_delstockq"> 
                </div>


<div class="inputMain">
    <label for="delreorderq">Reorder Quantity</label>
    <input type="text" name="delreorderq" id="delreorderq" readonly>
    <input type="hidden" name="hidden_delreorderq" id="hidden_delreorderq">
                </div>


<div class="inputMain">
    <label for="delcost">Cost Price</label>
    <input type="text" name="delcost" id="delcost" readonly>
    <input type="hidden" name="hidden_delcost" id="hidden_delcost"> 
                </div>


<div class="inputMain">
    <label for="delretail">Retail Price</label>
    <input type="text" name="delretail" id="delretail" readonly>
    <input type="hidden" name="hidden_delretail" id="hidden_delretail"> 
                </div>


<div class="inputMain">
    <label for="delsupplier">Supplier ID</label>
    <input type="text" name="delsupplier" id="delsupplier" readonly>
    <input type="hidden" name="hidden_delsupplier" id="hidden_delsupplier"> 
                </div>


<div class="inputMain">
    <label for="delstatus">Status</label>
    <input type="text" name="delstatus" id="delstatus" readonly>
    <input type="hidden" name="hidden_delstatus" id="hidden_delstatus"> 
                    </div>

                <!-- Form Buttons -->
                <div class="form_buttons">
                    <input type="reset" value="Cancel" class="formButton">
                    <input type="submit" value="Delete Stock Item" class="formButton">
                </div>
<!-- Success/Error Message -->
                <p id="message"></p>
            
</form>
        </div>

<?php 
if (isset($_SESSION["delete_message"])) {
    $class = $_SESSION["delete_success"] ? 'success-message' : 'error-message';
    echo "<div class='$class'>".htmlspecialchars($_SESSION["delete_message"])."</div>";
    unset($_SESSION["delete_message"]);
    unset($_SESSION["delete_success"]);
}
?>
    </main>

</body>
</html>