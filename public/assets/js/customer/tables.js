let curtPage = 1;
let rowsPerPage = 5;
let maxPaginationNumbers = 3;
let rows = [];
let searchTerm = '';

document.addEventListener('DOMContentLoaded', function () {
    // Store the rows in a separate array
    rows = Array.from(document.getElementById("eventTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr"));

    setupPagination(rows);

    // Add event listener for the search input
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', handleSearch);
});

function setupPagination(rows) {
    let totalRows = rows.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);
    let paginationUl = document.getElementById('pagination');
    paginationUl.innerHTML = '';

    // Previous button
    paginationUl.innerHTML += '<li onclick="changePage(-1)">«</li>';

    // Display up to maxPaginationNumbers pagination numbers
    for (let i = 1; i <= Math.min(totalPages, maxPaginationNumbers); i++) {
        paginationUl.innerHTML += `<li onclick="changePage(${i})">${i}</li>`;
    }

    // Next button
    paginationUl.innerHTML += '<li onclick="changePage(-2)">»</li>';

    displayRows(rows, rowsPerPage, curtPage);
}

function displayRows(rows, rowsPerPage, page) {
    let start = (page - 1) * rowsPerPage;
    let end = start + rowsPerPage;
    let matchedRows = [];

    for (let i = 0; i < rows.length; i++) {
        const contentName = rows[i].cells[0].innerText.toLowerCase(); // Assuming content name is in the first cell

        if (searchTerm === '' || contentName.includes(searchTerm)) {
            matchedRows.push(rows[i]);
        } else {
            rows[i].style.display = 'none'; // hide irrelevant rows
        }
    }

    let totalPages = Math.ceil(matchedRows.length / rowsPerPage);

    for (let i = 0; i < matchedRows.length; i++) {
        if (i >= start && i < end) {
            matchedRows[i].style.display = ''; // display relevant rows
        } else {
            matchedRows[i].style.display = 'none'; // hide rows not in current page
        }
    }

    updatePaginationUI(page, totalPages);
}


function updatePaginationUI(curtPage, totalPages) {
    let pagination = document.getElementById('pagination');

    // Display exactly maxPaginationNumbers pagination numbers
    let startPage = Math.max(1, Math.min(curtPage - Math.floor(maxPaginationNumbers / 2), totalPages - maxPaginationNumbers + 1));
    let endPage = Math.min(startPage + maxPaginationNumbers - 1, totalPages);

    pagination.innerHTML = '';

    // Previous button
    pagination.innerHTML += '<li onclick="changePage(-1)">«</li>';

    // Display exactly maxPaginationNumbers pagination numbers
    for (let i = startPage; i <= endPage; i++) {
        pagination.innerHTML += `<li onclick="changePage(${i})">${i}</li>`;
    }

    // Next button
    pagination.innerHTML += '<li onclick="changePage(-2)">»</li>';

    // Highlight current page number
    [...pagination.querySelectorAll('li')].forEach(li => {
        li.classList.remove('current');
    });
    pagination.querySelectorAll('li')[curtPage - startPage + 1].classList.add('current');
}

function changePage(page) {
    let totalPages = Math.ceil(rows.length / rowsPerPage);

    // Calculate new page number
    if (page == -1) { // Previous button clicked
        if (curtPage > 1) curtPage--;
    } else if (page == -2) { // Next button clicked
        if (curtPage < totalPages) curtPage++;
    } else {
        curtPage = page;
    }

    displayRows(rows, rowsPerPage, curtPage);
}

function handleSearch() {
    const searchInput = document.getElementById('searchInput');
    searchTerm = searchInput.value.toLowerCase();

    // Reset pagination to the first page when searching
    curtPage = 1;

    displayRows(rows, rowsPerPage, curtPage);
}

// Kaumadi js
function showAcceptPopup(customerId) {
    var modalId = 'acceptPopup_' + customerId;
    document.getElementById(modalId).style.display = 'flex';
  }
  
function hidePopup(modalId) {
document.getElementById(modalId).style.display = 'none';
}
