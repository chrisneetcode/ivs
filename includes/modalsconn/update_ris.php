<?php
require_once '../conn.php';
$db = new DBConnection();
$conn = $db->conn;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ris_id        = $_POST['ris_id'];
    $ris_no        = $_POST['ris_no'];
    $designation   = $_POST['designation'];
    $received_by   = $_POST['received_by'];
    $date_requested= $_POST['date_requested'];
    $printed_name  = $_POST['printed_name'] ?? null;

    $quantity_requested = $_POST['quantity_requested'] ?? [];
    $quantity_issued    = $_POST['quantity_issued'] ?? [];
    $remarks            = $_POST['remarks'] ?? [];

    try {
        $conn->begin_transaction();

        // 1. Update RIS header
        $updateRis = $conn->prepare("
            UPDATE tbl_ris
            SET ris_no = ?, 
                designation = ?, 
                received_by = ?, 
                date_requested = ?, 
                printed_name = ?, 
                status = 'complete'
            WHERE ris_id = ?
        ");
        $updateRis->bind_param(
            "sssssi",
            $ris_no,
            $designation,
            $received_by,
            $date_requested,
            $printed_name,
            $ris_id
        );
        $updateRis->execute();

        // 2. Update items + deduct stock
        foreach ($quantity_requested as $item_id => $req_qty) {
            $iss_qty = isset($quantity_issued[$item_id]) ? (int)$quantity_issued[$item_id] : 0;
            $remark  = $remarks[$item_id] ?? '';

            // fetch previous issued for delta calculation
            $prevQ = $conn->prepare("SELECT quantity_issued FROM tbl_ris_items WHERE ris_id = ? AND item_id = ?");
            $prevQ->bind_param("ii", $ris_id, $item_id);
            $prevQ->execute();
            $prevRes = $prevQ->get_result();
            $prevRow = $prevRes->fetch_assoc();
            $prevIssued = $prevRow ? (int)$prevRow['quantity_issued'] : 0;

            $delta = $iss_qty - $prevIssued; // only deduct the additional issued
            if ($delta < 0) $delta = 0;

            // deduct stock
            if ($delta > 0) {
                $updStock = $conn->prepare("UPDATE tbl_item SET initial_quantity = initial_quantity - ? WHERE item_id = ?");
                $updStock->bind_param("ii", $delta, $item_id);
                $updStock->execute();
            }

            // update ris items
            $updItem = $conn->prepare("
                UPDATE tbl_ris_items
                SET quantity_requested = ?, 
                    quantity_issued = ?, 
                    remarks = ?
                WHERE ris_id = ? AND item_id = ?
            ");
            $updItem->bind_param("iissi", $req_qty, $iss_qty, $remark, $ris_id, $item_id);
            $updItem->execute();
        }

$conn->commit();
$_SESSION['alert'] = [
    'type' => 'success',
    'message' => 'RIS updated successfully with stock adjusted.'
];
header("Location: /ivs/index.php?page=ris-list");
exit;

} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Error: ' . $e->getMessage()
    ];
    header("Location: /ivs/index.php?page=ris-list");
    exit;
}
} else {
    echo "Invalid request.";
}
