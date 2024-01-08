<?php
    $title = "Add Event";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="add-content">
            <form action="#" class="cont-add">
                <h1>Add a Event</h1>
                <div class="topic-cont">
                    <label class="label-topic" required>Topic</label><br>
                    <input type="text" class="form-topic">
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="description" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-doc-content">
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Main Image</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Image-1</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Image-2</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Image-3</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Image-4</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="img-cont-content">
                        <label class="label-topic">Upload Image-5</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
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
