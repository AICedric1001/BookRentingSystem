<?php
include_once("config.php");

// Check if book_id is provided
if (!isset($_POST["book_id"])) {
    header("Location: dashboard.php");
    exit();
}

$book_id = $_POST["book_id"];

// Fetch book data based on book_id
$stmt = $conn->prepare("SELECT * FROM books WHERE BookID = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No book found with the given book_id, redirect to dashboard.php
    header("Location: dashboard.php");
    exit();
}

$book = $result->fetch_assoc();

$stmt->close();

// Process update or delete operation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "Update") {
            // Perform update operation
            if (isset($_POST["book_id"], $_POST["book_name"], $_POST["genre"], $_POST["chronology"])) {
                $book_id = $_POST["book_id"];
                $book_name = $_POST["book_name"];
                $genre = $_POST["genre"];
                $chronology = $_POST["chronology"];

                $stmt = $conn->prepare("UPDATE books SET BookName = ?, Genre = ?, Chronology = ? WHERE BookID = ?");
                $stmt->bind_param("sssi", $book_name, $genre, $chronology, $book_id);

                if ($stmt->execute()) {
                    // Book updated successfully, redirect to dashboard.php
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Error occurred while updating book record
                    echo "Error updating book record: " . $stmt->error;
                }

                $stmt->close();
            }
        } elseif ($_POST["action"] === "Delete") {
            // Perform the delete operation
            $stmt = $conn->prepare("DELETE FROM books WHERE BookID = ?");
            $stmt->bind_param("i", $book_id);
            $stmt->execute();

            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                // Redirect back to dashboard.php after successful delete
                header("Location: dashboard.php");
                exit();
            } else {
                // No rows affected
                echo "Error: Book not found or already deleted.";
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configure Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Configure Book</h2>

        <form method="post" action="">
            <input type="hidden" name="book_id" value="<?php echo $book['BookID']; ?>">
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" value="<?php echo $book['BookName']; ?>" required>

            <label for="genre">Genre:</label>
            <input type="text" name="genre" value="<?php echo $book['Genre']; ?>" required>

            <label for="chronology">Chronology:</label>
            <input type="number" name="chronology" value="<?php echo $book['Chronology']; ?>" required>

            <input type="submit" name="action" value="Update">
            <input type="submit" name="action" value="Delete">
        </form>
    </div>
</body>
</html>
