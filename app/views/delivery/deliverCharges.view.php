<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/Group-27/public/assets/css/delivery/deliveryCharge.css">
    <title>Product Gallery</title>
    
</head>

<body>
    <?php include 'nav.view.php'; ?>

    <div class="container">
        <div class="div_table" style="width: 90%">
            <table>
                <tr>
                    <th style="width: 35%">Weight(kg)</th>
                    <th style="width: 45%">Price per unit(Rs)</th>
                    <th style="width: 20%">Edit</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>350</th>
                    <th><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></th>
                </tr>
                <tr>
                    <th>Additional per kilo</th>
                    <th>80</th>
                    <th><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="#"><i class="fa fa-edit" style="color:black;"></i></a></td>
                </tr>
            </table>
            <button class="custom-button"><i class="fa fa-plus"></i> </button>
        </div>
        
    </div>

    <?php include 'footer.view.php'; ?>
</body>

</html>
