<?php 
    require('db.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $error = "";
    // Lấy dữ liệu + mã hóa
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // Xử lý dữ liệu + thêm vào DB
        if($password !== $confirm_password){
            $error = "Password do not match";
        }else{
            $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) === 1){
                $error = "Username already taken!";
            }else{
                $sql = "INSERT INTO users (username, password, email) VALUES ('$username','$passwordHash','$email')";
                if(mysqli_query($conn, $sql)){
                    echo "Data inserted!";
                }else{
                    $error = "Data has not been added yet!" . mysqli_error($conn);
                }
            }
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
    <?php 
        if($error){
            ?> <p style="color: red"><?php echo $error ?></p><?php
        }
    ?>
    <form method="POST" action="">
            <h2>Create your Account</h2>
            <label for="username">Username:</label></br>
            <input value="<?php echo isset($username) ? $username : ''; ?>"  placeholder="Enter your username" type="text" name="username" required></br>

            <label for="email">Email:</label></br>
            <input  value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Enter your email"  type="email" name="email" required></br>

            <label for="password">Password:</label></br>
            <input placeholder="Enter your password"  type="password" name="password" required></br>

            <label for="confirm_password">Confirm Password:</label></br>
            <input  placeholder="Confirm your password" type="password" name="confirm_password" required></br>

            <input type="submit" value="Register">
        </form>
</body>
</html>

<?php mysqli_close($conn); ?>