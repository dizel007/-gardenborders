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
$code = $_POST['code'] ?? '';

// Валидация
$phone = $sms->validatePhone($phone);
if (!$phone || strlen($code) !== 6) {
    echo json_encode(['success' => false, 'message' => 'Неверные данные']);
    exit;
}

// Проверка кода
$result = $auth->verifyCode($phone, $code);

echo json_encode($result);

?>