// // here we access form by its ID
// let formValidation = ()=>{
// document.addEventListener("DOMContentLoaded ",()=>{
//     let supplierForm = document.getElementById("form")

//     // here we access the name filed by its ID
//     let supplierPhone = document.getElementById("supplier_telephone");
    
//     let phoneNumberValidation = (enteredPhone)=>{
//         // Regular expression pattern to validate phone numbers
//         // ^ - start of the string
//             console.log("Please follow the telephone pattern.")
//         // [1-9]{1,2} - area code (1 or 2 digits, not starting with 0)
//         // [0-9]{7} - subscriber number (7 digits)
//         // $ - end of the string
//         let pattern = /^(\+353|00353|0)[1-9]{1,2}[0-9]{7}$/;
//         if (!pattern.test(enteredPhone)) {
//             console.log("please follow the telephon pattern")
//             return false;
//         }
//         return true;
//     }
//     supplierForm.addEventListener("submit", (event) => {
//         let phoneValue = supplierPhone.value.trim();
//         supplierPhone.setCustomValidity("");
//         if (!phoneNumberValidation(phoneValue)) {
//             event.preventDefault();
//             supplierPhone.setCustomValidity("phone number should be  +35311234567, 0035311234567, 0851234567");
//             supplierPhone.reportValidity();
//         }
//     });
    
//     supplierPhone.addEventListener("input", () => {
//         let phoneValue = supplierPhone.value.trim();
//         if (phoneNumberValidation(phoneValue)) {
//             supplierPhone.setCustomValidity("");
//         }
//     });
// });

// };