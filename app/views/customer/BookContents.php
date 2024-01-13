<?php
    $title = "Contents";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
        <div class="sub-cont-C1">
            <div class="Content-books">
                <h1>CONTENTS</h2>
            </div>
         <div class="search-bar-C">
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
            <div class="content0-C">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/cont1.jpeg" alt="Book3" class="content-img-C"> <!--path changed-->
                <h1>Explore the Stars</h1><br>
                <p>Lorem ipsum dolor sit amet consectetur, 
                    adipisicing elit. Accusantium, numquam! 
                    Voluptas voluptates quas modi debitis molestias
                    cumque voluptatum fugit laudantium voluptatibus 
                    repellat facere optio cupiditate, vel, aperiam 
                    aliquam consequatur perspiciatis iusto enim quaerat. 
                    Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                    sit ullam sint dolores iure natus commodi veniam aliquid odit.
                </p><br>
                <a href="#"><button class="vw-btn-C">View Details</button></a>
            </div>
            <div class="content0-C">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/cont2.jpeg" alt="Book3" class="content-img-C"> <!--path changed-->
                <h1>Business Law</h1><br>
                <p>Lorem ipsum dolor sit amet consectetur, 
                    adipisicing elit. Accusantium, numquam! 
                    Voluptas voluptates quas modi debitis molestias
                    cumque voluptatum fugit laudantium voluptatibus 
                    repellat facere optio cupiditate, vel, aperiam 
                    aliquam consequatur perspiciatis iusto enim quaerat. 
                    Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                    sit ullam sint dolores iure natus commodi veniam aliquid odit.
                </p><br>
                <a href="#"><button class="vw-btn-C">View Details</button></a>
            </div>
            <div class="content0-C">
                <img src="<?php echo URLROOT; ?>/assets/images/customer/cont3.jpg" alt="Book3" class="content-img-C"> <!--path changed-->
                <h1>New Educators</h1><br>
                <p>Lorem ipsum dolor sit amet consectetur, 
                    adipisicing elit. Accusantium, numquam! 
                    Voluptas voluptates quas modi debitis molestias
                    cumque voluptatum fugit laudantium voluptatibus 
                    repellat facere optio cupiditate, vel, aperiam 
                    aliquam consequatur perspiciatis iusto enim quaerat. 
                    Laboriosam, debitis cum. Pariatur consequatur rem tenetur, 
                    sit ullam sint dolores iure natus commodi veniam aliquid odit.
                </p><br>
                <a href="#"><button class="vw-btn-C">View Content</button></a>
            </div>
        </div>
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
