<?php foreach($data['posts'] as $posts): ?>
            <tr>
                <th style="width:7%"><?php echo $posts->name; ?></th>
                <th style="width:7%"><?php echo $posts->email; ?></th>
                
            </tr>
                <?php endforeach; ?>