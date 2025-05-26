<?php include 'views/header.php'; include 'config/db.php'; ?>

<h3>Report: Harvest per Member</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Member</th>
      <th>Total Harvest (kg)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $res = $conn->query("SELECT m.full_name, SUM(p.quantity_kg) as total
                         FROM products p
                         JOIN members m ON m.id = p.member_id
                         GROUP BY p.member_id");
    while ($row = $res->fetch_assoc()) {
      echo "<tr><td>{$row['full_name']}</td><td>{$row['total']}</td></tr>";
    }
    ?>
  </tbody>
</table>

<h3 class="mt-5">Report: Sales Summary</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Client</th>
      <th>Total Quantity (kg)</th>
      <th>Total Amount (RWF)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // $res = $conn->query("SELECT c.name, SUM(s.quantity_kg) as qty, 
    //                      SUM(s.quantity_kg * s.price_per_kg) as total 
    //                      FROM sales s 
    //                      JOIN clients c ON c.id = s.client_id 
    //                      GROUP BY c.id");
    $query = "SELECT c.name, s.quantity_kg, s.total_price FROM sales s JOIN clients c ON s.client_id = c.id";

    while ($row = $res->fetch_assoc()) {
      echo "<tr><td>{$row['name']}</td><td>{$row['qty']} kg</td><td>{$row['total']} RWF</td></tr>";
    }
    ?>
  </tbody>
</table>

<?php include 'views/footer.php'; ?>
