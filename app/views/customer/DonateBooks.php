<?php
    $title = "Donate Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-D1">
            <!-- <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">Categories</button>
                <div id="myDropdown" class="dropdown-content">
                    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                    <a href="#about">About</a>
                    <a href="#base">Base</a>
                    <a href="#blog">Blog</a>
                    <a href="#contact">Contact</a>
                    <a href="#custom">Custom</a>
                    <a href="#support">Support</a>
                    <a href="#tools">Tools</a>
                    <a href="#contact">Contact</a>
                    <a href="#custom">Custom</a>
                    <a href="#support">Support</a>
                    <a href="#tools">Tools</a>
                </div>
            </div> -->
            <div class="Donate-books">
                <h1>BOOK DONATION EVENTS</h2>
            </div>
            <!-- <div class="search-bar">
                <form action="#.php" class="searching">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><img src="./assets/img/search.png"></button>
                </form>
            </div> -->
        </div>
        <div class="sub-cont-D2">
            <div class="B0-D">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/donate1.jpg" alt="Book1" class="event-D"> <!--path changed-->
                <table border="1" class="tb1">
                    <tr>
                        <th>Required</th>
                        <th>Get</th>
                        <th>Pending</th>
                        <th>More</th>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td>25</td>
                        <td>10</td>
                        <td>15</td>
                    </tr>
                </table>
                <table border="1" class="tb2">
                    <tr>
                        <th>Required</th>
                        <th>50</th>
                    </tr>
                    <tr>
                        <td>Get</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Pending</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>More</td>
                        <td>15</td>
                    </tr>
                </table>
                <a href="<?php echo URLROOT; ?>/customer/Donatedetails"><button class="dts-btn-D">Donate</button></a> <!--path changed-->
            </div>
            <div class="B0-D">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/donate2.jpg" alt="Book2" class="event-D"> <!--path changed-->
                <table border="1" class="tb1">
                    <tr>
                        <th>Required</th>
                        <th>Get</th>
                        <th>Pending</th>
                        <th>More</th>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td>25</td>
                        <td>10</td>
                        <td>15</td>
                    </tr>
                </table>
                <table border="1" class="tb2">
                    <tr>
                        <th>Required</th>
                        <th>50</th>
                    </tr>
                    <tr>
                        <td>Get</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Pending</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>More</td>
                        <td>15</td>
                    </tr>
                </table>
                <a href="<?php echo URLROOT; ?>/customer/Donatedetails"><button class="dts-btn-D">Donate</button></a> <!--path changed-->
            </div>
        </div>
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
