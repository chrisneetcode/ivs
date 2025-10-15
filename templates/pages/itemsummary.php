
<?php
require_once __DIR__ . '/../../includes/conn.php';
$db = new DBConnection();
$conn = $db->conn;

// Fetch ALL items (no pagination)
$query = "SELECT item_id, item_name, initial_quantity FROM tbl_item ORDER BY item_name ASC";
$result = $conn->query($query);
?>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white fw-bold">
            Item Summary
        </div>

        <div class="card-body">
            <!-- Live Search Input -->
            <div class="mb-3">
                <input type="text" id="liveSearch" class="form-control" placeholder="Search Item">
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="itemsTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 70%;">Item</th>
                            <th style="width: 30%;">Quantity Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <a href="stockcardv1.php?item_id=<?= $row['item_id'] ?>" 
                                           class="text-decoration-none text-success fw-semibold">
                                           <?= htmlspecialchars($row['item_name']) ?>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($row['initial_quantity']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr class="no-data">
                                <td colspan="2" class="text-center text-muted">No items found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("liveSearch");
    const table = document.getElementById("itemsTable");
    const rows = table.querySelectorAll("tbody tr");

    let noDataRow = table.querySelector(".no-data");
    if (!noDataRow) {
        noDataRow = document.createElement("tr");
        noDataRow.classList.add("no-data");
        noDataRow.innerHTML = `<td colspan="2" class="text-center text-muted">No items found.</td>`;
        noDataRow.style.display = "none";
        table.querySelector("tbody").appendChild(noDataRow);
    }

    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.classList.contains("no-data")) return;
            const itemName = row.cells[0].textContent.toLowerCase();
            if (itemName.includes(filter)) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        noDataRow.style.display = visibleCount === 0 ? "" : "none";
    });
});
</script>