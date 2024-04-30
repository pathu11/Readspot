<?php
$title = "Donate Books";
require APPROOT . '/views/customer/header.php'; //path changed
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Poster Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150vh;
            background-color: #f0f0f0;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }

        .cd-poster-container {
            position: relative;
            width: 70%;
            max-width: 100%;
            margin-top: 80px;
            height: 400px;
            margin-bottom: 5px;
            border: 2px solid #ffffff;
            overflow: hidden;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .cd-poster {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cd-poster-container:hover {
            transform: scale(1.05);
        }

        .cd-info-container {
            display: flex;
            justify-content: space-between;
            width: 71%;
            height: 17%;
            margin-top: 20px;
        }

        .cd-book-categories-container,
        .cd-event-description-container {
            width: calc(50% - 10px);
            height: 90%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #70bfba;
            margin: 0 10px;
        }

        .cd-book-categories-container {
            margin-right: 10px;
        }

        .cd-book-categories {
            font-size: 14px;
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        .cd-book-categories li {
            margin-bottom: 5px;
        }

        .cd-event-description {
            font-size: 14px;
            width: 100%;
            height: 90px;
        }

        .cd-event-description textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            resize: none;
        }

        .cd-event-description-container p {
            font-size: 14px;
        }

        .cd-donate-button {
            margin-top: 10px;
            background-color: #009d94;
            width: 50%;
            margin-bottom: 20px;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .cd-donate-button:hover {
            background-color: #007d75;
        }

        .cd-info-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 71%;
            margin-top: 20px;
        }

        .cd-deadline {
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            border: 3px solid rgb(255, 255, 255);
            background-color: rgb(172, 98, 98);
            color: white;
            width: 20%;
            height: 35px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cd-deadline input[type="text"] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            border: none;
            background-color: transparent;
            outline: none;
            font-size: 14px;
            color: #ffffff;
            margin-top: -2px;
            text-align: center;
        }

        .cd-view-icon {
            position: absolute;
            top: 15px;
            color: white;
            right: 15px;
            font-size: 14px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .cd-view-icon .fa {
            color: #ffffff;
        }

        .cd-view-icon:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        footer {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="back-btn-div01">
        <button class="back-btn01" onclick="history.back()"><i class="fa fa-angle-double-left"></i> Go Back</button>
    </div>

    <?php foreach($data['charityEvent'] as $donate): ?>
        <div class="cd-poster-container">
            <img src="<?php echo URLROOT; ?>/assets/images/charity/<?php echo $donate->poster; ?>" alt="Poster Image" class="cd-poster">
            <div class="cd-view-icon" onclick="toggleFullscreen('<?php echo URLROOT; ?>/assets/images/charity/<?php echo $donate->poster; ?>')">
                <i class="fas fa-eye"></i>
            </div>
        </div>
        <div class="cd-deadline">
            <strong>Deadline:</strong> <input type="text" value="<?php echo $donate->Deadline_date; ?>" style="font-weight: bold;" readonly>
        </div>
        <div class="cd-info-container">
            <div class="cd-book-categories-container">
                <?php
                    // Split the booksIWant string by commas
                    $booksIWantList = explode(',', $data['booksIWant']);

                    // Output each book in the list as a list item
                    echo '<div class="cd-book-categories">';
                    echo '<h3 style="font-size: 15px;">Book Categories :</h3>';
                    echo '<ul>'; // Start unordered list
                    foreach ($booksIWantList as $book) {
                        echo '<li>' . trim($book) . '</li>'; // Trim whitespace and display each book
                    }
                    echo '</ul>'; // End unordered list
                    echo '</div>';
                ?>
            </div>
            <div class="cd-event-description-container">
                <h3 style="font-size: 15px;">About Event:</h3>
                <p style="font-size: 14px;"><?php echo $donate->description; ?></p>
            </div>
        </div>
        <a href="<?php echo URLROOT; ?>/customer/Donateform/<?php echo $donate->charity_event_id; ?>" style="text-decoration: none; color: inherit;" class="cd-donate-button">Donate</a>
    <?php endforeach; ?>
</body>
<script>
    function toggleFullscreen(imageSrc) {
        const posterContainer = document.querySelector('.cd-poster-container');
        const fullscreenImage = document.createElement('img');
        fullscreenImage.src = imageSrc;
        fullscreenImage.style.position = "fixed";
        fullscreenImage.style.top = "0";
        fullscreenImage.style.left = "0";
        fullscreenImage.style.width = "100%";
        fullscreenImage.style.height = "100%";
        fullscreenImage.style.objectFit = "contain";
        fullscreenImage.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
        fullscreenImage.style.zIndex = "9999";
        fullscreenImage.style.cursor = "zoom-out";

        fullscreenImage.onclick = function() {
            fullscreenImage.remove();
        };

        document.body.appendChild(fullscreenImage);
    }
</script>

</html>

<?php
require APPROOT . '/views/customer/footer.php'; //path changed
?>