<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;

// Get filters
$search   = $_GET['search']   ?? '';
$fromDate = $_GET['fromDate'] ?? '';
$toDate   = $_GET['toDate']   ?? '';

$sql = "SELECT s.date_received, s.quantity_received, s.price, s.remarks, s.received_by, s.po_number,
               i.item_name AS item,
               sup.supplier_name AS supplier
        FROM tbl_stock_entry s
        JOIN tbl_item i ON s.item_id = i.item_id
        JOIN tbl_supplier sup ON s.supplier_id = sup.supplier_id
        WHERE 1=1";

$params = [];
$types  = "";

// General search across multiple fields
if (!empty($search)) {
    $sql .= " AND (
                i.item_name LIKE ? 
                OR sup.supplier_name LIKE ? 
                OR s.remarks LIKE ? 
                OR s.received_by LIKE ?
              )";
    $like = "%$search%";
    $params = array_merge($params, [$like, $like, $like, $like]);
    $types .= "ssss";
}

// Date filters
if (!empty($fromDate)) {
    $sql .= " AND s.date_received >= ?";
    $params[] = $fromDate;
    $types .= "s";
}
if (!empty($toDate)) {
    $sql .= " AND s.date_received <= ?";
    $params[] = $toDate;
    $types .= "s";
}

$sql .= " ORDER BY stock_entry_id desc";

// Prepare & execute
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Count matched records
$totalResults = $result->num_rows;
?>


<div class="container-fluid">
  <h4 class="mb-4"><i class="fa-solid fa-clock-rotate-left me-2"></i> Stock-In History</h4>

  <!-- Filters -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form class="row g-3 mb-3" method="get" action="index.php">
          <input type="hidden" name="page" value="stock-in-history">

        <div class="col-md-6">
          <label for="search" class="form-label">Search</label>
          <input type="text" class="form-control" id="search" name="search"
                 value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                 placeholder="Search by item, supplier, remarks, or received by">
        </div>
        <div class="col-md-2">
          <label for="fromDate" class="form-label">From</label>
          <input type="date" class="form-control" id="fromDate" name="fromDate" 
                 value="<?= htmlspecialchars($_GET['fromDate'] ?? '') ?>">
        </div>
        <div class="col-md-2">
          <label for="toDate" class="form-label">To</label>
          <input type="date" class="form-control" id="toDate" name="toDate" 
                 value="<?= htmlspecialchars($_GET['toDate'] ?? '') ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100 me-2">
            <i class="fa-solid fa-magnifying-glass me-1"></i> 
          </button>
          <a href="index.php?page=stock-in-history" class="btn btn-secondary w-100">
            Clear
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Transaction Log Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
          <i class="fa-solid fa-list me-2"></i> Transaction Log
        </h5>
        <span class="text-muted">
          <?= $totalResults ?> record<?= $totalResults == 1 ? '' : 's' ?> found
        </span>
      </div>

      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Supplier</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Remarks</th>
            <th>Received By</th>
            <th>PO #</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['date_received']) ?></td>
                <td><?= htmlspecialchars($row['supplier']) ?></td>
                <td><?= htmlspecialchars($row['item']) ?></td>
                <td><?= htmlspecialchars($row['quantity_received']) ?></td>
                <td><?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['remarks']) ?></td>
                <td><?= htmlspecialchars($row['received_by']) ?></td>
                <td><?= htmlspecialchars($row['po_number']) ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center text-muted">No records found</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
