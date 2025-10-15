<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;
?>

<div class="container mt-4">
  <?php if (isset($_SESSION['alert'])): ?>
  <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['alert']['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['alert']); ?>
<?php endif; ?>

  <h4 class="mb-3">REQUISITION AND ISSUE SLIP</h4>
  <form action="/ivs/includes/modalsconn/stockin.add.php" method="POST" id="stockInForm">

    <!-- Item -->
    <div class="row g-3">
      <div class="col-md-6">
        <label for="item_id" class="form-label">Select Item</label>
        <select class="form-select" id="item_id" name="item_id" required>
          <option value="" selected disabled>Select an Item</option>
          <?php
          $items = $conn->query("SELECT item_id, item_name, fund_cluster, unit, initial_quantity FROM tbl_item");
          while ($row = $items->fetch_assoc()):
          ?>
          <option 
            value="<?= $row['item_id'] ?>" 
            data-fund-cluster="<?= $row['fund_cluster'] ?>" 
            data-unit="<?= $row['unit'] ?>"
            data-quantity="<?= $row['initial_quantity'] ?>">
            <?= htmlspecialchars($row['item_name']) ?>
          </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Quantity -->
      <div class="col-md-3">
        <label for="quantity_received" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity_received" name="quantity_received" min="1" required>
      </div>

      <!-- Unit (Auto-filled) -->
      <div class="col-md-3">
        <label for="unit_display" class="form-label">Unit of Measure</label>
        <input type="text" class="form-control" id="unit_display" readonly placeholder="Unit">
        <input type="hidden" id="unit" name="unit">
      </div>

      <!-- Fund Cluster -->
      <div class="col-md-3">
        <label class="form-label">Fund Cluster</label>
        <input type="text" class="form-control" id="fund_cluster_display" readonly placeholder="Fund Cluster">
        <input type="hidden" id="fund_cluster" name="fund_cluster">
      </div>

      
      <!-- Available Stock -->
      <div class="col-md-3">
        <label class="form-label">Available Stock</label>
        <input type="text" class="form-control" id="available_stock" readonly placeholder="Available Stock">
      </div>
    </div>
  </form>
</div>

<!-- Modal (RIS Creation Confirmation) -->
<div class="modal fade" id="risModal" tabindex="-1" aria-labelledby="risModalLabel" aria-hidden="true">
  <div class="modal-dialog animate__animated animate__fadeIn" style="margin-top: 5vh;">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="risModalLabel">Item Available</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The item is available. Do you want to proceed with creating the RIS?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addRISModal">
        <i class="fa-solid "></i>Proceed</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal (Exceed Quantity Warning) -->
<div class="modal fade" id="exceedModal" tabindex="-1" aria-labelledby="exceedModalLabel" aria-hidden="true">
  <div class="modal-dialog animate__animated animate__shakeX" style="margin-top: 5vh;">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exceedModalLabel">Insufficient Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The requested quantity exceeds the available stock. Please modify your request or consult the inventory officer.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . "/../modals/addris.modal.php"; ?>