<?php
session_start();
include 'db.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION["user_id"];

// Create Note
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_note"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Sanitize input (optional)
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);

    // Validate input (optional)

    // Insert new note into the database
    $sql = "INSERT INTO notes (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    execute_query($sql);

    // Redirect back to dashboard after creating the note
    header("Location: dashboard.php");
    exit();
}

// Read Notes (List all notes for the current user)
$sql = "SELECT id, title, content FROM notes WHERE user_id = '$user_id'";
$result = execute_query($sql);
$notes = [];
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

// Update Note
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_note"])) {
    $note_id = $_POST["note_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Sanitize input (optional)
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);

    // Validate input (optional)

    // Update the note in the database
    $sql = "UPDATE notes SET title = '$title', content = '$content' WHERE id = '$note_id' AND user_id = '$user_id'";
    execute_query($sql);

    // Redirect back to dashboard after updating the note
    header("Location: dashboard.php");
    exit();
}

// Delete Note
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_note"])) {
    $note_id = $_POST["note_id"];

    // Delete the note from the database
    $sql = "DELETE FROM notes WHERE id = '$note_id' AND user_id = '$user_id'";
    execute_query($sql);

    // Redirect back to dashboard after deleting the note
    header("Location: dashboard.php");
    exit();
}
?>
