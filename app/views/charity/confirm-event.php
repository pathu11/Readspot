<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>User Request Form</title> 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .success-modal {
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

        .success-modal-content {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .success-modal-content i {
            font-size: 50px;
            color: #009d94;
            margin-bottom: 20px;
        }

        .success-modal-content p {
            margin-bottom: 20px;
        }

        .success-modal-content button {
            padding: 10px 127px;
            font-size: 15px;
            background-color: #009d94;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .success-modal-content button:hover {
            background-color: #00726c;
        }
    </style>
</head>

<body>

    <div id="successModal" class="success-modal">
        <div class="success-modal-content">
            <i class="fas fa-check-circle"></i>
            <p>You confirmed the request</p>
            <button onclick="userrequest()">Accept more requests</button>
        </div>
    </div>

    <script>
        function userrequest() {
            window.location.href = '<?php echo URLROOT; ?>/charity/donation';
        }

        window.onload = function() {
            const successModal = document.getElementById('successModal');
            successModal.style.display = 'flex';
        };
    </script>

</body>

</html>