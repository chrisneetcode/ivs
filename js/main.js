


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

