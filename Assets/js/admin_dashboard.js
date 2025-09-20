//File Name:                      Admin Dashoard Java Script
//Description:                    This file contians
//1. fetch_Supplier_function():   this function is resnponsible for fetch the Selected supplier's data from databse.

//2. load_all_drop_downs():       this function is validate the DropDown attributes then pass them to Display_drop_down().

//2(1). Display_drop_down():      this function is responsible for the creation of dropdowns for specific entity according
//                                to dropdown attributes.

//  3.display_supplier_form();    this function is responsible for displaying the forms dynamically via AJAX according to the sideBar 
//                                buttons and all the functions that i mention above are called in this function.

//4.  form_handler();             this functioin is responsible for submission of form and their data via AJAX and all the 
//                                form validation are in this function
//  Student ID :  c00311349
//  Date:         20/03/2025  -->




let container = document.getElementById("container");
function function_to_create_chart(
  graph_containerid,
  datasours,
  title,
  name_of_graph
) {
  var chart = new ej.charts.Chart({
    background: "none",
    width: "190px",
    height: "120px",

    primaryXAxis: {
      valueType: "Category",
    },

    primaryYAxis: {},

    series: [
      {
        type: "Column",
        dataSource: datasours,

        xName: name_of_graph,
        yName: "medal",
      },
    ],
    title: title,
  });
  chart.appendTo(graph_containerid);
}

let datasource1 = [
  { income: "1", medal: 20 },
  { income: "2", medal: 40 },
  { income: "3", medal: 20 },
  { income: "4", medal: 10 },
  { income: "5", medal: 40 },
];
let datasource2 = [
  { customer: "1", medal: 5 },
  { customer: "2", medal: 15 },
  { customer: "3", medal: 19 },
  { customer: "4", medal: 30 },
  { customer: "5", medal: 26 },
];
let datasource3 = [
  { delivery: "1", medal: 5 },
  { delivery: "2", medal: 15 },
  { delivery: "3", medal: 9 },
  { delivery: "4", medal: 30 },
  { delivery: "5", medal: 9 },
];
function_to_create_chart(
  "#graph_container1",
  datasource1,
  "Weekly income",
  "income"
);
function_to_create_chart(
  "#graph_container2",
  datasource2,
  "Weekly customer",
  "customer"
);
function_to_create_chart(
  "#graph_container3",
  datasource3,
  "Weekly Deliveries",
  "delivery"
);
// its for stcok item

//  this function with AJAX is for fetch th selected supplier's data from dataabase and display them in form
let fetch_stock_function = ()=>{
  let selected_stock = document.querySelector("[data-delete-stock-dropdown='Stock_Item']");
    // null check for the form who dont have stock dropdown
    if (!selected_stock) {
      console.log("No Stock dropdown found in this form");
      return;

    }

    selected_stock.addEventListener("change", (s) => {
    let stockID = s.target.value;
    console.log("Stock ID is: ",stockID)
    if (stockID) {
      // fetch data from database and display them in form
      fetch(`fetchStock.php`,{
        method:'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },

                body: `stock_id=${stockID}`
      })
        .then((response) => {
          // debugging in case of any erros
          if (!response.ok) {
            throw new Error(
              `HTTP error! Status: ${response.status}, Message: ${response.status}`
            );
          }
          return response.json();
        })
        .then((data) => {
          if (!data) {
            console.log("data not found",data)
          }
          console.log("Data received:", data);
         document.getElementById("id").value=data.Supplier_ID;
          document.getElementById("supplier_name").value=data.Name;
          document.getElementById("supplier_email").value=data.Email;
          document.getElementById("supplier_telephone").value=data.Telephone;
          document.getElementById("supplier_address").value=data.Address;
          document.getElementById("web_url").value=data.web_url;
        })
        .catch((error) => console.error("Error during fetching supplier details from dropdown", error))
    }
  });
};







