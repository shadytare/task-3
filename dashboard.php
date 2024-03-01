<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Fetch user's notes
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM notes WHERE user_id = $user_id";
$notes_result = execute_query($sql);

// Handle note submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_note"])) {
    // Retrieve input data
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Sanitize input (optional)
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);

    // Validate input (optional)

    // Insert new note
    $sql = "INSERT INTO notes (user_id, title, content) VALUES ($user_id, '$title', '$content')";
    execute_query($sql);

    // Redirect to refresh the page and prevent form resubmission
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to Your Dashboard</h2>
        <form method="post" action="">
            <input type="text" name="title" placeholder="Note Title" required><br>
            <textarea name="content" placeholder="Note Content" required></textarea><br>
            <button type="submit" name="submit_note">Add Note</button>
        </form>
        <h3>Your Notes:</h3>
        <?php while ($row = $notes_result->fetch_assoc()) { ?>
            <div class="note">
                <h4><?php echo $row["title"]; ?></h4>
                <p><?php echo $row["content"]; ?></p>
            </div>
        <?php } ?>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
