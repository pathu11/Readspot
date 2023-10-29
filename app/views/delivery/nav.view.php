<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        nav {
            background-color: #01322F;
            color: white;
            padding: 25px;
            width: 100%;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav img {
            height: 50px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0 20px;
            position: relative;
            transition: border-bottom 0.2s ease; /* Smooth transition for the hover line */
        }

        nav a:hover {
            color: #00FFF0;
        }

        nav a:hover::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -3px; /* Adjust the position as needed */
            left: 0;
            width: 100%;
            height: 1px;
            background-color: white;
        }

        nav a:last-child {
            margin-left: 20px; /* Adjust as needed to move right corner links to the left */
            margin-right: 30px; /* Increase the right margin for the last link */
        }

        nav a:last-child:hover {
            border-bottom: none; /* Remove the hover line from the last link */
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <img src="http://localhost/Group-27/public/assets/images/publisher/ReadSpot.png" alt="Logo" />
            <div>
                <a href="home.view.php">Dashboard</a>
                <a href="orders.view.php">Orders</a>
                <a href="deliverCharges.view.php">Delivery Charges</a>
                <a href="notification.view.php">Notifications </a>
                
                <a href="#User"> <i class="fas fa-user" style="color: #ffffff;"></i> Hi, Kaumadi</a>
                
            </div>
        </div>
    </nav>
</body>
