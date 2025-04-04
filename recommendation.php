<?php
include 'db.php';

// Check if a session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

// Prepare and execute SQL query to fetch book recommendations based on ratings and genre
$sql = "SELECT b.title, b.author, b.genre, b.cover_image, COALESCE(AVG(r.rating), 0) as avg_rating
        FROM books b
        LEFT JOIN ratings r ON b.id = r.book_id
        GROUP BY b.id, b.title, b.author, b.genre, b.cover_image
        ORDER BY avg_rating DESC, b.genre";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Display the results
if ($result->num_rows > 0) {
    echo "<div class='recommendations'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book-item'>";
        echo "<div class='book-cover'>";
        if (!empty($row['cover_image'])) {
            echo "<img src='images/2book.jpg" . htmlspecialchars($row['cover_image']) . "' alt='Cover Image' class='cover-image'>";
        } else {
            echo "<img src='images/wings of fire.jpeg' alt='Default Cover Image' class='cover-image'>";
        }
        echo "</div>";
        echo "<div class='book-details'>";
        echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
        echo "<strong>Author:</strong> " . htmlspecialchars($row['author']) . "<br>";
        echo "<strong>Genre:</strong> " . htmlspecialchars($row['genre']) . "<br>";
        echo "<strong>Average Rating:</strong> " . htmlspecialchars(number_format($row['avg_rating'], 2)) . "<br>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No recommendations found!";
}

$stmt->close();
$conn->close();
?>
<link rel="stylesheet" href="styles.css">
