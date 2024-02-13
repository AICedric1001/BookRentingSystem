<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .back-btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="process_registration.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="text" id="Fname" name="Fname" required>
             <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>
            <label for="address">Address(Location):</label>
            <input type="text" id="address" name="address" required>
            <input type="submit" value="Register">
        </form>
        <a href="login.php" class="back-btn">Back</a>
    </div>
</body>
</html>
