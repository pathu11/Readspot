<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="homepage.css">

    <title>Publisher Home Page</title>

</head>

<body>
    <?php include 'nav.php'; ?>   
    


    <div class="content">
        <h1 class="header_1">WELCOME TO</h1><br>
        <h1 class="header_2">ReadSpot</h1>
        <span>Effortlessly sell your books, manage inventory, and connect <br>
            with readers. Sell smart, sell efficiently. Happy publishing!</span>
    </div>

    <div class="btn">
        <!-- <button class="my-button"><a href="#" target="_blank">GET STARTING FOR SELLING</a></button> -->
        <button id="btnclick" class="my-button">GET STARTING FOR SELLING</button>
    </div>
    



    <script>
        // JavaScript to handle button click
        document.getElementById('btnclick').addEventListener('click', function() {

            window.location.href = 'addbooks.php';
        });
    </script> 
    <?php include 'footer.php'; ?>   
        
</body>

</html>