<?php
include("../config/db.php");

$sql = mysqli_query($conn, "
    SELECT * FROM notifications
    WHERE is_read = 0
    ORDER BY id DESC
    LIMIT 5
");

while ($row = mysqli_fetch_assoc($sql)) {
?>
    <div class="alert alert-<?= $row['type'] ?> py-1 mb-1">
        <?= $row['message'] ?>
        <br>
        <small><?= $row['created_at'] ?></small>
    </div>
<?php } ?>