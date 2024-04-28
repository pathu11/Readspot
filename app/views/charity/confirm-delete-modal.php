<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .nm-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .nm-modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 8px;
            width: 355px;
            margin-left: 37%;
            margin-top: 15%;
            text-align: center;
        }

        .nm-modal-content i {
            font-size: 30px;
            color: red;
            margin-bottom: 20px;
        }

        .nm-modal-content p {
            margin-bottom: 20px;
        }

        .nm-modal-content button {
            padding: 5px 62px;
            font-size: 14px;
            background-color: white;
            color: #4e4e4e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nm-modal-content button:hover {
            background-color: red;
            color: white;
        }

        .nm-modal-content #em-noButton:hover {
            background-color: gray;
            color: white;
        }

        .nm-red-box {
            background-color: #ffcccc;
            border: 1px solid #ff0000;
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div id="nm-deleteModal" class="nm-modal">
        <div class="nm-modal-content nm-red-box">
            <i class="fas fa-exclamation-triangle"></i>
            <p>Are you sure you want to delete this item?</p>
            <button id="nm-okButton">yes</button>
            <button id="nm-noButton">No</button>
        </div>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".em-delete-button");
        const deleteModal = document.getElementById("em-deleteModal");
        const yesButton = document.getElementById("em-okButton");
        const noButton = document.getElementById("em-noButton");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission
                deleteModal.style.display = "block";
            });
        });

        yesButton.addEventListener("click", function() {
            deleteEvent();
        });

        noButton.addEventListener("click", function() {
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
</script>

</html>