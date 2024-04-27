<?php
    $title = "Add Content";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <head>
        
    </head>
    <div class="container">
        <div class="add-content">
            <div class="back-btn-div">
                <button class="back-btn" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
            </div>
            <form action="<?php echo  URLROOT; ?>/customer/AddCont"  method="POST" enctype="multipart/form-data" class="cont-add">
                <h1>Add a Content</h1>
                <div class="topic-cont">
                    <label class="label-topic">Topic</label><br>
                    <input type="text" name="topic" class="form-topic" required>
                    
                </div>
                <div class="disc-cont">
                    <label class="label-topic">Summary about your content</label><br>
                    <textarea id="description" name="description" rows="12" class="form-topic" required></textarea>
                </div>
                <div class="upload-doc">
                    <div class="img-cont">
                        <label class="label-topic">Upload an relevent Image</label><br>
                        <input type="file" id="picture" name="picture" accept="image/*" required>
                    </div>
                    <div class="pdf-cont">
                        <label class="label-topic">Upload Your content Document</label><br>
                        <input type="file" id="pdf" name="pdf" accept=".pdf" required>
                    </div>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>
