<!-- Add User Modal -->
<div class="modal fade" id="addDivisionModal" tabindex="-1" aria-labelledby="addDivisionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/division.add.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDivisionModalLabel">Add New Division</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Name -->
          <div class="mb-3">
            <label for="division_name" class="form-label">Division Name</label>
            <input type="text" name="division_name" id="division_name" class="form-control" required>
          </div>

          <!-- Designation -->
          <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="designation" name="designation" id="designation" class="form-control" required>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Division</button>
        </div>
      </div>
    </form>
  </div>
</div>
