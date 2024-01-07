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
            <form action="#.php" class="favorite-search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
            </form>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Book Name</th>
                    <th>Type</th>
                    <th>VIew/Remove</th>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Used</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Used</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>New</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Exchange</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Exchange</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Used</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Exchange</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>Used</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>New</td>
                    <td><div class="f-vd"><a href="#" class="f-view">View</a><a href="#" class="f-delete">Remove</a></div></td>
                </tr>
            </table>
            </div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
