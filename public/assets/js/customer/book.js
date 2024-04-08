document.addEventListener("DOMContentLoaded", function() {
    var items = document.querySelectorAll('.B0-U'); // Select all book items
    var itemsPerPage = 10; // Number of items per page
    var currentPage = 1; // Current page
    var numPages = Math.ceil(items.length / itemsPerPage); // Total number of pages
    var pagination = document.getElementById('pagination');

    // Function to display items for the current page
    function displayItems() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = Math.min(startIndex + itemsPerPage, items.length);

        // Hide all items
        items.forEach(function(item) {
            item.style.display = 'none';
        });

        // Display items for the current page
        for (var i = startIndex; i < endIndex; i++) {
            items[i].style.display = 'block';
        }
    }

    // Function to update pagination buttons
    function updatePaginationButtons() {
        // Clear previous pagination buttons
        pagination.innerHTML = '';

        // Previous button
        pagination.innerHTML += '<li id="prevButton">«</li>';

        // Display only necessary pagination numbers
        for (var i = 1; i <= numPages; i++) {
            pagination.innerHTML += '<li class="' + (currentPage === i ? 'current' : '') + '">' + i + '</li>';
        }

        // Next button
        pagination.innerHTML += '<li id="nextButton">»</li>';

        // Add event listeners to newly created pagination buttons
        var pageButtons = pagination.querySelectorAll('li:not(#prevButton):not(#nextButton)');
        pageButtons.forEach(function(button, index) {
            button.addEventListener('click', function() {
                currentPage = index + 1;
                displayItems();
                updatePaginationButtons();
            });
        });

        // Add event listeners for previous and next buttons
        document.getElementById('prevButton').addEventListener('click', goToPrevPage);
        document.getElementById('nextButton').addEventListener('click', goToNextPage);
    }

    // Initial display
    displayItems();
    updatePaginationButtons();

    // Function to go to the previous page
    function goToPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            displayItems();
            updatePaginationButtons();
        }
    }

    // Function to go to the next page
    function goToNextPage() {
        if (currentPage < numPages) {
            currentPage++;
            displayItems();
            updatePaginationButtons();
        }
    }
});