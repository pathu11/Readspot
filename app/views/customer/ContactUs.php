<?php
    $title = "Contact Us";
    require APPROOT . '/views/customer/header.php'; //path changed
?>

    <div class="main-cont">
    <div class="add-content">
            <form action="#" class="book-add">

                <h1>SEND A MESSAGE</h1>
                
                <div class="topic-book">
                    <label class="label-topic" required>Name</label><br>
                    <input type="text" class="form-topic">
                </div>
                
                <div class="topic-book author">
                    <label class="label-topic" required>Email</label><br>
                    <input type="email" class="form-topic">
                </div>
        
                <div class="topic-book author">
                    <label class="label-topic" for="input3" required>Subject</label><br>
                    <input type="text" class="form-topic" id="input3">
                </div>
        
                <div class="disc-book">
                    <label class="label-topic">Message</label><br>
                    <textarea id="description" name="description" rows="20" class="form-topic" required></textarea>
                </div>

                <input type="submit" value="Send">
            </form>
        </div>
        
    </div>

<?php
    require APPROOT . '/views/customer/footer.php'; //path changed
?>
