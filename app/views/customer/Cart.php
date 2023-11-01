<?php
    $title = "My Cart";
    include_once 'header.php';
?>

    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>

        <div class="my-content">
            <div class="content-topic">
                <h2>My Cart</h2>
            </div>
            <div class="mycart">
            <form action="#.php" class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="http://localhost/Group-27/public/assets/images/customer/search.png"></button>
            </form>
            <br>
            <br>
            <table border="1">
                <tr>
                    <th>Book Name</th>
                    <th>Price per book</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Checkout/Remove</th>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
                <tr>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>rs200.00</td>
                    <td>3</td>
                    <td>rs600.00</td>
                    <td><div class="vd"><a href="#" class="view">Checkout</a><a href="#" class="delete">Remove</a></div></td>
                </tr>
            </table>
            </div>
            <!-- <div class="vw">
                <button class="vw-btn">Add a Content</button>
            </div> -->

        </div>
    </div>

<?php
    include_once 'footer.php';
?>
