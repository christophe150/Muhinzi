<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
include 'config/db.php';
include 'views/header.php';

// Handle Add Member
if (isset($_POST['add'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $conn->query("INSERT INTO members (full_name, phone, address) VALUES ('$full_name', '$phone', '$address')");
    header("Location: members.php");
}

// Handle Delete Member
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM members WHERE id = $id");
    header("Location: members.php");
}
?>

<h3 class="mb-4">Manage Members</h3>

<!-- Add Member Form -->
<form method="POST" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
    </div>
    <div class="col-md-3">
        <input type="text" name="phone" class="form-control" placeholder="Phone" required>
    </div>
    <div class="col-md-4">
        <input type="text" name="address" class="form-control" placeholder="Address" required>
    </div>
    <div class="col-md-1">
        <button type="submit" name="add" class="btn btn-success">Add</button>
    </div>
</form>

<!-- Members Table -->
<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $members = $conn->query("SELECT * FROM members");
        $i = 1;
        while ($row = $members->fetch_assoc()):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td>
                <a href="edit_member.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>
