<?php
    $title = "Content";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<?php
    require APPROOT . '/views/customer/sidebar.php'; //path changed
?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<div class="container">
    <div class="my-orders">
        <div class="order-topic">
            <h2>My Orders</h2>
        </div>
        <?php if(empty($data['orderDetails'])): ?>
            <?php echo '
                <br><br><h3 style="text-align:center;">No Orders.</h3>'; ?>
        <?php else : ?>
        <div class="myorder">
            <div class="order-search" id="searchForm" onsubmit="handleSearch()">
                    <input type="text" placeholder="Search.." name="search" id="searchInput">
                </div>
            <?php require APPROOT . '/views/customer/oderdetails.php'; ?>
            <br>
            <br>
            <table border="1" id="eventTable">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Delivery Status</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['orderDetails'] as $orders): ?>
                <tr>
                    <td><?php echo $orders->tracking_no; ?></td>
                    <td><?php echo $orders->status; ?></td>
                    <td class="action-buttons">
                       
                            <button type="submit" class="view-button" onclick='viewOrders(<?php echo htmlspecialchars(json_encode($orders)); ?>)'><i class="fas fa-eye"></i></button>
                            <button type="button" class="delete-button" onclick="cancelOrder(<?php echo $orders->order_id; ?>, '<?php echo $orders->status; ?>')"> <i class="fas fa-trash"></i></button> 
                    </td> 
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
        <?php endif; ?>
        <div id="cancelOrderModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeCancelOrderModal()">&times;</span>
                <p>Are you sure you want to cancel this order?</p>
                <input type="hidden" id="order_id">
                <input type="hidden" id="order_status">
                <br><br>
                <button class="button" onclick="displayReasonsForCancellation()">Yes</button>
                <button class="button" style=" background-color:red;"onclick="closeCancelOrderModal()">No</button>
            </div>
        </div>
        <div id="verifyOrderModal" class="modal" style="display: none;">
            <div class="modal-content">
                    <span class="close" onclick="closeVerifyOrderModal()">&times;</span>
                   
                    <div class="my-rate1">
                        <input class="radio" type="radio" name="rate" id="rate-5" value="5">
                     
                       <label for="rate-5" class="fas fa-star"></label>
                        <input class="radio" type="radio" name="rate" id="rate-4" value="4">
                        <label for="rate-4" class="fas fa-star"></label>

                        <input  class="radio" type="radio" name="rate" id="rate-3" value="3">
                        <label for="rate-3" class="fas fa-star"></label>

                        <input class="radio" type="radio" name="rate" id="rate-2" value="2">
                        <label for="rate-2" class="fas fa-star"></label>

                        <input class="radio" type="radio" name="rate" id="rate-1" value="1">
                        <label for="rate-1" class="fas fa-star"></label>
                </div>
                <div>
                <p>Please provide your valuable feedback about order delivery and product quality :</p><br>
                    <input id="verifyFeedBack"  class="verifyFeedBack">
                    <input type="hidden" id="orders_id">
                     <br><br>
                </div>
                    <button  class="button" onclick="confirmVerifyOrder()">Confirm</button>
                    <button  class="button" onclick="closeVerifyOrderModal()" style=" background-color:red;">Cancel</button>
                </div>
        </div>
        <div id="cancelOrderReasonModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeCancelOrderReasonModal()">&times;</span>
                <p>Please provide reason for cancellation:</p><br>
                <select id="cancellationReason">
                    <option>I do not need this order anymore</option>
                    <option>The seller raised the price of the order</option>
                    <option>The seller did not respond to my questions</option>
                    <option>Other</option>
                </select><br><br>
                <button  class="button" onclick="confirmCancelOrder()">Confirm</button>
                <button  class="button" onclick="closeCancelOrderReasonModal()" style=" background-color:red;">Cancel</button>
            </div>
        </div>

        <div id="cannotCancelOrderModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeCannotCancelOrderModal()">&times;</span>
                <p id="cannotCancelOrderMessage"></p>
            </div>
        </div>

        <div id="myModal" class="modal0">
            <div class="modal-content0">
                <!-- <h2>1234567891011</h2> -->
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="form1" id="bookDetailsTable">
                    <!-- Event details will go here -->
                </div>
            </div>
        </div>
    </div>
    <?php 
        require APPROOT . '/views/customer/footer.php'; //path changed 
    ?>
</div>

