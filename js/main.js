


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

// Updating Item Modal
document.addEventListener('DOMContentLoaded', () => {
  console.log("DOM fully loaded");

  document.querySelectorAll('.btn-update-item').forEach(button => {
    button.addEventListener('click', function () {
      console.log("Update Item button clicked");

      // Get data attributes from the clicked button
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const description = this.getAttribute('data-description');
      const unit = this.getAttribute('data-unit');
      const fundCluster = this.getAttribute('data-fund_cluster');
      const quantity = this.getAttribute('data-quantity');
      const critical = this.getAttribute('data-critical');

      // Set the values into the modal inputs
      document.getElementById('update_item_id').value = id;
      document.getElementById('update_name').value = name;
      document.getElementById('update_description').value = description;
      document.getElementById('update_quantity').value = quantity;
      document.getElementById('update_reorder').value = critical;
      document.getElementById('unit').value = unit;
      document.getElementById('update_fund_cluster').value = fundCluster;
    });
  });
});

// Updating Supplier Modal
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.btn-update-supplier').forEach(button => {
    button.addEventListener('click', function () {
      document.getElementById('update_supplier_id').value = this.getAttribute('data-id');
      document.getElementById('update_supplier_name').value = this.getAttribute('data-name');
      document.getElementById('update_contact_person').value = this.getAttribute('data-contact-person');
      document.getElementById('update_mobile_number').value = this.getAttribute('data-mobile-number');
      document.getElementById('update_tin').value = this.getAttribute('data-tin');
    });
  });
});