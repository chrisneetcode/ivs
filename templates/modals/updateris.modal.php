<!-- Update RIS Modal -->
<div class="modal fade" id="updateRISModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form id="updateRISForm" method="POST" action="modalsconn/save-update-ris.php">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Update RIS</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <!-- Hidden RIS ID -->
          <input type="hidden" name="ris_id" id="update_ris_id">

          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">RIS Number</label>
              <input type="text" class="form-control" name="ris_no" id="update_ris_no" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Designation</label>
              <input type="text" class="form-control" name="designation" id="update_designation" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Received By</label>
              <input type="text" class="form-control" name="received_by" id="update_received_by" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Status</label>
              <select class="form-select" name="status" id="update_status" required>
                <option value="pending">Pending</option>
                <option value="complete">Complete</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Date Requested</label>
              <input type="date" class="form-control" name="date_requested" id="update_date_requested" required>
            </div>
          </div>

          <hr>

          <h6>RIS Items</h6>
          <div class="table-responsive">
            <table class="table table-sm table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>Item Name</th>
                  <th>Qty Requested</th>
                  <th>Qty Issued</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody id="update_items_table">
                <!-- Filled dynamically via fetch -->
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openUpdateRIS(ris_id) {
  document.getElementById("update_items_table").innerHTML = "<tr><td colspan='4'>Loading...</td></tr>";

  fetch("modalsconn/fetch-update-ris.php?ris_id=" + ris_id)
    .then(res => res.json())
    .then(data => {
      // RIS Header
      document.getElementById("update_ris_id").value = data.ris.ris_id;
      document.getElementById("update_ris_no").value = data.ris.ris_no; // now editable
      document.getElementById("update_designation").value = data.ris.designation;
      document.getElementById("update_received_by").value = data.ris.received_by;
      document.getElementById("update_status").value = data.ris.status;
      document.getElementById("update_date_requested").value = data.ris.date_requested;

      // RIS Items
      let rows = "";
      data.items.forEach(item => {
        rows += `
          <tr>
            <td>${item.item_name}</td>
            <td>${item.quantity_requested}</td>
            <td>
              <input type="number" class="form-control form-control-sm text-center" 
                     name="quantity_issued[${item.item_id}]" value="${item.quantity_issued}">
            </td>
            <td>
              <input type="text" class="form-control form-control-sm" 
                     name="remarks[${item.item_id}]" value="${item.remarks}">
            </td>
          </tr>
        `;
      });
      document.getElementById("update_items_table").innerHTML = rows;
    });

  var updateModal = new bootstrap.Modal(document.getElementById("updateRISModal"));
  updateModal.show();
}
</script>
