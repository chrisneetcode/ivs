<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;

// Pagination setup
$limit = 20; 
$page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int) $_GET['p'] : 1;
$offset = ($page - 1) * $limit;

// Get total records
$total_query = "SELECT COUNT(*) as total FROM tbl_ris";
$total_result = $conn->query($total_query);

$total_records = 0;
if ($total_result && $total_result->num_rows > 0) {
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];
}
$total_pages = ($total_records > 0) ? ceil($total_records / $limit) : 1;

// Fetch RIS data with related items
$query = "
SELECT 
    r.ris_id, 
    r.ris_no, 
    r.designation, 
    r.received_by, 
    r.date_requested, 
    r.status, 
    r.fund_cluster,
    r.responsibility_code,
    r.printed_name,
    r.division_id,
    d.division_name,
    i.item_name,
    i.unit,
    ri.quantity_requested,
    ri.quantity_issued
FROM tbl_ris r
LEFT JOIN tbl_division d ON r.division_id = d.division_id
LEFT JOIN tbl_ris_items ri ON r.ris_id = ri.ris_id
LEFT JOIN tbl_item i ON ri.item_id = i.item_id
GROUP BY r.ris_id
ORDER BY r.date_requested DESC
LIMIT $limit OFFSET $offset
";
$result = $conn->query($query);
?>

<div class="container-fluid mt-4">
  
