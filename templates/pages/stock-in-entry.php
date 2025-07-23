<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT * FROM tbl_item ORDER BY item_id ASC";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()):
    
// $query = "SELECT * FROM tbl_supplier ORDER BY supplier_id ASC";
// $result = $conn->query($query);

?>

<?php endwhile; ?>

<div class="container mt-4">
  <h4 class="mb-3">Stock-In Entry</h4>
  <form action="/ivs/includes/modalsconn/stockin.add.php" method="POST" id="stockInForm">

    <div class="row g-3">
      <div class="col-md-6">
        <label for="item_id" class="form-label">Select Item</label>
        <select class="form-select" id="item_id" name="item_id" required>
        <option value="" selected disabled>Select an Item</option>
        <?php
        $items = $conn->query("SELECT item_id, item_name, fund_cluster FROM tbl_item");
        while ($row = $items->fetch_assoc()):
        ?>
        <option value="<?= $row['item_id'] ?>" data-fund-cluster="<?= $row['fund_cluster'] ?>">
        <?= htmlspecialchars($row['item_name']) ?>
        </option>
        <?php endwhile; ?>
        </select>
      </div>

      <div class="col-md-3">
        <label for="quantity_received" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity_received" name="quantity_received" min="1" required>
      </div>

      <div class="col-md-3">
        <label for="price" class="form-label">Unit Cost (₱)</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
      </div>

            <div class="col-md-6">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id" required>
                <option value="" selected disabled>Select a Supplier</option>
                <?php
                $suppliers = $conn->query("SELECT supplier_id, supplier_name, contact_person FROM tbl_supplier ORDER BY supplier_name ASC");
                while ($supplier = $suppliers->fetch_assoc()):
                ?>
                <option value="<?= $supplier['supplier_id'] ?>">
                    <?= htmlspecialchars($supplier['supplier_name']) ?> (<?= htmlspecialchars($supplier['contact_person']) ?>)
                </option>
                <?php endwhile; ?>
            </select>
            </div>

      <div class="col-md-3">
        <label for="date_received" class="form-label">Date Received</label>
        <input type="date" class="form-control" id="date_received" name="date_received" value="<?= date('Y-m-d') ?>" required>
      </div>

<div class="col-md-3">
  <label class="form-label">Fund Cluster</label>
  <input type="text" class="form-control" id="fund_cluster_display" readonly placeholder="Fund Cluster">
  <input type="hidden" id="fund_cluster" name="fund_cluster">
</div>


      <div class="col-md-4">
        <label for="remarks" class="form-label">Remarks (Optional)</label>
        <input type="text" class="form-control" id="remarks" name="remarks">
      </div>

    <div class="col-md-4">
        <label for="received_by" class="form-label">Received By</label>
<input type="text" class="form-control" value="<?= $_SESSION['username'] ?? '' ?>" disabled>
<input type="hidden" name="received_by" value="<?= $_SESSION['username'] ?? '' ?>">
      </div>
    </div>

    <div class="mt-4 text-end">
      <button type="submit" class="btn btn-success">Add Stock-In</button>
    </div>
  </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const itemSelect = document.getElementById('item_id');
  const fundClusterDisplay = document.getElementById('fund_cluster_display');
  const fundClusterHidden = document.getElementById('fund_cluster');

  itemSelect.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const fundCluster = selectedOption.getAttribute('data-fund-cluster');

    if (fundCluster) {
      fundClusterDisplay.value = fundCluster;
      fundClusterHidden.value = fundCluster;
    }
  });
});

</script>
