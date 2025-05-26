<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$id = $_GET['id'];
$member = $conn->query("SELECT * FROM members WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("UPDATE members SET full_name='$full_name', phone='$phone', address='$address' WHERE id=$id");
    header("Location: members.php");
}
include 'views/header.php';
?>

<h3>Edit Member</h3>
<form method="POST" class="row g-3">
    <div class="col-md-4">
        <input type="text" name="full_name" class="form-control" value="<?= $member['full_name'] ?>" required>
    </div>
    <div class="col-md-3">
        <input type="text" name="phone" class="form-control" value="<?= $member['phone'] ?>" required>
    </div>
    <div class="col-md-4">
        <input type="text" name="address" class="form-control" value="<?= $member['address'] ?>" required>
    </div>
    <div class="col-md-1">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </div>
</form>

<?php include 'views/footer.php'; ?>
