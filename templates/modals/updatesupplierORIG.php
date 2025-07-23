<!-- Update Supplier Modal -->
<div class="modal fade" id="updateSupplierModal" tabindex="-1" aria-labelledby="updateSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <form method="POST" action="/ivs/includes/modalsconn/supplier.update.php">
        <div class="modal-content"> 
        <div class="modal-header">
          <h5 class="modal-title" id="updateSupplierModalLabel">Update Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="supplier_id" id="update_supplier_id">

          <div class="mb-3">
            <label for="update_supplier_name" class="form-label">Supplier</label>
            <input type="text" name="supplier_name" id="update_supplier_name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="update_item" class="form-label">Item</label>
            <input type="text" name="item" id="update_item" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="update_description" class="form-label">Description</label>
            <input type="text" name="description" id="update_description" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="update_unit_of_measure" class="form-label">Unit of Measure</label>
            <select name="unit_of_measure" id="update_unit_of_measure" class="form-select" required>
              <option value="" disabled selected>Select Unit of Measure</option>
              <option value="pc">pc</option>
              <option value="bottle">bottle</option>
              <option value="ream">ream</option>
              <option value="box">box</option>
              <option value="pack">pack</option>
              <option value="book">book</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="update_quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="update_quantity" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="update_price" class="form-label">Price</label>
            <input type="number" name="price" id="update_price" class="form-control" required>
          </div> 
          <div class="mb-3">
            <label for="update_fund_cluster" class="form-label">Fund Cluster</label>
            <select name="fund_cluster" id="update_fund_cluster" class="form-select" required>
              <option value="" disabled selected>Select Fund Cluster</option>
              <option value="Regular">101-Regular Fund</option>
              <option value="SPLIT">102-SPLIT Fund</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="update_contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" id="update_contact_person" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="update_mobile_number" class="form-label">Mobile Number</label>
            <input 
              type="text"
              name="mobile_number"
              id="update_mobile_number"
              class="form-control"
required oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)" maxlength="11"
            >
          </div>
          <div class="mb-3">
            <label for="update_tin" class="form-label">TIN</label>
            <input 
              type="text"
              name="tin"
              id="update_tin"
              class="form-control"
              required oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 9)" maxlength="9">
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