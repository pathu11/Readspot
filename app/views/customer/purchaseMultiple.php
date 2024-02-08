<?php
    $title = "Purchase Details";
    // require APPROOT . '/views/customer/header.php'; //path changed
?>
<?php
    // require APPROOT . '/views/customer/sidebar.php'; //path changed
?>
<div class="container">
    <div class="purchase-details">
        <div class="purchase-topic">
            <h2>Purchase Details</h2>
        </div>
        <?php print_r($data['bookDetails']); ?>

        <div class="purchase-info">
            <table border="1">
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Price</th>
                </tr>
                <?php foreach($data['bookDetails'] as $book): ?>
                <tr>
                    <td><?php echo $book['book_id']; ?></td>
                    <td><?php echo $book->book_name; ?></td>
                    <td><?php echo $book->price; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php
    // require APPROOT . '/views/customer/footer.php'; //path changed
?>
