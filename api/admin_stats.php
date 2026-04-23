<?php
include("../config/db.php");

$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$posts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM posts WHERE status='visible'"))['total'];
$comments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM comments WHERE status='visible'"))['total'];

echo json_encode([
    "users" => $users,
    "posts" => $posts,
    "comments" => $comments
]);