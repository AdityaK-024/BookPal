<?php
// Connect to your database
$servername = "localhost";
$username = "root"; // Assuming you're using the default XAMPP username
$password = ""; // Leave empty if you haven't set a password
$database = "bookpal"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search type (title or author) and search query
$searchType = isset($_GET['type']) ? $_GET['type'] : 'title';
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Sanitize search query to prevent SQL injection
$searchQuery = $conn->real_escape_string($searchQuery);

// Construct SQL query based on search type and query
if ($searchType === 'title') {
    $sql = "SELECT * FROM books WHERE name LIKE '%$searchQuery%'";
} elseif ($searchType === 'author') {
    $sql = "SELECT * FROM books WHERE author LIKE '%$searchQuery%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='books-container'>"; // Start container for cards
    $count = 0; // Initialize counter for cards in row
    // Output data of each row in card format
    while($row = $result->fetch_assoc()) {
        echo "<div class='book-card'>";
        echo "<h2>Title: " . $row["name"]. "</h2>";
        echo "<p>Author: " . $row["author"]. "</p>";
        echo "<p>Format: " . $row["format"]. "</p>";
        echo "<p>ISBN: " . $row["isbn"]. "</p>";
        echo "<p>Category: " . $row["category"]. "</p>";
        echo "<p>Price: " . $row["price"]. "</p>";
        echo "<p>Old Price: " . $row["old_price"]. "</p>";
        echo "<p>Book Depository Stars: " . $row["book_depository_stars"]. "</p>";
        echo "<img src='" . $row["img_paths"] . "' alt='Book Cover'>";
        echo "</div>";
        $count++; // Increment counter
        // Check if 5 cards have been output
        if ($count % 5 == 0) {
            echo "</div><div class='books-container'>"; // Start new row
        }
    }
    echo "</div>"; // Close container for cards
} else {
    echo "<p>No results found</p>";
}

$conn->close();
?>
