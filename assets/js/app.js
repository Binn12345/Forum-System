function loadPosts(){
    fetch('../api/fetch_posts.php')
    .then(res => res.text())
    .then(data => {
        document.getElementById("post-container").innerHTML = data;
    });
}

// AUTO REFRESH EVERY 3 SECONDS
setInterval(loadPosts, 1500);


function createPost(){
    let content = document.getElementById("postContent").value;

    fetch("../actions/create_post.php", {
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: "content=" + content
    }).then(() => {
        document.getElementById("postContent").value = "";
        loadPosts();
    });
}

function loadPosts(){
    fetch("../actions/fetch_posts.php")
    .then(res => res.text())
    .then(data => {
        document.getElementById("feed").innerHTML = data;
    });
}

// AUTO REFRESH (REAL TIME)
setInterval(loadPosts, 1500);


const textarea = document.getElementById("postContent");

textarea.addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
});