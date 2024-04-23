document.addEventListener("DOMContentLoaded", function () {
    const notViewedIcons = document.querySelectorAll('.ur-status#ur-notviewed');
    const viewedIcons = document.querySelectorAll('.ur-status#ur-viewed');
    const popup = document.getElementById('ur-popup');
    const popupMessage = document.getElementById('ur-popupMessage');
    const closePopup = document.getElementById('ur-closePopup');
    const ignoreNow = document.getElementById('ur-ignoreNow');
    const viewAll = document.getElementById('ur-viewAll');
    const hiddenRows = document.querySelectorAll('tbody.ur-tbody tr.ur-hidden-row');

    notViewedIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault();
            popupMessage.textContent = "You did not view this request!";
            popup.style.display = 'block';
        });
    });

    viewedIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.preventDefault();
            popupMessage.textContent = "You already viewed it & Do you want to view again!";
            popup.style.display = 'block';
        });
    });

    closePopup.addEventListener('click', function () {
        popup.style.display = 'none';
    });

    popup.addEventListener('click', function (event) {
        if (event.target === this || event.target === ignoreNow) {
            popup.style.display = 'none';
        }
    });

    document.getElementById('ur-viewNow').addEventListener('click', function () {
        alert('Viewing request...');
        popup.style.display = 'none';
    });

    ignoreNow.addEventListener('click', function () {
        alert('Ignoring request...');
        popup.style.display = 'none';
    });

    viewAll.addEventListener('click', function () {
        hiddenRows.forEach(row => {
            row.style.display = 'table-row';
        });
        viewAll.style.display = 'none';
    });
});

function showContactOptions() {
    const modal = document.getElementById('ur-contactModal');
    modal.style.display = 'block';
}

function callNumber(phoneNumber) {
    window.location.href = `tel:+${phoneNumber}`;
}

function closeModal() {
    document.getElementById('ur-contactModal').style.display = 'none';
}

updateTotalCount();

function updateTotalCount() {
    const totalCount = document.getElementById('ur-totalCount');
    const rowCount = document.querySelectorAll('.ur-tbody tr').length;
    totalCount.textContent = rowCount;
}