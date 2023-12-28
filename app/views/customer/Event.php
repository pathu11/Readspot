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
            <form action="#.php" class="event-search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
            </form>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Contents</th>
                    <th>Added-Date</th>
                    <th>VIew/Delete </th>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="e-vd"><a href="#" class="e-view">View</a><a href="#" class="e-delete">Delete</a></div></td>
                </tr>
            </table>
            </div>
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
