<?php
    // Autoload
    require_once 'autoloader.php';
    // Start session
    session_start();

    // Require config file
    require_once 'config/config.php';

    // Load database
    require_once 'classes/Database.php';

    // Helper function
    require_once 'helpers.php';

    // Define global constants
    define('APP_NAME', 'CMS PDO SYSTEM');
?>