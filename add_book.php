<?php
 // Include database connection
 include 'db.php';
 
 // Start the session
 session_start();
 
 // Check if the user is logged in
 if (!isset($_SESSION['user_id'])) {
     header('Location: login.html');
     exit();
 }
 
 // Handle form submission
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (isset($_POST['title'], $_POST['author'], $_POST['genre'], $_POST['publish_date'], $_POST['cover_image'])) {
         $title = $_POST['title'];
         $author = $_POST['author'];
         $genre = $_POST['genre'];
         $publish_date = $_POST['publish_date'];
         $cover_image = $_POST['cover_image']; // This should be a file upload in a real application
 
         // Prepare and execute SQL query to insert book details
         $sql = "INSERT INTO books (title, author, genre, publish_date, cover_image) VALUES (?, ?, ?, ?, ?)";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param('sssss', $title, $author, $genre, $publish_date, $cover_image);
         $stmt->execute();
         $stmt->close();
 
         // Redirect or show success message
         echo "<p>Book added successfully!</p>";
     } else {
         echo "<p>Please fill in all fields.</p>";
     }
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add Book - Book Recommendation System</title>
     <link rel="stylesheet" href="styles.css">
 </head>
 <body>
     <header>
         <h1>Add a New Book</h1>
         <nav>
             <a href="index.php">Home</a> |
             <a href="dashboard.php">Dashboard</a>
         </nav>
     </header>
     <main>
         <section>
             <form action="add_book.php" method="post">
                 <h2>Book Details</h2>
                 <label for="title">Title:</label>
                 <input type="text" id="title" name="title" required>
 
                 <label for="author">Author:</label>
                 <input type="text" id="author" name="author" required>
 
                 <label for="genre">Genre:</label>
                 <input type="text" id="genre" name="genre" required>
 
                 <label for="publish_date">Publish Date:</label>
                 <input type="date" id="publish_date" name="publish_date" required>
 
                 <label for="cover_image">Cover Image (URL):</label>
                 <input type="text" id="cover_image" name="cover_image">
 
                 <button type="submit">Add Book</button>
             </form>
         </section>
     </main>
     <footer>
         <p>&copy; 2024 Book Recommendation System. All rights reserved.</p>
     </footer>
 </body>
 </html>
