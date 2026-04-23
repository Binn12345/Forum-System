<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forum Feed</title>

    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f0f2f5;
        }

        /* TOP NAV */
        .topbar{
            background:#1877f2;
            color:white;
            padding:12px 20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-size:16px;
            font-weight:bold;
        }

        .topbar-left{
            font-size:18px;
        }

        .topbar-right{
            display:flex;
            align-items:center;
            gap:12px;
            font-size:14px;
        }

        .logout-btn{
            background:#ff4d4f;
            color:white;
            padding:6px 12px;
            border-radius:6px;
            text-decoration:none;
            font-weight:bold;
            transition:0.2s;
        }

        .logout-btn:hover{
            background:#d9363e;
        }

        /* CONTAINER */
        .container{
            max-width:600px;
            margin:20px auto;
            padding:0 10px;
        }

        /* POST BOX */
        .post-box{
            background:white;
            padding:15px;
            border-radius:10px;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
            margin-bottom:15px;
        }

        .composer textarea{
            width:100%;
            min-height:50px;
            max-height:200px;
            padding:12px 14px;
            border:1px solid #ddd;
            border-radius:10px;
            font-size:14px;
            resize:none;
            outline:none;
            transition:0.2s;
            box-sizing:border-box;
        }

        .composer textarea:focus{
            border-color:#1877f2;
            box-shadow:0 0 0 3px rgba(24,119,242,0.15);
        }

        button{
            margin-top:10px;
            background:#1877f2;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
            width:100%;
            font-weight:bold;
        }

        button:hover{
            background:#165cdb;
        }

        /* POST CARD */
        .post{
            background:white;
            padding:15px;
            border-radius:10px;
            margin-bottom:12px;
            box-shadow:0 2px 6px rgba(0,0,0,0.08);
        }

        .username{
            font-weight:bold;
            color:#1877f2;
        }

        .time{
            font-size:12px;
            color:gray;
        }

        .content{
            margin-top:8px;
            font-size:14px;
        }

        /* MOBILE */
        @media (max-width:600px){
            .composer textarea{
                font-size:13px;
                padding:10px;
            }

            .topbar{
                font-size:14px;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="topbar">
    <div class="topbar-left">Forum System</div>

    <div class="topbar-right">
        <span>Hi, <b><?= $_SESSION['username'] ?></b></span>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="container">

    <!-- POST BOX -->
    <div class="post-box">
        <!-- <div style="margin-bottom:8px;">
            Create a Post
        </div> -->

        <div class="composer">
            <textarea id="postContent" placeholder="What's on your mind?" rows="1"></textarea>
        </div>

        <button onclick="createPost()">Post</button>
    </div>

    <!-- FEED -->
    <div id="feed"></div>

</div>

<script src="../assets/js/app.js"></script>

<script>
// load feed
loadPosts();

// auto resize textarea
const textarea = document.getElementById("postContent");
textarea.addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
});
</script>

</body>
</html>