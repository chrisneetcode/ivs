<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;

header('Content-Type: application/json');

if (!isset($_GET['ris_id']) || !is_numeric($_GET['ris_id'])) {
    echo json_encode(["error" => "Invalid RIS ID"]);
    exit;
}

$ris_id = intval($_GET['ris_id']);

$query = $conn->prepare("
    SELECT 
        i.item_name,
        i.unit,
        ri.quantity_requested,
        ri.quantity_issued,
        ri.remarks
    FROM tbl_ris_items ri
    INNER JOIN tbl_item i ON ri.item_id = i.item_id
    WHERE ri.ris_id = ?
");
$query->bind_param("i", $ris_id);
$query->execute();
$result = $query->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
