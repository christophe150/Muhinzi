<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "User created successfully. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<form method="POST" class="container mt-5">
    <h2>Register Admin</h2>
    <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
    <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
