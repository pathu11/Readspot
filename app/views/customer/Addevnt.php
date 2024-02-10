<?php
    $title = "Add Event";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo URLROOT; ?>/customer/Addevnt" enctype="multipart/form-data" class="cont-add" method="POST">
                <h1>Add a Event</h1>
                <div class="topic-cont">
                    <label class="label-topic">Event Name</label><br>
                    <input type="text" class="form-topic" name="eventName" required>
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="descriptions" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-pages book-cate">
                    <div class="topic-cont author">
                        <label class="label-topic">Event Location</label><br>
                        <input type="text" class="form-topic" name="location" required>
                    </div>
                    <div class="topic-book author">
                        <label class="label-topic">Event Category</label><br>
                        <select id="category"  name="category" required>
                            <option value="technology">Technology</option>
                            <option value="travel">Travel</option>
                            <option value="food">Food</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="health">Health</option>
                        </select>
                    </div>
                </div>
                <div class="upload-pages">
                    <div class="topic-cont">
                        <label class="label-topic">Start Date</label><br>
                        <input type="date" class="form-topic" name="startDate" required>
                    </div>
                    <div class="topic-cont">
                        <label class="label-topic">End Date</label><br>
                        <input type="date" class="form-topic" name="endDate" required>
                    </div>
                </div>
                
                <div class="upload-pages">
                    <div class="topic-cont">
                        <label class="label-topic">Start Time</label><br>
                        <input type="time" class="form-topic" name="startTime" required>
                    </div>
                    <div class="topic-cont">
                        <label class="label-topic">End Time</label><br>
                        <input type="time" class="form-topic" name="endTime" required>
                    </div>
                </div>

                <div class="upload-doc-content">
                    <div class="img-cont-content">
                        <label class="label-topic">Event Poster</label><br>
                        <input type="file" id="picture" name="imgMain" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image1</label><br>
                        <input type="file" id="picture" name="1stImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image2</label><br>
                        <input type="file" id="picture" name="2ndImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image3</label><br>
                        <input type="file" id="picture" name="3rdImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image4</label><br>
                        <input type="file" id="picture" name="4thImg" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Prev Event Image5</label><br>
                        <input type="file" id="picture" name="5thImg" accept="image/*" required>
                    </div>
                    <!-- <div class="pdf-cont">
                        <label class="label-topic">Upload Document</label><br>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" required>
                    </div> -->
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
