# 🧩 Minimalistic Forum / Blog System (PHP + JavaScript)

A clean and lightweight discussion platform built with PHP (backend) and vanilla JavaScript (frontend). Designed for simplicity, speed, and easy deployment on shared hosting environments.

---

## 🚀 Features

### 👥 User Features
- User registration & login (session-based auth)
- Create, edit, and delete posts
- Comment on posts
- Simple user profiles
- Clean, responsive UI (vanilla JS + CSS)

### 🛠 Admin Panel
- Dashboard overview (users, posts, comments)
- Manage users (delete / promote to admin)
- Moderate posts and comments
- Role-based access control

---

## 🏗 Tech Stack

- Backend: PHP (Core PHP)
- Frontend: HTML, CSS, JavaScript (Vanilla JS)
- Database: MySQL
- Server: Apache / Nginx (XAMPP, LAMP, etc.)

---

## 📁 Project Structure

php-minimal-forum/
│── admin/
│── config/
│── includes/
│── public/
│── posts/
│── comments/
│── auth/
│── index.php
│── dashboard.php
│── database.sql

---

## 🔐 Authentication

Uses PHP Sessions

Password hashing:
password_hash($password, PASSWORD_BCRYPT);

---

## 👑 Admin Setup

Promote user to admin:
UPDATE users SET role = 'admin' WHERE email = 'your@email.com';

---

## 📡 Core Functionality

Posts:
- Create / Read / Update / Delete

Comments:
- Add / Delete

Admin:
- Manage users
- Moderate content

---

## 🎨 Customization

- CSS: /public/css/
- JS: /public/js/
- Layouts: /includes/

---

## 🔒 Security Notes

Add before production:
- CSRF protection
- Prepared statements (PDO)
- Input validation
- XSS protection (htmlspecialchars)
- Rate limiting

---

## ⚠️ Disclaimer

Minimal learning project. Not production-ready without improvements.

---

## 📜 License

MIT License

---

## 💡 Future Improvements

- AJAX comments
- Rich text editor
- Image uploads
- Notifications
- Search & pagination

---

Happy coding! 🚀