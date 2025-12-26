
<?php
//  Проверка доступности товаров в корзине
// get-product-availability.php
session_start();
require_once "config.php";

// Подключение к БД
try {  
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
    $pdo->exec('SET NAMES utf8');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Получаем данные из POST запроса
$input = json_decode(file_get_contents('php://input'), true);
$productIds = $input['productIds'] ?? [];

if (empty($productIds)) {
    echo json_encode([]);
    exit;
}

// Преобразуем ID в числа и фильтруем
$productIds = array_map('intval', $productIds);
$productIds = array_filter($productIds);

if (empty($productIds)) {
    echo json_encode([]);
    exit;
}

// Создаем строку с placeholders для IN условия
$placeholders = implode(',', array_fill(0, count($productIds), '?'));

// Получаем товары из БД
$stmt = $pdo->prepare("SELECT id, name, inStock FROM stocks WHERE id IN ($placeholders)");
$stmt->execute($productIds);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Формируем массив с наличием
$availabilityData = [];
foreach ($products as $product) {
    $availabilityData[$product['id']] = [
        'inStock' => intval($product['inStock']),
        'name' => $product['name']
    ];
}

// Для товаров, которых нет в БД, устанавливаем наличие по умолчанию
foreach ($productIds as $id) {
    if (!isset($availabilityData[$id])) {
        $availabilityData[$id] = [
            'inStock' => 0,
            'name' => 'Товар не найден'
        ];
    }
}

// Устанавливаем заголовок для JSON
header('Content-Type: application/json');
echo json_encode($availabilityData);