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
                            <th>Book Name</th>
                            <th>Type</th>
                            <th>VIew/Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Used</td>
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Used</td>
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Used</td>
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Used</td>
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Lorem ipsum dolor sit amet1</td>
                            <td>Used</td>
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
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
