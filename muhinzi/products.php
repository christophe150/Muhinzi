<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
include 'config/db.php';
include 'views/header.php';

// Add product
if (isset($_POST['add'])) {
    $member_id = $_POST['member_id'];
    $quantity_kg = $_POST['quantity_kg'];
    $date_received = $_POST['date_received'];

    $conn->query("INSERT INTO products (member_id, quantity_kg, date_received) 
                  VALUES ('$member_id', '$quantity_kg', '$date_received')");
    header("Location: products.php");
}

// Delete product
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM products WHERE id = " . $_GET['delete']);
    header("Location: products.php");
}
?>

<h3 class="mb-4">Manage Products (Maize Harvests)</h3>

<!-- Add Product Form -->
<form method="POST" class="row g-3 mb-4">
    <div class="col-md-4">
        <select name="member_id" class="form-control" required>
            <option value="">Select Member</option>
            <?php
            $members = $conn->query("SELECT * FROM members");
            while ($m = $members->fetch_assoc()) {
                echo "<option value='{$m['id']}'>{$m['full_name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <input type="number" step="0.01" name="quantity_kg" class="form-control" placeholder="Quantity (kg)" required>
    </div>
    <div class="col-md-3">
        <input type="date" name="date_received" class="form-control" required>
    </div>
    <div class="col-md-2">
        <button type="submit" name="add" class="btn btn-success w-100">Add</button>
    </div>
</form>

<!-- Product Table -->
<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>#</th>
            <th>Member</th>
            <th>Quantity (kg)</th>
            <th>Date Received</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $results = $conn->query("SELECT p.id, m.full_name, p.quantity_kg, p.date_received 
                                 FROM products p JOIN members m ON p.member_id = m.id");
        $i = 1;
        while ($row = $results->fetch_assoc()):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['quantity_kg'] ?></td>
            <td><?= $row['date_received'] ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'views/footer.php'; ?>
