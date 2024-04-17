<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/charity-home.css" ?>>
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/eveTable1.css" ?>>
    <link rel="stylesheet" href=<?php echo URLROOT . "/assets/css/charity/customerSupport.css" ?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Font Awesome for bell icon -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js library -->
    <title>ReadSpot Online Book store</title>
    <script src=<?php echo URLROOT . "/assets/js/charity/script.js" ?>></script>
    <script src=<?php echo URLROOT . "/assets/js/charity/eventscript.js" ?>></script>

</head>
    
<body>
    <header>
        <div>
            <img id="logo" src=<?php echo URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="event" >Event Management</a>
            <a href="donation">Donation Requests</a>
            <a href="customerSupport" class="active" id="donorRequestLink">Customer Support</a>
            <a href="aboutUs">
                <i class="fas fa-bell" id="bell"></i>
                <span class="notification-text">Notification</span>
            </a>
        </nav>
        <div class="dropdown" style="float:right;">
            <button class="dropdown-button">
                <img id="profile" src=<?= URLROOT . "/assets/images/charity/gokuU.jpg" ?> alt="Profile Pic">
            </button>
            <div class="dropdown-content">
                <a href="#"><i class="fas fa-user-edit"></i>Profile</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

    </header>

    <div class="body-container">
        <img id="bcnd" src=<?php echo URLROOT . "/assets/images/charity/Event_man.jpg" ?>>
    </div>

    <div class="row">
        <!-- First row of boxes -->
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
                <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Donation-Related Queries:</h2>
                    <div class="note">You have donation-Related Queries</div>
                </div>
                </a>
            </div>
        </div>
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
            <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Feedback and Reviews:</h2>
                    <div class="note">You have feedbacks</div>
                </div>
            </div>
            </a>
        </div>
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
            <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Partnership Queries:</h2>
                    <div class="note">You have Partnership enquiries</div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Second row of boxes -->
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
                <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Event Participation Queries:</h2>
                    <div class="note">You have event Participation Queries</div>
                </div>
                </a>
            </div>
        </div>
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
                <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Event Sponsorship Queries:</h2>
                    <div class="note">You have Sponsorship Queries</div>
                </div>
                </a>
            </div>
        </div>
        <div class="box" onclick="toggleContent(this)">
            <div class="box-inner">
                <a href="donationQuery">
                <div class="box-content">
                    <i class="fas fa-bell notification-bell"></i>
                    <h2>Logistical Queries: </h2>
                    <div class="note">You have logistical Queries</div>
                </div>
                </a>
            </div>
        </div>
    </div>

    <!-- <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <div class="notification-container" id="notificationContainer">
        <div class="notification-content">
            <span id="messageContent"></span>
        </div>
    </div> -->


    <script>
        function toggleContent(box) {
            const boxInner = box.querySelector('.box-inner');
            const boxContent = box.querySelector('.box-content');

            boxInner.style.transform = boxInner.style.transform === 'rotateX(20deg)' ? 'rotateX(0)' : 'rotateX(20deg)';
            boxContent.classList.toggle('hidden');
        }

        // Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Last Month', 'Today'],
                datasets: [{
                    label: 'Query Difference',
                    data: [10, 20], // Replace with your actual data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const notifications = [
            "Thank you for joining our charity circle!",
            "Your donation has been received ",
            "New Customers on dashboard",
            "step to next Gen"
        ];

        let currentNotification = 0;

        function showNotification() {
            const notificationContainer = document.getElementById("notificationContainer");
            const messageContentElement = document.getElementById("messageContent");

            const message = notifications[currentNotification];
            messageContentElement.textContent = message;

            notificationContainer.classList.remove('hide');
            notificationContainer.classList.add('show');

            setTimeout(() => {
                notificationContainer.classList.remove('show');
                notificationContainer.classList.add('hide');
                currentNotification = (currentNotification + 1) % notifications.length;
                setTimeout(showNotification, 1000); // Add a delay before showing the next notification
            }, 5000);
        }

        showNotification(); // Show the first notification

        
    </script>
    
    <footer>
        <div>
            <p>Privacy Policy : All content included on this site, such as text, graphics, logos, button icons, images,
                audio clips, digital downloads, data compilations,<br>
                and software, is the property of READSPOT or its content suppliers and protected by Sri Lanka and
                international copyright laws...
            </p>
        </div>
        <div>
            <p id="copyright" style=" color: #00ffee;">&copy; 2023 ReadSpot. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>
