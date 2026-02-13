<?php
// autoloader
// every file you add to the core should included in the init
require "config.php";
require "functions.php";
require "connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
