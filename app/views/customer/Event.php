<?php
    $title = "My Events";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="container">
        <?php
            require APPROOT . '/views/customer/sidebar.php'; //path changed
        ?>

        <div class="my-content">
            <div class="content-topic">
                <h2>My Events</h2>
            </div>
            <div class="mycontent">
            <form action="#.php" class="search">
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
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>R03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="vd"><a href="#" class="view">View</a><a href="#" class="delete">Delete</a></div></td>
                </tr>
            </table>
            </div>
            <div class="vw">
                <a href="<?php echo URLROOT; ?>/customer/Addevnt"><button class="vw-btn">Add a Event</button></a> <!--path changed-->
            </div>

        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
