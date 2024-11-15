<?php 
    session_start();
    if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true){
        header('Location: index.php');
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
    <p>Welcome <?php $_SESSION['username'];?>.</p>
    <a href="logout.php">Log out</a>
</body>
</html>