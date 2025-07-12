<?php
require_once __DIR__ . '/../../includes/conn.php';

$db = new DBConnection();
$conn = $db->conn;

$query = "SELECT id, username, userlevel FROM tbl_user";
$result = $conn->query($query);

if (!empty($_SESSION['user_success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['user_success'] ?></div>
    <?php unset($_SESSION['user_success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['user_error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['user_error'] ?></div>
    <?php unset($_SESSION['user_error']); ?>
<?php endif; 
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus"></i> Add User</a>
    </div>

    <!-- User Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Accounts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                    <td><?= htmlspecialchars($row['userlevel']) ?></td>
                                    <td>
                                    <button 
                                    class="btn btn-sm btn-info btn-edit-user"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-username="<?= htmlspecialchars($row['username']) ?>"
                                    data-userlevel="<?= htmlspecialchars($row['userlevel']) ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateUserModal">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
