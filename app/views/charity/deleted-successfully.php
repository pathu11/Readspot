<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .dltpop-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .dltpop-modal-content {
            margin: auto;
            display: block;
            width: 20%;
            max-width: 500px;
            max-height: 16vh;
            object-fit: contain;
            margin-top: 18%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .dltpop-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 20px;
            transition: 0.3s;
            cursor: pointer;
        }

        .dltpop-close:hover,
        .dltpop-close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .dltpop-tick-icon {
            color: red;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .dltpop-yes-button, .dltpop-no-button {
            margin-top: 10px;
            padding: 10px 20px;
            width: 45%;
            background-color: #009d94;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .dltpop-ok-button{
            margin-top: 29px;
            padding: 10px 20px;
            width: 45%;
            background-color: #009d94;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dltpop-ok-button:hover, .dltpop-no-button:hover {
            background-color:#00857e;
        }
    </style>
</head>

<body>
    <button type="submit" class="delete-button" onclick="confirmDelete()">
        <i class="fas fa-trash"></i>
    </button>

    <div class="dltpop-modal" id="dltpop-confirmModal">
        <div class="dltpop-modal-content">
            <i class="fas fa-exclamation-triangle dltpop-tick-icon"></i>
            <p>Are you sure you want to delete this event?</p>
            <button class="dltpop-yes-button" onclick="deleteEvent()">Yes</button>
            <button class="dltpop-no-button" onclick="closePopup()">No</button>
        </div>
    </div>

    <div class="dltpop-modal" id="dltpop-successModal">
        <div class="dltpop-modal-content">
            <i class="fas fa-check-circle dltpop-tick-icon"></i>
            <p>Deleted Successfully!</p>
            <button class="dltpop-ok-button" onclick="closePopup()">OK</button>
        </div>
    </div>

    <script>
        function confirmDelete() {
            document.getElementById('dltpop-confirmModal').style.display = 'block';
        }

        function deleteEvent() {
            document.getElementById('dltpop-confirmModal').style.display = 'none';
            document.getElementById('dltpop-successModal').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('dltpop-confirmModal').style.display = 'none';
            document.getElementById('dltpop-successModal').style.display = 'none';
        }
    </script>
</body>

</html>
