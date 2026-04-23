<?php
include '../config/db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1;

$posts = $conn->query("
    SELECT posts.*, users.username
    FROM posts
    JOIN users ON posts.user_id = users.id
    ORDER BY posts.is_pinned DESC, posts.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Forum Feed</title>

<style>

    .post {
    background: #fff;
    border-radius: 14px;
    padding: 14px;
    margin-bottom: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.comment-box {
    display: flex;
    gap: 8px;
    margin-top: 10px;
}

.comment-box input {
    flex: 1;
    padding: 8px 10px;
    border-radius: 20px;
    border: 1px solid #ddd;
    outline: none;
}

.comment-box button {
    border: none;
    background: #1877f2;
    color: white;
    padding: 8px 14px;
    border-radius: 20px;
    cursor: pointer;
}

.comment-box button:hover {
    background: #145dc1;
}

.comment-thread {
    margin-top: 10px;
    padding-left: 5px;
}

.comment {
    background: #f0f2f5;
    padding: 6px 10px;
    border-radius: 10px;
    margin-top: 6px;
    font-size: 13px;
}

.user {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg,#1877f2,#42a5f5);
}

.content {
    font-size: 15px;
    line-height: 1.5;
    margin-bottom: 10px;
}

.actions {
    display: flex;
    justify-content: space-around;
    border-top: 1px solid #eee;
    padding-top: 10px;
    font-size: 14px;
    color: #555;
}

.comment-preview {
    margin-top: 10px;
}

.comment {
    background: #f0f2f5;
    padding: 6px 10px;
    border-radius: 10px;
    margin-top: 5px;
    font-size: 13px;
}

.pin {
    color: #1877f2;
}
body {
    font-family: system-ui, Arial;
    background: #eef0f3;
    margin: 0;
    color: #1c1e21;
}

.container {
    max-width: 600px;
    margin: 20px auto;
}

/* POST */
.post {
    background: #fff;
    border-radius: 14px;
    padding: 14px;
    margin-bottom: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: 0.2s;
}

.post:hover {
    transform: translateY(-2px);
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.user {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg,#1877f2,#42a5f5);
}

/* CONTENT */
.content {
    font-size: 15px;
    line-height: 1.5;
    margin-bottom: 12px;
}

/* ACTIONS */
.actions {
    display: flex;
    justify-content: space-around;
    border-top: 1px solid #eee;
    padding-top: 10px;
    margin-top: 10px;
    font-size: 14px;
}

.actions div {
    cursor: pointer;
    padding: 6px 10px;
    border-radius: 8px;
    transition: 0.2s;
}

.actions div:hover {
    background: #f0f2f5;
}

/* COMMENT BOX */
.comment-box {
    display: flex;
    gap: 8px;
    margin-top: 10px;
}

.comment-box input {
    flex: 1;
    padding: 8px 10px;
    border-radius: 20px;
    border: 1px solid #ddd;
    outline: none;
}

.comment-box button {
    border: none;
    background: #1877f2;
    color: white;
    padding: 8px 14px;
    border-radius: 20px;
    cursor: pointer;
}

.comment-box button:hover {
    background: #145dc1;
}

/* COMMENTS */
.comment {
    background: #f0f2f5;
    padding: 6px 10px;
    border-radius: 10px;
    margin-top: 6px;
    font-size: 13px;
}

.pin {
    color: #1877f2;
    font-size: 18px;
}
</style>
</head>

<body>

<div class="container">

<div id="feed">

<?php while ($row = $posts->fetch_assoc()) { ?>

<?php
$post_id = $row['id'];

$likeCount = $conn->query("
    SELECT COUNT(*) as c FROM likes WHERE post_id=$post_id
")->fetch_assoc()['c'];

$commentCount = $conn->query("
    SELECT COUNT(*) as c FROM comments WHERE post_id=$post_id
")->fetch_assoc()['c'];

$comments = $conn->query("
    SELECT comments.*, users.username
    FROM comments
    JOIN users ON users.id = comments.user_id
    WHERE post_id=$post_id
    ORDER BY comments.id DESC
    LIMIT 3
");
?>

<div class="post">

    <!-- HEADER -->
    <div class="header">
        <div class="user">
            <div class="avatar"></div>
            <div><?= $row['username'] ?></div>
        </div>

        <?php if ($row['is_pinned']) { ?>
            <div class="pin">📌</div>
        <?php } ?>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <?= nl2br($row['content']) ?>
    </div>

    <!-- ACTIONS -->
    <div class="actions">
        <div onclick="likePost(<?= $post_id ?>, this)">
            👍 <?= $likeCount ?>
        </div>

        <div>
            💬 <?= $commentCount ?>
        </div>

        <div>↗ Share</div>
    </div>

    <!-- COMMENT INPUT -->
    <div class="comment-box">
        <input id="c<?= $post_id ?>" placeholder="Write a comment...">
        <button onclick="commentPost(<?= $post_id ?>)">Post</button>
    </div>

    <!-- COMMENTS -->
    <div id="comments<?= $post_id ?>">
        <?php while ($c = $comments->fetch_assoc()) { ?>
            <div class="comment">
                <b><?= $c['username'] ?>:</b> <?= $c['comment'] ?>
            </div>
        <?php } ?>
    </div>

</div>

<?php } ?>

</div>

</div>

<script>
/* LIKE */
function likePost(postId, el) {
    fetch('../api/like.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'post_id=' + postId
    })
    .then(res => res.json())
    .then(data => {
        el.innerHTML = "👍 " + data.count;
    });
}

/* COMMENT */
function commentPost(postId) {
    let input = document.getElementById("c" + postId);

    if (!input.value.trim()) return;

    fetch('../api/comment.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'post_id=' + postId + '&comment=' + input.value
    }).then(() => {
        location.reload();
    });
}

/* REAL-TIME REFRESH */
setInterval(() => {
    fetch('load.php')
    .then(res => res.text())
    .then(html => {
        document.getElementById("feed").innerHTML = html;
    });
}, 5000);
</script>

</body>
</html>