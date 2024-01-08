// // Get references to the type dropdown and the input elements
// const typeDropdown = document.getElementById('content-type');
// const ISBNInput = document.getElementById('ISBN');
// const ISSNInput = document.getElementById('ISSN');
// const ISMNInput = document.getElementById('ISMN');

// // Event listener for when the type dropdown changes
// typeDropdown.addEventListener('change', () => {
//     // Enable or disable input fields based on the selected value
//     const selectedType = typeDropdown.value;
//     ISBNInput.disabled = selectedType !== 'ISBN';
//     ISSNInput.disabled = selectedType !== 'ISSN';
//     ISMNInput.disabled = selectedType !== 'ISMN';
// });

// function validateForm() {
//     var input1 = document.getElementById('input1').value;
//     var input2 = document.getElementById('input2').value;
//     var input3 = document.getElementById('input3').value;

//     if (input1 === '' && input2 === '' && input3 === '') {
//         // alert("At least one input is required.");
//         return false;
//     }

//     return true;
// }