<?php
session_start();
include("../config/db.php");

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
$data = mysqli_fetch_assoc($sql);

if($data && password_verify($pass, $data['password'])){

    $_SESSION['user_id'] = $data['id'];
    $_SESSION['role'] = $data['role'];

    if($data['role'] == 'admin'){
        header("Location: ../admin/dashboard.php");
    }else{
        header("Location: ../user/dashboard.php");
    }

}else{
    echo "Invalid login";
}