
document.addEventListener('DOMContentLoaded', function () {
    const notAvailableButtons = document.querySelectorAll('.not-available');
    const modal = document.getElementById('confirmationModal');
    const closeModalBtn = document.getElementById('closeModal');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    notAvailableButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            modal.style.display = 'block';
        });
    });

    closeModalBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    confirmBtn.addEventListener('click', function () {
        window.location.href = 'oldDonationDetailsPage.html';
    });
});




