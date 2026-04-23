<?php session_start(); 

// echo password_hash("admin123", PASSWORD_DEFAULT);die;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forum Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card p-4 shadow" style="width: 350px;">

        <h4 class="text-center mb-3">Login</h4>

        <form method="POST" action="process_login.php">

            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <button class="btn btn-primary w-100">Login</button>

        </form>

    </div>

</div>

</body>
</html>