<?php
include 'db.php';

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $genre = $_POST['genre'];
    $author = $_POST['author'];
    $preference_date = date('Y-m-d');
     

    $sql = "INSERT INTO preferences (user_id, genre, author, preference_date) VALUES ('$user_id', '$genre', '$author', '$preference_date')";

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Preferences</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Set Preferences</h1>
    <form action="preferences.php" method="post">
        <label for="genre">Favorite Genre:</label>
        <input type="text" id="genre" name="genre" required><br>
        <label for="author">Favorite Author:</label>
        <input type="text" id="author" name="author" required><br>
        <button type="submit">Save Preferences</button>
    </form>
</body>
</html>
<link rel="stylesheet" href="styles.css">
