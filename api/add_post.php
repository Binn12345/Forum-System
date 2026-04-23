<?php
session_start();
include("../config/db.php");

$user = $_SESSION['user_id'];
$content = $_POST['content'];

mysqli_query($conn, "INSERT INTO posts(user_id, content) VALUES('$user','$content')");