<?php
require_once '../config.php';
require_once 'config.php';


header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Метод не поддерживается']);
    exit;
}

$phone = $_POST['phone'] ?? '';

// Валидация телефона
$phone = $sms->validatePhone($phone);
if (!$phone) {
    echo json_encode(['success' => false, 'message' => 'Неверный формат номера']);
    exit;
}

// Отправка кода
$result = $auth->sendSMSCode($phone);

echo json_encode($result);
?>