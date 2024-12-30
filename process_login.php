<?php

session_start();

// include "dbconnection";

$servername = "localhost";
$dbusername = "root"; // Changed variable name to avoid conflict
$password = "";
$dbname = "knowledgemarketingdb";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // // Validate input
    // if (empty($username) || empty($password)) {
    //     echo "Both fields are required.";
    //     exit;
    // }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username; // Store the logged-in username
            echo "success";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User  not found.";
    }

    $stmt->close();
    $conn->close();
}
?>