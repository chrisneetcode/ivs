<!-- Update User Modal -->
<div class="modal fade" id="updateItemModal" tabindex="-1" aria-labelledby="updateItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/items.update.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateItemModalLabel">Update Item Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="update_item_id" name="item_id">
          <!-- Item Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" id="update_name" name="item_name" class="form-control" required>
          </div>
          <!-- Description -->
          <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" id="update_description" name="description" class="form-control" required>
          </div>
                    <!-- Quantity -->
          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" id="update_quantity" name="initial_quantity" class="form-control" required>
          </div>
                    <!-- Reorder Point -->
          <div class="mb-3">
            <label class="form-label">Reorder Point</label>
            <input type="number" id="update_reorder" name="critical_level" class="form-control" required>
          </div>
                    <!-- Unit of Measure Dropdown -->
          <div class="mb-3">
            <label class="form-label">Unit of Measure</label>
            <select name="unit" id="unit" class="form-select" required>
              <option value="">Select Unit of Measure</option>
              <option value="pc">pc</option>
              <option value="bottle">bottle</option>
              <option value="ream">ream</option>
              <option value="box">box</option>
              <option value="pack">pack</option>
              <option value="book">book</option>
            </select>
          </div>
                  <!-- Fund Cluster Dropdown -->
        <div class="mb-3">
          <label class="form-label">Fund Cluster</label>
          <select name="fund_cluster" id="update_fund_cluster" class="form-select" required>
            <option value="">Select Fund Cluster</option>
            <option value="101-Regular">101-Regular</option>
            <option value="102-SPLIT">102-SPLIT</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Division</button>
        </div>
      </div>
    </form>
  </div>
</div>
