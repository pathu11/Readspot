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

// document.addEventListener('DOMContentLoaded', function () {
//   let rows = document.getElementById("eventTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
//   setupPagination(rows);
// });



function viewEvent(eventId) {
  // For demonstration, using static data. Replace with actual event data retrieval logic.
  var eventDetails = `
         <img src="${eventId}" width=70%;>
     
     
  `;
  var table = document.getElementById("eventDetailsTable");
  table.innerHTML = eventDetails;
  document.getElementById("myModal").style.display = "flex";
}
function viewBook(bookDetails) {
  var modal = document.getElementById("myModal");
  var bookDetailsTable = document.getElementById("bookDetailsTable");

  var detailsHTML = `
      <table>
          <tr>
              <th>Book Name</th>
              <td>${bookDetails.book_name}</td>
          </tr>
          <tr>
              <th>Author</th>
              <td>${bookDetails.author}</td>
          </tr>
          <tr>
              <th>Price</th>
              <td>${bookDetails.price}</td>
          </tr>
          <tr>
              <th>Weight</th>
              <td>${bookDetails.weight}</td>
          </tr>
          <tr>
              <th>Description</th>
              <td>${bookDetails.descript}</td>
          </tr>
          <tr>
              <th>Isbn Number</th>
              <td>${bookDetails.ISBN_no}</td>
          </tr>
          <tr>
              <th>Category</th>
              <td>${bookDetails.category}</td>
          </tr>
          <tr>
              <th>No of Books</th>
              <td>${bookDetails.quantity}</td>
          </tr>
      </table>
  `;

  bookDetailsTable.innerHTML = detailsHTML;
  modal.style.display = "block";
}

function viewImage(imageSrc) {
  var modal = document.getElementById("myModalImage");
  var imageDetailsTable = document.getElementById("eventDetailsTable");

  // Clear the imageDetailsTable content
  imageDetailsTable.innerHTML = '';

  var imageHTML = `
      <img src="${imageSrc}" width="50%" >
  `;

  imageDetailsTable.innerHTML = imageHTML;
  modal.style.display = "block";
}

function viewBookOnly(bookDetails) {
  // Display only the book details table
  viewBook(bookDetails);
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}
function closeModalImage() {
  document.getElementById("myModalImage").style.display = "none";
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

function showAcceptPopup(customerId) {
  var modalId = 'acceptPopup_' + customerId;
  document.getElementById(modalId).style.display = 'flex';
}

function hidePopup(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

function showRejectPopup(customerId) {
  var modalId = 'rejectPopup_' + customerId;
  document.getElementById(modalId).style.display = 'flex';
}

