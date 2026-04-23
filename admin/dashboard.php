<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// COUNT USERS
$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];

// COUNT POSTS
$posts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM posts"))['total'];

// COUNT COMMENTS
$comments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM comments"))['total'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

    <!-- NAV -->
    <nav class="navbar navbar-dark bg-black px-3">
        <span class="navbar-brand">ADMIN PANEL</span>

        <div>
            <?= $_SESSION['username'] ?> |
            <a href="../auth/logout.php" class="text-warning">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">

        <div class="row">

            <div class="col-md-4">
                <div class="card bg-primary text-white p-3">
                    <h4>Total Users</h4>
                    <h2 id="totalUsers">0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white p-3">
                    <h4>Total Posts</h4>
                    <h2 id="totalPosts">0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-warning text-dark p-3">
                    <h4>Total Comments</h4>
                    <h2 id="totalComments">0</h2>
                </div>
            </div>

        </div>

        <hr>

        <a href="users.php" class="btn btn-light">Manage Users</a>
        <a href="posts.php" class="btn btn-light">Manage Posts</a>

        <small class="text-warning d-block mt-2">
            Last updated: <span id="lastUpdate"></span>
        </small>

        <hr>
        
        <!-- ACTIVITY FEED -->
        <div class="col-md-12">
            <div class="card shadow p-3">

                <h5>Live Activity</h5>

                <div id="activityFeed" style="max-height:300px; overflow:auto;">
                    Loading...
                </div>

            </div>
        </div>

    </div>

    <!-- <div class="row mt-4">


    </div> -->


    <script>
        function loadStats() {
            fetch('../api/admin_stats.php')
                .then(res => res.json())
                .then(data => {

                    document.getElementById("totalUsers").innerText = data.users;
                    document.getElementById("totalPosts").innerText = data.posts;
                    document.getElementById("totalComments").innerText = data.comments;

                    document.getElementById("lastUpdate").innerText = new Date().toLocaleTimeString();
                });
        }

        // initial load
        loadStats();

        // auto refresh every 3 seconds
        setInterval(loadStats, 3000);


        function loadActivity() {
            fetch('../api/admin_activity.php')
                .then(res => res.text())
                .then(data => {
                    document.getElementById("activityFeed").innerHTML = data;
                });
        }

        loadActivity();
        setInterval(loadActivity, 3000);
    </script>

</body>

</html>