<!-- Add User Modal -->
<div class="modal fade" id="addItemsModal" tabindex="-1" aria-labelledby="addItemsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/items.add.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemsModalLabel">Add New Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <!-- Item Name -->
            <div class="mb-3">
              <label for="item_name" class="form-label">Item Name</label>
              <input type="text" name="item_name" id="item_name" class="form-control" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <!-- Unit -->
            <div class="mb-3">
              <label for="unit" class="form-label">Unit of Measure</label>
              <select name="unit" id="unit" class="form-select" required>
                <option value=""> Select Unit of Measure</option>
              <option value="pc">pc</option>
              <option value="bottle">bottle</option>
              <option value="ream">preamc</option>
              <option value="box">box</option>
              <option value="pack">pack</option>
              <option value="book">book</option>
              </select>
            </div>
                        <!-- Initial Quantity -->
            <div class="mb-3">
              <label for="initial_quantity" class="form-label">Quantity</label>
              <input type="number" name="initial_quantity" id="initial_quantity" class="form-control" required min="0">
            </div>

            <!-- Fund Cluster -->
            <div class="mb-3">
              <label for="fund_cluster" class="form-label">Fund Cluster</label>
              <select name="fund_cluster" id="fund_cluster" class="form-select" required>
                <option value=""> Select Fund Cluster</option>
                <option value="101-Regular">101-Regular</option>
                <option value="102-SPLIT">102-SPLIT</option>
              </select>
            </div>

            <!-- Critical Level -->
            <div class="mb-3">
              <label for="critical_level" class="form-label">Reorder Point</label>
              <input type="number" name="critical_level" id="critical_level" class="form-control" required min="0">
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add New Item</button>
        </div>
      </div>
    </form>
  </div>
</div>
