<?php
include 'DBconnection.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode([]);
    exit;
}

$stockId = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM Stock_Item WHERE Stock_ID = ?");
$stmt->execute([$stockId]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($item);
?>