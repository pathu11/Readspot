<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/nav.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/event.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/publisher/print.css" media="print"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<style>
   
    @media print {
    body {
        display: block !important;
        margin:40px;
    }
    h1{
        text-align:center;
    }
    table {
        width: 100%;
       
        border-collapse: collapse; /* Collapse the table borders */
    }
    table, tbody, tr {
        align-items:center;
        
        display: table-row !important;
    }
}

</style>
    <title>Payments</title>
</head>
<body>
    <?php require APPROOT . '/views/publisher/sidebar.php';?>
    <div class="all">
        <div class="container">
            <h2>EVENTS INFO ></h2>
            <table id="eventTable">
                <input type="text" id="searchInput" placeholder="Search" oninput="searchEvents()">
                <thead>
                    <tr>
                        <th>Payment Id</th>
                        <th>Order Id</th>
                        <th>Book Id</th>
                        <th>Book Quantity</th>
                        <th>Received Amount</th>
                        <th>Received Date</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['paymentDetails'] as $paymentDetails): ?>
                    <tr>
                        <td><?php echo $paymentDetails->payment_id; ?></td>
                        <td><?php echo $paymentDetails->order_id; ?></td>
                        <td><?php echo $paymentDetails->book_id; ?></td>
                        <td><?php echo $paymentDetails->quantity; ?></td>
                        <td><?php echo $paymentDetails->payment; ?></td>
                        <td><?php echo $paymentDetails->paid_date; ?></td>
                        <td><i class="fas fa-print" onclick="printInvoice('<?php echo $paymentDetails->payment_id; ?>')"></i></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Modal for invoice details -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Invoice Details</h2>
                    <div id="invoiceDetails" class="print-only">
                        <!-- Invoice details will go here -->
                    </div>
                    <button onclick="printInvoicePopup()">Print</button>
                </div>
            </div>
            <ul class="pagination" id="pagination">
                <li id="prevButton">«</li>
                <li class="current">1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
                <li>5</li>
                <li>6</li>
                <li>7</li>
                <li>8</li>
                <li>9</li>
                <li>10</li>
                <li id="nextButton">»</li>
            </ul>
        </div>
        <?php
            require APPROOT . '/views/publisher/footer.php'; //path changed
        ?> 
    </div>
        

    <script src="<?php echo URLROOT;?>/assets/js/publisher/table.js"></script>
    <script>
        function printInvoice(paymentId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var paymentDetails = JSON.parse(xhr.responseText);
                    if (paymentDetails) {
                        displayInvoiceDetails(paymentDetails);
                    } else {
                        console.error("Failed to fetch payment details.");
                    }
                }
            };
            xhr.open("GET", "<?php echo URLROOT; ?>/publisher/PaymentDetails?paymentId=" + paymentId, true);
            xhr.send();
        }

        function displayInvoiceDetails(paymentDetails) {
            var invoiceDetailsDiv = document.getElementById('invoiceDetails');
            invoiceDetailsDiv.innerHTML = ""; // Clear previous content

            var html = "<h1>Payment Invoice</h1>";
            html+="<p>Seller Name :"+paymentDetails.name +"</p>";
            html+="<p>Seller Email :"+paymentDetails.email +"</p>";
            html += "<table>";
            html += "<tr><td>Payment Id</td><td>" + paymentDetails.payment_id + "</td></tr>";
            html += "<tr><td>Order Id</td><td>" + paymentDetails.order_id + "</td></tr>";
            html += "<tr><td>Book Name</td><td>" + paymentDetails.book_name + "</td></tr>";
            html += "<tr><td>Book Quantity</td><td>" + paymentDetails.quantity + "</td></tr>";
            html += "<tr><td>Book Price per</td><td>" + paymentDetails.price + "</td></tr>";
            html += "<tr><td>Received Amount</td><td>" + paymentDetails.payment + "</td></tr>";
            html += "<tr><td>Received Date</td><td>" + paymentDetails.paid_date + "</td></tr>";
            html += "</table>";

            invoiceDetailsDiv.innerHTML = html;

            document.getElementById('myModal').style.display = "block";
}


function printInvoicePopup() {
            var element = document.getElementById('invoiceDetails');
            html2pdf().from(element).save();
        }


    </script>
</body>
</html>
