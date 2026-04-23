<?php
include '../config/db.php';
session_start();

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

$conn->query("
    INSERT INTO comments (user_id, post_id, comment)
    VALUES ($user_id, $post_id, '$comment')
");

echo "ok";