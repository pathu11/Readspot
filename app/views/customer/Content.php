<?php
    $title = "Content";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-content">
            <div class="content-topic">
                <h2>My Contents</h2>
            </div>
            <div class="mycontent">
            <div class="content-search" id="searchForm" onsubmit="handleSearch()">
                <input type="text" placeholder="Search.." name="search" id="searchInput">
            </div>
            <br>
            <br>
            <table border="1" id="eventTable">
                <thead>
                    <tr>
                        <th>Content Name</th>
                        <th >Added-Date</th>
                        <th>VIew/Delete </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>01/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet2</td>
                        <td>02/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>03/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>04/09/2023</td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
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
                        <td>1Lorem ipsum dolor sit amet</td>
                        <td>05/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>06/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>07/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>08/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>09/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>10/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>11/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet1</td>
                        <td>12/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet5</td>
                        <td>13/09/2023</td>
                        <td class="action-buttons">
                        <button class="view-button" onclick="viewEvent(1)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-button" onclick="deleteEvent(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                        <!-- <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td> -->
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
            <div class="c-vw">
                <a href="<?php echo URLROOT; ?>/customer/AddCont"><button class="c-vw-btn">Add Content</button></a> <!--path changed-->
            </div>
            <br>
            <br>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>



