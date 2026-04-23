<?php
include '../config/db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1;
$content = trim($_POST['content']);

$stmt = $conn->prepare("INSERT INTO posts (user_id, content, is_admin) VALUES (?, ?, 0)");
$stmt->bind_param("is", $user_id, $content);

$stmt->execute();

header("Location: ../feed/index.php");