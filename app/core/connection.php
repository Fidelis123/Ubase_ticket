<?php
// C:\xampp\htdocs\blog_learn\app\core\connection.php

// Define constants only if they are not already defined
if (!defined('DBUSER') && !defined('DBPASS') && !defined('DBNAME') && !defined('DBHOST')) {

    if ($_SERVER['SERVER_NAME'] == "localhost") {
        // Local development settings
        define('DBUSER', "root");
        define('DBPASS', "");
        define('DBNAME', "myblog_db");
        define('DBHOST', "localhost");
    } else {
        // Live server settings (update these when deploying)
        define('DBUSER', "your_live_user");
        define('DBPASS', "your_live_password");
        define('DBNAME', "your_live_database");
        define('DBHOST', "your_live_host");
    }
}
