<?php 
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){     
            ?><nav>
                <ul>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
            </nav><?php
        }else{
            ?><nav><a href="login.php">Login</a>
            <a href="register.php">Register</a></nav>
            <?php
        }
?>