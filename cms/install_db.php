<?php
// Fix for path issues
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

try {
    $db = new Database;
    
    // Create Users Table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->query($sql);
    if($db->execute()){
        echo "Table 'users' check/creation successful.\n";
    } else {
        echo "Failed to create table 'users'.\n";
    }

    // Insert Admin User if not exists
    // We check first to avoid unique constraint errors if INSERT IGNORE is not supported fully or just to be clean
    $db->query("SELECT id FROM users WHERE username = 'admin'");
    if(!$db->single()){
        // Password: password
        $pass = password_hash('password', PASSWORD_DEFAULT); 
        $db->query("INSERT INTO users (username, password) VALUES ('admin', :pass)");
        $db->bind(':pass', $pass);
        if($db->execute()){
            echo "Admin user created successfully (User: admin, Pass: password).\n";
        } else {
            echo "Failed to create admin user.\n";
        }
    } else {
        echo "Admin user already exists.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
