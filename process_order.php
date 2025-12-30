<?php
session_start();
require_once 'config.php';
// блокируем вывод JS кода в product.php
$do_not_start_js_code_in_product_php = 1;
// Подключаем товары напрямую
require_once 'products.php';
require_once 'includes/database.php';

/// Доставем послений номер заказа 
try {
    $stmt = $pdo->prepare("SELECT * FROM orders ORDER BY id DESC LIMIT 1;");
    $stmt->execute([]);
    $LastOrder = $stmt->fetch(PDO::FETCH_ASSOC);
    $small_order_number = $LastOrder['small_order_number'] + 1;
 } catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

// Проверяем, есть ли данные в сессии
if (!isset($_SESSION['order_data'])) {
        header('Location: index.php');
    exit;
}
//****************************************************************************************************************
// Сохраним данные о пользователие
//****************************************************************************************************************
        $full_name_for_db = htmlspecialchars($_POST['full_name']);
        $email_for_db     = htmlspecialchars($_POST['email']);
        $login_phone      = $_COOKIE['login_phone'];

$stmt = $pdo->prepare("UPDATE `users` SET full_name= :full_name, email= :email WHERE phone =:phone");
$stmt->execute(array("phone" => $login_phone,
                     "full_name" => $full_name_for_db,
                     "email" => $email_for_db));




// Проверяем наличие товаров еще раз перед оформлением
$cartItems = $_SESSION['order_data']['cart_items'];
$allAvailable = true;
$unavailableItems = [];

foreach ($cartItems as &$item) {
    // Ищем товар в оригинальном массиве
    $found = false;
    $availableStock = 0;
    
    foreach ($products as $product) {
        if ($product['id'] == $item['id']) {
            $item['article'] = $product['article'];
            $found = true;
            $availableStock = $product['inStock'];
            break;
        }
    }
    
    if (!$found || $item['quantity'] > $availableStock) {
        $allAvailable = false;
        $unavailableItems[] = [
            'name' => $item['name'],
            'requested' => $item['quantity'],
            'available' => $found ? $availableStock : 0
        ];
    }
}

// Если товары стали недоступны - показываем ошибку
if (!$allAvailable) {
    $errorMessage = "К сожалению, пока вы оформляли заказ, некоторые товары закончились:";
    foreach ($unavailableItems as $item) {
        if ($item['available'] == 0) {
            $errorMessage .= "\n- {$item['name']}: товар не найден";
        } else {
            $errorMessage .= "\n- {$item['name']}: запрошено {$item['requested']} шт., в наличии осталось {$item['available']} шт.";
        }
    }
    $errorMessage .= "\nПожалуйста, вернитесь в корзину и измените заказ.";
    
    $_SESSION['order_error'] = $errorMessage;
    //    die('NOT SECCION');
       header('Location: index.php');
    exit;
}

// Получаем данные из формы
$orderData = [
    'customer' => [
        'full_name' => htmlspecialchars($_POST['full_name'] ?? ''),
        'phone' =>     htmlspecialchars($_POST['phone'] ?? ''),
        'email' =>     htmlspecialchars($_POST['email'] ?? '')
    ],
    'delivery' => [
        'method' =>    htmlspecialchars($_POST['delivery_method'] ?? 'pickup'),
        'address' =>   htmlspecialchars($_POST['delivery_address'] ?? '')
    ],
    'payment' => [
        'method' =>    htmlspecialchars($_POST['payment_method'] ?? 'cash')
    ],
    'comment' =>       htmlspecialchars($_POST['comment'] ?? ''),
    'cart_items' =>   $cartItems,
    'total_amount' => $_SESSION['order_data']['total_amount'],
    'order_date' =>   $_SESSION['order_data']['created_at'],
    'order_number' => 'GB-' . date('Ymd') . '-' . str_pad($small_order_number , 4, '0', STR_PAD_LEFT)
];

// Сохраняем данные заказа в сессию
$_SESSION['order_number'] = $orderData['order_number'];

/***************************************************************************************************************
*********  Создаем заказ в БД
************************************************************************************************************** */
// echo "<pre>";
// print_r($orderData);
try {
    $sql = "INSERT INTO orders(order_number, order_date, total_amount, paid, small_order_number) 
                     VALUES ( :order_number, :order_date, :total_amount, :paid, :small_order_number)";
    
    // Подготовка запроса
    $stmt = $pdo->prepare($sql);
    
    // Данные для вставки
    $data = [
        'order_number' => $orderData['order_number'],
        'order_date' => $orderData['order_date'],
        'total_amount' => $orderData['total_amount'],
        'paid' => 0,
        'small_order_number' => $small_order_number // текущая дата и время
    ];
    
    // Выполнение запроса
    $stmt->execute($data);
    
    // echo "Заказ успешно добавлен. ID: " . $pdo->lastInsertId();
    
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

/***************************************************************************************************************
********* Записываем товары в таблицу резервов
************************************************************************************************************** */
$dateTime = new DateTime();
$dateTime->modify('+15 minutes');
// $expiresAt = '2025-12-31T23:59:59Z'; // Дата окончания оплаты
$reserv_time = $dateTime->format('Y-m-d H:i:s');

foreach ($orderData['cart_items'] as $cart_items) {
 try {
    $sql = "INSERT INTO reserv_stocks(article, quantity, time_order, reserve_time, processed, id_product) 
                     VALUES ( :article, :quantity, :time_order, :reserve_time, :processed , :id_product)";
    
    // Подготовка запроса
    $stmt = $pdo->prepare($sql);

    // Данные для вставки
    $data = [
        'article' => $cart_items['article'],
        'quantity' => $cart_items['quantity'],
        'time_order' => $orderData['order_date'],
        'reserve_time' => $reserv_time,
        'processed' => 0,
        'id_product' => $cart_items['id'] 
    ];
    
    // Выполнение запроса
    $stmt->execute($data);
    $reservStockId_data_for_delete[] = $pdo->lastInsertId();
    // echo "Записали в таблицу резерва: " . $pdo->lastInsertId() . " <br>";
   
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}   
 $orderData['reservStockId_data_for_delete'] =  $reservStockId_data_for_delete;
}



// Сохраняем заказ в папку на сайте 
ProductDatabase::saveOrder($orderData);

if ($_POST['payment_method'] != 'cash') {
    require_once "pay_ozon_order.php";
} else {
    $successUrl = "pay_ok_ozon.php?order_number=".$orderData['order_number'];
    header('Location: '.$successUrl);
}
exit();
?>