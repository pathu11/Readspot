


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
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
        <img src="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png" alt="Logo" />
        <div>
        
           
            <a href="<?php echo URLROOT; ?>/publisher/index">Home</a>
            <a href="<?php echo URLROOT; ?>/publisher/addBooks">Book Shelf</a>
            <a href="<?php echo URLROOT; ?>/publisher/processingorders">Orders</a>
            <a href="<?php echo URLROOT; ?>/publisher/customerSupport">Customer Support</a>
            <a href="<?php echo URLROOT; ?>/publisher/setting">Settings</a>
            
            

            <?php if (isset($_SESSION['user_id'])) : ?>
               
                   <div class="dropdown">
                    <a href="javascript:void(0);" class="dropbtn"><i class="fas fa-user" style="color: #ffffff;"></i> Hi <?php echo $_SESSION['user_id']; ?> </a>
                    <div class="dropdown-content">
                    <a href="<?php echo URLROOT; ?>/publisher/customerSupport">Customer Support</a>
                    <a href="<?php echo URLROOT; ?>/publisher/setting">Settings</a>
                    <a href="<?php echo URLROOT; ?>/publisher/logout">Logout</a>
                    </div>
                   </div>
               
            <?php  else : ?>
                <a href="<?php echo URLROOT; ?>/landing/login">Login</a>
            <?php endif; ?>

            <!-- echo "<h1>Welcome, $publisherName!</h1>"; -->
        </div>
    </div>
</nav>
</body>