<script>
    function cancelOrder(orderId, orderStatus) {
        var cancelOrderModal = document.getElementById("cancelOrderModal");
        if (cancelOrderModal) {
            cancelOrderModal.style.display = "block";
            document.getElementById("order_id").value = orderId;
            document.getElementById("order_status").value = orderStatus;
        }
    }
    
    // function verifyOrder(orders.order_id) {
    //     // Display only the book details table
       
    //     verifyOrders(orders.order_id);
    // }
  
    function verifyOrder(orderId) {
        var orderStatus = document.getElementById("order_status").value;
        console.log(orderStatus);
        if (orderStatus.toLowerCase() !== 'cancel') {
            var verifyOrderModal = document.getElementById("verifyOrderModal");
            if (verifyOrderModal) {
                closeModal(); // Close the existing modal
                verifyOrderModal.style.display = "block";
                document.getElementById("orders_id").value = orderId; // Set the order ID value
            }
        } else {
            // If the order status is "cancel", display an error message
            alert("Your order is already cancelled. You cannot verify it.");
        }
    }



    function displayReasonsForCancellation() {
        var orderStatus = document.getElementById("order_status").value;
        var cancelOrderReasonModal = document.getElementById("cancelOrderReasonModal");
        var cannotCancelOrderModal = document.getElementById("cannotCancelOrderModal");

        if (orderStatus === "processing" || orderStatus === "pending") {
            if (cancelOrderReasonModal) {
                cancelOrderReasonModal.style.display = "block";
            }
        } else {
            if (cannotCancelOrderModal) {
                cannotCancelOrderModal.style.display = "block";
                var statusMessage = "Sorry, you cannot cancel the order. It is already in " + orderStatus + " status.";
                document.getElementById("cannotCancelOrderMessage").innerText = statusMessage;
            }
        }
        var cancelOrderModal = document.getElementById("cancelOrderModal");
        if (cancelOrderModal) {
            cancelOrderModal.style.display = "none";
        }
    }
    function closeCancelOrderModal() {
        var cancelOrderModal = document.getElementById("cancelOrderModal");
        if (cancelOrderModal) {
            cancelOrderModal.style.display = "none";
        }
    }

    function closeVerifyOrderModal() {
        var closeVerifyOrderModal= document.getElementById("verifyOrderModal");
        if (closeVerifyOrderModal) {
            verifyOrderModal.style.display = "none";
        }
    }
    function closeCancelOrderReasonModal() {
        var cancelOrderReasonModal = document.getElementById("cancelOrderReasonModal");
        if (cancelOrderReasonModal) {
            cancelOrderReasonModal.style.display = "none";
        }
    }
    function closeCannotCancelOrderModal() {
        var cannotCancelOrderModal = document.getElementById("cannotCancelOrderModal");
        if (cannotCancelOrderModal) {
            cannotCancelOrderModal.style.display = "none";
        }
    }
    function confirmVerifyOrder() {
        var orderId = document.getElementById("orders_id").value;
        var reason = document.getElementById("verifyFeedBack").value;
        var rating = null;

        // Get the selected rating value
        var ratingInputs = document.getElementsByName('rate');
        for (var i = 0; i < ratingInputs.length; i++) {
            if (ratingInputs[i].checked) {
                rating = ratingInputs[i].value;
                break;
            }
        }

        console.log("Order ID:", orderId);
        console.log("Reason:", reason);
        console.log("Rating:", rating);

        if (orderId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo URLROOT; ?>/customer/confirmOrderStatus", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            var data = JSON.stringify({ orderId: orderId, reason: reason, rating: rating });

            xhr.onload = function () {
                console.log("Response received:", xhr.responseText);
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log("Parsed Response:", response);
                    if (response.success) {
                        sweetsuccessVerify();
                        closeVerifyOrderModal();
                    } else {
                        alert("Failed to confirm order status.");
                    }
                } else {
                    alert("Failed to confirm order status. Please try again later.");
                }
            };

            xhr.onerror = function () {
                alert("Error occurred while confirming order status. Please try again later.");
            };

            xhr.send(data);
        } else {
            alert("Error occurred. Please try again later.");
        }
}

    function confirmCancelOrder() {
        var orderId = document.getElementById("order_id").value;
        var reason = document.getElementById("cancellationReason").value;

        console.log("Order ID:", orderId);
        console.log("Reason:", reason);

        if (orderId && reason) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo URLROOT; ?>/customer/cancelOrder", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            var data = JSON.stringify({ orderId: orderId, reason: reason });
            xhr.onload = function () {
                console.log("Response received:", xhr.responseText);
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log("Parsed Response:", response);
                    if (response.success) {
                        sweetsuccess();
                        // alert("Order has been successfully cancelled.");
                        closeCancelOrderReasonModal();
                    } else {
                        alert("Failed to cancel order.");
                    }
                }
            };
        xhr.send(data);
    } else {
        alert("error occured.please try again later.");
    }
}
    function sweetsuccess() {
        
                Swal.fire({
                    title: 'Success',
                    text: 'Order has been successfully cancelled',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: "#70BFBA",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to login page
                        window.location.href = window.location.href;
                    }
                });

                // Return false to prevent form submission
                return false;
        
            return true;
        }
        function sweetsuccessVerify() {
        
            Swal.fire({
                title: 'Success',
                text: 'Successfully confirmed that your order is delivered to your location.Thank you for choosing us',
                icon: 'success',
                confirmButtonText: 'Ok',
                confirmButtonColor: "#70BFBA",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to login page
                    window.location.href = window.location.href;
                }
            });

            // Return false to prevent form submission
            return false;

        return true;
}
    window.onclick = function(event) {
        var cancelOrderReasonModal = document.getElementById("cancelOrderReasonModal");
        var cannotCancelOrderModal = document.getElementById("cannotCancelOrderModal");
        if (event.target == cancelOrderReasonModal) {
            cancelOrderReasonModal.style.display = "none";
        }
        if (event.target == cannotCancelOrderModal) {
            cannotCancelOrderModal.style.display = "none";
        }
    }
