<?php
// checkout.php
session_start();

// Подключаем базу данных товаров
require_once 'includes/database.php';
require_once 'products.php'; // Подключаем напрямую

// Проверяем, переданы ли данные о товарах
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart_items'])) {
    $cartItems = json_decode($_POST['cart_items'], true);
    
    // Проверяем наличие всех товаров НАПРЯМУЮ из массива $products
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
        
        if (!$found) {
            $allAvailable = false;
            $unavailableItems[] = [
                'name' => $item['name'],
                'requested' => $item['quantity'],
                'available' => 0
            ];
        } elseif ($item['quantity'] > $availableStock) {
            $allAvailable = false;
            $unavailableItems[] = [
                'name' => $item['name'],
                'requested' => $item['quantity'],
                'available' => $availableStock
            ];
        }
    }
    
    // Если какие-то товары недоступны - показываем ошибку
    if (!$allAvailable) {
        $errorMessage = "Некоторые товары недоступны в запрошенном количестве:\n";
        foreach ($unavailableItems as $item) {
            if ($item['available'] == 0) {
                $errorMessage .= "\n- {$item['name']}: товар не найден";
            } else {
                $errorMessage .= "\n- {$item['name']}: запрошено {$item['requested']} шт., в наличии {$item['available']} шт.";
            }
        }
        $errorMessage .= "\n\nПожалуйста, вернитесь в корзину и измените количество товаров.";
        
        // Сохраняем ошибку в сессии и перенаправляем обратно
        $_SESSION['checkout_error'] = $errorMessage;
        header('Location: index.php');
        exit;
    }
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

