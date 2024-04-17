<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />

  <title>Payments</title>
</head>

<body>
<?php require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="container">
        <h2>EVENTS INFO ></h2>

        <table id="eventTable">
            <input  type="text" id="searchInput" placeholder="Search by ID or Name" oninput="searchEvents()">
            <thead>
                <tr>
                   <th>Event ID</th>
                    <th>Event Poster</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Event Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
           
               
                
               
                
        </table>

  
        <!-- Modal for event details -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Poster Details</h2>
                <table id="eventDetailsTable">
                    <!-- Event details will go here -->
                </table>
            </div>
        </div>
        <ul class="pagination" id="pagination">
            <li id="prevButton">«</li>
            <li class="current">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>6</li>
            <li>7</li>
            <li>8</li>
            <li>9</li>
            <li>10</li>
            <li id="nextButton">»</li>
        </ul>
        <div class="button-container">
             <a href="<?php echo URLROOT;?>/publisher/addEvent"><button>Add an event</button></a>
        </div>
    </div>
    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>

</body>