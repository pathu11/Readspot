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
                                <a href="<?php echo URLROOT; ?>/customer/ViewMyEvent/<?php echo $favorite->fav_id; ?>" style="text-decoration: none;">
                                    <button class="view-button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="<?php echo URLROOT; ?>/customer/deleteEvent/<?php echo $favorite->fav_id; ?>" style="text-decoration: none;">
                                    <button class="delete-button">
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
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