<!-- Остальной HTML код остается без изменений -->
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
                            <?php 
                            // Находим товар в оригинальном массиве для получения актуального остатка
                            $currentStock = 0;
                            foreach ($products as $product) {
                                if ($product['id'] == $item['id']) {
                                    $currentStock = $product['inStock'];
                                    break;
                                }
                            }
                            ?>
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
                                    <div class="stock-info">
                                        <i class="fas fa-warehouse"></i>
                                        <span>На складе: <?php echo $currentStock; ?> шт.</span>
                                        <?php if ($item['quantity'] > $currentStock): ?>
                                            <span style="color: #f44336; font-size: 12px; margin-left: 10px;">
                                                <i class="fas fa-exclamation-triangle"></i> Запрошено больше чем есть в наличии
                                            </span>
                                        <?php endif; ?>
                                    </div>
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
                            <input type="tel" id="phone" name="phone" required placeholder="79161234567">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@mail.ru">
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

    <script>
        // JavaScript для взаимодействия с выбором опций
        document.addEventListener('DOMContentLoaded', function() {
            // Получаем элементы
            const deliveryOptions = document.querySelectorAll('.delivery-option');
            const paymentOptions = document.querySelectorAll('.payment-option');
            const cashPaymentOption = document.querySelector('.payment-option input[value="cash"]').closest('.payment-option');
            const cardPaymentOption = document.querySelector('.payment-option input[value="card"]').closest('.payment-option');
            const cashRadio = document.querySelector('input[value="cash"]');
            const cardRadio = document.querySelector('input[value="card"]');
            
            // Функция для проверки возможности оплаты наличными
            function checkCashPaymentAvailability() {
                const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
                
                if (selectedDelivery && selectedDelivery.value === 'pickup') {
                    // Для самовывоза - наличные доступны
                    cashPaymentOption.classList.remove('disabled');
                    cashRadio.disabled = false;
                    
                    // Добавляем/удаляем лейбл
                    let disabledLabel = cashPaymentOption.querySelector('.disabled-label');
                    if (disabledLabel) {
                        disabledLabel.remove();
                    }
                } else {
                    // Для других способов доставки - наличные недоступны
                    cashPaymentOption.classList.add('disabled');
                    cashRadio.disabled = true;
                    
                    // Если наличные были выбраны - переключаем на карту
                    if (cashRadio.checked) {
                        cardRadio.checked = true;
                        cashPaymentOption.classList.remove('selected');
                        cardPaymentOption.classList.add('selected');
                    }
                    
                    // Добавляем лейбл "Только для самовывоза"
                    let disabledLabel = cashPaymentOption.querySelector('.disabled-label');
                    if (!disabledLabel) {
                        disabledLabel = document.createElement('span');
                        disabledLabel.className = 'disabled-label';
                        disabledLabel.textContent = 'Только для самовывоза';
                        cashPaymentOption.appendChild(disabledLabel);
                    }
                }
            }
            
            // Обработка выбора способа доставки
            deliveryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    deliveryOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    // Проверяем доступность наличных
                    checkCashPaymentAvailability();
                });
            });
            
            // Обработка выбора способа оплаты (только если не заблокирован)
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const radio = this.querySelector('input[type="radio"]');
                    if (radio.disabled) return;
                    
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
            
            // Инициализация при загрузке
            checkCashPaymentAvailability();
            
            // Простой ввод телефона - только цифры
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.placeholder = "79161234567";
                
                phoneInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/\D/g, '');
                    
                    if (this.value.length > 11) {
                        this.value = this.value.substring(0, 11);
                    }
                });
                
                phoneInput.addEventListener('keydown', function(e) {
                    if ((e.key >= '0' && e.key <= '9') || 
                        e.key === 'Backspace' || 
                        e.key === 'Delete' ||
                        e.key === 'Tab' ||
                        e.key === 'ArrowLeft' ||
                        e.key === 'ArrowRight' ||
                        e.key === 'ArrowUp' ||
                        e.key === 'ArrowDown' ||
                        e.key === 'Home' ||
                        e.key === 'End') {
                        return;
                    }
                    
                    e.preventDefault();
                });
            }
            
            // Автоматическое форматирование ФИО
            const fullNameInput = document.getElementById('full_name');
            if (fullNameInput) {
                fullNameInput.addEventListener('blur', function() {
                    if (this.value) {
                        this.value = this.value
                            .toLowerCase()
                            .split(' ')
                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                            .join(' ');
                    }
                });
            }
            
            // Валидация формы при отправке
            const form = document.getElementById('checkoutForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    // Сбрасываем все ошибки
                    form.querySelectorAll('.error-message').forEach(error => error.remove());
                    form.querySelectorAll('input, textarea').forEach(field => {
                        field.style.borderColor = '';
                    });
                    
                    // Проверка обязательных полей
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#f44336';
                            
                            let errorDiv = field.parentElement.querySelector('.error-message');
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'error-message';
                                errorDiv.style.color = '#f44336';
                                errorDiv.style.fontSize = '12px';
                                errorDiv.style.marginTop = '5px';
                                errorDiv.textContent = 'Это поле обязательно для заполнения';
                                field.parentElement.appendChild(errorDiv);
                            }
                        }
                    });
                    
                    // Проверка телефона
                    const phone = document.getElementById('phone');
                    if (phone && phone.value) {
                        const phoneDigits = phone.value.replace(/\D/g, '');
                        
                        if (phoneDigits.length !== 11) {
                            isValid = false;
                            phone.style.borderColor = '#f44336';
                            
                            let errorDiv = phone.parentElement.querySelector('.error-message');
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'error-message';
                                errorDiv.style.color = '#f44336';
                                errorDiv.style.fontSize = '12px';
                                errorDiv.style.marginTop = '5px';
                                errorDiv.textContent = 'Введите 11 цифр номера телефона';
                                phone.parentElement.appendChild(errorDiv);
                            }
                        } else if (!phoneDigits.startsWith('7') && !phoneDigits.startsWith('8')) {
                            isValid = false;
                            phone.style.borderColor = '#f44336';
                            
                            let errorDiv = phone.parentElement.querySelector('.error-message');
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'error-message';
                                errorDiv.style.color = '#f44336';
                                errorDiv.style.fontSize = '12px';
                                errorDiv.style.marginTop = '5px';
                                errorDiv.textContent = 'Номер телефона должен начинаться с 7 или 8';
                                phone.parentElement.appendChild(errorDiv);
                            }
                        }
                    }
                    
                    // Проверка email если указан
                    const email = document.getElementById('email');
                    if (email && email.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(email.value)) {
                            isValid = false;
                            email.style.borderColor = '#f44336';
                            
                            let errorDiv = email.parentElement.querySelector('.error-message');
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'error-message';
                                errorDiv.style.color = '#f44336';
                                errorDiv.style.fontSize = '12px';
                                errorDiv.style.marginTop = '5px';
                                errorDiv.textContent = 'Введите корректный email адрес';
                                email.parentElement.appendChild(errorDiv);
                            }
                        }
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                        
                        const firstError = form.querySelector('[style*="border-color: rgb(244, 67, 54)"]');
                        if (firstError) {
                            firstError.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center' 
                            });
                            
                            setTimeout(() => {
                                firstError.focus();
                            }, 500);
                        }
                    } else {
                        // Если валидация прошла успешно, форматируем телефон перед отправкой
                        if (phone && phone.value) {
                            const phoneDigits = phone.value.replace(/\D/g, '');
                            if (phoneDigits.length === 11) {
                                phone.value = '+7 (' + phoneDigits.substring(1, 4) + ') ' + 
                                             phoneDigits.substring(4, 7) + '-' + 
                                             phoneDigits.substring(7, 9) + '-' + 
                                             phoneDigits.substring(9, 11);
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>