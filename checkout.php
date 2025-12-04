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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
            background: linear-gradient(180deg, #f9f9f9 0%, #ffffff 100%);
            min-height: 100vh;
        }
        
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .checkout-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .checkout-header h1 {
            color: var(--primary-green);
            margin-bottom: 10px;
        }
        
        .checkout-header p {
            color: var(--earth-brown);
            font-size: 18px;
        }
        
        .checkout-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
            position: relative;
        }
        
        .checkout-progress:before {
            content: '';
            position: absolute;
            top: 15px;
            left: 10%;
            right: 10%;
            height: 3px;
            background: #e0e0e0;
            z-index: 1;
        }
        
        .progress-step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        
        .progress-step.active .step-circle {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
        }
        
        .step-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: 600;
            color: #999;
        }
        
        .step-label {
            font-size: 14px;
            color: #666;
        }
        
        .active .step-label {
            color: var(--primary-green);
            font-weight: 600;
        }
        
        .checkout-content {
            background: white;
            border-radius: var(--radius);
            padding: 40px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .order-summary {
            margin-bottom: 40px;
        }
        
        .order-summary h2 {
            color: var(--primary-green);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .order-items {
            border: 1px solid #eee;
            border-radius: var(--radius);
            overflow: hidden;
        }
        
        .order-item {
            display: flex;
            padding: 20px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .item-image i {
            font-size: 30px;
            color: var(--primary-green);
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark-gray);
        }
        
        .item-category {
            font-size: 12px;
            color: var(--primary-green);
            background: var(--light-green);
            padding: 3px 10px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .item-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-price {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 18px;
        }
        
        .item-quantity {
            color: #666;
        }
        
        .order-total {
            background: var(--light-green);
            padding: 25px;
            border-radius: var(--radius);
            margin-top: 30px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .total-row.final {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-green);
            padding-top: 15px;
            border-top: 2px solid #ddd;
            margin-top: 20px;
        }
        
        .delivery-section {
            margin-bottom: 40px;
        }
        
        .delivery-section h2 {
            color: var(--primary-green);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .delivery-options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .delivery-option {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            padding: 25px;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }
        
        .delivery-option:hover {
            border-color: var(--secondary-green);
            transform: translateY(-5px);
        }
        
        .delivery-option.selected {
            border-color: var(--primary-green);
            background: var(--light-green);
        }
        
        .delivery-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        
        .delivery-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .delivery-icon i {
            font-size: 25px;
            color: white;
        }
        
        .delivery-option h3 {
            color: var(--dark-gray);
            margin-bottom: 10px;
        }
        
        .delivery-price {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 20px;
            margin-top: 15px;
        }
        
        .delivery-time {
            display: inline-block;
            background: var(--accent-orange);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }
        
        .payment-section {
            margin-bottom: 40px;
        }
        
        .payment-section h2 {
            color: var(--primary-green);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .payment-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .payment-option {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            padding: 25px;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }
        
        .payment-option:hover {
            border-color: var(--secondary-green);
        }
        
        .payment-option.selected {
            border-color: var(--primary-green);
            background: var(--light-green);
        }
        
        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        
        .payment-icon {
            font-size: 40px;
            color: var(--primary-green);
            margin-bottom: 15px;
        }
        
        .checkout-actions {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 40px;
        }
        
        .btn-back {
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
        }
        
        .btn-back:hover {
            background: var(--light-green);
            transform: translateY(-2px);
        }
        
        .btn-submit {
            padding: 15px 50px;
            background: linear-gradient(135deg, var(--secondary-green), var(--primary-green));
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-green), #1b5e20);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(46, 125, 50, 0.3);
        }
        
        .form-section {
            margin-bottom: 40px;
        }
        
        .form-section h2 {
            color: var(--primary-green);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            font-size: 16px;
            font-family: inherit;
            transition: var(--transition);
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        @media (max-width: 768px) {
            .checkout-content {
                padding: 25px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .order-item {
                flex-direction: column;
                text-align: center;
            }
            
            .item-image {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .checkout-actions {
                flex-direction: column;
            }
            
            .btn-back,
            .btn-submit {
                width: 100%;
                justify-content: center;
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
                    </div>
                </div>
                
                <!-- Секция оплаты -->
                <div class="payment-section">
                    <h2><i class="fas fa-credit-card"></i> Способ оплаты</h2>
                    <div class="payment-options">
                        <label class="payment-option selected">
                            <input type="radio" name="payment_method" value="cash" checked>
                            <div class="payment-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h3>Наличными</h3>
                            <p>Оплата при получении</p>
                        </label>
                        
                        <label class="payment-option">
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

    <script>
        // JavaScript для взаимодействия с выбором опций
        document.addEventListener('DOMContentLoaded', function() {
            // Обработка выбора способа доставки
            const deliveryOptions = document.querySelectorAll('.delivery-option');
            deliveryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    deliveryOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
            
            // Обработка выбора способа оплаты
            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
            
            // Маска для телефона
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        value = '+7 (' + value;
                        if (value.length > 7) {
                            value = value.slice(0, 7) + ') ' + value.slice(7);
                        }
                        if (value.length > 12) {
                            value = value.slice(0, 12) + '-' + value.slice(12);
                        }
                        if (value.length > 15) {
                            value = value.slice(0, 15) + '-' + value.slice(15);
                        }
                    }
                    this.value = value;
                });
            }
            
            // Валидация формы
            const form = document.getElementById('checkoutForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#f44336';
                        } else {
                            field.style.borderColor = '';
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Пожалуйста, заполните все обязательные поля, отмеченные звездочкой (*)');
                    }
                });
            }
        });
    </script>
</body>
</html>