<?php
include_once("config.php");

$error_message = "";

// Fetching books data for reference
$books_query = "SELECT * FROM books";
$books_result = $conn->query($books_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personID = $_POST["personID"];
    $timeIn = $_POST["timeIn"];
    $bookID = $_POST["bookID"];

    // Validate PersonID
    $stmt = $conn->prepare("SELECT * FROM renteraccount WHERE PersonID = ?");
    $stmt->bind_param("i", $personID);
    $stmt->execute();
    $result_rentaccount = $stmt->get_result();
    
    // Validate BookID
    $stmt = $conn->prepare("SELECT * FROM books WHERE BookID = ?");
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $result_books = $stmt->get_result();

    if ($result_rentaccount->num_rows > 0 && $result_books->num_rows > 0) {
        // Insert data into the checkinout table
        $stmt = $conn->prepare("INSERT INTO checkinout (PersonID, TimeIn, BookID) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $personID, $timeIn, $bookID);

        if ($stmt->execute()) {
            // Redirect to checkinout.php with success message
            header("Location: checkinout.php?success=1");
            exit();
        } else {
            $error_message = "Error adding check-in entry: " . $stmt->error;
        }
    } else {
        $error_message = "Invalid Person ID or Book ID.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Book!</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 1000px; /* Adjusted width */
            margin: 50px auto;
            padding: 80px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 20px 0 10px;
            color: #333;
        }

        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Style for the book list button */
        #book-list-btn {
            position: absolute;
            top: 0;
            Right: 0;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 0 0 8px 0;
            transition: transform 0.3s;
        }

        #book-list-btn:hover {
            transform: translateY(-3px);
        }

        /* Style for the book list container */
        .book-list-container {
            position: absolute;
            top: 0;
            left: -100%;
            width: 70%;
            height: 100%;
            background-color: #f0f0f0;
            transition: left 0.3s;
            overflow-y: auto;
            padding: 0px;
        }

        .book-list-container.open {
            left: 0;
        }

        .book-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .book-list li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rent A Book!</h2>

        <form method="post" action="">
            <label for="personID">Person ID:</label>
            <input type="number" name="personID" required><br>

            <label for="timeIn">Check-in Date:</label>
            <input type="date" name="timeIn" required><br>

            <label for="bookID">Book ID Index:</label>
            <input type="number" name="bookID" required><br>

            <input type="submit" value="Submit">
        </form>

        <!-- Book List Button -->
        <div id="book-list-btn">Book List</div>

        <!-- Book List Container -->
        <div class="book-list-container" id="book-list-container">
            <h2>Book List</h2>
            <ul class="book-list">
                <?php while ($row = $books_result->fetch_assoc()) { ?>
                    <li><?php echo $row['BookID']; ?>: <?php echo $row['BookName']; ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById('book-list-btn').addEventListener('click', function() {
            document.getElementById('book-list-container').classList.toggle('open');
        });
    </script>
</body>
</html>
