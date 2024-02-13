<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Dashboard</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
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
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container input[type=text], .form-container input[type=number] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Library Management System - Dashboard</h2>

  <?php
    // Include the database connection
    include_once("config.php");

    // Fetching books from database
    $sql = "SELECT * FROM books"; // Modify this query to fetch data from your books table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Book ID</th><th>Book Name</th><th>Genre</th><th>Chronology</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["BookID"]."</td>";
            echo "<td>".$row["BookName"]."</td>";
            echo "<td>".$row["Genre"]."</td>";
            echo "<td>".$row["Chronology"]."</td>";
            echo "<td>
                    <form method='post' action='config_book.php'>
                        <input type='hidden' name='book_id' value='".$row["BookID"]."'>
                        <input type='submit' name='config' value='Config'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

    <div class="form-container">
        <h2>Add a New Book</h2>
        <form action="insert_book.php" method="post">
            <label for="bookname">Book Name:</label>
            <input type="text" id="bookname" name="bookname" required>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>
            <label for="chronology">Chronology:</label>
            <input type="number" id="chronology" name="chronology" required>
            <input type="submit" value="Add Book">
        </form>
    </div>

    <br>
    <a href="bookrent.php" class="button">Rent A Book!</a>
    <a href="logout.php" class="button">Logout</a>
</div>

</body>
</html>