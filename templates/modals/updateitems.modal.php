<!-- Update User Modal -->
<div class="modal fade" id="updateItemModal" tabindex="-1" aria-labelledby="updateItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/division.update.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateItemModalLabel">Update Division</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="update_division_id" name="division_id">
          <!-- Division Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Division Name</label>
            <input type="text" id="update_name" name="division_name" class="form-control" required>
          </div>

                    <!-- Unit of Measure Dropdown -->
          <div class="mb-3">
            <label for="userlevel" class="form-label">User Level</label>
              <select name="update_unit_of_measure" id="unit" class="form-select" required>
              <option value=""> Select Unit of Measure</option>
              <option value="pc">pc</option>
              <option value="bottle">bottle</option>
              <option value="ream">preamc</option>
              <option value="box">box</option>
              <option value="pack">pack</option>
              <option value="book">book</option>
            </select>
          </div>


                  <!-- Fund Cluster Dropdown -->
          <div class="mb-3">
            <label for="userlevel" class="form-label">User Level</label>
              <select name="fund_cluster" id="update_fund_cluster" class="form-select" required>
                <option value=""> Select Fund Cluster</option>
                <option value="101-Regular">101-Regular</option>
                <option value="102-SPLIT">102-SPLIT</option>
              </select>
          </div>


                  <!-- Status Dropdown -->
          <div class="mb-3">
            <label for="userlevel" class="form-label">User Level</label>
              <select name="status" id="update_status" class="form-select" required>
                <option value="Available">Available</option>
                <option value="Out of Stock">Out of Stock</option>
                <option value="Not Available">Not Available</option>
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
