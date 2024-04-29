document.querySelectorAll('.not-menu-icons').forEach((icons) => {
    icons.addEventListener('click', (e) => {
        document.querySelectorAll('.not-menu-icons.active').forEach((activeIcons) => {
            if (activeIcons !== icons) {
                activeIcons.classList.remove('active');
            }
        });

        icons.classList.toggle('active');

        e.stopPropagation();
    });
});


document.addEventListener('click', () => {
    document.querySelectorAll('.not-menu-icons.active').forEach((icons) => {
        icons.classList.remove('active');
    });
});


//
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".em-delete-button");
    const deleteModal = document.getElementById("em-deleteModal");
    const yesButton = document.getElementById("em-okButton");
    const noButton = document.getElementById("em-noButton");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default form submission
            deleteModal.style.display = "block";
        });
    });

    yesButton.addEventListener("click", function () {
        deleteEvent();
    });

    noButton.addEventListener("click", function () {
        closeModal();
    });

    function deleteEvent() {
        const eventId = "<?php echo $event->charity_event_id; ?>"; // Get the event ID
        const formData = new FormData();
        formData.append('eventId', eventId);

        fetch("<?php echo URLROOT; ?>/Readspot/charity/deleteEvent", {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Event deleted!");
                    closeModal(); // Close the modal
                    // Optionally, you can reload the page to reflect the changes
                    // location.reload();
                } else {
                    alert("Failed to delete event.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while deleting the event.");
            });
    }

    function closeModal() {
        deleteModal.style.display = "none";
    }
});
