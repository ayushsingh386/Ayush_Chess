<?php
// Database connection parameters
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your MySQL username
$password = "anuj"; // Your MySQL password
$dbname = "chess_tutorials"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users1 (name, email, phone, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $password);

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['pass'];// Hash the password for security

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: success.html"); // Redirect to a success page
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>