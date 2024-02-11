<?php
    $title = "Purchase Details";
?>

<div class="container">
    <div class="purchase-details">
        <div class="purchase-topic">
            <h2>Purchase Details</h2>
        </div>
        <div class="purchase-info">
            <table border="1">
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php if (!empty($data['bookDetails'])): ?>
                    <?php foreach ($data['bookDetails'] as $cartItems): ?>
                        <?php $uniqueCartItems = array_map("unserialize", array_unique(array_map("serialize", $cartItems))); ?>
                        <?php foreach ($uniqueCartItems as $book): ?>
                            <tr>
                                <td><?php echo $book->book_id; ?></td>
                                <td><?php echo $book->book_name; ?></td>
                                <td><?php echo $book->price; ?></td>
                                <td><?php echo $book->maxQuantity; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No book details found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
