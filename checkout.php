<?php
// checkout.php
session_start();

// Проверяем, переданы ли данные о товарах
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart_items'])) {
    $cartItems = json_decode($_POST['cart_items'], true);
} else {
    // Если данные не переданы, перенаправляем на главную
    header('Location: index.php');
    exit;
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

// Рассчитываем итоговую сумму
$totalAmount = 0;
foreach ($cartItems as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Сохраняем данные заказа в сессию
$_SESSION['order_data'] = [
    'cart_items' => $cartItems,
    'total_amount' => $totalAmount,
    'created_at' => date('Y-m-d H:i:s')
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа - GardenBorders</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

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
                    Профессиональные решения для вашего сада
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
            <div class="header-actions">
                <a href="index.php" class="consult-btn">
                    <i class="fas fa-arrow-left"></i> Вернуться в магазин
                </a>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="checkout-container">
        <div class="checkout-header">
            <h1><i class="fas fa-shopping-cart"></i> Оформление заказа</h1>
            <p>Завершите оформление заказа, заполнив информацию ниже</p>
        </div>
        
        <div class="checkout-progress">
            <div class="progress-step active">
                <div class="step-circle">1</div>
                <div class="step-label">Корзина</div>
            </div>
            <div class="progress-step active">
                <div class="step-circle">2</div>
                <div class="step-label">Оформление</div>
            </div>
            <div class="progress-step">
                <div class="step-circle">3</div>
                <div class="step-label">Подтверждение</div>
            </div>
        </div>
        
        <form id="checkoutForm" method="POST" action="process_order.php">
            <input type="hidden" name="cart_items" value='<?php echo json_encode($cartItems, JSON_UNESCAPED_UNICODE); ?>'>
            
            <div class="checkout-content">
                <!-- Секция товаров -->
                <div class="order-summary">
                    <h2><i class="fas fa-box"></i> Состав заказа</h2>
                    <div class="order-items">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="order-item">
                                <div class="item-image">
                                    <?php 
                                    // Проверяем, есть ли изображение
                                    if (!empty($item['image']) && file_exists('images/products/' . $item['image'])): 
                                    ?>
                                        <img src="images/products/<?php echo htmlspecialchars($item['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($item['name']); ?>"
                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius);">
                                    <?php else: ?>
                                        <i class="fas fa-box"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="item-details">
                                    <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div class="item-category"><?php echo getCategoryName($item['category']); ?></div>
                                    <div class="item-meta">
                                        <div class="item-price"><?php echo number_format($item['price'], 0, '', ' '); ?> ₽</div>
                                        <div class="item-quantity">Количество: <?php echo $item['quantity']; ?> шт.</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="order-total">
                        <div class="total-row">
                            <span>Товары (<?php echo count($cartItems); ?> позиций):</span>
                            <span><?php echo number_format($totalAmount, 0, '', ' '); ?> ₽</span>
                        </div>
                        <div class="total-row">
                            <span>Скидка:</span>
                            <span style="color: var(--accent-orange);">0 ₽</span>
                        </div>
                        <div class="total-row final">
                            <span>Итого к оплате:</span>
                            <span><?php echo number_format($totalAmount, 0, '', ' '); ?> ₽</span>
                        </div>
                    </div>
                </div>
                
                <!-- Секция контактной информации -->
                <div class="form-section">
                    <h2><i class="fas fa-user"></i> Контактная информация</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">ФИО *</label>
                            <input type="text" id="full_name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="+7 (___) ___-__-__">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                </div>
                
                <!-- Секция доставки -->
                <div class="delivery-section">
                    <h2><i class="fas fa-truck"></i> Способ доставки</h2>
                    <div class="delivery-options-grid">
                        <label class="delivery-option selected">
                            <input type="radio" name="delivery_method" value="pickup" checked>
                            <div class="delivery-icon">
                                <i class="fas fa-store-alt"></i>
                            </div>
                            <h3>Самовывоз</h3>
                            <p>Заберите заказ с нашего склада в Москве</p>
                            <div class="delivery-price">Бесплатно</div>
                            <div class="delivery-time">Сегодня</div>
                        </label>
                        
                        <label class="delivery-option">
                            <input type="radio" name="delivery_method" value="courier">
                            <div class="delivery-icon">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                            <h3>Курьерская доставка</h3>
                            <p>Доставка по Москве и области</p>
                            <div class="delivery-price">500 ₽</div>
                            <div class="delivery-time">1-2 дня</div>
                        </label>
                        
                        <label class="delivery-option">
                            <input type="radio" name="delivery_method" value="russia">
                            <div class="delivery-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <h3>По России</h3>
                            <p>Доставка в любой город транспортной компанией</p>
                            <div class="delivery-price">от 800 ₽</div>
                            <div class="delivery-time">3-7 дней</div>
                        </label>

                        <label class="delivery-option">
                            <input type="radio" name="delivery_method" value="ozon">
                            <div class="delivery-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <h3>ОЗОН Логистика</h3>
                            <p>Доставка ОЗОН Логистикой в ПВЗ вашего города</p>
                            <div class="delivery-price">от 400 ₽</div>
                            <div class="delivery-time">3-7 дней</div>
                        </label>

                    </div>
                </div>
                
                <!-- Секция оплаты -->
            <div class="payment-section">
                <h2><i class="fas fa-credit-card"></i> Способ оплаты</h2>
                <div class="payment-options">
                    <label class="payment-option selected" id="cashPaymentOption">
                        <input type="radio" name="payment_method" value="cash" checked>
                        <div class="payment-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Наличными</h3>
                        <p>Оплата при получении</p>
                        <!-- Здесь будет добавляться лейбл "Только для самовывоза" через JS -->
                    </label>
                    
                    <label class="payment-option" id="cardPaymentOption">
                        <input type="radio" name="payment_method" value="card">
                        <div class="payment-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3>Банковской картой</h3>
                        <p>Онлайн оплата на сайте</p>
                    </label>
                </div>
            </div>
                            
                <!-- Секция комментария -->
                <div class="form-section">
                    <h2><i class="fas fa-comment"></i> Комментарий к заказу</h2>
                    <div class="form-group">
                        <textarea name="comment" placeholder="Укажите дополнительные пожелания или особенности доставки"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="checkout-actions">
                <a href="index.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Вернуться в корзину
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check-circle"></i> Подтвердить заказ
                </button>
            </div>
        </form>
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
                    <h4>Контакты</h4>
                    <p><i class="fas fa-phone-alt"></i> 8 (800) 350-25-25</p>
                    <p><i class="fas fa-envelope"></i> info@gardenborders.ru</p>
                    <p><i class="fas fa-map-marker-alt"></i> Москва, ул. Садовая, 42</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> GardenBorders. Все права защищены.</p>
            </div>
        </div>
    </footer>

  <script src="js/checkout.js"></script>
</body>
</html>