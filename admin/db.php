<?php
// Database configuration
$db_host = 'localhost';     // Database host (e.g., localhost)
$db_username = 'root';      // Database username
$db_password = '';          // Database password
$db_name = 'tamoor-ecom';   // Database name

// Establish database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8mb4
if (!$conn->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $conn->error);
    exit();
}

?>
