<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize input (optional for login, since we're using prepared statements)
    // Validate input (optional)

    // Query to check if user exists
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = execute_query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password";
        }
    } else {
        $error_message = "Invalid username or password";
    }
}
?>
