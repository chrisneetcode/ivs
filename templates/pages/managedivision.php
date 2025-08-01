<?php
require_once __DIR__ . '/../../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT division_id, division_name, designation FROM tbl_division";
$result = $conn->query($query);


?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Division</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addDivisionModal">
            <i class="fa-solid fa-people-group"></i> Add Division</a>
    </div>

    <!-- User Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Division</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Division Name</th>
                            <th>Designation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['division_id']) ?></td>
                                    <td><?= htmlspecialchars($row['division_name']) ?></td>
                                    <td><?= htmlspecialchars($row['designation']) ?></td>
                                    <td>
                                    <button 
                                    class="btn btn-sm btn-info btn-update-division"
                                    data-id="<?= htmlspecialchars($row['division_id']) ?>"
                                    data-name="<?= htmlspecialchars($row['division_name']) ?>"
                                    data-designation="<?= htmlspecialchars($row['designation']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateDivisionModal">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No Division found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        <?php include __DIR__ . "/../modals/updatedivision.modal.php"; ?>