<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Only POST requests are allowed.']);
    exit;
}

// Read raw JSON or form POST
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$name = trim($input['name'] ?? '');
$phone = trim($input['phone'] ?? '');
$ward = trim($input['ward'] ?? '');
$locality = trim($input['locality'] ?? '');
$category = trim($input['category'] ?? '');
$priority = trim($input['priority'] ?? 'Medium');
$description = trim($input['description'] ?? '');

if (empty($name) || empty($phone) || empty($ward) || empty($description)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please fill in all mandatory fields: Name, Phone, Ward, and Description.']);
    exit;
}

$dataPath = __DIR__ . '/data/grievances.json';
$grievances = [];
if (file_exists($dataPath)) {
    $existing = file_get_contents($dataPath);
    $grievances = json_decode($existing, true) ?: [];
}

// Generate unique tracking code
$trackingId = 'VR-BV-' . rand(1000, 9999);

$newGrievance = [
    'id' => $trackingId,
    'timestamp' => date('Y-m-d H:i:s'),
    'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
    'phone' => htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'),
    'ward' => htmlspecialchars($ward, ENT_QUOTES, 'UTF-8'),
    'locality' => htmlspecialchars($locality, ENT_QUOTES, 'UTF-8'),
    'category' => htmlspecialchars($category, ENT_QUOTES, 'UTF-8'),
    'priority' => htmlspecialchars($priority, ENT_QUOTES, 'UTF-8'),
    'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
    'status' => 'Received',
    'notes' => 'Acknowledged. Assigned to ward coordination team for review.'
];

array_unshift($grievances, $newGrievance);
file_put_contents($dataPath, json_encode($grievances, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Trigger Automated Server-Side WhatsApp Dispatch
require_once __DIR__ . '/includes/whatsapp_service.php';
$dispatchResult = sendAutomatedWhatsAppGrievance($newGrievance);

echo json_encode([
    'success' => true,
    'tracking_id' => $trackingId,
    'message' => 'Your civic grievance has been recorded successfully. Rohini Vegesna\'s team will follow up promptly.',
    'data' => $newGrievance,
    'whatsapp_sent' => $dispatchResult['sent'] ?? false,
    'whatsapp_recipient' => $dispatchResult['recipient'] ?? '',
    'whatsapp_details' => $dispatchResult['details'] ?? ''
]);

