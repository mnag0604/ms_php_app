<?php
$host = "localhost";  // Change if using a different host
$dbname = "quality_improvement"; // Database name
$username = "root"; // Change if using a different user
$password = ""; // Change if using a password

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8");

// Uncomment for debugging
// echo "Database Connected Successfully!";
?>
