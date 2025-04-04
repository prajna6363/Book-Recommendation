<?php
include 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $rating_date = date('Y-m-d');

    $sql = "INSERT INTO ratings (user_id, book_id, rating, review, rating_date) VALUES ('$user_id', '$book_id', '$rating', '$review', '$rating_date')";

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
    <title>Rate a Book</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Rate a Book</h1>
    <form action="rate_book.php" method="post">
        <label for="book_id">Book ID:</label>
        <input type="number" id="book_id" name="book_id" required><br>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required><br>
        <label for="review">Review:</label>
        <textarea id="review" name="review"></textarea><br>
        <button type="submit">Submit Rating</button>
    </form>
</body>
</html>
