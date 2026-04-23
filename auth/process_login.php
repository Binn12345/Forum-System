<?php
session_start();
include("../config/db.php");

$username = $_POST['username'];
$password = $_POST['password'];

// prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {

    // check password
    if (password_verify($password, $user['password'])) {

        if ($user['status'] == 'banned') {
            die("Account banned");
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        // ROUTING
        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../user/dashboard.php");
        }

    } else {
        echo "Wrong password";
    }

} else {
    echo "User not found";
}