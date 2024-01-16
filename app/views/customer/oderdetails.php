<div class="order-view" id="order-details">
    <button type="submit" class="close-order-view" onclick="toggleOrder('order-details')"><img src="<?php echo URLROOT; ?>/assets/images/customer/close.png" class="order-close"></button>
    <div class="main-order-details">
        
    </div>
</div>

<script>
    function toggleOrder(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle("show-order");
    }
</script>