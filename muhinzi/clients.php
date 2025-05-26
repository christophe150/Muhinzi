<?php include 'views/header.php'; include 'config/db.php'; ?>

<div class="container mt-4">
  <h3>Register New Client</h3>

  <!-- Add New Client Form -->
  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label for="name" class="form-label">Client Name</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="col-md-6">
      <label for="contact" class="form-label">Contact Info</label>
      <input type="text" class="form-control" name="contact" required>
    </div>
    <div class="col-12">
      <button type="submit" name="add_client" class="btn btn-success">Add Client</button>
    </div>
  </form>

  <!-- Insert Logic -->
  <?php
  if (isset($_POST['add_client'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    $conn->query("INSERT INTO clients (name, contact) VALUES ('$name', '$contact')");
    echo "<div class='alert alert-success mt-3'>Client added successfully!</div>";
  }

  // Delete Logic
  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM clients WHERE id = $id");
    echo "<div class='alert alert-danger mt-3'>Client deleted successfully!</div>";
  }
  ?>

  <!-- Display Clients -->
  <h4 class="mt-5">List of Clients</h4>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Client Name</th>
        <th>Contact</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $res = $conn->query("SELECT * FROM clients");
      $i = 1;
      while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$i}</td>
                <td>{$row['name']}</td>
                <td>{$row['contact']}</td>
                <td>
                  <a href='clients.php?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
                  <a href='edit_client.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
                </td>
              </tr>";
        $i++;
      }
      ?>
    </tbody>
  </table>
</div>

<?php include 'views/footer.php'; ?>
