function loadPosts(){
    fetch('../api/fetch_posts.php')
    .then(res => res.text())
    .then(data => {
        document.getElementById("post-container").innerHTML = data;
    });
}

// AUTO REFRESH EVERY 3 SECONDS
setInterval(loadPosts, 3000);