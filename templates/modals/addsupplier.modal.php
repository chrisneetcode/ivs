<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" action="/ivs/includes/modalsconn/supplier.add.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Supplier Name -->
          <div class="mb-3">
            <label for="supplier_name" class="form-label">Supplier Name</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
          </div>

          <!-- Contact Person -->
          <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control" required>
          </div>

          <!-- Mobile Number -->
          <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                   maxlength="11" pattern="^09\d{9}$"
                   title="Mobile number must start with 09 and be exactly 11 digits"
                   required>
          </div>

          <!-- TIN -->
          <div class="mb-3">
            <label for="tin" class="form-label">TIN</label>
            <input type="text" name="tin" id="tin" class="form-control"
                   maxlength="9" pattern="^\d{9}$"
                   title="TIN must be exactly 9 digits"
                   required>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Supplier</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- JavaScript for digit-only inputs -->
<script>
  document.getElementById('mobile_number').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 11);
  });

  document.getElementById('tin').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 9);
  });
</script>