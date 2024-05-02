<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
    <?php
// Create a database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define search query
$search_query = $_POST['search_query']; // Assuming you're receiving the search query from a form POST request

// Search for books by name
$sql = "SELECT * FROM books WHERE name LIKE '%" . $search_query . "%'";
$result = $conn->query($sql);

// Display search results
if ($result->num_rows > 0) {
    echo "<h2>Search Results</h2>";
    while($row = $result->fetch_assoc()) {
        echo "Book Name: " . $row["name"] . "<br>";
        echo "Author: " . $row["author"] . "<br>";
        echo "Category: " . $row["category"] . "<br>";
        // Display other book details as needed
        echo "<hr>";
    }
} else {
    echo "No books found matching your search criteria.";
}

// Close connection
$conn->close();
?>

    </div>
    
</body>
</html>
