<?php
require_once __DIR__ . '/../../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT supplier_id, supplier_name, contact_person, mobile_number, tin, date_added 
          FROM tbl_supplier 
          ORDER BY date_added DESC";
$result = $conn->query($query);


?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Supplier</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            <i class="fa-solid fa-people-group"></i> Add Supplier</a>
    </div>

    <!-- Supplier Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Supplier</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="suppliersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact Person</th>
                            <th>Mobile Number</th>
                            <th>TIN</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['supplier_name']) ?></td>
                                    <td><?= htmlspecialchars($row['contact_person']) ?></td>
                                    <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                                    <td><?= htmlspecialchars($row['tin']) ?></td>
                                    <td><?= date("F j, Y", strtotime($row['date_added'])) ?></td>
                                    <td>
                                    <button 
                                    class="btn btn-sm btn-info btn-update-supplier"
                                    data-id="<?= htmlspecialchars($row['supplier_id']) ?>"
                                    data-name="<?= htmlspecialchars($row['supplier_name']) ?>"
                                    data-contact-person="<?= htmlspecialchars($row['contact_person']) ?>"
                                    data-mobile-number="<?= htmlspecialchars($row['mobile_number']) ?>"
                                    data-tin="<?= htmlspecialchars($row['tin']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateSupplierModal">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No Division found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
        <?php include __DIR__ . "/../modals/updatesupplier.modal.php"; ?>

        <?php include __DIR__ . "/../modals/addsupplier.modal.php"; ?>