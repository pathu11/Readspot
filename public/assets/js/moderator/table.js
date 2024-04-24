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