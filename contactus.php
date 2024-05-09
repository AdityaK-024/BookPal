<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password if set
$dbname = "bookpal";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the contact form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)");

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Contact form submission successful
        echo "Message sent successfully! We'll get back to you soon.";

        // Redirect back to the contact page after a delay
        header("refresh:3; url=contactus.html");
        exit;
    } else {
        // An error occurred while storing the message
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
