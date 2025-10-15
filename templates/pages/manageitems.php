<?php
require_once __DIR__ . '/../../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT item_id, item_name, description, unit, fund_cluster, initial_quantity, critical_level, date_added FROM tbl_item
ORDER BY date_added DESC";
$result = $conn->query($query);


?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Items</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addItemsModal">
            <i class="fa-solid fa-people-group"></i> Add Items</a>
    </div>
    <!-- Items Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="itemsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Items Name</th>
                            <th>Description</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Fund Cluster</th>
                            <th>Threshold</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['item_name']) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td><?= htmlspecialchars($row['unit']) ?></td>
                                    <td><?= htmlspecialchars($row['initial_quantity']) ?></td>
                                    <td><?= htmlspecialchars($row['fund_cluster']) ?></td>
                                    <td><?= htmlspecialchars($row['critical_level']) ?></td>
                                    <td>
                                        <?php
                                            $qty = intval($row['initial_quantity']);
                                            $critical = intval($row['critical_level']);

                                            if ($qty == 0) {
                                                echo '<span class="badge bg-danger">Out of Stock</span>';
                                            } elseif ($qty < $critical) {
                                                echo '<span class="badge bg-warning text-dark">Low Stock</span>';
                                            } else {
                                                echo '<span class="badge bg-success">Available</span>';
                                            }
                                        ?>
                                    </td>     
                                    <td><?= date('F j, Y', strtotime($row['date_added'])) ?></td>
                                    <td>
                                    <button 
                                        class="btn btn-sm btn-info btn-update-item"
                                        data-id="<?= htmlspecialchars($row['item_id']) ?>"
                                        data-name="<?= htmlspecialchars($row['item_name']) ?>"
                                        data-description="<?= htmlspecialchars($row['description']) ?>"
                                        data-unit="<?= htmlspecialchars($row['unit']) ?>"
                                        data-fund_cluster="<?= htmlspecialchars($row['fund_cluster']) ?>"
                                        data-quantity="<?= htmlspecialchars($row['initial_quantity']) ?>"
                                        data-critical="<?= htmlspecialchars($row['critical_level']) ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateItemModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">No Items found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        <?php include __DIR__ . "/../modals/updateitems.modal.php"; ?>