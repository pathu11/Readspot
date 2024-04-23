<?php
    $title = "Content";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
<?php
    require APPROOT . '/views/customer/sidebar.php'; //path changed
?>
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
                       
                            <button type="submit" class="view-button"  onclick="toggleOrder('order-details')"><i class="fas fa-eye"></i></button>
                            <button type="button" class="delete-button"onclick="cancelOrder(<?php echo $orders->order_id; ?>, '<?php echo $orders->status; ?>')"> <i class="fas fa-trash"></i></button>
                       
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
                    alert("Order has been successfully cancelled.");
                    closeCancelOrderReasonModal();
                } else {
                    alert("Failed to cancel order.");
                }
            }
        };
        xhr.send(data);
    } else {
        alert("Please provide both order ID and reason for cancellation.");
    }
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
