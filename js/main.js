
// RHONA

//function before proceeding in  the creation of RIS
document.addEventListener('DOMContentLoaded', function () {
  const itemSelect = document.getElementById('item_id');
  const fundClusterDisplay = document.getElementById('fund_cluster_display');
  const unitDisplay = document.getElementById('unit_display');
  const fundClusterInput = document.getElementById('fund_cluster');
  const unitInput = document.getElementById('unit');
  const quantityInput = document.getElementById('quantity_received');
  const stockDisplay = document.getElementById('available_stock');

  itemSelect.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const fundCluster = selectedOption.getAttribute('data-fund-cluster');
    const unit = selectedOption.getAttribute('data-unit');
    const stock = selectedOption.getAttribute('data-quantity');

    fundClusterDisplay.value = fundCluster;
    unitDisplay.value = unit;
    fundClusterInput.value = fundCluster;
    unitInput.value = unit;
    stockDisplay.value = stock;
  });

  quantityInput.addEventListener('input', function () {
    const requestedQty = parseInt(quantityInput.value);
    const availableQty = parseInt(stockDisplay.value);

    if (!itemSelect.value || isNaN(requestedQty)) {
      return;
    }

    if (requestedQty > availableQty) {
      const exceedModal = new bootstrap.Modal(document.getElementById('exceedModal'));
      exceedModal.show();
    } else if (requestedQty > 0 && requestedQty <= availableQty) {
      const risModal = new bootstrap.Modal(document.getElementById('risModal'));
      risModal.show();
    }
  });
});

//function for the date format
  flatpickr("#ris_date_picker", {
    dateFormat: "Y/m/d",  // Format: YYYY/MM/DD
    allowInput: false     // Prevent keyboard typing
  });

  document.addEventListener('DOMContentLoaded', function () {
  const divisionSelect = document.getElementById('division_id');
  const designationInput = document.getElementById('designation');

  divisionSelect.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const designation = selectedOption.getAttribute('data-designation');
    designationInput.value = designation || '';
  });
});

  flatpickr("#date_requested", {
    dateFormat: "m/d/Y", // Output format: YYYY/MM/DD
    allowInput: true
  });

// for ris table
document.addEventListener('DOMContentLoaded', function () {
  const addItemRowBtn = document.getElementById('addItemRow');
  const itemTableBody = document.querySelector('#itemTable tbody');
  const itemOptionsHTML = document.getElementById('itemOptionsTemplate').innerHTML.trim();
  const qtyAlert = document.getElementById('qtyAlert');

  function showAlert(message) {
    qtyAlert.textContent = message;
    qtyAlert.classList.remove('d-none');
  }

  function hideAlert() {
    qtyAlert.classList.add('d-none');
  }

  function createItemRow() {
    const row = document.createElement('tr');

    row.innerHTML = `
      <td>
        <select class="form-select item-select" name="item_id[]" required>
          <option value="" disabled selected>Select Item</option>
          ${itemOptionsHTML}
        </select>
      </td>
      <td><input type="text" class="form-control stock-display" readonly placeholder="Stock"></td>
      <td><input type="text" class="form-control unit-display" readonly placeholder="Unit"></td>
      <td><input type="text" class="form-control cluster-display" readonly placeholder="Fund Cluster"></td>
      <td><input type="number" class="form-control quantity-requested" name="quantity_requested[]" min="1" required></td>
      <td><input type="number" class="form-control quantity-issued" name="quantity_issued[]" min="1" required></td>
      <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
    `;

    const itemSelect = row.querySelector('.item-select');
    const stockDisplay = row.querySelector('.stock-display');
    const quantityRequested = row.querySelector('.quantity-requested');
    const quantityIssued = row.querySelector('.quantity-issued');

    itemSelect.addEventListener('change', function () {
  const selected = this.options[this.selectedIndex];
  const stock = selected.getAttribute('data-stock');
  const unit = selected.getAttribute('data-unit');
  const cluster = selected.getAttribute('data-cluster');

  stockDisplay.value = stock || '';
  row.querySelector('.unit-display').value = unit || '';
  row.querySelector('.cluster-display').value = cluster || '';

  // Validate Qty Requested
  quantityRequested.addEventListener('input', function () {
    const enteredQty = parseInt(this.value, 10);
    const availableQty = parseInt(stock, 10);

    if (!isNaN(enteredQty) && enteredQty > availableQty) {
      showAlert('Quantity Requested exceeds available stock.');
      this.classList.add('is-invalid');
    } else {
      hideAlert();
      this.classList.remove('is-invalid');
    }
  });

  // Validate and deduct Qty Issued
  quantityIssued.addEventListener('input', function () {
    const issuedQty = parseInt(this.value, 10);
    const originalStock = parseInt(stock, 10);

    if (!isNaN(issuedQty) && issuedQty > originalStock) {
      showAlert('Quantity Issued exceeds available stock.');
      this.classList.add('is-invalid');
    } else {
      hideAlert();
      this.classList.remove('is-invalid');
      const remainingStock = originalStock - issuedQty;
      stockDisplay.value = !isNaN(remainingStock) && remainingStock >= 0 ? remainingStock : originalStock;
    }
  });
});

    // Remove row button
    row.querySelector('.remove-row').addEventListener('click', function () {
      row.remove();
      hideAlert(); // hide alert if any row is removed
    });

    return row;
  }

  // Add first row
  itemTableBody.appendChild(createItemRow());

  // Add new row
  addItemRowBtn.addEventListener('click', function () {
    itemTableBody.appendChild(createItemRow());
  });
});

