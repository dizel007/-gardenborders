<?php
// process_order.php - в начало файла
session_start();

// Подключаем товары напрямую
require_once 'products.php';
require_once 'includes/database.php';

// Проверяем, есть ли данные в сессии
if (!isset($_SESSION['order_data'])) {
    header('Location: index.php');
    exit;
}

// Проверяем наличие товаров еще раз перед оформлением
$cartItems = $_SESSION['order_data']['cart_items'];
$allAvailable = true;
$unavailableItems = [];

foreach ($cartItems as $item) {
    // Ищем товар в оригинальном массиве
    $found = false;
    $availableStock = 0;
    
    foreach ($products as $product) {
        if ($product['id'] == $item['id']) {
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
    $errorMessage = "К сожалению, пока вы оформляли заказ, некоторые товары закончились:\n";
    foreach ($unavailableItems as $item) {
        if ($item['available'] == 0) {
            $errorMessage .= "\n- {$item['name']}: товар не найден";
        } else {
            $errorMessage .= "\n- {$item['name']}: запрошено {$item['requested']} шт., в наличии осталось {$item['available']} шт.";
        }
    }
    $errorMessage .= "\n\nПожалуйста, вернитесь в корзину и измените заказ.";
    
    $_SESSION['order_error'] = $errorMessage;
    header('Location: index.php');
    exit;
}

// ... остальной код без изменений

// Получаем данные из формы
$orderData = [
    'customer' => [
        'full_name' => htmlspecialchars($_POST['full_name'] ?? ''),
        'phone' => htmlspecialchars($_POST['phone'] ?? ''),
        'email' => htmlspecialchars($_POST['email'] ?? '')
    ],
    'delivery' => [
        'method' => htmlspecialchars($_POST['delivery_method'] ?? 'pickup'),
        'address' => htmlspecialchars($_POST['delivery_address'] ?? '')
    ],
    'payment' => [
        'method' => htmlspecialchars($_POST['payment_method'] ?? 'cash')
    ],
    'comment' => htmlspecialchars($_POST['comment'] ?? ''),
    'cart_items' => $cartItems,
    'total_amount' => $_SESSION['order_data']['total_amount'],
    'order_date' => $_SESSION['order_data']['created_at'],
    'order_number' => 'GB-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT)
];

// РЕЗЕРВИРУЕМ ТОВАРЫ НА СКЛАДЕ
$reservationSuccess = true;
$reservationErrors = [];

foreach ($cartItems as $item) {
    $reserved = ProductDatabase::reserveProduct($item['id'], $item['quantity']);
    if (!$reserved) {
        $reservationSuccess = false;
        $reservationErrors[] = $item['name'];
    }
}

// Если резервирование не удалось - отменяем заказ
if (!$reservationSuccess) {
    $errorMessage = "Произошла ошибка при резервировании товаров:\n";
    foreach ($reservationErrors as $error) {
        $errorMessage .= "\n- {$error}";
    }
    $errorMessage .= "\n\nПожалуйста, повторите попытку оформления заказа.";
    
    $_SESSION['order_error'] = $errorMessage;
    header('Location: index.php');
    exit;
}

// Сохраняем заказ в базу данных
ProductDatabase::saveOrder($orderData);

// Сохраняем номер заказа в сессии
$_SESSION['last_order_number'] = $orderData['order_number'];

// Очищаем корзину из сессии
unset($_SESSION['order_data']);

// Функция для получения названия метода доставки
function getDeliveryMethodName($method) {
    $methods = [
        'pickup' => 'Самовывоз',
        'courier' => 'Курьерская доставка',
        'russia' => 'Доставка по России',
        'ozon' => 'ОЗОН Логистика'
    ];
    return $methods[$method] ?? $method;
}

// Функция для получения названия метода оплаты
function getPaymentMethodName($method) {
    $methods = [
        'cash' => 'Наличными при получении',
        'card' => 'Банковской картой онлайн'
    ];
    return $methods[$method] ?? $method;
}

// Функция для получения названия категории
function getCategoryName($category) {
    $categories = [
        'classic' => 'Для грядок',
        'wave' => 'Для цветников',
        'stone' => 'Для дорожек',
        'decor' => 'Декоративные',
        'pro' => 'PRO серия'
    ];
    return $categories[$category] ?? $category;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ оформлен - GardenBorders</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
            background: linear-gradient(180deg, #f9f9f9 0%, #ffffff 100%);
            min-height: 100vh;
        }
        
        .confirmation-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .confirmation-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .confirmation-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        
        .confirmation-icon i {
            font-size: 50px;
            color: white;
        }
        
        .confirmation-header h1 {
            color: var(--primary-green);
            margin-bottom: 10px;
        }
        
        .confirmation-header p {
            color: var(--earth-brown);
            font-size: 18px;
            margin-bottom: 20px;
        }
        
        .order-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-green);
            background: var(--light-green);
            padding: 10px 30px;
            border-radius: 50px;
            display: inline-block;
        }
        
        .confirmation-content {
            background: white;
            border-radius: var(--radius);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .info-section {
            margin-bottom: 40px;
        }
        
        .info-section:last-child {
            margin-bottom: 0;
        }
        
        .info-section h2 {
            color: var(--primary-green);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background: var(--light-green);
            padding: 20px;
            border-radius: var(--radius);
        }
        
        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .order-summary {
            background: var(--light-green);
            padding: 25px;
            border-radius: var(--radius);
            margin-top: 30px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .summary-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .summary-item.total {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-green);
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid rgba(0, 0, 0, 0.1);
        }
        
        .order-items {
            margin-top: 20px;
        }
        
        .order-item {
            display: flex;
            padding: 15px;
            background: white;
            border-radius: var(--radius);
            margin-bottom: 10px;
            align-items: center;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .item-meta {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
        }
        
        .confirmation-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }
        
        .btn-home {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--secondary-green), var(--primary-green));
            border-radius: 50px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }
        
        .btn-home:hover {
            background: linear-gradient(135deg, var(--primary-green), #1b5e20);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(46, 125, 50, 0.3);
        }
        
        .btn-print {
            padding: 15px 40px;
            background: white;
            border: 2px solid var(--primary-green);
            border-radius: 50px;
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .btn-print:hover {
            background: var(--light-green);
            transform: translateY(-2px);
        }
        
        .whats-next {
            background: var(--light-green);
            padding: 30px;
            border-radius: var(--radius);
            margin-top: 40px;
        }
        
        .whats-next h3 {
            color: var(--primary-green);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .step {
            background: white;
            padding: 20px;
            border-radius: var(--radius);
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            background: var(--primary-green);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        @media (max-width: 768px) {
            .confirmation-content {
                padding: 25px;
            }
            
            .confirmation-actions {
                flex-direction: column;
            }
            
            .btn-home,
            .btn-print {
                width: 100%;
                justify-content: center;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .order-item {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Шапка сайта -->
    <div class="top-header">
        <div class="container">
            <div class="header-left">
                <div class="logo">
                    <i class="fas fa-leaf"></i>
                    <span>Garden<span class="logo-highlight">Borders</span></span>
                </div>
                <div class="slogan">
                    <i class="fas fa-seedling"></i>
                    Заказ успешно оформлен
                </div>
            </div>
            <div class="header-right">
                <div class="contact-info">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <span class="phone-number">8 (800) 777-25-25</span>
                        <span class="phone-description">Бесплатно по России</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Навигация -->
    <nav class="main-nav">
        <div class="container">
            <ul class="nav-list">
                <li><a href="index.php"><i class="fas fa-home"></i> Главная</a></li>
                <li><a href="index.php#products"><i class="fas fa-th-large"></i> Каталог</a></li>
            </ul>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="confirmation-container">
        <div class="confirmation-header">
            <div class="confirmation-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1>Заказ успешно оформлен!</h1>
            <p>Спасибо за ваш заказ. Наш менеджер свяжется с вами в ближайшее время для подтверждения.</p>
            <div class="order-number">Номер заказа: <?php echo $orderData['order_number']; ?></div>
        </div>
        
        <div class="confirmation-content">
            <!-- Информация о заказе -->
            <div class="info-section">
                <h2><i class="fas fa-info-circle"></i> Информация о заказе</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Дата заказа</div>
                        <div class="info-value"><?php echo date('d.m.Y H:i', strtotime($orderData['order_date'])); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Статус</div>
                        <div class="info-value" style="color: var(--primary-green); font-weight: 700;">Обрабатывается</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Способ оплаты</div>
                        <div class="info-value"><?php echo getPaymentMethodName($orderData['payment']['method']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Способ доставки</div>
                        <div class="info-value"><?php echo getDeliveryMethodName($orderData['delivery']['method']); ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Информация о покупателе -->
            <div class="info-section">
                <h2><i class="fas fa-user"></i> Информация о покупателе</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">ФИО</div>
                        <div class="info-value"><?php echo $orderData['customer']['full_name']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Телефон</div>
                        <div class="info-value"><?php echo $orderData['customer']['phone']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo $orderData['customer']['email'] ?: 'Не указан'; ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Состав заказа -->
            <div class="info-section">
                <h2><i class="fas fa-box"></i> Состав заказа</h2>
                <div class="order-items">
                    <?php foreach ($orderData['cart_items'] as $item): ?>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                <div class="item-meta">
                                    <span><?php echo getCategoryName($item['category']); ?></span>
                                    <span><?php echo $item['quantity']; ?> шт. × <?php echo number_format($item['price'], 0, '', ' '); ?> ₽</span>
                                    <span style="font-weight: 700; color: var(--primary-green);">
                                        <?php echo number_format($item['price'] * $item['quantity'], 0, '', ' '); ?> ₽
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="order-summary">
                    <div class="summary-item">
                        <span>Товары (<?php echo count($orderData['cart_items']); ?> позиций):</span>
                        <span><?php echo number_format($orderData['total_amount'], 0, '', ' '); ?> ₽</span>
                    </div>
                    <div class="summary-item">
                        <span>Доставка:</span>
                        <span>
                            <?php 
                            $deliveryCost = 0;
                            if ($orderData['delivery']['method'] === 'courier') {
                                $deliveryCost = 500;
                            } elseif ($orderData['delivery']['method'] === 'russia') {
                                $deliveryCost = 800;
                            } elseif ($orderData['delivery']['method'] === 'ozon') {
                                $deliveryCost = 400;
                            }
                            echo $deliveryCost > 0 ? number_format($deliveryCost, 0, '', ' ') . ' ₽' : 'Бесплатно';
                            ?>
                        </span>
                    </div>
                    <div class="summary-item total">
                        <span>Итого:</span>
                        <span>
                            <?php 
                            echo number_format($orderData['total_amount'] + $deliveryCost, 0, '', ' '); 
                            ?> ₽
                        </span>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($orderData['comment'])): ?>
                <div class="info-section">
                    <h2><i class="fas fa-comment"></i> Комментарий к заказу</h2>
                    <div class="info-item">
                        <div class="info-value"><?php echo nl2br(htmlspecialchars($orderData['comment'])); ?></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Что дальше -->
        <div class="whats-next">
            <h3><i class="fas fa-clock"></i> Что дальше?</h3>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Подтверждение заказа</h4>
                    <p>Наш менеджер свяжется с вами в течение 30 минут для подтверждения заказа</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Подготовка товара</h4>
                    <p>Товар будет собран и подготовлен к отправке в течение 1-2 рабочих дней</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Доставка</h4>
                    <p>Мы доставим ваш заказ в согласованные сроки</p>
                </div>
            </div>
        </div>
        
        <div class="confirmation-actions">
            <a href="index.php" class="btn-home">
                <i class="fas fa-home"></i> Вернуться на главную
            </a>
            <button onclick="window.print()" class="btn-print">
                <i class="fas fa-print"></i> Распечатать заказ
            </button>
        </div>
    </main>

    <!-- Подвал -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-leaf"></i>
                        <span>Garden<span class="logo-highlight">Borders</span></span>
                    </div>
                    <p>Профессиональные решения для ландшафтного дизайна</p>
                </div>
                <div class="footer-section">
                    <h4>По вопросам заказа</h4>
                    <p><i class="fas fa-phone-alt"></i> 8 (800) 350-25-25</p>
                    <p><i class="fas fa-envelope"></i> orders@gardenborders.ru</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> GardenBorders. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        // Очищаем корзину в localStorage после оформления заказа
        document.addEventListener('DOMContentLoaded', function() {
            localStorage.removeItem('cart');
            
            // Обновляем счетчик корзины если он есть на странице
            const cartCounter = document.querySelector('.cart-count');
            if (cartCounter) {
                cartCounter.textContent = '0';
            }
        });
    </script>
</body>
</html>