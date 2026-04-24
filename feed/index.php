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

.topbar{
    background:#1877f2;
    color:white;
    padding:12px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.topbar-right{
    display:flex;
    gap:10px;
}

.logout-btn{
    background:#ff4d4f;
    color:white;
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
}

.container{
    max-width:600px;
    margin:20px auto;
}

.post-box{
    background:white;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
}

textarea{
    width:100%;
    min-height:50px;
    border-radius:8px;
    padding:10px;
    resize:none;
}

button{
    margin-top:10px;
    width:100%;
    background:#1877f2;
    color:white;
    padding:10px;
    border:none;
    border-radius:8px;
}

/* PREVIEW */
.preview{
    display:flex;
    gap:5px;
    margin-top:10px;
    flex-wrap:wrap;
}
.preview img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:6px;
}

/* POSTS */
.post{
    background:white;
    padding:15px;
    margin-bottom:10px;
    border-radius:10px;
}

.image-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:5px;
    margin-top:10px;
}
.image-grid img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:6px;
}
</style>
</head>

<body>

<div class="topbar">
    <div>Forum System</div>
    <div class="topbar-right">
        Hi <?= $_SESSION['user']['username'] ?>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="container">

<div class="post-box">
    <textarea id="postContent" placeholder="What's on your mind?"></textarea>

    <input type="file" id="images" multiple>

    <div id="preview" class="preview"></div>

    <button onclick="createPost()">Post</button>
</div>

<div id="feed"></div>

</div>

<script>
// AUTO RESIZE
let textarea = document.getElementById("postContent");
textarea.addEventListener("input", function(){
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

// IMAGE PREVIEW
document.getElementById("images").addEventListener("change", function(){
    let preview = document.getElementById("preview");
    preview.innerHTML = "";

    Array.from(this.files).forEach(file=>{
        let reader = new FileReader();
        reader.onload = e=>{
            let img = document.createElement("img");
            img.src = e.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
});

// CREATE POST
function createPost(){
    let content = document.getElementById("postContent").value;
    let files = document.getElementById("images").files;

    let formData = new FormData();
    formData.append("content", content);

    for(let i=0;i<files.length;i++){
        formData.append("images[]", files[i]);
    }

    fetch("../actions/create_post.php",{
        method:"POST",
        body:formData
    }).then(()=>{
        document.getElementById("postContent").value="";
        document.getElementById("images").value="";
        document.getElementById("preview").innerHTML="";
        loadPosts();
    });
}

// LOAD POSTS
function loadPosts(){
    fetch("../actions/fetch_posts.php")
    .then(res=>res.text())
    .then(data=>{
        document.getElementById("feed").innerHTML = data;
    });
}

setInterval(loadPosts, 2000);
loadPosts();
</script>

</body>
</html>