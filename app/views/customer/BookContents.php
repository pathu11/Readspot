<?php
    $title = "Contents";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="back-btn-div01">
            <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
        </div>
        <div class="sub-cont-C1">
            <div class="Content-books">
                <h1>CONTENTS</h2>
            </div>
         <div class="search-bar-C">
                <button type="submit" class="filter-btn-C" onclick="toggleDropdownfilter('filter-dropdown')">Filter</button>
                <form action="#.php" class="searching-C">
                    <select id="searchBy"  name="category">
                        <option value="technology">Title</option>
                        <option value="travel">Author</option>
                        <option value="food">ISBN</option>
                        <option value="lifestyle">Publisher</option>
                    </select>
                    <input type="text" placeholder="Search.." name="search-C">
                    <button type="submit"><img src="<?php echo URLROOT; ?>/assets/images/customer/search.png"></button> <!--path changed-->
                </form>
            </div>
        </div>
        <div class="sub-cont-C2">
         
        <?php foreach($data['contentDetails'] as $content): ?>
            <div class="content0-C">
                
                <div class="content1-C">
                    <img src="<?php echo URLROOT; ?>/assets/images/landing/addcontents/<?php echo $content->img; ?>"  alt="Book3" class="content-img-C"> <!--path changed-->
                    <div class="content2-C">
                        <h1><?php echo $content->topic; ?></h1><br>
                        <p>
                            <?php 
                                // Limit the text to 150 characters
                                $limitedText = substr($content->text, 0, 400);
                                echo $limitedText;
                            ?>
                            <?php if(strlen($content->text) > 150): ?>
                                <span id="dots">...</span>
                                <span id="more" style="display: none;">
                                    <?php echo substr($content->text, 150); ?>
                                </span>
                                <a style="text-decoration:none;" href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?> ">Read more</a>

                            <?php endif; ?>
            </p>
                    </div>
                </div>
                <div class="view-fav">
                    <img src="<?php echo URLROOT; ?>/assets/images/customer/favorit.png" alt="Favorit">
                    <a href="<?php echo URLROOT; ?>/customer/viewcontent/<?php echo $content->content_id; ?>"><button class="vw-btn-C">View Details</button></a>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
        <?php
            require APPROOT . '/views/customer/filterbook.php'; //path changed
        ?>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>


