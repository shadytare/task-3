<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Sanitize input
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    // Other fields can be sanitized similarly

    // Validate input (optional)

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert new user
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    $result = execute_query($sql);

    if ($result) {
        $_SESSION["registration_success"] = true;
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Registration failed. Please try again.";
    }
}
?>
