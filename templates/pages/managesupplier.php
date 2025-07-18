<?php
require_once __DIR__ . '/../../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT id, supplier_name, item, description, unit_of_measure, quantity, fund_cluster, price, contact_person, mobile_number, tin FROM tbl_supplier";
$result = $conn->query($query);

if (!empty($_SESSION['supplier_success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['supplier_success'] ?></div>
    <?php unset($_SESSION['supplier_success']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['supplier_error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['supplier_error'] ?></div>
    <?php unset($_SESSION['supplier_error']); ?>
<?php endif; 
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Supplier</h1>
        <a href="#" class="btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            <i class="fas fa-box"></i> Add Supplier</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Supplier</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="suppliersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier Name</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Unit of Measure</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Fund Cluster</th>
                            <th>Contact Person</th>
                            <th>Mobile Number</th>
                            <th>TIN Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['supplier_name']) ?></td>
                                    <td><?= htmlspecialchars($row['item']) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td><?= htmlspecialchars($row['unit_of_measure']) ?></td>
                                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                                    <td><?= htmlspecialchars($row['price']) ?></td>
                                    <td><?= htmlspecialchars($row['fund_cluster']) ?></td>
                                    <td><?= htmlspecialchars($row['contact_person']) ?></td>
                                    <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                                    <td><?= htmlspecialchars($row['tin']) ?></td>
                                    <td>
                                    <button 
                                    class="btn btn-sm btn-info btn-edit-supplier"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-supplier_name="<?= htmlspecialchars($row['supplier_name']) ?>"
                                    data-item="<?= htmlspecialchars($row['item']) ?>"
                                    data-description="<?= htmlspecialchars($row['description']) ?>"
                                    data-unit_of_measure="<?= htmlspecialchars($row['unit_of_measure']) ?>"
                                    data-quantity="<?= htmlspecialchars($row['quantity']) ?>"
                                    data-price="<?= htmlspecialchars($row['price']) ?>"
                                    data-fund_cluster="<?= htmlspecialchars($row['fund_cluster']) ?>"
                                    data-contact_person="<?= htmlspecialchars($row['contact_person']) ?>"
                                    data-mobile_number="<?= htmlspecialchars($row['mobile_number']) ?>"
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
                                <td colspan="4" class="text-center">No Supplier found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
