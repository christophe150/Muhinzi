<?php include 'views/header.php'; include 'config/db.php'; ?>

<h3>Record New Sale</h3>
<form method="POST" class="row g-3">
  <div class="col-md-4">
    <label>Client</label>
    <select name="client_id" class="form-select">
      <?php
      $clients = $conn->query("SELECT * FROM clients");
      while ($row = $clients->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
      }
      ?>
    </select>
  </div>
  <div class="col-md-3">
    <label>Quantity (kg)</label>
    <input type="number" step="0.01" name="quantity_kg" class="form-control" required>
  </div>
  <div class="col-md-3">
    <label>Price per kg</label>
    <input type="number" step="0.01" name="price_per_kg" class="form-control" required>
  </div>
  <div class="col-md-2">
    <label>Sale Date</label>
    <input type="date" name="sale_date" class="form-control" required>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" name="submit">Add Sale</button>
  </div>
</form>

<?php
if (isset($_POST['submit'])) {
  $client_id = $_POST['client_id'];
  $quantity_kg = $_POST['quantity_kg'];
  $price_per_kg = $_POST['price_per_kg'];
  $sale_date = $_POST['sale_date'];

  $conn->query("INSERT INTO sales (client_id, quantity_kg, price_per_kg, sale_date)
                VALUES ('$client_id', '$quantity_kg', '$price_per_kg', '$sale_date')");
  echo "<div class='alert alert-success mt-2'>Sale recorded successfully!</div>";
// $query = "INSERT INTO sales (member_id, product_id, quantity, total_price, sale_date) 
//           VALUES ('$member_id', '$product_id', '$quantity', '$total_price', NOW())";

}
?>

<h4 class="mt-5">Sales Records</h4>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Client</th>
      <th>Quantity</th>
      <th>Price/kg</th>
      <th>Total</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $result = $conn->query("SELECT sales.*, clients.name FROM sales
                            JOIN clients ON sales.client_id = clients.id");
    $i = 1;
    while ($row = $result->fetch_assoc()) {
      $total = $row['quantity_kg'] * $row['price_per_kg'];
      echo "<tr>
              <td>{$i}</td>
              <td>{$row['name']}</td>
              <td>{$row['quantity_kg']} kg</td>
              <td>{$row['price_per_kg']} RWF</td>
              <td>{$total} RWF</td>
              <td>{$row['sale_date']}</td>
            </tr>";
      $i++;
    }
    ?>
  </tbody>
</table>

<?php include 'views/footer.php'; ?>