//  this function with AJAX is for fetch th selected supplier's data from dataabase and display them in form
let fetch_Supplier_function = ()=>{
  let selected_supplier = document.querySelector("[data-amend-supplier-dropdown='Supplier']");
    // null check for the form who dont have supplier dropdown
    if (!selected_supplier) {
      console.log("No supplier dropdown found in this form");
      return;

    }

  selected_supplier.addEventListener("change", (s) => {
    let supplierID = s.target.value;
    console.log("supplier ID is: ",supplierID)
    if (supplierID) {
      // fetch data from database and display them in form
      fetch(`fetchsupplier.php`,{
        method:'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },

                body: `supplier_id=${supplierID}`
      })
        .then((response) => {
          // debugging in case of any erros
          if (!response.ok) {
            throw new Error(
              `HTTP error! Status: ${response.status}, Message: ${response.status}`
            );
          }
          return response.json();
        })
        .then((data) => {
          if (!data) {
            console.log("data not found",data)
          }
          console.log("Data received:", data);
         document.getElementById("id").value=data.Supplier_ID;
          document.getElementById("supplier_name").value=data.Name;
          document.getElementById("supplier_email").value=data.Email;
          document.getElementById("supplier_telephone").value=data.Telephone;
          document.getElementById("supplier_address").value=data.Address;
          document.getElementById("web_url").value=data.web_url;
        })
        .catch((error) => console.error("Error during fetching supplier details from dropdown", error))
    }
  });
};
//function for automatically load the drop list
function load_all_drop_downs() {
  // get all the dropdown from the form
  let all_drop_downs = document.querySelectorAll(".drop_down_list");
  all_drop_downs.forEach((drop_down) => {
    let file_link = drop_down.getAttribute("data_file_link");
    let id = drop_down.getAttribute("data_value");
    let text = drop_down.getAttribute("data_text");
    if (!file_link || !drop_down.id || !id || !text) {
      alert("This Button is not active yet for:", drop_down.id);
      return;
    }
    Display_drop_down(file_link, drop_down.id, id, text);
  });
}

// this function is for display the drop down list  inside the form for selecting the details
 let Display_drop_down = (link, drop_down_table, id, text) => {
  console.log("fetching data from database (fetch.php).", link);
  fetch(link)
    .then((response) => {
      if (!response.ok) {
        throw new Error(
          `HTTP error! Status: ${response.status}, Message: ${response.statusText}`
        );
      }
      return response.json();
    })
    .then((data) => {
      console.log("Data received:", data); // Debugging

      let drop_down = document.getElementById(drop_down_table);
      if (!drop_down) {
        console.error("Drop down element not foun(form_ajax.js).");
      }
      drop_down.innerHTML = "<option value=''>---Select---</option>"; // Clear existing options

      let items = [];

      if (drop_down_table === "Customer") {
        items = data.customer;
      } else if (drop_down_table === "Supplier") {
        items = data.supplier;
      } else if (drop_down_table === "Job_Type") {
        items = data.job_type;
      }else if (drop_down_table === "Stock_Item") {
        items = data.stock_item;
      }

      items.forEach((item) => {
        let option = document.createElement("option");
        option.value = item[id];
        option.textContent = item[text];
        drop_down.appendChild(option);
      });
    })
    .catch((error) => console.error("Error during submitting form", error));
};

