<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>

<h2>Add New Book</h2>

<form action="insert_book.php" method="post">
    Title: <input type="text" name="title"><br><br>
    Author: <input type="text" name="author"><br><br>
    Genre: <input type="text" name="genre"><br><br>
    Available: <input type="number" name="available"><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>