<?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['alert']['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>
    <div class="card shadow">
        <div class="card-header bg-success text-white fw-bold">
            RIS List
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 120px;">RIS No</th>
                            <th style="width: 150px;">Designation</th>
                            <th style="width: 150px;">Received By</th>
                            <th style="width: 150px;">Date Requested</th>
                            <th style="width: 100px; text-align:center;">Status</th>
                            <th style="width: 180px; text-align:center;">Actions</th>
                        </tr>
                        <!-- Filter row -->
                        <tr class="table-secondary">
                            <th><input type="text" class="form-control form-control-sm column-filter" placeholder="Search RIS"></th>
                            <th><input type="text" class="form-control form-control-sm column-filter" placeholder="Search Designation"></th>
                            <th><input type="text" class="form-control form-control-sm column-filter" placeholder="Search Receiver"></th>
                            <th><input type="text" class="form-control form-control-sm column-filter" placeholder="Search Date"></th>
                            <th><input type="text" class="form-control form-control-sm column-filter text-center" placeholder="Status"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="data-row" data-ris-id="<?= $row['ris_id'] ?>">
                                    <td><?= htmlspecialchars($row['ris_no']) ?></td>
                                    <td><?= htmlspecialchars($row['designation']) ?></td>
                                    <td><?= htmlspecialchars($row['received_by']) ?></td>
                                    <td><?= date("F d, Y", strtotime($row['date_requested'])) ?></td>
                                    <td class="text-center">
                                        <?php if ($row['status'] === "complete"): ?>
                                            <span class="badge bg-secondary">complete</span>
                                        <?php elseif ($row['status'] === "pending"): ?>
                                            <span class="badge bg-warning text-dark">pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-info text-dark"><?= htmlspecialchars($row['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#items-<?= $row['ris_id'] ?>"
                                                aria-expanded="false" 
                                                aria-controls="items-<?= $row['ris_id'] ?>">
                                            View Items
                                        </button>

                                        <!-- Print RIS -->
                                        <button
                                          type="button"
                                          class="btn btn-outline-danger btn-print-ris"
                                          data-id="<?= htmlspecialchars($row['ris_id']) ?>"
                                          data-ris_no="<?= htmlspecialchars($row['ris_no']) ?>"
                                          data-date="<?= htmlspecialchars($row['date_requested']) ?>"
                                          data-division="<?= htmlspecialchars($row['division_name']) ?>"
                                          data-responsibility_code="<?= htmlspecialchars($row['responsibility_code']) ?>"received_by
                                          data-received_by="<?= htmlspecialchars($row['received_by']) ?>"
                                          data-printed_name="<?= htmlspecialchars($row['printed_name']) ?>"
                                          data-designation="<?= htmlspecialchars($row['designation']) ?>"
                                          data-fund_cluster="<?= htmlspecialchars($row['fund_cluster']) ?>"
                                          data-item_name="<?= htmlspecialchars($row['item_name']) ?>"
                                          data-unit="<?= htmlspecialchars($row['unit']) ?>"
                                          data-quantity_requested="<?= htmlspecialchars($row['quantity_requested']) ?>"
                                          data-quantity_issued="<?= htmlspecialchars($row['quantity_issued']) ?>"
                                          data-status="<?= htmlspecialchars($row['status']) ?>"
                                        >
                                          <i class="fas fa-print"></i>
                                        </button>
                                    </td>
                                </tr>

<!-- Collapsible row -->
<tr class="collapse bg-light" id="items-<?= $row['ris_id'] ?>">
  <td colspan="6">
    <form method="POST" action="/ivs/includes/modalsconn/update_ris.php">
      <input type="hidden" name="ris_id" value="<?= $row['ris_id'] ?>">

      <!-- RIS HEADER INFO -->
       
      <!-- RIS No. -->
      <div class="row mb-3">
  <div class="col-md-3">
    <label class="form-label">RIS Number</label>
    <input 
      type="date" 
      class="form-control" 
      name="ris_no" 
      id="update_ris_no" 
      value="<?= !empty($row['ris_no']) ? htmlspecialchars(date('Y-m-d', strtotime($row['ris_no']))) : date('Y-m-d') ?>" 
      required
      onchange="formatRISNo(this)">
  </div>


        <!-- Designation Dropdown -->
        <div class="col-md-3">
          <label class="form-label fw-bold">Designation</label>
          <select class="form-control form-control-sm" name="designation" required>
            <option value="">-- Select Designation --</option>
            <?php
              $div_query = "SELECT division_id, designation FROM tbl_division ORDER BY designation ASC";
              $div_result = $conn->query($div_query);
              if ($div_result && $div_result->num_rows > 0) {
                  while ($div = $div_result->fetch_assoc()) {
                      $selected = ($row['designation'] == $div['designation']) ? "selected" : "";
                      echo "<option value='" . htmlspecialchars($div['designation']) . "' $selected>" 
                             . htmlspecialchars($div['designation']) . 
                           "</option>";
                  }
              }
            ?>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label fw-bold">Received By</label>
          <input type="text" class="form-control form-control-sm" 
                 name="received_by" value="<?= htmlspecialchars($row['received_by']) ?>">
        </div>

<div class="col-md-3">
  <label class="form-label fw-bold">Date Requested</label>
  <input type="text" 
         class="form-control form-control-sm ris-date"
         name="date_requested"
         value="<?= htmlspecialchars($row['date_requested']) ?>">
</div>


      </div>
<?php
$items_query = $conn->prepare("
  SELECT ri.item_id, 
         i.item_name, 
         i.initial_quantity,   -- fetch available stock
         ri.quantity_requested, 
         ri.quantity_issued, 
         ri.remarks
  FROM tbl_ris_items ri
  INNER JOIN tbl_item i ON ri.item_id = i.item_id
  WHERE ri.ris_id = ?
");
$items_query->bind_param("i", $row['ris_id']);
$items_query->execute();
$items_result = $items_query->get_result();
?>

<?php if ($items_result && $items_result->num_rows > 0): ?>
<table class="table table-sm table-bordered mb-0 text-center">
  <thead class="table-light">
    <tr>
      <th>Item Name</th>
      <th>Available Stock</th>
      <th>Qty Requested</th>
      <th>Qty Issued</th>
      <th>Remarks</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($item = $items_result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($item['item_name']) ?></td>

        <!-- Available Stock (dynamic) -->
        <td>
          <input type="text" 
                 class="form-control form-control-sm text-center available-stock" 
                 value="<?= htmlspecialchars($item['initial_quantity']) ?>" 
                 readonly 
                 data-original="<?= $item['initial_quantity'] ?>">
        </td>

        <!-- Qty Requested -->
        <td>
          <input type="number" 
                 class="form-control form-control-sm text-center qty-requested" 
                 name="quantity_requested[<?= $item['item_id'] ?>]" 
                 value="<?= htmlspecialchars($item['quantity_requested']) ?>" 
                 min="1" 
                 data-stock="<?= $item['initial_quantity'] ?>">
          <div class="invalid-feedback">Qty Requested exceeds available stock.</div>
        </td>

        <!-- Qty Issued -->
        <td>
          <input type="number" 
                 class="form-control form-control-sm text-center qty-issued" 
                 name="quantity_issued[<?= $item['item_id'] ?>]" 
                 value="<?= htmlspecialchars($item['quantity_issued']) ?>" 
                 min="0">
          <div class="invalid-feedback">Qty Issued cannot exceed Qty Requested.</div>
        </td>

        <!-- Remarks -->
        <td>
          <input type="text" 
                 class="form-control form-control-sm" 
                 name="remarks[<?= $item['item_id'] ?>]" 
                 value="<?= htmlspecialchars($item['remarks']) ?>">
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const toInt = v => {
    const n = parseInt(v, 10);
    return Number.isNaN(n) ? 0 : n;
  };

  document.querySelectorAll("table tbody tr").forEach(row => {
    const nameCell = row.querySelector(".item-name")?.innerText.trim() ?? "(item)";
    const avail = row.querySelector(".available-stock");
    const req = row.querySelector(".qty-requested");
    const iss = row.querySelector(".qty-issued");
    const reqFeedback = req?.nextElementSibling;
    const issFeedback = iss?.nextElementSibling;

    if (!avail || !req || !iss) return; // safety

    // initial values you must provide from server
    const initialQuantity = toInt(avail.dataset.original ?? avail.value); // data-original="60"
    const prevIssued = toInt(iss.dataset.prev ?? iss.defaultValue ?? iss.value); // data-prev="50"

    function updateRow() {
      const curReq = toInt(req.value);
      const curIss = toInt(iss.value);

      // validation: Issued cannot exceed Requested
      if (curIss > curReq) {
        iss.classList.add("is-invalid");
        if (issFeedback) { issFeedback.style.display = "block"; issFeedback.textContent = "Qty Issued cannot exceed Qty Requested."; }
      } else {
        iss.classList.remove("is-invalid");
        if (issFeedback) issFeedback.style.display = "none";
      }

      // validation: Requested shouldn't be ridiculously higher than possible (optional)
      if (curReq > initialQuantity + prevIssued) {
        req.classList.add("is-invalid");
        if (reqFeedback) { reqFeedback.style.display = "block"; reqFeedback.textContent = `Qty Requested too large.`; }
      } else {
        req.classList.remove("is-invalid");
        if (reqFeedback) reqFeedback.style.display = "none";
      }

      // delta = how many more are being issued now compared to baseline
      const delta = curIss - prevIssued; // if negative, you returned stock
      const additionalDeduct = delta > 0 ? delta : 0;

      // available shown = initialQuantity - additionalDeduct
      // (This follows your request: previous issued is not re-deducted here)
      let remaining = initialQuantity - additionalDeduct;

      if (remaining < 0) remaining = 0; // clamp

      avail.value = String(remaining);

      // debug line you can observe in DevTools Console
      console.log(`${nameCell}: initial=${initialQuantity}, prevIssued=${prevIssued}, curIss=${curIss}, delta=${delta}, shownAvailable=${avail.value}`);
    }

    // bind events
    iss.addEventListener("input", updateRow);
    req.addEventListener("input", updateRow);

    // init
    updateRow();
  });
});
</script>



        <div class="mt-2 text-end">
<button type="submit" class="btn btn-sm btn-success"> Update Changes </button>
        </div>
      <?php else: ?>
        <p class="text-muted">No items found for this RIS.</p>
      <?php endif; ?>
    </form>
  </td>
</tr>

                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No RIS records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

           <!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="index.php?page=ris-list&p=<?= $page - 1 ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?page=ris-list&p=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="index.php?page=ris-list&p=<?= $page + 1 ?>">Next</a>
        </li>
    </ul>
</nav>

        </div>
    </div>
</div>
