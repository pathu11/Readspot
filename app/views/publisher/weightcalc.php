<?php

    $title = "weight calculator";


?>

<!DOCTYPE html>
<html lang="en">

<head>


    <title>Approximate weight calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/addbooks.css" />

</head>
    <body>
    <?php   require APPROOT . '/views/publisher/sidebar.php';?>
        <div class="form-container">
            
            <div class="form1">
                <h2>Approximate  book weight calculator</h2>
                <form id="bookWeightCalculator">
               
                <input type="number" id="width" name="width" placeholder="Page Width (cm):"required><br>

               
                <input type="number" id="height" name="height" placeholder="Page Height (cm):"required><br>

               
                <input type="number" id="pages" name="pages" placeholder="Number of Pages:"required><br>

                
                <input type="number" id="paperWeight" name="paperWeight" placeholder="Paper Weight (GSM): " required><br>

               
                <input type="number" id="coverWeight" name="coverWeight" placeholder="Cover Weight (GSM, if applicable):" ><br>
                <button class="submit" type="button" onclick="goBack()">Back</button>
                <button class="submit" type="button" onclick="calculateWeight()">Calculate Weight</button>
            </form>
            <div id="result"></div>
</div>
</div>

   

</body>
<script>
    function calculateWeight() {
    // Get values from the form
    var width = parseFloat(document.getElementById("width").value);
    var height = parseFloat(document.getElementById("height").value);
    var pages = parseInt(document.getElementById("pages").value);
    var paperWeight = parseFloat(document.getElementById("paperWeight").value);
    var coverWeight = parseFloat(document.getElementById("coverWeight").value) || 0;

    // Calculate area of one page
    var areaPerPage = width * height;

    // Calculate total weight
    var totalWeight = areaPerPage * pages * paperWeight / 10000 + coverWeight;

    // Display the result
    document.getElementById("result").innerHTML = "Estimated Weight: " +"<br>"+ totalWeight.toFixed(2) + " grams";
}

</script>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</Html>


