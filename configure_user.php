<?php
include_once("config.php");

// Check if person_id is provided
if (!isset($_GET["person_id"])) {
    header("Location: users_list.php");
    exit();
}

$person_id = $_GET["person_id"];

// Fetch user data based on person_id
$stmt = $conn->prepare("SELECT * FROM renteraccount WHERE PersonID = ?");
$stmt->bind_param("i", $person_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // No user found with the given person_id, redirect to users_list.php
    header("Location: users_list.php");
    exit();
}

$user = $result->fetch_assoc();

$stmt->close();

// Process update or delete operation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "update") {
            // Perform update operation
            if (isset($_POST["person_id"], $_POST["firstname"], $_POST["lastname"], $_POST["address"])) {
                $person_id = $_POST["person_id"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $address = $_POST["address"];

                $stmt = $conn->prepare("UPDATE renteraccount SET FirstName = ?, LastName = ?, Address = ? WHERE PersonID = ?");
                $stmt->bind_param("sssi", $firstname, $lastname, $address, $person_id);

                if ($stmt->execute()) {
                    // User updated successfully, redirect to users_list.php
                    header("Location: users_list.php");
                    exit();
                } else {
                    // Error occurred while updating user record
                    echo "Error updating user record: " . $stmt->error;
                }

                $stmt->close();
            }
        } elseif ($_POST["action"] === "delete") {
            // Perform delete operation
            if (isset($_POST["person_id"])) {
                $person_id = $_POST["person_id"];
                
                // Perform the delete operation
                $stmt = $conn->prepare("DELETE FROM renteraccount WHERE PersonID = ?");
                $stmt->bind_param("i", $person_id);
                $stmt->execute();

                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    // Redirect back to users_list.php after successful delete
                    header("Location: users_list.php");
                    exit();
                } else {
                    // No rows affected
                    echo "Error: User not found or already deleted.";
                }

                $stmt->close();
            }
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
    <title>Configure User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Configure User</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="person_id" value="<?php echo $user['PersonID']; ?>">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo $user['FirstName']; ?>" required>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $user['LastName']; ?>" required>

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $user['Address']; ?>" required>

            <input type="submit" name="action" value="Update">
            <input type="submit" name="action" value="Delete">
        </form>
    </div>
</body>
</html>
