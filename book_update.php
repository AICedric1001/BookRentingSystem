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

// Function to add a book
function addBook($title, $author, $genre, $available) {
    global $conn;
    $sql = "INSERT INTO books (title, author, genre, available) VALUES ('$title', '$author', '$genre', $available)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update a book
function updateBook($id, $title, $author, $genre, $available) {
    global $conn;
    $sql = "UPDATE books SET title='$title', author='$author', genre='$genre', available=$available WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Function to delete a book
function deleteBook($id) {
    global $conn;
    $sql = "DELETE FROM books WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Example usage
// Adding a book
addBook("To Kill a Mockingbird", "Harper Lee", "Fiction", 1);

// Updating a book
updateBook(1, "1984", "George Orwell", "Dystopian", 0);

// Deleting a book
deleteBook(2);

$conn->close();
?>