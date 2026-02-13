<?php
// C:\xampp\htdocs\chris_blog\app\core\functions.php

require_once "connection.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Authenticate a user by saving them in session
 */
function authenticate(array $user) {
    $_SESSION['user'] = [
        'id'       => $user['id'],
        'username' => $user['username'],
        'email'    => $user['email'],
        'role'     => $user['role'] ?? 'user'
    ];
}

/**
 * Check if a user is logged in
 */
function isAuthenticated(): bool {
    return isset($_SESSION['user']);
}

/**
 * Get currently logged-in user
 */
function currentUser(): ?array {
    return $_SESSION['user'] ?? null;
}

/**
 * Logout user
 */
function logout() {
    unset($_SESSION['user']);
    session_destroy();
    setcookie('remember_me', '', time() - 3600, '/');
}


function query(string $query, array $data = [])
{
    try {
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($dsn, DBUSER, DBPASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare($query);
        $check = $stmt->execute($data);

        // If it's a SELECT or SHOW query, fetch results
        if (preg_match("/^(SELECT|SHOW)/i", trim($query))) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: false;
        }

        // For INSERT, UPDATE, DELETE → return true/false
        return $check;
    } catch (PDOException $e) {
        // Optional: log error in dev mode
        echo "Database error: " . $e->getMessage();
        return false;
    }
}

// ======================
function redirect($page){
header('location: ' . $page);
die;
}

function str_to_url($url)
{
    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}

// function authenticate($user)
// {
//        $_SESSION['USER'] = $row;
//             $success = true; 
// } 

function logged_in()
{
    if(!empty($_SESSION['user']))
        return true;
    return false; 
}


create_tables();
function create_tables(){
    try{
        $dsn = "mysql:host=" . DBHOST;
        $con = new PDO($dsn, DBUSER, DBPASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               // Create database if not exists
        $con->exec("CREATE DATABASE IF NOT EXISTS " . DBNAME);
        // echo "Database checked/created successfully.<br>";

         // STEP 2: Reconnect with the actual database
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($dsn, DBUSER, DBPASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connected to database successfully.<br>";

        
        // STEP 3: Create users table
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            image VARCHAR(1024) DEFAULT NULL,
            role VARCHAR(10) NOT NULL DEFAULT 'user',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            KEY username (username),
            KEY email (email)
        ) ENGINE=InnoDB";
        $con->exec($query);
        // echo "Table 'users' checked/created successfully.<br>";

         // STEP 4: Create categories table
        $query = "CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category VARCHAR(50) NOT NULL,
            slug VARCHAR(100) NOT NULL,
            disabled TINYINT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            KEY slug (slug),
            KEY category (category)
        ) ENGINE=InnoDB";
        $con->exec($query);
        // echo "Table 'categories' checked/created successfully.<br>";


        // STEP 5: Create posts table (fixed foreign key issue)
        $query = "CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            category_id INT NULL,
            title VARCHAR(150) NOT NULL,
            content TEXT NULL,
            image VARCHAR(1024) DEFAULT NULL,
            slug VARCHAR(150) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            KEY user_id (user_id),
            KEY category_id (category_id),
            KEY title (title),
            KEY slug (slug),
            CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
        ) ENGINE=InnoDB";
        $con->exec($query);
        // echo "Table 'posts' checked/created successfully.<br>";

        // echo "<br>All tables created successfully!";
        
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}


