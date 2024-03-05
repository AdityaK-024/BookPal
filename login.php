<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookpal";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch user
    $stmt = $conn->prepare("SELECT name, email, password FROM signin_bookpal WHERE email = ?");
    
    // Check for preparation errors
    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Check for execution errors
    if ($stmt->error) {
        die("Error in executing the statement: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Password is correct, set session variables
            session_start();
            $_SESSION["user_email"] = $row["email"];
            $_SESSION["user_name"] = $row["name"];
            
            // Redirect to welcome page
            header("Location: home.html");
            exit;
        } else {
            // Password is incorrect
            echo "Invalid email or password. Please try again.";
        }
    } else {
        // User not found
        echo "Invalid email or password. Please try again.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
