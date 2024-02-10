<?php
    $title = "My Events";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-event">
            <div class="event-topic">
                <h2>My Events</h2>
            </div>
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
                        <th onclick="sortTable(1)">Added-Date</th>
                        <th>VIew/Delete </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ALorem ipsum dolor sit amet</td>
                        <td>01/09/2023</td>
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
                        <td>BLorem ipsum dolor sit amet</td>
                        <td>02/09/2023</td>
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
                        <td>ALorem ipsum dolor sit amet</td>
                        <td>03/09/2023</td>
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
                        <td>CLorem ipsum dolor sit amet</td>
                        <td>03/10/2023</td>
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
                        <td>BLorem ipsum dolor sit amet</td>
                        <td>03/09/2024</td>
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
                        <td>BLorem ipsum dolor sit amet</td>
                        <td>02/09/2023</td>
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
                        <td>ALorem ipsum dolor sit amet</td>
                        <td>03/10/2021</td>
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
            <div class="e-vw">
                <a href="<?php echo URLROOT; ?>/customer/Addevnt"><button class="e-vw-btn">Add a Event</button></a> <!--path changed-->
            </div>
            <br>
            <br>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
