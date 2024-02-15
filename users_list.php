<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users</h2>

        <?php

        error_reporting(E_ALL);
ini_set('display_errors', 1);

        include_once("config.php");

        $users = array();

        // Fetches Users
        $RentAccount = $conn->query("SELECT * FROM renteraccount");
        while ($row = $RentAccount->fetch_assoc()) {
            $users[] = array(
                'PersonID' => $row['PersonID'],
                'Firstname' => $row['FirstName'],
                'Lastname' => $row['LastName'],
                'Address' => $row['Address']
            );
        }

        $conn->close();

        if (!empty($users)) {
            echo "<table>";
            echo "<tr><th>Person ID</th><th>Firstname</th><th>Lastname</th><th>Address</th><th>Configure</th></tr>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['PersonID']}</td>";
                echo "<td>{$user['Firstname']}</td>";
                echo "<td>{$user['Lastname']}</td>";
                echo "<td>{$user['Address']}</td>";
                echo "<td>";
                echo "<form method='get' action='configure_user.php'>";
                echo "<input type='hidden' name='person_id' value='{$user['PersonID']}'>";
                echo "<input type='submit' value='Configure'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users</h2>

        <?php

        error_reporting(E_ALL);
ini_set('display_errors', 1);

        include_once("config.php");

        $users = array();

        // Fetches Users
        $RentAccount = $conn->query("SELECT * FROM renteraccount");
        while ($row = $RentAccount->fetch_assoc()) {
            $users[] = array(
                'PersonID' => $row['PersonID'],
                'Firstname' => $row['FirstName'],
                'Lastname' => $row['LastName'],
                'Address' => $row['Address']
            );
        }

        $conn->close();

        if (!empty($users)) {
            echo "<table>";
            echo "<tr><th>Person ID</th><th>Firstname</th><th>Lastname</th><th>Address</th><th>Configure</th></tr>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['PersonID']}</td>";
                echo "<td>{$user['Firstname']}</td>";
                echo "<td>{$user['Lastname']}</td>";
                echo "<td>{$user['Address']}</td>";
                echo "<td>";
                echo "<form method='get' action='configure_user.php'>";
                echo "<input type='hidden' name='person_id' value='{$user['PersonID']}'>";
                echo "<input type='submit' value='Configure'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>
</body>
</html>
>>>>>>> b9a026137f39a8cef8029ef9d228f18d1191dfec
