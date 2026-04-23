forum_system/
│
├── assets/
│   ├── css/
│   │    └── style.css
│   ├── js/
│   │    └── main.js
│   └── img/
│
├── config/
│   └── db.php
│
├── auth/
│   ├── login.php
│   ├── register.php
│   ├── logout.php
│
├── admin/
│   ├── index.php              (admin dashboard)
│   ├── posts.php             (all posts management)
│   ├── create_post.php       (admin post)
│   ├── delete_post.php
│   └── users.php             (optional user management)
│
├── user/
│   ├── profile.php
│   └── settings.php
│
├── posts/
│   ├── create.php            (user create post)
│   ├── delete.php
│   └── edit.php
│
├── feed/
│   └── index.php            (MAIN WALL / FEED)
│
├── notifications/
│   ├── index.php
│   ├── fetch.php            (AJAX load)
│   └── mark_read.php
│
├── api/
│   ├── like.php
│   ├── comment.php
│   └── post.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   └── functions.php
│
├── index.php                (redirect to feed)
└── database.sql