function updateEvent(eventId) {
    // Handle update logic for the event with ID eventId
    console.log('Updating event with ID:', eventId);
}

function deleteEvent(eventId) {
    // Handle delete logic for the event with ID eventId
    console.log('Deleting event with ID:', eventId);
}

function addEvent() {
    // Handle logic to add a new event
    console.log('Adding a new event');
}

function searchEvents() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("eventTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Assuming Event ID is in the first column
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

/*
 // Get the pagination elements
 var pagination = document.getElementById("pagination");
 var prevButton = document.getElementById("prevButton");
 var nextButton = document.getElementById("nextButton");

 // Set the current page and total pages (you can update these dynamically)
 var currentPage = 5;
 var totalPages = 5;

 // Update the next button's status based on the current page
 function updateNextButtonStatus() {
   if (currentPage === totalPages) {
    prevButton.classList.add("disabled");
   } else {
    prevButton.classList.remove("disabled");
   }
 }

 // Initial update
 updateNextButtonStatus();

 // Event listeners for pagination
 prevButton.addEventListener("click", function () {
   if (currentPage > 1) {
     currentPage--;
     // Perform your pagination logic here
     console.log("Previous button clicked. Current Page: " + currentPage);
     updateNextButtonStatus();
   }
 });

 nextButton.addEventListener("click", function () {
   if (currentPage < totalPages) {
     currentPage++;
     // Perform your pagination logic here
     console.log("Next button clicked. Current Page: " + currentPage);
     updateNextButtonStatus();
   }
 });
*/



let currentPage = 1;
let rowsPerPage = 5; // Set this based on your layout and row heights

function setupPagination(rows) {
    let totalRows = rows.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);
    let paginationUl = document.getElementById('pagination');
    paginationUl.innerHTML = '';

    // Previous button
    paginationUl.innerHTML += '<li onclick="changePage(-1)">«</li>';

    for (let i = 1; i <= totalPages; i++) {
        paginationUl.innerHTML += `<li onclick="changePage(${i})">${i}</li>`;
    }

    // Next button
    paginationUl.innerHTML += '<li onclick="changePage(-2)">»</li>';

    displayRows(rows, rowsPerPage, currentPage);
}

function displayRows(rows, rowsPerPage, page) {
    let start = (page - 1) * rowsPerPage;
    let end = start + rowsPerPage;
    let pagination = document.getElementById('pagination');


    for (let i = 0; i < rows.length; i++) {
        if (i >= start && i < end) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }

    // Highlight current page number
    [...pagination.querySelectorAll('li')].forEach(li => {
        li.classList.remove('current');
    });
    pagination.querySelectorAll('li')[page].classList.add('current');

}

function changePage(page) {
    let rows = document.getElementById("eventTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    let totalRows = rows.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);

    // Calculate new page number
    if (page == -1) { // Previous button clicked
        if (currentPage > 1) currentPage--;
    } else if (page == -2) { // Next button clicked
        if (currentPage < totalPages) currentPage++;
    } else {
        currentPage = page;
    }

    displayRows(rows, rowsPerPage, currentPage);
}

document.addEventListener('DOMContentLoaded', function () {
    let rows = document.getElementById("eventTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    setupPagination(rows);
});



function viewEvent(eventId) {
    // For demonstration, using static data. Replace with actual event data retrieval logic.
    var eventDetails = `
        <tr>
            <td>Event ID</td>
            <td>${eventId}</td>
        </tr>
        <tr>
            <td>Event Name</td>
            <td>Books for Bright Futures</td>
        </tr>
        <tr>
            <td>Goal</td>
            <td>Provide 1,000 books to underprivileged children</td>
        </tr>
        <tr>
            <td>Location</td>
            <td>Charity Book Depot, Colombo 01000, Sri Lanka</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>20.01.2024</td>
        </tr>
        <tr>
            <td>Time</td>
            <td>9 am</td>
        </tr>
         <tr>
            <td>Number of Books</td>
            <td>500</td>
        </tr>
         <tr>
            <td>Book Category</td>
            <td>Fiction</td>
        </tr>
         <tr>
            <td>Contact Number</td>
            <td>0768545700</td>
        </tr>
    `;
    var table = document.getElementById("eventDetailsTable");
    table.innerHTML = eventDetails;
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

function updateEvent(eventId) {
    // Implement the update logic
    alert("Update functionality not implemented yet.");
}

function deleteEvent(eventId) {
    // Implement the delete logic
    alert("Delete functionality not implemented yet.");
}


// addeventscript.js
function submitEventForm() {
    // Add logic to handle form submission
    alert('Form submitted successfully!'); // Replace with your logic
}

// Function to redirect to addevent.html
function redirectToAddEvent() {
    window.location.href = 'addevent.html';
}

