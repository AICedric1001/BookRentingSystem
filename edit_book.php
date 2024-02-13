<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>

<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];

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

    // Fetch book details from database
    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $author = $row['author'];
        $genre = $row['genre'];
        $available = $row['available'];
    } else {
        echo "No book found with ID: $id";
    }

    $conn->close();
} else {
    echo "No ID provided";
}
?>

<h2>Edit Book</h2>

<form action="update_book.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Title: <input type="text" name="title" value="<?php echo $title; ?>"><br><br>
    Author: <input type="text" name="author" value="<?php echo $author; ?>"><br><br>
    Genre: <input type="text" name="genre" value="<?php echo $genre; ?>"><br><br>
    Available: <input type="number" name="available" value="<?php echo $available; ?>"><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>