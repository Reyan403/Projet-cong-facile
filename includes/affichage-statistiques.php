<?php
$sql = "SELECT rt.name AS type_label, COUNT(r.id) AS total
        FROM request_type rt
        LEFT JOIN request r ON r.request_type_id = rt.id
        GROUP BY rt.id, rt.name";
$stmt = $connexion->prepare($sql);
$stmt->execute();

$labels = [];
$values = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $row['type_label'];
    $values[] = (int)$row['total'];
}

$managerId = $_SESSION['manager_id'] ?? null;

$monthlyData = array_fill(1, 12, ['accepted' => 0, 'total' => 0]);

$sql = "SELECT 
    MONTH(r.created_at) AS month,
    r.answer AS status,
    COUNT(*) AS count
FROM request r
JOIN user u ON r.collaborator_id = u.id
JOIN person p ON u.person_id = p.id
WHERE p.manager_id = :manager_id
GROUP BY MONTH(r.created_at), r.answer
ORDER BY month";

$stmt = $connexion->prepare($sql);
$stmt->bindParam(':manager_id', $managerId, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $month = (int)$row['month'];
    $count = (int)$row['count'];

    $monthlyData[$month]['total'] += $count;

    if ((int)$row['status'] === 1) {
        $monthlyData[$month]['accepted'] += $count;
    }
}

$monthlyPercentages = [];
for ($i = 1; $i <= 12; $i++) {
    $total = $monthlyData[$i]['total'];
    $accepted = $monthlyData[$i]['accepted'];
    $percentage = $total > 0 ? round(($accepted / $total) * 100, 2) : 0;
    $monthlyPercentages[] = $percentage;
}