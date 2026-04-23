forum-system/
│
├── config/
│   └── db.php
│
├── auth/
│   ├── login.php
│   ├── register.php
│   ├── process_login.php
│   ├── process_register.php
│   └── logout.php
│
├── admin/
│   ├── dashboard.php
│   ├── users.php
│   └── posts.php
│
├── user/
│   ├── dashboard.php
│   ├── post.php
│   └── profile.php
│
├── api/  ← REAL-TIME PART
│   ├── fetch_posts.php
│   ├── fetch_comments.php
│   ├── add_post.php
│   ├── add_comment.php
│   └── like_post.php
│
├── assets/
│   ├── css/
│   ├── js/
│   │   └── app.js
│   └── img/
│
├── index.php
└── .htaccess