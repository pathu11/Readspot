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
            <form action="#.php" class="content-search">
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
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>03/09/2023</td>
                    <td><div class="c-vd"><a href="#" class="c-view">View</a><a href="#" class="c-delete">Delete</a></div></td>
                </tr>
            </table>
            </div>
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


