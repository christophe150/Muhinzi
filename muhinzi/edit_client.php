<?php include 'views/header.php'; include 'config/db.php'; ?>

<?php
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM clients WHERE id = $id");
$client = $res->fetch_assoc();

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $contact = $_POST['contact'];
  $conn->query("UPDATE clients SET name = '$name', contact = '$contact' WHERE id = $id");
  header("Location: clients.php");
}
?>

<div class="container mt-4">
  <h3>Edit Client</h3>
  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label for="name" class="form-label">Client Name</label>
      <input type="text" name="name" class="form-control" value="<?= $client['name'] ?>" required>
    </div>
    <div class="col-md-6">
      <label for="contact" class="form-label">Contact Info</label>
      <input type="text" name="contact" class="form-control" value="<?= $client['contact'] ?>" required>
    </div>
    <div class="col-12">
      <button type="submit" name="update" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>

<?php include 'views/footer.php'; ?>
