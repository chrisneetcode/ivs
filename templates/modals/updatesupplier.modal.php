<!-- Update User Modal -->
<div class="modal fade" id="updateSupplierModal" tabindex="-1" aria-labelledby="updateSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/supplier.update.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateSupplierModalLabel">Update Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Hidden Supplier ID -->
          <input type="hidden" id="update_supplier_id" name="supplier_id">

          <!-- Supplier Name -->
          <div class="mb-3">
            <label for="update_supplier_name" class="form-label">Supplier Name</label>
            <input type="text" id="update_supplier_name" name="supplier_name" class="form-control" required>
          </div>

          <!-- Contact Person -->
          <div class="mb-3">
            <label for="update_contact_person" class="form-label">Contact Person</label>
            <input type="text" id="update_contact_person" name="contact_person" class="form-control" required>
          </div>

          <!-- Mobile Number -->
          <div class="mb-3">
            <label for="update_mobile_number" class="form-label">Mobile Number</label>
            <input type="text" id="update_mobile_number" name="mobile_number" class="form-control" maxlength="11" pattern="^09\d{9}$" 
            title="Mobile number must start with 09 and be exactly 11 digits" required>
          </div>

          <!-- TIN -->
          <div class="mb-3">
            <label for="update_tin" class="form-label">TIN</label>
            <input type="text" id="update_tin" name="tin" class="form-control" maxlength="9" pattern="^\d{9}$" 
            title="TIN must be exactly 9 digits" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Supplier</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  document.getElementById('update_mobile_number').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 11);
  });

  document.getElementById('update_tin').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 9);
  });
</script>