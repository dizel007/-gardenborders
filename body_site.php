<?php
// Данные о товарах
require_once "products.php";

// Получение названия категории
function getCategoryName($category) {
    $categories = [
        'classic' => 'Для грядок1',
        'wave' => 'Для цветников',
        'stone' => 'Для дорожек',
        'decor' => 'Декоративные',
        'pro' => 'PRO серия'
    ];
    return $categories[$category] ?? $category;
}

// Получение CSS класса для цвета
function getColorClass($index) {
    $colors = ['color-green', 'color-brown', 'color-gray', 'color-terracotta', 'color-sand'];
    return $colors[$index] ?? 'color-green';
}

// Фильтрация товаров по категории
$category = $_GET['category'] ?? 'all';
$filteredProducts = $category === 'all' ? $products  : array_filter($products, function($product) use ($category) {
        return $product['category'] === $category;
    });
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров - GardenBorders</title>
    <!-- <link rel="stylesheet" href="styles/main.css"> -->
    <!-- <link rel="stylesheet" href="styles/products.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { padding-top: 70px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    </style>
</head>
<body>

    <div class="container">
        <!-- Заголовок -->
        <div class="section-header" style="margin-top: 60px;">
            <h2><i class="fas fa-th-large"></i> Каталог бордюров</h2>
            <p class="section-subtitle">Выберите идеальное решение для вашего сада</p>
        </div>

        <!-- Фильтры -->
        <div class="category-filter">
            <a href="?category=all#products" class="filter-btn <?php echo $category === 'all' ? 'active' : ''; ?>">
                Все бордюры
            </a>
            <a href="?category=classic#products" class="filter-btn <?php echo $category === 'classic' ? 'active' : ''; ?>">
                Для грядок
            </a>
            <a href="?category=wave#products" class="filter-btn <?php echo $category === 'wave' ? 'active' : ''; ?>">
                Для цветников
            </a>
            <a href="?category=stone#products" class="filter-btn <?php echo $category === 'stone' ? 'active' : ''; ?>">
                Для дорожек
            </a>
            <a href="?category=decor#products" class="filter-btn <?php echo $category === 'decor' ? 'active' : ''; ?>">
                Декоративные
            </a>
            <a href="?category=pro#products" class="filter-btn <?php echo $category === 'pro' ? 'active' : ''; ?>">
                PRO серия
            </a>
        </div>

        <!-- Сообщение если товаров нет -->
        <?php if (empty($filteredProducts)): ?>
            <div class="no-products">
                <i class="fas fa-search"></i>
                <h3>Товары не найдены</h3>
                <p>Попробуйте выбрать другую категорию</p>
            </div>
        <?php endif; ?>

        <!-- Сетка товаров -->
        <div class="products-grid">
            <?php foreach ($filteredProducts as $product): ?>
                <div class="product-card" data-category="<?php echo $product['category']; ?>" data-id="<?php echo $product['id']; ?>">
                    <?php if ($product['badge']): ?>
                        <div class="product-badge <?php echo $product['badge'] === 'PRO' ? 'pro' : ''; ?>">
                            <?php echo $product['badge']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-image">
                        <i class="<?php echo $product['image']; ?>"></i>
                    </div>
                    
                    <div class="product-info">
                        <div class="product-category"><?php echo getCategoryName($product['category']); ?></div>
                        <div class="product-title"><?php echo htmlspecialchars($product['name']); ?></div>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        
                        <?php if ($product['colors'] && $product['colors'] > 0): ?>
                            <div class="product-colors">
                                <?php for ($i = 0; $i < min($product['colors'], 5); $i++): ?>
                                    <div class="color-option <?php echo getColorClass($i); ?>"></div>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-meta">
                            <div class="product-stock">
                                <i class="fas fa-<?php echo $product['inStock'] > 0 ? 'check-circle' : 'times-circle'; ?>"></i>
                                <span class="stock-<?php echo $product['inStock'] > 0 ? 'high' : 'low'; ?>">
                                    <?php echo $product['inStock'] > 0 ? "В наличии: {$product['inStock']} шт." : 'Нет в наличии'; ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="product-price"><?php echo number_format($product['price'], 0, '', ' '); ?> ₽</div>
                        
                        <div class="product-features">
                            <div class="product-feature">
                                <i class="fas fa-sun"></i>
                                <span>УФ-защита</span>
                            </div>
                            <div class="product-feature">
                                <i class="fas fa-snowflake"></i>
                                <span>Морозостойкий</span>
                            </div>
                            <div class="product-feature">
                                <i class="fas fa-ruler"></i>
                                <span>Легкий монтаж</span>
                            </div>
                        </div>
                        
                        <button class="add-to-cart" 
                                onclick="addToCart(<?php echo $product['id']; ?>, event)" 
                                <?php echo $product['inStock'] === 0 ? 'disabled' : ''; ?>>
                            <i class="fas fa-cart-plus"></i> 
                            <?php echo $product['inStock'] === 0 ? 'Нет в наличии' : 'Добавить в корзину'; ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Подключение JS -->
    <script>
        // Данные товаров для JS (чтобы корзина работала)
        const productsData = <?php echo json_encode($products); ?>;
        
        // Глобальные функции корзины
        let AppState = {
            products: productsData,
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            cartCount: 0,
            cartTotal: 0
        };

        // Обновление счетчика
        function updateCartCounter() {
            const cartCount = AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
            const counter = document.querySelector('.cart-count');
            if (counter) counter.textContent = cartCount;
        }

        // Обновление при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCounter();
            
            // Анимация товаров
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        });

        // Функция добавления в корзину - ИСПРАВЛЕННАЯ ВЕРСИЯ
        function addToCart(productId, event) {
            const product = productsData.find(p => p.id === productId);
            if (!product) return;
            
            if (product.inStock === 0) {
                showNotification('Товар отсутствует в наличии', 'error');
                return;
            }
            
            // Анимация кнопки
            const button = event.target.closest('.add-to-cart');
            if (button) {
                const originalHTML = button.innerHTML;
                const originalBackground = button.style.background;
                button.style.transform = 'scale(0.95)';
                button.innerHTML = '<i class="fas fa-check"></i> Добавлено!';
                button.style.background = 'linear-gradient(135deg, #2e7d32, #4caf50)';
                
                setTimeout(() => button.style.transform = 'scale(1)', 200);
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.style.background = originalBackground;
                }, 1500);
            }
            
            const existingItemIndex = AppState.cart.findIndex(item => item.id === productId);
            
            if (existingItemIndex > -1) {
                if (AppState.cart[existingItemIndex].quantity < product.inStock) {
                    AppState.cart[existingItemIndex].quantity += 1;
                    showNotification(`Товар "${product.name}" добавлен в корзину (${AppState.cart[existingItemIndex].quantity} шт.)`, 'success');
                } else {
                    showNotification(`Нельзя добавить больше товара "${product.name}". В наличии только ${product.inStock} шт.`, 'error');
                    return;
                }
            } else {
                AppState.cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    category: product.category,
                    quantity: 1
                });
                showNotification(`Товар "${product.name}" добавлен в корзину`, 'success');
            }
            
            // Сохраняем в localStorage
            localStorage.setItem('cart', JSON.stringify(AppState.cart));
            
            // Обновляем счетчик
            updateCartCounter();
            
            // СИНХРОНИЗИРУЕМ С ГЛОБАЛЬНЫМ СОСТОЯНИЕМ (ВАЖНО!)
            if (window.AppState) {
                window.AppState.cart = AppState.cart;
                window.AppState.cartCount = AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
                
                // Обновляем глобальный счетчик
                const globalCounter = document.querySelector('.cart-count');
                if (globalCounter) {
                    globalCounter.textContent = window.AppState.cartCount;
                }
                
                // Вызываем глобальные функции обновления
                if (window.updateCartTotals) window.updateCartTotals();
                if (window.updateCartUI) window.updateCartUI();
                if (window.saveCartToStorage) window.saveCartToStorage();
            }
            
            // Эффект пульсации
            const cartIcon = document.querySelector('.cart-icon');
            if (cartIcon) {
                cartIcon.style.animation = 'pulse 0.5s ease';
                setTimeout(() => cartIcon.style.animation = '', 500);
            }
        }

        // Функция уведомлений
        function showNotification(message, type = 'success') {
            const existingNotifications = document.querySelectorAll('.notification.show');
            existingNotifications.forEach(notification => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            });
            
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            let icon = 'fas fa-check-circle';
            if (type === 'error') icon = 'fas fa-exclamation-circle';
            if (type === 'info') icon = 'fas fa-info-circle';
            
            notification.innerHTML = `
                <i class="${icon}"></i>
                <span>${message}</span>
                <button class="notification-close" onclick="this.parentElement.remove()">&times;</button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.add('show'), 10);
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        }

        // Функция для загрузки корзины из localStorage при загрузке страницы
        function loadCartFromStorage() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                try {
                    AppState.cart = JSON.parse(savedCart);
                    updateCartCounter();
                } catch (e) {
                    console.error('Ошибка загрузки корзины:', e);
                    AppState.cart = [];
                }
            }
        }

        // Загружаем корзину при загрузке страницы
        document.addEventListener('DOMContentLoaded', loadCartFromStorage);

        // Делаем функции глобальными
        window.addToCart = addToCart;
        window.showNotification = showNotification;
        window.updateCartCounter = updateCartCounter;
    </script>

    <!-- Стили для уведомлений -->
    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 20px 25px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            z-index: 1100;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 15px;
            max-width: 400px;
            transform: translateX(120%);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55), opacity 0.5s ease;
        }
        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }
        .notification.success {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            border-left: 5px solid #ffeb3b;
        }
        .notification.error {
            background: linear-gradient(135deg, #f44336, #e53935);
            border-left: 5px solid #ffcdd2;
        }
        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            margin-left: auto;
            opacity: 0.7;
        }
        .notification-close:hover {
            opacity: 1;
        }
        
        /* Анимация для значка корзины */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Анимация появления товаров */
        .product-card {
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
        }
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>