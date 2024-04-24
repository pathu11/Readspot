<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>User Request Form</title>
    <style>
        /* Setting Poppins font */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ... (Previous CSS remains unchanged) ... */

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

        #bookQuantity {
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        #progressBox {
            width: 100%;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }


        #remainingProgress {
            width: 0;
            background-color: red;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: white;
            transition: width 2s ease-in-out;
        }

        #donatedProgress {
            width: 0;
            background-color: #70bfba;
            height: 30px;
            line-height: 30px;
            text-align: center;
            color: white;
            transition: width 2s ease-in-out;
        }

        #donatedProgress.loaded,
        #remainingProgress.loaded {
            width: 100%;
            transition: width 0.5s ease-in-out;
        }

        #donatedProgress,
        #remainingProgress {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Modal for Success Message -->
    <div id="successModal" class="success-modal">
        <div class="success-modal-content">
            <i class="fas fa-check-circle"></i>
            <p>You confirmed the request</p>

            <!-- Progress Box -->
            <div id="progressBox">
                <div id="donatedProgress" class="loading">160 books Confirmed</div>
                <div id="remainingProgress" class="loading">40 books remaining</div>
            </div>

            <p id="bookQuantity">40 more books needed to complete this event</p>
            <button onclick="userrequest()">Accept more requests</button>
        </div>
    </div>

    <script>
        let donatedBooks = 160;
        const totalBooksRequired = 200;
        const remainingBooks = totalBooksRequired - donatedBooks;
        document.getElementById('bookQuantity').innerText = `${remainingBooks} more books needed to complete this event`;

        // Function to update progress bars with animation
        function updateProgressBars() {
            const donatedProgress = document.getElementById('donatedProgress');
            const remainingProgress = document.getElementById('remainingProgress');

            // Calculate progress percentage
            const donatedPercentage = (donatedBooks / totalBooksRequired) * 100;
            const remainingPercentage = (remainingBooks / totalBooksRequired) * 100;

            // Update progress bars
            donatedProgress.style.width = `${donatedPercentage}%`;
            remainingProgress.style.width = `${remainingPercentage}%`;

            // Remove loading class after animation
            setTimeout(() => {
                donatedProgress.classList.remove('loading');
                remainingProgress.classList.remove('loading');
                donatedProgress.classList.add('loaded');
                remainingProgress.classList.add('loaded');
            }, 2000); // 2s is the duration of the animation
        }

        window.onload = function() {
            const successModal = document.getElementById('successModal');
            successModal.style.display = 'flex';

            // Trigger animation
            setTimeout(updateProgressBars, 50);
        };

        function userrequest() {
            window.location.href = '<?php echo URLROOT; ?>/charity/userrequest';
            // window.location.href = "<?php echo URLROOT; ?>/customer/Event";
        }
    </script>

</body>

</html>