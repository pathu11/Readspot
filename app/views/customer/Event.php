<?php
    $title = "Content";
    include_once 'header.php';
?>

    <div class="container">
        <?php
            include_once 'sidebar.php';
        ?>

        <div class="my-content">
            <div class="content-topic">
                <h2>My Events</h2>
            </div>
            <div class="mycontent">
            <form action="#.php" class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="./assets/img/search.png"></button>
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
                <a href="./Addevnt.php"><button class="vw-btn">Add a Event</button></a>
            </div>

        </div>
    </div>

<?php
    include_once 'footer.php';
?>
