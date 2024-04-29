<?php
    $title = "Events"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />
    <title>Events</title>
</head>

<body>
    <?php require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="all">
        <div class="container">
            <h2>EVENTS INFO ></h2>
            <table id="eventTable">
                <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
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
                <tbody>
                    <?php foreach($data['eventDetails'] as $event): ?>
                    <tr>
                        <td><?php echo $event->id; ?></td>
                        <td><img src="<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $event->poster; ?>" onclick="viewEvent(this.src)" width="30%" /></td>
                        <td><?php echo $event->title; ?></td>
                        <td><?php echo $event->description; ?></td>
                        <td><?php echo $event->location; ?></td>
                        <td><?php echo $event->start_date; ?></td>
                        <td><?php echo $event->end_date; ?></td>
                        <td><?php echo $event->category_name; ?></td>
                        <td><?php echo $event->status; ?></td>
                        <td class="action-buttons">
                            <button class="view-button" onclick="viewEvent('<?php echo URLROOT; ?>/assets/images/landing/addevents/<?php echo $event->poster; ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                        

                            <button class="update-button" >
                                <a  style="color:white;" href="<?php echo URLROOT; ?>/publisher/updateEvent/<?php echo $event->id; ?>" ><i class="fas fa-edit"></i></a>
                            </button>
                            <button class="delete-button" onclick="deleteEvent('<?php echo $event->id; ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <input type="hidden" id="event_id">
                    <h2 style="color:black;">Do you want to delete this event details?</h2><br>
                    <button type="submit" onclick="verifyDelete()">Delete</button>
                    <button type="submit" onclick="closeDeleteModal()">Cancel</button>
                </div>
            </div>
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
        <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?> 
        </div>
    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
    <script>
        function deleteEvent(eventId){
            document.getElementById("event_id").value = eventId;
            var deleteModal = document.getElementById("deleteModal");
            deleteModal.style.display = "block";
        }

        function closeDeleteModal(){
            var deleteModal = document.getElementById("deleteModal");
            deleteModal.style.display = "none";
        }

        function verifyDelete() {
            var event_id = document.getElementById("event_id").value; // Correctly get the value
            fetch("<?php echo URLROOT; ?>/publisher/deleteEvent/" + event_id, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log("Event deleted successfully");
                    window.location.reload(); // Optionally reload the page after successful deletion
                } else {
                    console.error("Failed to delete event");
                }
                closeDeleteModal();
            })
            .catch(error => {
                console.error("Error:", error);
                closeDeleteModal();
            });
        }
</script>

</body>
</html>
