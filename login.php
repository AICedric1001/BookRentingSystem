<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <form action="process_login.php" method="POST">
            <label for="Fname">Firstname</label>
            <input type="text" id="Fname" name="Fname" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($_GET['error'])) {
            echo "<p>{$_GET['error']}</p>";
        }
        ?>
        <a href="register.php">Register</a>
    </div>
</body>
</html>
