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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .half-container {
            width: 48%;
            float: left;
            margin-right: 16px;
            margin-left: 10px;
        }

        .query-container {
            display: flex;
            flex-direction: column;
            min-height: 40px;
            border-radius: 8px;
            margin-bottom: 5px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .query-text {
            font-size: 13px;
            margin-bottom: 5px;
        }

        .query-actions {
            display: flex;
            justify-content: flex-end;
        }

        button {
            padding: 5px 10px;
            margin-left: 5px;
            cursor: pointer;
            background-color: #009d94;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }

        button:hover {
            background-color: #00756f;
        }

        .icon {
            margin-right: 5px;
            font-size: 13px;
        }

        .chart-container {
            max-width: 100%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }


        #queries-container::after {
            content: "";
            display: table;
            clear: both;
        }

        #deleteAllButton {
            float: right;
            margin-bottom: 20px;
            margin-right: 20px;
            margin-top: 20px;
            height: 30px;
            width: 150px;
            background-color: #404040;
            justify-content: center;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>
    
<body>
    <header>
        <div>
            <img id="logo" src=<?php echo URLROOT . "/assets/images/charity/ReadSpot.png" ?> alt="Logo">
        </div>
        <nav>
            <a href="./">Home</a>
            <a href="event" >Event Management</a>
            <a href="customerSupport" class="active" id="donorRequestLink">Customer Support</a>
            <a href="aboutUs">About Us</a>
        </nav>

    </header>
    <div class="chart-container">
        <canvas id="roundedChart"></canvas>
    </div>


    <!-- Bookshop Q&A Container -->
    <div id="queries-container">
        <div class="half-container" id="left-queries">
            <!-- Left side queries will be dynamically added here -->
        </div>
        <div class="half-container" id="right-queries">
            <!-- Right side queries will be dynamically added here -->
        </div>
    </div>

    <button id="deleteAllButton">Delete All Queries</button>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bookshop Q&A Script
        function addQuery(query, side) {
            var queriesContainer = document.getElementById(side === 'left' ? 'left-queries' : 'right-queries');

            var queryContainer = document.createElement('div');
            queryContainer.className = 'query-container';

            var queryText = document.createElement('div');
            queryText.className = 'query-text';
            queryText.textContent = query;

            var queryActions = document.createElement('div');
            queryActions.className = 'query-actions';

            var commentButton = createButton('Comment');
            var deleteButton = createButton('Delete');

            queryActions.appendChild(commentButton);
            queryActions.appendChild(deleteButton);

            queryContainer.appendChild(queryText);
            queryContainer.appendChild(queryActions);
            queriesContainer.appendChild(queryContainer);
        }


        function createButton(icon) {
            var button = document.createElement('button');
            button.innerHTML = '<span class="icon">' + icon + '</span>';
            button.addEventListener('click', function () {
                alert(icon + ' clicked!');
            });
            return button;
        }

        // Example queries
        addQuery('How can I donate books to your organization?', 'left');
        addQuery('Are there specific types of books you accept or need most?', 'right');
        addQuery('Can I donate books that are not in English?', 'left');
        addQuery('Can I mail books to your charity, and if so, what is the address?', 'right');
        addQuery('Do I need to schedule an appointment to drop off book donations?', 'left');
        addQuery('What is the step-by-step process for donating books to your organization?', 'right');
        addQuery('Can I pre-order upcoming releases?', 'left');
        addQuery('Tell me about your charity initiatives.', 'right');

        // 3D Effect Doughnut Chart Script
        var ctx = document.getElementById('roundedChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Fantasy', 'Mystery', 'Romance', 'Science Fiction', 'Thriller'],
                datasets: [{
                    label: 'Sales Last Month',
                    data: [120, 90, 150, 80, 110],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.9)',     // Thicker and more vibrant pink
                        'rgba(54, 162, 235, 0.9)',    // Thicker and more vibrant blue
                        'rgba(255, 206, 86, 0.9)',    // Thicker and more vibrant yellow
                        'rgba(75, 192, 192, 0.9)',    // Thicker and more vibrant teal
                        'rgba(153, 102, 255, 0.9)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Sales Last Month by Category'
                    }
                },
                elements: {
                    arc: {
                        borderWidth: 1,
                        borderColor: '#fff',
                        hoverBorderWidth: 3
                    }
                }
            },
        });

        // Existing script...

        // Delete All Queries Event Listener
        document.getElementById('deleteAllButton').addEventListener('click', function () {
            // Clear all queries from both containers
            document.getElementById('left-queries').innerHTML = '';
            document.getElementById('right-queries').innerHTML = '';
        });

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
