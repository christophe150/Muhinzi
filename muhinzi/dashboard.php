<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
include 'views/header.php';
?>

<h3>Welcome, <?= $_SESSION['user'] ?></h3>
<div class="list-group">
    <a href="members.php" class="list-group-item">Manage Members</a>
    <a href="products.php" class="list-group-item">Manage Products</a>
    <a href="clients.php" class="list-group-item">Manage Clients</a>
    <a href="sales.php" class="list-group-item">Manage Sales</a>
    <a href="reports.php" class="list-group-item">View Reports</a>
    <a href="auth/logout.php" class="list-group-item text-danger">Logout</a>
</div>

<?php include 'views/footer.php'; ?>
