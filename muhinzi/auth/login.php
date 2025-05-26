<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: ../dashboard.php");
    } else {
        echo "Invalid login.";
    }
}
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<form method="POST" class="container mt-5">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" class="form-control mb-2 " required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <button type="submit" class="btn btn-success mt-3">Login</button>
</form>



