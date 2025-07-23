<!-- Update User Modal -->
<div class="modal fade" id="updateDivisionModal" tabindex="-1" aria-labelledby="updateDivisionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/division.update.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDivisionModalLabel">Update Division</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="update_division_id" name="division_id">
          <!-- Division Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Division Name</label>
            <input type="text" id="update_name" name="division_name" class="form-control" required>
          </div>

          <!-- Designation -->
          <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="designation" id="update_designation" name="designation" class="form-control">
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Division</button>
        </div>
      </div>
    </form>
  </div>
</div>
