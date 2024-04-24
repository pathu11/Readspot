document.addEventListener("DOMContentLoaded", function () {
    const notViewedIcons = document.querySelectorAll('.status#notviewed');
    const viewedIcons = document.querySelectorAll('.status#viewed');
    const popup = document.getElementById('popup');
    const popupMessage = document.getElementById('popupMessage');
    const closePopup = document.getElementById('closePopup');
    const ignoreNow = document.getElementById('ignoreNow');
    const viewAll = document.getElementById('viewAll');
    const hiddenRows = document.querySelectorAll('tbody tr.hidden-row');

    notViewedIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault();
            popupMessage.textContent = "You did not view this request !";
            popup.style.display = 'block';
        });
    });

    viewedIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault();
            popupMessage.textContent = "You already viewed it & Do you want to view again !";
            popup.style.display = 'block';
        });
    });

    // Close popup when clicking on close button
    closePopup.addEventListener('click', function () {
        popup.style.display = 'none';
    });

    // Close popup when clicking outside of it or on "Ignore" button
    popup.addEventListener('click', function (event) {
        if (event.target === this || event.target === ignoreNow) {
            popup.style.display = 'none';
        }
    });

    // Handle popup button clicks
    document.getElementById('viewNow').addEventListener('click', function () {
        alert('Viewing request...');
        //view the request
        popup.style.display = 'none';
    });

    ignoreNow.addEventListener('click', function () {
        alert('Ignoring request...');
        //ignore the request
        popup.style.display = 'none';
    });

    // View All Requests button click event
    viewAll.addEventListener('click', function () {
        hiddenRows.forEach(row => {
            row.style.display = 'table-row'; // Display hidden rows
        });
        viewAll.style.display = 'none'; // Hide the view all button after showing all rows
    });
});

function showContactOptions() {
    const modal = document.getElementById('contactModal');
    modal.style.display = 'block';
}

function callNumber(phoneNumber) {
    window.location.href = `tel:+${phoneNumber}`;
}

function closeModal() {
    document.getElementById('contactModal').style.display = 'none';
}