</script>

<script>
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function viewOrder(order) {
        var modal = document.getElementById("myModal");
        var bookDetailsTable = document.getElementById("bookDetailsTable");
        var orderDetailsArray = <?php echo json_encode($data['orderDetailsArray']); ?>;
        var orderDetails = orderDetailsArray[order.order_id];
        var detailsHTML = '';
        var totalPrice = 0; // Initialize total price variable
        var deliveryFee = 0;

        // Loop through the order details and generate HTML for each book
        orderDetails.forEach(function(book) {
            var imageSource = '';
            if (book.type == "new") {
                imageSource = '<?php echo URLROOT; ?>/assets/images/publisher/addbooks/' + book.img1;
            } else if (book.type == "used") {
                imageSource = '<?php echo URLROOT; ?>/assets/images/customer/AddUsedBook/' + book.img1;
            } else { 
                imageSource = '<?php echo URLROOT; ?>/assets/images/customer/book.jpg'
            }

            // Calculate the subtotal for each book (price * quantity)
            var subtotal = book.price * book.quantity;
            totalPrice += subtotal; // Add subtotal to total price
            detailsHTML += `
                <tr>
                    <td><img src="${imageSource}" alt="Book" class="ordertablediv-img"></td>
                    <td>${book.book_name}</td>
                    <td>${book.price} x ${book.quantity}</td>
                </tr>
            `;

            deliveryFee = parseFloat(book.total_delivery);
        });

        // Add delivery fee to the total price
        totalPrice += deliveryFee;

        // Determine the background color for each progress bar based on the delivery status
        // var progressBarProcessingClass = order.status === "processing" ? "progress-bar-processing" : "";
        var progressBarProcessingClass = (order.status === "pending" || order.status === "processing" || order.status === "shipping" || order.status === "delivered") ? "progress-bar-processing" : "";
        var progressBarPickupClass = (order.status === "shipping" || order.status === "delivered") ? "progress-bar-pickup" : "";
        var progressBarDeliveredClass = (order.status === "delivered") ? "progress-bar-delivered" : "";

        // Update the modal content with the generated HTML
        bookDetailsTable.innerHTML = `
            <h2>${order.tracking_no}</h2>
            <div class="ordertablediv">
                <table border="1">
                    <tbody>
                        ${detailsHTML}
                    </tbody>
                </table>
                
                <div class="delivery-fee">
                    <h4>Delivery-fee</h4>
                    <h4>${deliveryFee}</h4>
                </div>
                <div class="delivery-fee">
                    <h4>Total</h4>
                    <h4>${totalPrice}</h4>
                </div>
                <div class="delivery-status">
                    <div class="progress">
                        <div class="progress-bar ${progressBarProcessingClass}" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar ${progressBarPickupClass}" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar ${progressBarDeliveredClass}" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="status-labels">
                        <div class="label">
                        <i class="fas fa-cogs"></i>
                        <span>Processing</span>
                        </div>
                        <div class="label">
                        <i class="fas fa-truck"></i>
                        <span>Pick-up</span>
                        </div>
                        <div class="label">
                        <i class="fas fa-check-circle"></i>
                        <span>Delivered</span>
                        </div>
                    </div>
                </div>
                <div class="delivery-received">
                    <p>Did you receive order ?</p> 
                    <center><button onclick="verifyOrder(${order.order_id})">Yes</button></center>
            </div>
        `;
        modal.style.display = "block";
    }

    function viewOrders(orders) {
        // Display only the book details table
        viewOrder(orders);
        // verifyOrder(orders.order_id);
    }
  

</script>
