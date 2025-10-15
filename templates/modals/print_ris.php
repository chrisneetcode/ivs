  <html>
  <head>
    <title>RIS Print</title>
    <style>
      body { font-family: Arial, sans-serif; margin: 40px; }
      table, th, td { border: 1px solid black; border-collapse: collapse; }
      th, td { padding: 8px; text-align: left; }
      .center { text-align: center; margin-top: 50px; }
      .signature-table td { height: 20px; vertical-align: bottom; padding: 6px; }
      .heading-title { text-align: center; padding-top: 10px; padding-bottom: 20px; font-weight: bold; }
      .purpose-section { margin-top: 20px; padding-bottom: 20px; }
      .line { border-bottom: 1px solid #000; margin: 30px 0; width: 100%; }
    </style>
  </head>
  <body>
    <!-- Keep your same header design -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
      <div class="logo-group" style="display: flex; align-items: center; gap: 10px;">
        <img src="http://localhost/ivs/src/images/bp_logo.png" style="width: 100px;">
        <img src="http://localhost/ivs/src/images/dar_logo.png" style="width: 100px;">
      </div>
      <div class="dar-info" style="text-align: center; flex-grow: 1;">
        <div style="font-weight: bold; font-size: 24px;">DEPARTMENT OF AGRARIAN REFORM - LA UNION</div>
        <div style="font-weight: bold; font-size: 20px;">PROVINCIAL OFFICE</div>
        <div style="font-weight: bold;">RSRK Building, Sitio 5, Biday, San Fernando City, La Union</div>
      </div>
      <div style="width: 120px;"></div>
    </div>
    <div style="text-align: right; font-style: italic; font-size: 22px; margin-top: 20px;">Appendix 63</div>

    <h2 class="center heading-title"><strong>REQUISITION AND ISSUE SLIP</strong></h2>
    <table style="width: 100%; margin-bottom: 50px;">
      <tr><td><strong>Entity Name:</strong> DARPO LU</td><td><strong>Fund Cluster:</strong> ${fundCluster}</td></tr>
      <tr><td><strong>Division:</strong> ${division}</td><td><strong>Responsibility Code:</strong> 004-01-005-00003</td></tr>
      <tr><td><strong>Office:</strong> DARPO LA UNION</td><td><strong>RIS No.:</strong> ${refNum}</td></tr>
    </table>

    <table width="100%">
      <thead>
        <tr>
          <th colspan="4" style="text-align: center;">Requisition</th>
          <th colspan="2" style="text-align: center;">Stock Available?</th>
          <th colspan="2" style="text-align: center;">Issue</th>
        </tr>
        <tr>
          <th style="text-align: center;">Stock No.</th>
          <th style="text-align: center;">Unit</th>
          <th style="text-align: center;">Description</th>
          <th style="text-align: center;">Qty Req</th>
          <th style="text-align: center;">Yes</th>
          <th style="text-align: center;">No</th>
          <th style="text-align: center;">Qty Issued</th>
          <th style="text-align: center;">Remarks</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>${unit}</td>
          <td>${itemName}</td>
          <td>${qtyRequested}</td>
          <td></td>
          <td></td>
          <td>${qtyIssued}</td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div class="purpose-section">
      <strong>Purpose:</strong>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>

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
        <td>Printed Name:</td><td>${name}</td><td></td><td style="text-align:center;">VALDEMIR P. VALDEZ</td><td></td>
      </tr>
      <tr>
        <td>Designation:</td><td>${designation}</td><td></td><td style="text-align:center;">ARPO 1</td><td></td>
      </tr>
      <tr>
        <td>Date:</td><td>${date}</td><td></td><td></td><td></td>
      </tr>
    </table>
  </body>
  </html>