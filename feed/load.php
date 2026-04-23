<?php
include '../config/db.php';

$result = $conn->query("
    SELECT posts.*, users.username
    FROM posts
    JOIN users ON users.id = posts.user_id
    ORDER BY posts.is_pinned DESC, posts.id DESC
");

while ($row = $result->fetch_assoc()) {

    $post_id = $row['id'];

    // LIKE COUNT
    $likeCount = $conn->query("
        SELECT COUNT(*) as c FROM likes WHERE post_id=$post_id
    ")->fetch_assoc()['c'];

    // COMMENT COUNT
    $commentCount = $conn->query("
        SELECT COUNT(*) as c FROM comments WHERE post_id=$post_id
    ")->fetch_assoc()['c'];

    // ALL COMMENTS (FULL THREAD)
    $comments = $conn->query("
        SELECT comments.*, users.username
        FROM comments
        JOIN users ON users.id = comments.user_id
        WHERE post_id=$post_id
        ORDER BY comments.id ASC
    ");

    echo "<div class='post'>";

    /* HEADER */
    echo "
    <div class='header'>
        <div class='user'>
            <div class='avatar'></div>
            <div>{$row['username']}</div>
        </div>";

    if ($row['is_pinned']) {
        echo "<div class='pin'>📌</div>";
    }

    echo "</div>";

    /* CONTENT */
    echo "<div class='content'>" . nl2br(htmlspecialchars($row['content'])) . "</div>";

    /* ACTIONS */
    echo "
    <div class='actions'>
        <div>👍 {$likeCount}</div>
        <div>💬 {$commentCount}</div>
        <div>↗ Share</div>
    </div>
    ";

    /* COMMENT INPUT (IMPORTANT RETAINED) */
    echo "
    <div class='comment-box'>
        <input id='c{$post_id}' placeholder='Write a comment...'>
        <button onclick='commentPost({$post_id})'>Post</button>
    </div>
    ";

    /* FULL COMMENTS THREAD (RETAINED) */
    echo "<div class='comment-thread'>";

    while ($c = $comments->fetch_assoc()) {
        echo "
        <div class='comment'>
            <b>{$c['username']}:</b> " . htmlspecialchars($c['comment']) . "
        </div>";
    }

    echo "</div>";

    echo "</div>";
}
?>