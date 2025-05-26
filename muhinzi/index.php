<?php
session_start();
include 'views/header.php'; include 'config/db.php'; ?>

<h2>Welcome, <?= $_SESSION['user'] ?> 👋</h2>
<p>This is the dashboard for TWIGIRE MUHINZI Cooperative.</p>

<div class="row mt-4">
  <div class="col-md-3">
    <div class="card text-white bg-primary">
      <div class="card-body">
        <h5 class="card-title">Total Members</h5>
        <p class="card-text">
          <?php
          $res = $conn->query("SELECT COUNT(*) as total FROM members");
          echo $res->fetch_assoc()['total'];
          ?>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-success">
      <div class="card-body">
        <h5 class="card-title">Total Maize (kg)</h5>
        <p class="card-text">
          <?php
          $res = $conn->query("SELECT SUM(quantity_kg) as total FROM products");
          echo $res->fetch_assoc()['total'] . " kg";
          ?>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-warning">
      <div class="card-body">
        <h5 class="card-title">Total Sales (RWF)</h5>
        <p class="card-text">
          <?php
          $res = $conn->query("SELECT SUM(quantity_kg * price_per_kg) as total FROM sales");
          echo $res->fetch_assoc()['total'] . " RWF";
          ?>
        </p>
      </div>
    </div>
  </div>
</div>

<?php include 'views/footer.php'; ?>
