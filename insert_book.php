<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$available = $_POST['available'];

// Insert data into database
$sql = "INSERT INTO books (title, author, genre, available) VALUES ('$title', '$author', '$genre', $available)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>