


document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("darkModeToggle");
  const body = document.body;

  // Apply saved mode
  if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
    toggle.checked = true;
  }

  toggle.addEventListener("change", function () {
    if (this.checked) {
      body.classList.add("dark-mode");
      localStorage.setItem("dark-mode", "enabled");
    } else {
      body.classList.remove("dark-mode");
      localStorage.setItem("dark-mode", "disabled");
    }
  });
});
// Updating User Modal
document.addEventListener('DOMContentLoaded', () => {
  console.log("DOM fully loaded");
  document.querySelectorAll('.btn-edit-user').forEach(button => {
    button.addEventListener('click', function () {
      console.log("Edit button clicked");
      const id = this.getAttribute('data-id');
      const username = this.getAttribute('data-username');
      const userlevel = this.getAttribute('data-userlevel');
      document.getElementById('update_user_id').value = id;
      document.getElementById('update_username').value = username;
      document.getElementById('update_userlevel').value = userlevel;
      document.getElementById('update_password').value = ''; // optional reset
    });
  });
});

// Updating Supplier Modal
document.addEventListener('DOMContentLoaded', () => {
  console.log("Supplier modal JS loaded");
  document.querySelectorAll('.btn-edit-supplier').forEach(button => {
    button.addEventListener('click', function () {
      console.log("Edit supplier button clicked");
      const id = this.getAttribute('data-id');
      const supplier_name = this.getAttribute('data-supplier_name');
      const item = this.getAttribute('data-item');
      const description = this.getAttribute('data-description');
      const unit = this.getAttribute('data-unit_of_measure');
      const quantity = this.getAttribute('data-quantity');
      const price = this.getAttribute('data-price');
      const fund_cluster = this.getAttribute('data-fund_cluster');
      const contact_person = this.getAttribute('data-contact_person');
      const mobile = this.getAttribute('data-mobile_number');
      const tin = this.getAttribute('data-tin');
      document.getElementById('update_supplier_name').value = supplier_name;
      document.getElementById('update_item').value = item;
      document.getElementById('update_description').value = description;
      document.getElementById('update_unit_of_measure').value = unit;
      document.getElementById('update_quantity').value = quantity;
      document.getElementById('update_price').value = price;
      document.getElementById('update_fund_cluster').value = fund_cluster;
      document.getElementById('update_contact_person').value = contact_person;
      document.getElementById('update_mobile_number').value = mobile;
      document.getElementById('update_tin').value = tin;

      // If you need to store ID (e.g., hidden input for updating)
      const hiddenIdField = document.getElementById('update_supplier_id');
      if (hiddenIdField) {
        hiddenIdField.value = id;
      }
    });
  });
});

// Updating Division Modal
document.addEventListener('DOMContentLoaded', () => {
  console.log("DOM fully loaded");
  document.querySelectorAll('.btn-update-division').forEach(button => {
    button.addEventListener('click', function () {
      console.log("Edit button clicked");
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const designation = this.getAttribute('data-designation');
      document.getElementById('update_division_id').value = id;
      document.getElementById('update_name').value = name;
      document.getElementById('update_designation').value = designation;
    });
  });
});