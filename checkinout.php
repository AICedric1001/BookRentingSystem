<?php
include_once("config.php");

$sql = "SELECT * FROM checkinout
        INNER JOIN renteraccount ON checkinout.PersonID = renteraccount.PersonID
        ";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Rent Details</title>
        <link rel='stylesheet' href='styles.css'>
        <style>
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            .details-box {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-top: 20px;
            }
            .details {
                border-bottom: 1px solid #ccc;
                padding-bottom: 20px;
                margin-bottom: 20px;
            }
            .details:last-child {
                border-bottom: none;
                padding-bottom: 0;
                margin-bottom: 0;
            }
            .details p {
                margin: 10px 0;
            }
            .error-message {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Rent Lists</h2>
            <div class='details-box'>
    ";

        while ($row = $result->fetch_assoc()) {
        echo "
            <div class='details'>
                <p><strong>Person ID:</strong> " . $row['PersonID'] . "</p>
                <p><strong>Name:</strong> " . $row['FirstName'] . " " . $row['LastName'] . "</p>
                <p><strong>Time In:</strong> " . $row['TimeIn'] . "</p>
                <p><strong>Book ID:</strong> " . $row['BookId'] . "</p>
            </div>
        ";
    }

    echo "
            </div>
        </div>
    </body>
    </html>
    ";
} else {
    echo "<p class='error-message'>No check-in/out records found.</p>";
}

$conn->close(); 
?>
