<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card p-4 bg-secondary" style="width:350px;">
    <h4 class="text-center">Forum Login</h4>

    <form method="POST" action="process_login.php">
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>