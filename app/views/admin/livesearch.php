<div class="table-container" >
        <table>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Date</th>
            </tr>
           
    <?php foreach($data['customerSearchDetails'] as $customer): ?>
    <tr>
        <td><?php echo $customer->customer_id; ?></td>
        <td><?php echo $customer->name; ?></td>
        <td><?php echo $customer->email; ?></td>
        <td><?php echo $customer->created_at; ?></td>
    <?php endforeach; ?>               
        </table>
        
    </div>