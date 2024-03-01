<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper function for executing SQL queries
function execute_query($sql) {
    global $conn;
    $result = $conn->query($sql);
    if (!$result) {
        die("Error executing query: " . $conn->error);
    }
    return $result;
}
?>
