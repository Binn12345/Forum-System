<?php
include("../config/db.php");

$sql = mysqli_query($conn, "
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON users.id = posts.user_id 
    ORDER BY posts.id DESC
");

while($row = mysqli_fetch_assoc($sql)){
?>
<div class="card mb-2">
    <div class="card-body">
        <b><?= $row['username'] ?></b>
        <p><?= $row['content'] ?></p>
        <small><?= $row['created_at'] ?></small>
    </div>
</div>
<?php } ?>