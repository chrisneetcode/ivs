<!-- Add RIS Modal -->
<div class="modal fade" id="addRISModal" tabindex="-1" aria-labelledby="addRISModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/ris.add.php">
      <div class="modal-content" style="max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
          <h5 class="modal-title" id="addRISModalLabel">Add REQUISITION AND ISSUE SLIP</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
            <form class="row g-3">
<!-- RIS No. (Date Picker and Custom Format Display year/month/date) -->
<!-- RIS No, Division, and Designation in One Row -->
<div class="row g-3">
  <!-- RIS Number (Read-only) -->
  <div class="col-md-3">
    <label for="ris_date_picker" class="form-label">RIS Number</label>
    <input 
      type="text" 
      id="ris_date_picker" 
      name="ris_no"
      class="form-control"
      readonly 
      required
    >
  </div>

  <!-- Division Dropdown -->
  <div class="col-md-6">
    <label for="division_id" class="form-label">Division</label>
    <select class="form-select" id="division_id" name="division_id" required>
      <option value="" selected disabled>Select Division</option>
      <?php
      // Fetch division_id, division_name, and designation from tbl_division
      $divisions = $conn->query("SELECT division_id, division_name, designation FROM tbl_division");
      while ($row = $divisions->fetch_assoc()):
      ?>
        <option 
          value="<?= $row['division_id'] ?>" 
          data-designation="<?= htmlspecialchars($row['designation']) ?>">
          <?= htmlspecialchars($row['division_name']) ?>
        </option>
      <?php endwhile; ?>
    </select>
  </div>

  <!-- Designation (Auto-filled) -->
  <div class="col-md-3">
    <label for="designation" class="form-label">Designation</label>
    <input 
      type="text" 
      class="form-control" 
      id="designation" 
      name="designation" 
      readonly 
      required 
      placeholder="Designation">
  </div>

<!-- Requested by: Printed Name -->
<div class="col-md-5">
  <label for="printed_name" class="form-label">Requested by:</label>
  <input 
    type="text" 
    name="printed_name" 
    id="printed_name" 
    class="form-control" 
    placeholder="Enter name of requester" 
    required
  >
</div>
<!-- Received by: Receiver's Name -->
<div class="col-md-4">
  <label for="received_by" class="form-label">Received by:</label>
  <input 
    type="text" 
    name="received_by" 
    id="received_by" 
    class="form-control" 
    placeholder="Enter name of receiver" 
    required 
  >
</div>
<!-- Date Requested using Flatpickr -->
<div class="col-md-3">
  <label for="date_requested" class="form-label">Date Requested:</label>
  <input 
    type="date" 
    name="date_requested" 
    id="date_requested" 
    class="form-control" 
    required
  >
</div>


<!-- Items Section -->
<div class="mb-3">
  <label class="form-label">Items to Request</label>
  <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
    <div id="qtyAlert" class="alert alert-danger mt-3 d-none" role="alert">
  Entered quantity exceeds available stock!
</div>
    <table class="table table-bordered align-middle" id="itemTable">
      <thead class="table-light">
        <tr>
          <th style="width: 25%">Item</th>
          <th>Stock</th>
          <th>Unit</th>
          <th>Fund Cluster</th>
          <th>Qty Requested</th>
          <th>Qty Issued</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- JS will add rows here -->
      </tbody>
    </table>
  </div>
  <button type="button" class="btn btn-success mt-2" id="addItemRow">+ Add Item</button>
</div>

<!-- Hidden item options template -->
<select id="itemOptionsTemplate" class="d-none">
  <?php
  $items = $conn->query("SELECT item_id, item_name, fund_cluster, unit, initial_quantity FROM tbl_item");
  while ($item = $items->fetch_assoc()):
  ?>
    <option 
      value="<?= $item['item_id'] ?>"
      data-stock="<?= $item['initial_quantity'] ?>"
      data-unit="<?= $item['unit'] ?>"
      data-cluster="<?= $item['fund_cluster'] ?>"
    >
      <?= htmlspecialchars($item['item_name']) ?>
    </option>
  <?php endwhile; ?>
</select>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add RIS</button>
        </div>
      </div>
    </form>
  </div>
</div>