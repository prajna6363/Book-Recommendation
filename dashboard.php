<?php
 include 'db.php';
 
 session_start();
 
 // Ensure the user is logged in
 if (!isset($_SESSION['user_id'])) {
     header('Location: login.html');
     exit();
 }
 
 $user_id = $_SESSION['user_id'];
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="styles.css">
     <title>Dashboard</title>
 </head>
 <body>
     <header>
         <h1>Welcome to Dashboard</h1>
     </header>
     <nav>
         <ul>
             <li><a href="add_book.php">Add Book</a></li>
             <li><a href="rate_book.php">Rate Book</a></li>
             <li><a href="preferences.php">Set Preferences</a></li>
             <li><a href="logout.php">Logout</a></li>
         </ul>
     </nav>
     <main>
         <h2>Book Recommendations</h2>
         <?php include __DIR__ . '/recommendation.php'; ?>
 
         <h2>Top Rated Books</h2>
         <?php include __DIR__ . '/top_rated_books.php'; ?>
 
         <h2>New Arrivals</h2>
         <?php include __DIR__ . '/new_arrivals.php'; ?>
 
         <!-- Add more sections as needed -->
     </main>
     <footer>
         <p>&copy; 2024 Your Book Recommendation System</p>
     </footer>
 </body>
 </html>
