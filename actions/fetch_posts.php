<?php
include '../config/db.php';

$sql = "SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON users.username = posts.user_id 
        ORDER BY posts.id DESC";
        // var_dump('<pre>',$sql);die;

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){
    echo "
    <div style='border:1px solid #ccc; padding:10px; margin:10px'>
        <b>{$row['username']}</b><br>
        {$row['content']}<br>
        <small>{$row['created_at']}</small>
    </div>
    ";
}
?>