<?php
require_once '../conn.php';
$db = new DBConnection();
$conn = $db->conn;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->begin_transaction();

    try {
        // Main RIS info
        $ris_no = $_POST['ris_no'] ?? '';
        $entity_name = "DARPO LU";
        $division_id = $_POST['division_id'] ?? '';
        $responsibility_code = "004-01-005-00003";
        $printed_name = $_POST['printed_name'] ?? '';
        $designation = $_POST['designation'] ?? '';
        $date_requested_raw = $_POST['date_requested'] ?? '';
        $date_requested = !empty($date_requested_raw) ? date('Y-m-d', strtotime($date_requested_raw)) : null;
        $received_by = $_POST['received_by'] ?? '';
        $status = "pending";

        $item_ids = $_POST['item_id'] ?? [];
        $quantity_requested = $_POST['quantity_requested'] ?? [];
        $quantity_issued = $_POST['quantity_issued'] ?? [];

        if (empty($item_ids)) {
            throw new Exception("No items selected.");
        }

        // Get fund_cluster from first item
        $first_item_id = (int)$item_ids[0];
        $fund_stmt = $conn->prepare("SELECT fund_cluster FROM tbl_item WHERE item_id = ?");
        $fund_stmt->bind_param("i", $first_item_id);
        $fund_stmt->execute();
        $fund_stmt->bind_result($fund_cluster);
        if (!$fund_stmt->fetch()) {
            throw new Exception("Unable to fetch fund_cluster for first item.");
        }
        $fund_stmt->close();

        // Insert into tbl_ris
        $stmt = $conn->prepare("
            INSERT INTO tbl_ris 
            (ris_no, entity_name, fund_cluster, division_id, responsibility_code, printed_name, designation, date_requested, received_by, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssssssss",
            $ris_no,
            $entity_name,
            $fund_cluster,
            $division_id,
            $responsibility_code,
            $printed_name,
            $designation,
            $date_requested,
            $received_by,
            $status
        );
        if (!$stmt->execute()) {
            throw new Exception("Error inserting RIS: " . $stmt->error);
        }
        $ris_id = $stmt->insert_id;

        // Prepare insert and update statements
        $item_stmt = $conn->prepare("
            INSERT INTO tbl_ris_items (ris_id, item_id, quantity_requested, quantity_issued) 
            VALUES (?, ?, ?, ?)
        ");
        $update_stock_stmt = $conn->prepare("
            UPDATE tbl_item SET initial_quantity = initial_quantity - ? WHERE item_id = ?
        ");

        foreach ($item_ids as $index => $item_id_val) {
            $item_id = (int)$item_id_val;
            $qty_requested = (int)($quantity_requested[$index] ?? 0);
            $qty_issued = (int)($quantity_issued[$index] ?? 0);

            // Stock check
            $stock_check = $conn->prepare("SELECT initial_quantity FROM tbl_item WHERE item_id = ?");
            $stock_check->bind_param("i", $item_id);
            $stock_check->execute();
            $stock_check->bind_result($available_stock);
            $stock_check->fetch();
            $stock_check->close();

            if ($qty_issued > $available_stock) {
                throw new Exception("Issued qty ($qty_issued) exceeds stock ($available_stock) for item ID $item_id.");
            }

            // Insert item
            $item_stmt->bind_param("iiii", $ris_id, $item_id, $qty_requested, $qty_issued);
            if (!$item_stmt->execute()) {
                throw new Exception("Error inserting RIS item: " . $item_stmt->error);
            }

            // Deduct stock
            $update_stock_stmt->bind_param("ii", $qty_issued, $item_id);
            if (!$update_stock_stmt->execute()) {
                throw new Exception("Error updating stock: " . $update_stock_stmt->error);
            }
        }

        $conn->commit();
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'RIS created successfully with stock updated.'];
        header("Location: /ivs/index.php?page=create-ris");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error: ' . $e->getMessage()];
        header("Location: /ivs/index.php?page=create-ris");
        exit;
    }
}
?>