document.querySelectorAll('.btn-update-ris').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('update_ris_id').value = button.dataset.id;
        document.getElementById('update_ris_no').value = button.dataset.ris_no;
    });
});

//update on ris
flatpickr("#update_ris_no", {
    dateFormat: "Y/m/d",  // Format: 2025/08/18
    allowInput: false
});

//Filtering Script for RIS list
document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".column-filter");
    const rows = document.querySelectorAll("tbody tr.data-row"); // only RIS rows

    filters.forEach((filter, colIndex) => {
        filter.addEventListener("keyup", function () {
            const search = this.value.toLowerCase();

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                if (cells[colIndex]) {
                    const text = cells[colIndex].innerText.toLowerCase();
                    const risId = row.getAttribute("data-ris-id");
                    const collapseRow = document.querySelector(`#items-${risId}`);

                    if (text.includes(search)) {
                        row.style.display = "";
                        if (collapseRow) collapseRow.style.display = ""; // show item row
                    } else {
                        row.style.display = "none";
                        if (collapseRow) collapseRow.style.display = "none"; // hide item row too
                    }
                }
            });
        });
    });
});

//for update ris modal
function loadUpdateRIS(risId) {
  fetch("updateris.modal.php?ris_id=" + risId)
    .then(response => response.text())
    .then(html => {
      document.body.insertAdjacentHTML("beforeend", html);
      let modal = new bootstrap.Modal(document.getElementById('updateRISModal'));
      modal.show();
    });
}

//for ris no format
function formatRISNo(input) {
  let date = new Date(input.value);
  if (isNaN(date.getTime())) {
    date = new Date(); // fallback to today
  }
  let year = date.getFullYear();
  let month = String(date.getMonth() + 1).padStart(2, '0');
  let day = String(date.getDate()).padStart(2, '0');
  input.value = `${year}-${month}-${day}`;
}

//for date requested calendar stlyle
  flatpickr(".ris-date", {
    dateFormat: "Y/m/d",   // matches RIS No format
    defaultDate: null,     // prevents auto "1970/01/01"
    allowInput: true
  });

