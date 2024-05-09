<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Change this if you have set a password for MySQL
$dbname = "bookpal"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read data from CSV file
$csvFile = 'main_dataset.csv'; // Path to CSV file
$file = fopen($csvFile, 'r');

// Skip header row
$header = fgetcsv($file);

// Insert data into database
while (($row = fgetcsv($file)) !== FALSE) {
    $data = array_combine($header, $row); // Combine header and row data

    // Escape special characters in data and prepare for insertion
    $name = mysqli_real_escape_string($conn, $data['name']);
    $author = mysqli_real_escape_string($conn, $data['author']);
    $format = mysqli_real_escape_string($conn, $data['format']);
    $book_depository_stars = mysqli_real_escape_string($conn, $data['book_depository_stars']);
    $price = mysqli_real_escape_string($conn, $data['price']);
    $currency = mysqli_real_escape_string($conn, $data['currency']);
    $old_price = mysqli_real_escape_string($conn, $data['old_price']);
    $isbn = mysqli_real_escape_string($conn, $data['isbn']);
    $category = mysqli_real_escape_string($conn, $data['category']);
    $img_paths = mysqli_real_escape_string($conn, $data['img_paths']);

    // Prepare and execute SQL statement (use prepared statement for better security)
    $sql = $conn->prepare("INSERT INTO books (name, author, format, book_depository_stars, price, currency, old_price, isbn, category, img_paths) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssdsssss", $name, $author, $format, $book_depository_stars, $price, $currency, $old_price, $isbn, $category, $img_paths);
    
    if ($sql->execute()) {
        echo "Record inserted successfully: $name, $author, $format, $isbn <br>";
    } else {
        echo "Error inserting record: " . $conn->error;
    }
}

// Close file and database connection
fclose($file);
$conn->close();
?>
