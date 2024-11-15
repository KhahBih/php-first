<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = 'admin';
        $password = 'secret';
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        if($input_password === $password && $input_username === $username){
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $input_username;
            header('Location: admin.php');
            exit;
        }else{
            $message = "Username or password invalid!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"></br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"></br>
        <input type="submit">
    </form>
    <?php if(isset($message)): ?>
        <p><?php echo $message?></p>
    <?php endif; ?>
</body>
</html>