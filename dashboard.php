<!DOCTYPE html>
<html>
<head>
    <title>Book Renting System</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Book Renting System Dashboard</h2>

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

// Fetching books from database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Genre</th><th>Available</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["title"]."</td>";
        echo "<td>".$row["author"]."</td>";
        echo "<td>".$row["genre"]."</td>";
        echo "<td>".$row["available"]."</td>";
        echo "<td><a href='edit_book.php?id=".$row["id"]."'>Edit</a> | <a href='delete_book.php?id=".$row["id"]."'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<br>
<a href="add_book.php">Add New Book</a>

</body>
</html>
