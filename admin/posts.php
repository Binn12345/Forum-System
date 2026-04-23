<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$sql = mysqli_query($conn, "
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON users.id = posts.user_id 
    ORDER BY posts.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h3>Posts Management</h3>

    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>

        <div class="card mb-2">
            <div class="card-body">

                <b><?= $row['username'] ?></b>
                <p><?= $row['content'] ?></p>

                <a href="delete_post.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                    Delete
                </a>

            </div>
        </div>

    <?php } ?>

</div>

</body>
</html>