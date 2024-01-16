<?php
    $title = "Content";
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
            <form action="#.php" class="order-search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
            </form>
            <?php
                require APPROOT . '/views/customer/oderdetails.php';
            ?>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Reference No.</th>
                    <th >Delivery Status</th>
                    <th>VIew Details</th>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Pending</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Picked up</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Picked up</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Delivered</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Picked up</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Picked up</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Delivered</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Pending</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
                <tr>
                    <td>123456789</td>
                    <td>Delivered</td>
                    <td><div class="o-vd"><button type="submit" class="o-view" onclick="toggleOrder('order-details')">View</button>
                </tr>
            </table>
            <!-- <br>
            <br> -->
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>


