<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$trackingId = trim($_GET['id'] ?? '');

if (empty($trackingId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Tracking ID is required.']);
    exit;
}

$dataPath = __DIR__ . '/data/grievances.json';
if (!file_exists($dataPath)) {
    echo json_encode(['success' => false, 'message' => 'No records found.']);
    exit;
}

$grievances = json_decode(file_get_contents($dataPath), true) ?: [];

$found = null;
foreach ($grievances as $g) {
    if (strcasecmp($g['id'], $trackingId) === 0) {
        $found = $g;
        break;
    }
}

if ($found) {
    echo json_encode(['success' => true, 'data' => $found]);
} else {
    echo json_encode(['success' => false, 'message' => 'Grievance ID not found. Please verify your reference number.']);
}

