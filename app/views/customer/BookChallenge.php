<?php
    $title = "Buy New Books";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-BC1">
            <div class="Book-Challenge">
                <h1>BOOK CHALLENGE</h1>
            </div>
            <!-- <div class="search-bar-N">
                <button type="submit" class="filter-btn" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
                <form action="#.php" class="searching-N">
                    <select id="searchBy"  name="category">
                        <option value="technology">Title</option>
                        <option value="travel">Author</option>
                        <option value="food">ISBN</option>
                        <option value="lifestyle">Publisher</option>
                    </select>
                    <input type="text" placeholder="Search.." name="search-N">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button>
                </form>
            </div> -->
        </div>
        <?php
            // require APPROOT . '/views/customer/filterbook.php';
        ?>

        <div class="sub-cont-BC2">
            <div class="next-challenge">
                <h2>Next Challenge</h2>
                <div class="time-countdown"><br>
                    <h1>04&emsp; 11 : 53 : 46</h1>
                    <h6>&ensp;DAYS&emsp;&emsp;&emsp;&emsp;HOURS&emsp;&ensp;MINUTES&emsp;&ensp;SECONDS</h6>
                </div> 
            </div>
            <div class="new-challenge">

            </div>
        </div>

        <div class="sub-cont-BC3">
            <h1>Last Winner</h1>
            <div class="last-winner"><br>
                <div class="winner-img-name">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/book2.jpeg">
                    <h3> Ramath Perera </h3>
                </div>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda mollitia nam beatae quia eveniet iste ducimus hic libero nobis officia aliquid aliquam, culpa aut ut laboriosam id eligendi doloribus eum dicta sit quidem deleniti ad odio animi? Esse molestias et quod, aperiam nulla, voluptate quisquam error voluptas facilis nihil ea quaerat quos dolores earum iure, soluta optio deleniti officia rem! Quis neque dignissimos voluptate molestiae nesciunt placeat nihil possimus, pariatur illo id, sapiente laborum consectetur odio accusantium. Repellat, quas nisi. Laborum nobis cum dolores ex reprehenderit. Voluptatem praesentium deleniti, nulla vel magnam ad a obcaecati quaerat quasi molestiae consequuntur excepturi provident nam labore hic molestias nesciunt. Sit, odio minus vitae harum tenetur at voluptatem non ratione quo nostrum, molestiae cum quaerat doloribus sunt voluptates, inventore nemo dolores amet perferendis quibusdam! Quia saepe consectetur aliquid quibusdam corrupti, reprehenderit, omnis sed optio praesentium explicabo quas, hic totam natus eaque officia nostrum doloribus? <a href="#">Read More>></a></p>            
            </div> 
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
