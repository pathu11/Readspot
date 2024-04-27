<?php
    $title = "My Favorite";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-favorite">
            <div class="favorite-topic">
                <h2>My Favorite</h2>
            </div>
            <?php if(empty($data['favoriteDetails'])): ?>
                <?php echo '
                    <br><br><h3 style="text-align:center;">No Favorite Books or Contents.</h3>'; ?>
            <?php else : ?>
            <div class="myfavorite">
                <div class="favorite-search" id="searchForm" onsubmit="handleSearch()">
                    <input type="text" placeholder="Search.." name="search" id="searchInput">
                </div>
                <br>
                <br>
                <table border="1" id="eventTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Book Name</th>
                            <th onclick="sortTable(1)">Type</th>
                            <th>VIew/Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['favoriteDetails'] as $favorite): ?>
                        <tr>
                            <td><?php echo $favorite->topic; ?></td>
                            <td><?php echo $favorite->category; ?></td>
                            <td class="action-buttons">
                                <a href="<?php echo URLROOT; ?>/customer/ViewFavorite/<?php echo $favorite->fav_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="#" style="text-decoration: none;">
                                    <button class="delete-button" onclick="showModal()">
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
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- <span class="close" onclick="closeModal()">&times;</span> -->
                <!-- <h2>Record Added!</h2> -->
                <p>Are you sure?</p>
                <button onclick="yesModal()">Yes</button>
                <button onclick="noModal()" style="background-color:red">No</button>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

    <script>
        function showModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        function yesModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            window.location.href = "<?php echo URLROOT; ?>/customer/deleteFavorite/<?php echo $favorite->fav_id; ?>"; // Redirect to the event page
        }

        function noModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
        // Submit form function
        // function submitForm() {
        //     document.getElementById("eventForm").submit();
        // }
    </script>