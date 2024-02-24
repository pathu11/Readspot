<?php
    $title = "Add Content";
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
            <form action="<?php echo  URLROOT; ?>/customer/AddCont"  method="POST" enctype="multipart/form-data" class="cont-add">
                <h1>Add a Content</h1>
                <div class="topic-cont">
                    <label class="label-topic" required>Topic</label><br>
                    <input type="text" name="topic" class="form-topic">
                    
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Description</label><br>
                    <textarea id="description" name="description" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-doc">
                    <div class="img-cont">
                        <label class="label-topic">Upload Image</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="pdf-cont">
                        <label class="label-topic">Upload Document</label><br>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" >
                    </div>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
