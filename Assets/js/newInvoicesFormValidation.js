// Setting the current date as the default value for the date field
document.addEventListener("DOMContentLoaded", function() {
    let dateField = document.getElementById("invoice_date");
    let today = new Date().toISOString().split('T')[0];
    dateField.value = today;
});

// Validation for the date field
function validateDate() {
    let dateField = document.getElementById("invoice_date");
    let selectedDate = new Date(dateField.value);
    let today = new Date();

    // Ensure the selected date is not in the future
    if (selectedDate > today) {
        alert("The date of the invoice cannot be in the future.");
        return false;
    }
    return true;
}