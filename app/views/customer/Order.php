<?php
    $title = "My Orders";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-orders">
            <div class="order-topic">
                <h2>My Orders</h2>
            </div>
            <div class="myorder">
                <div class="order-search" id="searchForm" onsubmit="handleSearch()">
                    <input type="text" placeholder="Search.." name="search" id="searchInput">
                </div>
                <?php
                    require APPROOT . '/views/customer/oderdetails.php';
                ?>
                <br>
                <br>
                <table border="1" id="eventTable">
                    <thead>
                        <tr>
                            <th>Reference No.</th>
                            <th >Delivery Status</th>
                            <th>VIew Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['orderDetails'] as $orders): ?>
                        <tr>
                            <td><?php echo $orders->tracking_no; ?></td>
                            <td><?php echo $orders->status; ?></td>
                            <!-- <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button> -->
                            <td class="action-buttons">
                                <button class="view-button" onclick="viewEvent(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="delete-button" onclick="deleteEvent(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <!-- <br>
            <br> -->
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


