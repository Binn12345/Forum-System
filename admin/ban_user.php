<?php
include("../config/db.php");

$id = $_GET['id'];

mysqli_query($conn, "UPDATE users SET status='banned' WHERE id='$id'");

header("Location: users.php");