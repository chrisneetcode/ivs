<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/user.update.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="update_user_id" name="user_id">
          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="update_username" name="username" class="form-control" required>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="update_password" name="password" class="form-control">
          </div>

          <!-- User Level Dropdown -->
          <div class="mb-3">
            <label for="userlevel" class="form-label">User Level</label>
            <select id="update_userlevel" name="userlevel" class="form-select" required>
              <option value="" disabled selected>Select user level</option>
              <option value="Admin">Admin</option>
              <option value="Staff">GSS Staff</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </div>
    </form>
  </div>
</div>
