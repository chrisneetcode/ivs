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
            <label for="supplier_name" class="form-label">Supplier</label>
            <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
          </div>

          <!-- Item -->
          <div class="mb-3">
            <label for="item" class="form-label">Item</label>
            <input type="text" name="item" id="item" class="form-control" required>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
          </div>

          <!-- Unit of Measure -->
          <div class="mb-3">
            <label for="unit_of_measure" class="form-label">Unit of Measure</label>
            <select name="unit_of_measure" id="unit_of_measure" class="form-select" required>
              <option value="" disabled selected>Select Unit of Measure</option>
              <option value="pc">pc</option>
              <option value="bottle">bottle</option>
              <option value="ream">preamc</option>
              <option value="box">box</option>
              <option value="pack">pack</option>
              <option value="book">book</option>
            </select>
          </div>

          <!-- Quantity -->
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
          </div>

          <!-- Price -->
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
          </div> 

          <!-- Fund Cluster -->
          <div class="mb-3">
            <label for="fund_cluster" class="form-label">Fund Cluster</label>
            <select name="fund_cluster" id="fund_cluster" class="form-select" required>
              <option value="" disabled selected>Select Fund Cluster</option>
              <option value="Regular">101-Regular Fund</option>
              <option value="SPLIT">102-SPLIT Fund</option>
            </select>
          </div>

          <!-- Contact Person -->
          <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control" required>
          </div>

          <!-- Mobile Number -->
          <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input 
              name="mobile_number"
              class="form-control"
required oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)" maxlength="10"
            >
          </div>
          <script>
          document.getElementById('mobile_number').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, ''); // Remove non-digits
          });
          </script>


            <!-- TIN -->
            <div class="mb-3">
              <label for="tin" class="form-label">TIN</label>
              <input 
                type="text"
                name="tin"
                id="tin"
                class="form-control"
                pattern="^\d{9}$"
                maxlength="9"
                minlength="9"
                title="TIN must be exactly 9 digits"
                required
              >
            </div>
            <script>
            document.getElementById('tin').addEventListener('input', function () {
              this.value = this.value.replace(/\D/g, ''); // Allow digits only
            });
            </script>



        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Create Supplier</button>
        </div>
      </div>
    </form>
  </div>
</div>
