<?php
    $title = "My Events";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-event">
            <div class="event-topic">
                <h2>My Events</h2>
            </div>
            <?php if(empty($data['eventDetails'])): ?>
                <?php echo '
                    <br><br><h3 style="text-align:center;">No events added yet.</h3>'; ?>
            <?php else : ?>
            <div class="myevent">
                <div class="event-search" id="searchForm" onsubmit="handleSearch()">
                    <input type="text" placeholder="Search.." name="search" id="searchInput">
                </div>
                <br>
                <br>
                <table border="1" id="eventTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Contents</th>
                            <th onclick="sortTable(1)">Category</th>
                            <th>VIew/Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['eventDetails'] as $event): ?>
                        <tr>
                            <td><?php echo $event->title; ?></td>
                            <td><?php echo $event->category_name; ?></td>
                            <td class="action-buttons">
                                <a href="<?php echo URLROOT; ?>/customer/UpdateEvent/<?php echo $event->id; ?>" style="text-decoration: none;">
                                    <button class="update-button">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <a href="<?php echo URLROOT; ?>/customer/ViewMyEvent/<?php echo $event->id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="#">
                                    <button class="delete-button" onclick="showModal(<?php echo $event->id; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
            <?php endif; ?>
            <div class="e-vw">
                <a href="<?php echo URLROOT; ?>/customer/Addevnt"><button class="e-vw-btn">Add a Event</button></a> <!--path changed-->
            </div>
            <br>
            <br>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <p>Are you sure?</p>
                <button onclick="yesModal()">Yes</button>
                <button onclick="noModal()" style="background-color:red">No</button>
                <!-- Hidden input field to store the content_id -->
                <input type="hidden" id="contentId">
            </div>
        </div>

        <script>
            function showModal(contentId) {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";

                // Store the content_id in a hidden input field inside the modal
                var contentIdInput = document.getElementById("contentId");
                contentIdInput.value = contentId;
            }

            function yesModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";

                // Retrieve the content_id from the hidden input field
                var contentIdInput = document.getElementById("contentId");
                var contentId = contentIdInput.value;

                // Redirect to the deleteContent endpoint with the content_id
                window.location.href = "<?php echo URLROOT; ?>/customer/deleteEvent/" + contentId; // Redirect to the event page
            }

            function noModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
            }
        </script>

        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

    