// from here the javaScript (AJAX start) for dynamically  display all forms in dashboard ||| And also for send data to database through AJAX
document.addEventListener("DOMContentLoaded", () => {



  // here "event is the perameter of function"
  //event delegation: Event delegation is a technique in JavaScript where you attach a single event listener to a parent element instead of adding event listeners to multiple child elements. This takes advantage of event bubbling, which allows the event to "bubble up" from a child element to its parent.
  let sidebar = document.querySelector(".dashboard_sidebar");
  sidebar.addEventListener("click", (event) => {
    if (event.target.classList.contains("load-file")) {
      let file_links = event.target.getAttribute("file-link");
      if (!file_links) {
        alert("This button is not activate yet!.");
        return;
      } else {
        event.preventDefault();
        display_supplier_form(file_links);
        // store the last opened page in local storage to prevent from go back to dashboar page even after reload the page
        sessionStorage.setItem("lastOpenedForm", file_links);
      }
    }
  });

  // this function is for display the form and hide the dahsboard content which is initialy display in dashboard
  let display_supplier_form = (file) => {
    // AJAX start for display forms in dashboard
    // fetch request the form from server
    fetch(file)
      // convert the server response into html "response is predefined"
      .then((response) => response.text())
      .then((data) => {
        //access the dashboard content section for hiding while showing the form
        let dashboard_content = document.getElementById("dashboard_content");
        dashboard_content.style.display = "none";
        //access form conatiner (this is not actual for container ) its form container in dashboard where we will show actual form dynamically
        let formcontianer = document.getElementById("dynamicDisplayForms");
        //give the form data(actual form) to form variable which contain the dynamically form container
        formcontianer.innerHTML = data;
        formcontianer.style.display ="flex";
        load_all_drop_downs();
        form_handler();
        fetch_Supplier_function();
      })
      .catch((error) => console.log("Error during loading form", error));
  };
  // this function handles the form data then send it to php file then php file send data to database
  let form_handler = () => {
    let form = document.getElementById("form");
    if (!form) return;
    // Check if phone field exists in THIS form
    let phoneInput = form.querySelector('[name="phone"], #supplier_telephone');
    // Setup real-time validation ONLY if phone field exists
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            const isValid = /^[0-9]{10,20}$/.test(this.value.trim());
            this.setCustomValidity(isValid ? "" : "Phone: 10-20 digits required");
            this.reportValidity();
        });
    }




// NEW: Booking date validation setup
const bookingInput = form.querySelector('#booking_date, [name="booking_date"], [type="date"]');
if (bookingInput) {
    // Real-time validation
    bookingInput.addEventListener('input', function() {
        
        this.setCustomValidity("");
        this.reportValidity();
    });
}  






















    form.addEventListener("submit", (event) => {
      // event.preventDefault(); : this stop the normal form submission (without AJAX)      
      event.preventDefault();
      let isFormValid = true;

      // validate form
      if (phoneInput) {
        const phoneValid = /^[0-9]{10,20}$/.test(phoneInput.value.trim());
        if (!phoneValid) {
            phoneInput.setCustomValidity("Invalid phone number");
            phoneInput.reportValidity();
            console.log("Phone validation failed");
            isFormValid = false;
          }
    }












        // NEW: Booking date validation
        if (bookingInput) {
          let selectedDate = new Date(bookingInput.value);
          let today = new Date();
          
          
          if (selectedDate < today) {
            bookingInput.setCustomValidity("Please select today's date or a future date");
            bookingInput.reportValidity();
            isFormValid = false;
        } else {
            bookingInput.setCustomValidity(""); // Clear if valid
        }
    }

    if (!isFormValid) return false;



      // window.confirm : predefined function in JS whenever we submit form it will ask for confirmation
      let is_confirm = window.confirm("Are you sure to make changes ?");
      if (!is_confirm) {
        // FormData() :predefined function that extrats the form data
        return false;
      }
      let form_data = new FormData(form);
      let action_url = form.getAttribute("action");
      fetch(action_url, {
        method: "POST",
        body: form_data,
      })
        .then((response) => response.text())
        .then((msg) => {
          let messge = document.getElementById("message");
          // show response (message success/error)
          messge.innerHTML = msg;
          // reset the form after send data to php file(AddSupplier)
          form.reset();
        })
        .catch((error) => console.log("Error during submitting form", error));
    });
  };
  let lastOpenedForm = sessionStorage.getItem("lastOpenedForm");
  if (lastOpenedForm) {
   display_supplier_form(lastOpenedForm);
  }
});
