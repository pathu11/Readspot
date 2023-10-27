

<!DOCTYPE html>
<html>
<head>
    <title>Log in</title>
</head>
<body>
    <h2>Log in</h2>
    <form  method="POST">
        <?php if(!empty($errors)):?>
        <div >
            <?= implode("<br>", $errors)?>
        </div>
        <?php endif;?>
  
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
