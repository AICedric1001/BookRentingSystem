<?php
session_start();

include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Fname = $_POST["Fname"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM renteraccount WHERE FirstName = ?");
    $stmt->bind_param("s", $Fname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['Fname'] = $row['FirstName'];
            $_SESSION['PersonID'] = $row['PersonID'];
            header("Location: dashboard.php");
            exit();
        }
    }

    header("Location: login.php?error=Invalid credentials");
    exit();
}

header("Location: login.php");
exit();
?>
