<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="text-white">

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-black px-3">
        <span class="navbar-brand">ADMIN PANEL</span>

        <div>
            <?= $_SESSION['username'] ?> |
            <a href="../auth/logout.php" class="text-warning">Logout</a>
        </div>
    </nav>



    <div class="container mt-4">

        <div class="card shadow border-0 p-3 bg-dark text-white rounded-4 mt-3">

            <h5>
                Notifications
                <span id="notifCount" class="badge bg-danger">0</span>
            </h5>

            <div id="notifBox" style="max-height:200px; overflow:auto;">
                Loading...
            </div>

        </div>

        <!-- HEADER -->
        <div class="text-center mb-3 text-muted">
            <small>Live Admin Monitoring System</small>
        </div>

        <!-- STATS -->
        <div class="row g-3">

            <div class="col-md-4">
                <div class="card shadow border-0 p-3 rounded-4 bg-primary text-white">
                    <h5>Total Users</h5>
                    <h2 id="totalUsers">0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 p-3 rounded-4 bg-success text-white">
                    <h5>Total Posts</h5>
                    <h2 id="totalPosts">0</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 p-3 rounded-4 bg-warning text-dark">
                    <h5>Total Comments</h5>
                    <h2 id="totalComments">0</h2>
                </div>
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="mt-4">
            <a href="users.php" class="btn btn-light">Manage Users</a>
            <a href="posts.php" class="btn btn-light">Manage Posts</a>
        </div>

        <!-- LAST UPDATED -->
        <small class="text-warning d-block mt-2">
            Last updated: <span id="lastUpdate"></span>
        </small>

        <hr class="text-secondary">

        <!-- ACTIVITY FEED -->
        <div class="card shadow border-0 p-3 bg-dark text-white rounded-4">

            <h5 class="mb-3">Live Activity</h5>

            <div id="activityFeed" style="max-height:300px; overflow:auto;">
                Loading...
            </div>

        </div>

        
        <hr class="text-secondary">

        <!-- ACTIVITY FEED -->
        <div class="card shadow border-0 p-3 bg-dark text-white rounded-4">

            <h5 class="mb-3">Feed</h5>



            <div id="feed" style="max-height:300px; overflow:auto;"> Loading...</div>

        </div>


    </div>

    <!-- JS -->
    <script>

        
function loadPosts(){
    fetch("../actions/fetch_posts.php")
    .then(res => res.text())
    .then(data => {
        document.getElementById("feed").innerHTML = data;
    });
}

setInterval(loadPosts, 2000);
loadPosts();


        function loadStats() {
            fetch('../api/admin_stats.php')
                .then(res => res.json())
                .then(data => {

                    document.getElementById("totalUsers").innerText = data.users;
                    document.getElementById("totalPosts").innerText = data.posts;
                    document.getElementById("totalComments").innerText = data.comments;

                    document.getElementById("lastUpdate").innerText =
                        new Date().toLocaleTimeString();
                });
        }

        function loadActivity() {
            fetch('../api/admin_activity.php')
                .then(res => res.text())
                .then(data => {
                    document.getElementById("activityFeed").innerHTML = data;
                });
        }

        function refreshAll() {
            loadStats();
            loadActivity();
        }

        // INITIAL LOAD
        refreshAll();

        // REAL-TIME LOOP
        setInterval(refreshAll, 1000);

        function loadNotifications() {
            fetch('../api/admin_notifications.php')
                .then(res => res.text())
                .then(data => {
                    document.getElementById("notifBox").innerHTML = data;

                    // simple badge count update
                    let count = (data.match(/alert/g) || []).length;
                    document.getElementById("notifCount").innerText = count;
                });
        }

        // INITIAL
        loadNotifications();

        // REAL-TIME EVERY 3 SECONDS
        setInterval(loadNotifications, 3000);

        // function clearNotifications() {
        //     fetch('../api/mark_notifications.php')
        //     .then(() => loadNotifications());
        // }
    </script>

</body>

</html>