<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;


// Fetch ALL items (no pagination)
$query = "SELECT item_name, initial_quantity FROM tbl_item ORDER BY item_name ASC";
$result = $conn->query($query);
?>


<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white fw-bold">
            Item Summaryfdsfdsfs
        </div>


        <div class="container mt-4">
  <!-- Stock Card Header -->
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <h5 class="card-title">Stock Card – Pentelpen</h5>
      <p class="mb-1">
        <strong>Description:</strong> Pilot |
        <strong>UOM:</strong> pc |
        <strong>Price:</strong> 20
      </p>
      <p class="mb-1">
        <strong>Fund Cluster:</strong> 101-Regular |
        <strong>Supplier:</strong> St. Jude Enterprise
      </p>
      <h6 class="mt-2">
        <span class="badge bg-success">Current Balance: 27 pcs</span>
      </h6>
    </div>
  </div>



  <!-- Transactions Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>Date</th>
              <th>Reference No.</th>
              <th>Receipt Qty</th>
              <th>Issued Qty</th>
              <th>Issued To / Office</th>
              <th>Balance</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-07-23</td>
              <td>PO#2025-07-23</td>
              <td>50</td>
              <td></td>
              <td></td>
              <td><span class="badge bg-success">50</span></td>
              <td>Initial stock</td>
            </tr>
            <tr>
              <td>2025-08-01</td>
              <td>RIS#2025-08-01</td>
              <td></td>
              <td>5</td>
              <td>Second Floor</td>
              <td><span class="badge bg-success">45</span></td>
              <td>Issued</td>
            </tr>
            <tr>
              <td>2025-08-03</td>
              <td>RIS#2025-08-03</td>
              <td></td>
              <td>10</td>
              <td>Budget</td>
              <td><span class="badge bg-warning text-dark">35</span></td>
              <td>Issued</td>
            </tr>
            <tr>
              <td>2025-08-10</td>
              <td>RIS#2025-08-10</td>
              <td></td>
              <td>8</td>
              <td>STOD</td>
              <td><span class="badge bg-danger">27</span></td>
              <td>Issued</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- Footer Stats -->
  <div class="card shadow-sm mt-3">
    <div class="card-body">
      <p><strong>Reorder Point:</strong> 20 pcs</p>
      <p><strong>Days to Consume:</strong> ~12 days (based on average issue)</p>
    </div>
  </div>
</div>


<!-- MODAL: Add Ledger Entry -->
<div class="modal fade" id="addLedgerModal" tabindex="-1" aria-labelledby="addLedgerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLedgerLabel">Add Ledger Entry (PO/Receipt)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">Reference No.</label>
          <input type="text" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Date Received</label>
          <input type="date" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Quantity Received</label>
          <input type="number" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Remarks</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Entry</button>
      </div>
    </form>
  </div>
</div>


<!-- MODAL: Record Issue -->
<div class="modal fade" id="recordIssueModal" tabindex="-1" aria-labelledby="recordIssueLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recordIssueLabel">Record Issue (RIS)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">RIS No.</label>
          <input type="text" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Date Issued</label>
          <input type="date" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Issued Qty</label>
          <input type="number" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Issued To / Office</label>
          <input type="text" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Remarks</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Save Issue</button>
      </div>
    </form>
  </div>
</div>

        </div>
    </div>
</div>


<!-- JS for Live Search -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("liveSearch");
    const table = document.getElementById("itemsTable");
    const rows = table.querySelectorAll("tbody tr");
   
    // Add a "No items found" row dynamically if not exists
    let noDataRow = table.querySelector(".no-data");
    if (!noDataRow) {
        noDataRow = document.createElement("tr");
        noDataRow.classList.add("no-data");
        noDataRow.innerHTML = `<td colspan="2" class="text-center text-muted">No items found.</td>`;
        noDataRow.style.display = "none";
        table.querySelector("tbody").appendChild(noDataRow);
    }


    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        let visibleCount = 0;


        rows.forEach(row => {
            if (row.classList.contains("no-data")) return; // skip placeholder row


            const itemName = row.cells[0].textContent.toLowerCase();
            if (itemName.includes(filter)) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });


        // Toggle "No items found" row
        noDataRow.style.display = visibleCount === 0 ? "" : "none";
    });
});
</script>
