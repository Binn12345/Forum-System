<?php
include("../config/db.php");

$sql = mysqli_query($conn, "
    SELECT al.*, u.username 
    FROM activity_logs al
    LEFT JOIN users u ON u.id = al.admin_id
    ORDER BY al.id DESC
    LIMIT 10
");

while ($row = mysqli_fetch_assoc($sql)) {
?>
    <div class="border-bottom py-2">
        <b><?= $row['username'] ?? 'System' ?></b><br>
        <small><?= $row['action'] ?></small><br>
        <small class="text-muted"><?= $row['created_at'] ?></small>
    </div>
<?php } ?>