document.addEventListener("DOMContentLoaded", function () {
  const requestedInputs = document.querySelectorAll(".qty-requested");
  const issuedInputs = document.querySelectorAll(".qty-issued");

  // Validate Qty Requested
requestedInputs.forEach(input => {
  input.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault(); // prevent accidental form submission

      const stock = parseInt(this.dataset.stock);
      const value = parseInt(this.value);

      if (value > stock) {
        this.classList.add("is-invalid");
        alert("Requested quantity exceeds available stock!");
      } else {
        this.classList.remove("is-invalid");
        alert("Quantity validated successfully!");
      }
    }
  });
});


  // Validate Qty Issued
  issuedInputs.forEach(input => {
    input.addEventListener("input", function () {
      const requestedInput = this.closest("tr").querySelector(".qty-requested");
      const requested = parseInt(requestedInput.value) || 0;
      const value = parseInt(this.value);

      if (value > requested) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
});

document.querySelector("form").addEventListener("submit", function(e) {
    let valid = true;

    document.querySelectorAll("tr").forEach(row => {
        let stock = parseInt(row.querySelector("input[value]").value) || 0;
        let requested = parseInt(row.querySelector("input[name^='quantity_requested']").value) || 0;
        let issued = parseInt(row.querySelector("input[name^='quantity_issued']").value) || 0;

        if (requested < 1 || requested > stock) {
            alert("Requested qty must be between 1 and available stock (" + stock + ")");
            valid = false;
        }
        if (issued < 0 || issued > requested) {
            alert("Issued qty cannot exceed requested qty (" + requested + ")");
            valid = false;
        }
    });

    if (!valid) e.preventDefault();
});

//Print RIS function
document.addEventListener("DOMContentLoaded", function () {
  const printButtons = document.querySelectorAll(".btn-print-ris");

  printButtons.forEach(button => {
    button.addEventListener("click", async function () {
      const risId = this.dataset.id;
      const risNo = this.dataset.ris_no;
      const date = this.dataset.date;
      const division = this.dataset.division;
      const responsibilityCode = this.dataset.responsibility_code;
      const printedName = this.dataset.printed_name;
      const received_by = this.dataset.received_by;
      const designation = this.dataset.designation;
      const fundCluster = this.dataset.fund_cluster;

      try {
        // Fetch RIS items from PHP
        const res = await fetch(`templates/modals/get_ris_items.php?ris_id=${risId}`);
        const items = await res.json();

        if (!Array.isArray(items) || items.length === 0) {
          alert("No items found for this RIS.");
          return;
        }

        // Build table rows for items
        let rows = "";
        items.forEach(item => {
          const stockYes = item.quantity_issued > 0 ? "✔️" : "";
          const stockNo = item.quantity_issued > 0 ? "" : "❌";

          rows += `
            <tr>
              <td></td>
              <td>${item.unit}</td>
              <td>${item.item_name}</td>
              <td>${item.quantity_requested}</td>
              <td>${stockYes}</td>
              <td>${stockNo}</td>
              <td>${item.quantity_issued}</td>
              <td>${item.remarks ?? ""}</td>
            </tr>
          `;
        });

        // Official RIS Layout
        const printContent = `
<html>
<head>
  <title>RIS Print</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    table, th, td { border: 1px solid black; border-collapse: collapse; }
    th, td { padding: 6px; text-align: center; }
    .center { text-align: center; margin-top: 20px; }
    .signature-table td { height: 20px; vertical-align: bottom; padding: 6px; }
    .heading-title { text-align: center; padding-top: 10px; padding-bottom: 20px; font-weight: bold; }
    .purpose-section { margin-top: 20px; padding-bottom: 20px; }
    .line { border-bottom: 1px solid #000; margin: 20px 0; width: 100%; }
  </style>
</head>
<body>
  <!-- Header with logos -->
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display:flex; gap:10px;">
      <img src="http://localhost/ivs/src/images/bp_logo.png" style="width: 100px;">
      <img src="http://localhost/ivs/src/images/dar_logo.png" style="width: 100px;">
    </div>
    <div style="text-align:center; flex-grow:1;">
      <div style="font-weight: bold; font-size: 22px;">DEPARTMENT OF AGRARIAN REFORM - LA UNION</div>
      <div style="font-weight: bold; font-size: 18px;">PROVINCIAL OFFICE</div>
      <div style="font-size: 14px;">RSRK Building, Sitio 5, Biday, San Fernando City, La Union</div>
    </div>
    <div style="width:120px;"></div>
  </div>

  <div style="text-align:right; font-style:italic; font-size:18px; margin-top:10px;">Appendix 63</div>

  <h2 class="center heading-title">REQUISITION AND ISSUE SLIP</h2>

  <table style="width:100%; margin-bottom:20px;">
    <tr>
      <td style="text-align:left;"><strong>Entity Name:</strong> DARPO LU</td>
      <td style="text-align:left;"><strong>Fund Cluster:</strong> ${fundCluster}</td>
    </tr>
    <tr>
      <td style="text-align:left;"><strong>Division:</strong> ${division}</td>
      <td style="text-align:left;"><strong>Responsibility Code:</strong> ${responsibilityCode}</td>
    </tr>
    <tr>
      <td style="text-align:left;"><strong>Office:</strong> DARPO LA UNION</td>
      <td style="text-align:left;"><strong>RIS No.:</strong> ${risNo}</td>
    </tr>
  </table>

  <!-- Items table -->
  <table style="width:100%;">
    <thead>
      <tr>
        <th colspan="4">Requisition</th>
        <th colspan="2">Stock Available?</th>
        <th colspan="2">Issue</th>
      </tr>
      <tr>
        <th>Stock No.</th>
        <th>Unit</th>
        <th>Description</th>
        <th>Qty Req</th>
        <th>Yes</th>
        <th>No</th>
        <th>Qty Issued</th>
        <th>Remarks</th>
      </tr>
    </thead>
    <tbody>
      ${rows}
    </tbody>
  </table>

  <!-- Purpose -->
  <div class="purpose-section">
    <strong>Purpose:</strong>
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
  </div>

  <!-- Signatures -->
  <table class="signature-table" width="100%">
    <tr>
      <td></td>
      <td style="text-align:center;"><strong>Requested by:</strong></td>
      <td style="text-align:center;"><strong>Approved by:</strong></td>
      <td style="text-align:center;"><strong>Issued by:</strong></td>
      <td style="text-align:center;"><strong>Received by:</strong></td>
    </tr>
    <tr>
      <td>Signature:</td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
      <td>Printed Name:</td>
      <td>${printedName}</td>
      <td></td>
      <td style="text-align:center;">VALDEMIR P. VALDEZ</td>
      <td style="text-align:center;">${received_by}</td>
    </tr>
    <tr>
      <td>Designation:</td>
      <td>${designation}</td>
      <td></td>
      <td style="text-align:center;">ARPO 1</td>
      <td></td>
    </tr>
    <tr>
      <td>Date:</td>
      <td>${date}</td>
      <td></td><td></td><td></td>
    </tr>
  </table>
</body>
</html>
        `;

        const originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
      } catch (err) {
        console.error("Error fetching RIS items:", err);
        alert("Failed to load RIS items.");
      }
    });
  });
});

//Print SPLIT RSMI
 document.addEventListener('DOMContentLoaded', function () {
  const printButtons = document.querySelectorAll('.btn-print-splitrsmi');

  printButtons.forEach(button => {
    button.addEventListener('click', function () {
      const refNum = this.dataset.ris_no;
      const date = this.dataset.date;
      const division = this.dataset.division;
      const requestDescrip = this.dataset.request_descrip;
      const quantity = this.dataset.acquired_quantity;
      const unit = this.dataset.unit;
      const remarks = this.dataset.remarks;
      const name = this.dataset.printed_name;
      const designation = this.dataset.designation;
      const fundCluster = this.dataset.fund_cluster;


const printContent = `
  <html>
  <head>
    <title>RIS Print</title>
    <style>
      body { font-family: Arial, sans-serif; margin: 40px; }
  .header-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

      table, th, td { border: 1px solid black; border-collapse: collapse; }
      th, td { padding: 8px; text-align: left; }
      .center { text-align: center; margin-top: 50px; }
      .signature-table td {
        height: 20px;
        vertical-align: bottom;
        padding: 6px;
        font-size: 15px;
      }
        .heading-title {
          padding-bottom: 50px; /* Adjust value as needed */
          margin-top: 50px;
          font-weight: bold;
        }
        .info-section {
          display: flex;
          justify-content: space-between;
          gap: 20px;
          margin-bottom: 20px;
        }

        .info-column {
          width: 48%;
        }

        .info-column p {
          margin: 4px 0;
        }

        .section-title {
          font-weight: bold;
        }

        .heading-title {
          text-align: center;
          padding-bottom: 20px;
          font-weight: bold;
        }
          .heading-title {
          padding-top: 10px;
          padding-bottom: 20px;
        }
            .purpose-section {
            margin-top: 20px;
            padding-bottom: 20px;
          }

          .line {
            border-bottom: 1px solid #000;
            margin: 30px 0;
            width: 100%;
          }
</style>
    </style>
  </head>
  <body>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
  <!-- Logos on the left -->
  <div class="logo-group" style="display: flex; align-items: center; gap: 10px;">
    <img src="http://localhost/ivs/src/images/bp_logo.png" alt="BP Logo" style="width: 100px; height: auto;">
    <img src="http://localhost/ivs/src/images/dar_logo.png" alt="DAR Logo" style="width: 100px; height: auto;">
  </div>

  <!-- DAR Title in the center -->
  <div class="dar-info" style="text-align: center; flex-grow: 1;">
    <div style="font-weight: bold; font-size: 24px;">DEPARTMENT OF AGRARIAN REFORM - LA UNION</div>
    <div style="font-weight: bold; font-size: 20px;">PROVINCIAL OFFICE</div>
    <div style="font-weight: bold;">RSRK Building, Sitio 5, Biday, San Fernando City, La Union</div>
  </div>

  <!-- Spacer to balance layout -->
  <div style="width: 120px;"></div>
</div>

<!-- Appendix Below DAR Title, Aligned Right -->
<div style="text-align: right; font-style: italic; font-size: 22px; margin-top: 20px;">
  Appendix 64
</div>


    <h2 class="center heading-title"><strong> REPORT OF SUPPLIES AND MATERIALS ISSUED</strong></h2>
    <!-- Monthly Report Subheading -->
<p style="text-align: center; font-size: 16px; margin-top: -15px; margin-bottom: 30px;">
  <em>SPLIT Monthly Report for the month of ____________________</em>
</p>
<table style="width: 100%; margin-bottom: 20px; font-family: Arial, sans-serif; border-collapse: collapse;">
  <!-- Top Row: Entity Name and Serial No. -->
  <tr>
    <td style="padding: 5px;"><strong>Entity Name:</strong> DARPO LU</td>
    <td style="padding: 5px;"><strong>Serial No.:</strong></td>
    
  </tr>

  <!-- Second Row: Fund Cluster and Date -->
  <tr>
    <td style="padding: 5px;"><strong>Fund Cluster:</strong> ${fundCluster}</td>
    <td style="padding: 5px;"><strong>Date:</td>
  </tr>

</table>

    <table width="100%">
<thead>
<tr>
  <th colspan="6" style="text-align: center; font-weight: bold;">
    <strong><em>To be filled up by the Supply and/or Property Division/Unit</em></strong>
  </th>
  <th colspan="2" style="text-align: center; font-weight: bold;">
    <strong><em>To be filled up by the Accounting Division/Unit</em></strong>
  </th>
</tr>
<tr>
  <th style="text-align: center; width: 120px;">RIS Number</th>
  <th style="text-align: center;">Responsibility Center Code</th>
  <th style="text-align: center;">Stock No.</th>
  <th style="text-align: center;">Item</th>
  <th style="text-align: center;">Unit</th>
  <th style="text-align: center;">Quantiy Issued</th>
  <th style="text-align: center;">Unit Cost</th>
  <th style="text-align: center;">Amount</th>
</tr>
</thead>
  <tbody>
    <tr>
      <td style="text-align: center;">${refNum}</td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;">${requestDescrip}</td>
      <td style="text-align: center;">${unit}</td>
      <td style="text-align: center;">${quantity}</td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;">${remarks}</td>
    </tr>
      <tr>
      <td colspan="7" style="text-align: right; font-weight: bold;">Total Amount:</td>
    </tr>
<!-- Certification and Posting Section -->
<tr>
  <td colspan="4" style="text-align: left; font-weight: bold; vertical-align: top;">
    I hereby certify to the correctness of the above information.<br><br>
    <div style="text-align: center; margin-top: 20px; font-size: 25px;"">
      <u>VALDEMIR P. VALDEZ</u>
    </div>
    <div style="text-align: center; font-size: 15px;">
      Signature over Printed Name of Supply and/or Property Custodian
    </div>
  </td>
  <td colspan="3" style="text-align: left; font-weight: bold; vertical-align: top;">
    Posted by:<br><br>
    <div style="text-align: center;">
    <br><br>
      ____________________________________<br>
      <span style="font-size: 15px;">Signature over Printed Name of Designated Accounting Staff</span>
    </div>
  </td>
  <td style="text-align: center; vertical-align: bottom; font-weight: bold;">

    _____________________<br>
    <span style="font-size: 15px;">Date</span>
  </td>
</tr>
    </tr>
  </tbody>
    </table>


  </body>
  </html>
`;

const originalContent = document.body.innerHTML;
document.body.innerHTML = printContent;
window.print();
document.body.innerHTML = originalContent;
location.reload();
    });
  });
});

//Print 101 RSMI
 document.addEventListener('DOMContentLoaded', function () {
  const printButtons = document.querySelectorAll('.btn-print-101rsmi');

  printButtons.forEach(button => {
    button.addEventListener('click', function () {
      const refNum = this.dataset.ref_num;
      const date = this.dataset.date;
      const requestDescrip = this.dataset.request_descrip;
      const quantity = this.dataset.acquired_quantity;
      const unit = this.dataset.unit;
      const remarks = this.dataset.remarks;
      const name = this.dataset.name;
      const designation = this.dataset.designation;
      const fundCluster = this.dataset.fund_cluster;
      const division = this.closest('tr').querySelector('td:nth-child(4)').innerText;

const printContent = `
  <html>
  <head>
    <title>RIS Print</title>
    <style>
      body { font-family: Arial, sans-serif; margin: 40px; }
  .header-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

      table, th, td { border: 1px solid black; border-collapse: collapse; }
      th, td { padding: 8px; text-align: left; }
      .center { text-align: center; margin-top: 50px; }
      .signature-table td {
        height: 20px;
        vertical-align: bottom;
        padding: 6px;
        font-size: 15px;
      }
        .heading-title {
          padding-bottom: 50px; /* Adjust value as needed */
          margin-top: 50px;
          font-weight: bold;
        }
        .info-section {
          display: flex;
          justify-content: space-between;
          gap: 20px;
          margin-bottom: 20px;
        }

        .info-column {
          width: 48%;
        }

        .info-column p {
          margin: 4px 0;
        }

        .section-title {
          font-weight: bold;
        }

        .heading-title {
          text-align: center;
          padding-bottom: 20px;
          font-weight: bold;
        }
          .heading-title {
          padding-top: 10px;
          padding-bottom: 20px;
        }
            .purpose-section {
            margin-top: 20px;
            padding-bottom: 20px;
          }

          .line {
            border-bottom: 1px solid #000;
            margin: 30px 0;
            width: 100%;
          }
</style>
    </style>
  </head>
  <body>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
  <!-- Logos on the left -->
  <div class="logo-group" style="display: flex; align-items: center; gap: 10px;">
    <img src="http://localhost/ivs/src/images/bp_logo.png" alt="BP Logo" style="width: 100px; height: auto;">
    <img src="http://localhost/ivs/src/images/dar_logo.png" alt="DAR Logo" style="width: 100px; height: auto;">
  </div>

  <!-- DAR Title in the center -->
  <div class="dar-info" style="text-align: center; flex-grow: 1;">
    <div style="font-weight: bold; font-size: 24px;">DEPARTMENT OF AGRARIAN REFORM - LA UNION</div>
    <div style="font-weight: bold; font-size: 20px;">PROVINCIAL OFFICE</div>
    <div style="font-weight: bold;">RSRK Building, Sitio 5, Biday, San Fernando City, La Union</div>
  </div>

  <!-- Spacer to balance layout -->
  <div style="width: 120px;"></div>
</div>

<!-- Appendix Below DAR Title, Aligned Right -->
<div style="text-align: right; font-style: italic; font-size: 22px; margin-top: 20px;">
  Appendix 64
</div>


    <h2 class="center heading-title"><strong> REPORT OF SUPPLIES AND MATERIALS ISSUED</strong></h2>
    <!-- Monthly Report Subheading -->
<p style="text-align: center; font-size: 16px; margin-top: -15px; margin-bottom: 30px;">
  <em>101 Monthly Report for the month of ____________________</em>
</p>
<table style="width: 100%; margin-bottom: 20px; font-family: Arial, sans-serif; border-collapse: collapse;">
  <!-- Top Row: Entity Name and Serial No. -->
  <tr>
    <td style="padding: 5px;"><strong>Entity Name:</strong> DARPO LU</td>
    <td style="padding: 5px;"><strong>Serial No.:</strong></td>
    
  </tr>

  <!-- Second Row: Fund Cluster and Date -->
  <tr>
    <td style="padding: 5px;"><strong>Fund Cluster:</strong> ${fundCluster}</td>
    <td style="padding: 5px;"><strong>Date:</td>
  </tr>

</table>

    <table width="100%">
<thead>
<tr>
  <th colspan="6" style="text-align: center; font-weight: bold;">
    <strong><em>To be filled up by the Supply and/or Property Division/Unit</em></strong>
  </th>
  <th colspan="2" style="text-align: center; font-weight: bold;">
    <strong><em>To be filled up by the Accounting Division/Unit</em></strong>
  </th>
</tr>
<tr>
  <th style="text-align: center; width: 120px;">RIS Number</th>
  <th style="text-align: center;">Responsibility Center Code</th>
  <th style="text-align: center;">Stock No.</th>
  <th style="text-align: center;">Item</th>
  <th style="text-align: center;">Unit</th>
  <th style="text-align: center;">Quantiy Issued</th>
  <th style="text-align: center;">Unit Cost</th>
  <th style="text-align: center;">Amount</th>
</tr>
</thead>
  <tbody>
    <tr>
      <td style="text-align: center;">${refNum}</td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;">${requestDescrip}</td>
      <td style="text-align: center;">${unit}</td>
      <td style="text-align: center;">${quantity}</td>
      <td style="text-align: center;"></td>
      <td style="text-align: center;">${remarks}</td>
    </tr>
      <tr>
      <td colspan="7" style="text-align: right; font-weight: bold;">Total Amount:</td>
    </tr>
<!-- Certification and Posting Section -->
<tr>
  <td colspan="4" style="text-align: left; font-weight: bold; vertical-align: top;">
    I hereby certify to the correctness of the above information.<br><br>
    <div style="text-align: center; margin-top: 20px; font-size: 25px;"">
      <u>VALDEMIR P. VALDEZ</u>
    </div>
    <div style="text-align: center; font-size: 15px;">
      Signature over Printed Name of Supply and/or Property Custodian
    </div>
  </td>
  <td colspan="3" style="text-align: left; font-weight: bold; vertical-align: top;">
    Posted by:<br><br>
    <div style="text-align: center;">
    <br><br>
      ____________________________________<br>
      <span style="font-size: 15px;">Signature over Printed Name of Designated Accounting Staff</span>
    </div>
  </td>
  <td style="text-align: center; vertical-align: bottom; font-weight: bold;">

    _____________________<br>
    <span style="font-size: 15px;">Date</span>
  </td>
</tr>
    </tr>
  </tbody>
    </table>


  </body>
  </html>
`;

const originalContent = document.body.innerHTML;
document.body.innerHTML = printContent;
window.print();
document.body.innerHTML = originalContent;
location.reload();
    });
  });
});
