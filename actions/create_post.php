<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['username'];
$content = $_POST['content'];
// var_dump('<pre>',$_POST);die;
$conn->query("INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')");
?>