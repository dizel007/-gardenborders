<?php
// body_site.php
require_once "products.php";

// Путь к папке с изображениями
$imagePath = "images/products/";
$defaultImage = "default.jpg";

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

function getColorClass($index) {
    $colors = ['color-green', 'color-brown', 'color-gray', 'color-terracotta', 'color-sand'];
    return $colors[$index] ?? 'color-green';
}

// Функция для проверки существования изображения
function getProductImage($imageName, $defaultImage, $imagePath) {
    $fullPath = $imagePath . $imageName;
    if (file_exists($fullPath)) {
        return $fullPath;
    }
    return $imagePath . $defaultImage;
}

$category = $_GET['category'] ?? 'all';
$filteredProducts = $category === 'all' ? $products : array_filter($products, function($product) use ($category) {
    return $product['category'] === $category;
});
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров - GardenBorders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { padding-top: 70px; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="section-header" style="margin-top: 60px;">
            <h2><i class="fas fa-th-large"></i> Каталог бордюров</h2>
            <p class="section-subtitle">Выберите идеальное решение для вашего сада</p>
        </div>

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

        <?php if (empty($filteredProducts)): ?>
            <div class="no-products">
                <i class="fas fa-search"></i>
                <h3>Товары не найдены</h3>
                <p>Попробуйте выбрать другую категорию</p>
            </div>
        <?php endif; ?>

        <div class="products-grid">
            <?php foreach ($filteredProducts as $product): ?>
                <div class="product-card" data-category="<?php echo $product['category']; ?>" data-id="<?php echo $product['id']; ?>">
                    <?php if ($product['badge']): ?>
                        <div class="product-badge <?php echo $product['badge'] === 'PRO' ? 'pro' : ''; ?>">
                            <?php echo $product['badge']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-image">
                        <!-- Основное изображение товара -->
                        <img src="<?php echo getProductImage($product['images'][0] ?? '', $defaultImage, $imagePath); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" 
                             class="main-product-image"
                             data-product-id="<?php echo $product['id']; ?>">
                        
                        <!-- Навигация по изображениям (кружочки) -->
                        <?php if (count($product['images'] ?? []) > 1): ?>
                            <div class="image-navigation" data-product-id="<?php echo $product['id']; ?>">
                                <?php foreach ($product['images'] as $index => $image): ?>
                                    <button class="image-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                                            data-index="<?php echo $index; ?>"
                                            data-image="<?php echo getProductImage($image, $defaultImage, $imagePath); ?>"
                                            onmouseover="changeProductImage(<?php echo $product['id']; ?>, <?php echo $index; ?>, '<?php echo getProductImage($image, $defaultImage, $imagePath); ?>')">
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
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

    <script>
        const productsData = <?php echo json_encode($products); ?>;
        const imagePath = "<?php echo $imagePath; ?>";
        const defaultImage = "<?php echo $imagePath . $defaultImage; ?>";
        
        let AppState = {
            products: productsData,
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            cartCount: 0,
            cartTotal: 0
        };

        // Функция смены изображения при наведении на кружок
        function changeProductImage(productId, imageIndex, imagePath) {
            const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
            if (!productCard) return;
            
            const mainImage = productCard.querySelector('.main-product-image');
            if (!mainImage) return;
            
            // Меняем изображение
            mainImage.src = imagePath;
            
            // Обновляем активный кружок
            const dots = productCard.querySelectorAll('.image-dot');
            dots.forEach(dot => {
                dot.classList.remove('active');
                if (parseInt(dot.dataset.index) === imageIndex) {
                    dot.classList.add('active');
                }
            });
        }

        // Функция для проверки и загрузки изображений
        function checkImageExists(imageUrl, callback) {
            const img = new Image();
            img.onload = function() { callback(true); };
            img.onerror = function() { callback(false); };
            img.src = imageUrl;
        }

        // Инициализация изображений при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCounter();
            
            // Для каждого товара проверяем изображения
            productsData.forEach(product => {
                if (product.images && product.images.length > 0) {
                    const productId = product.id;
                    const dots = document.querySelectorAll(`.product-card[data-id="${productId}"] .image-dot`);
                    
                    dots.forEach((dot, index) => {
                        const imageUrl = dot.dataset.image;
                        checkImageExists(imageUrl, function(exists) {
                            if (!exists) {
                                dot.dataset.image = defaultImage;
                            }
                        });
                    });
                }
            });
            
            // Анимация товаров
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        });

        // Остальные функции (addToCart, showNotification и т.д.) остаются без изменений
        function updateCartCounter() {
            const cartCount = AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
            const counter = document.querySelector('.cart-count');
            if (counter) counter.textContent = cartCount;
        }

        function addToCart(productId, event) {
            const product = productsData.find(p => p.id === productId);
            if (!product) return;
            
            if (product.inStock === 0) {
                showNotification('Товар отсутствует в наличии', 'error');
                return;
            }
            
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
                    image: product.images ? product.images[0] : 'default.jpg',
                    category: product.category,
                    quantity: 1
                });
                showNotification(`Товар "${product.name}" добавлен в корзину`, 'success');
            }
            
            localStorage.setItem('cart', JSON.stringify(AppState.cart));
            updateCartCounter();
            
            if (window.AppState) {
                window.AppState.cart = AppState.cart;
                window.AppState.cartCount = AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
                
                const globalCounter = document.querySelector('.cart-count');
                if (globalCounter) {
                    globalCounter.textContent = window.AppState.cartCount;
                }
                
                if (window.updateCartTotals) window.updateCartTotals();
                if (window.updateCartUI) window.updateCartUI();
                if (window.saveCartToStorage) window.saveCartToStorage();
            }
            
            const cartIcon = document.querySelector('.cart-icon');
            if (cartIcon) {
                cartIcon.style.animation = 'pulse 0.5s ease';
                setTimeout(() => cartIcon.style.animation = '', 500);
            }
        }

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

        // Делаем функции глобальными
        window.changeProductImage = changeProductImage;
        window.addToCart = addToCart;
        window.showNotification = showNotification;
        window.updateCartCounter = updateCartCounter;
    </script>

    <style>
        /* Стили для изображений товаров */
        .product-image {
            height: 220px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
            overflow: hidden;
        }
        
        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .product-image:hover img {
            transform: scale(1.05);
        }
        
        /* Навигация по изображениям (кружочки) */
        .image-navigation {
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 5px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .image-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: none;
            background-color: rgba(0, 0, 0, 0.3);
            cursor: pointer;
            padding: 0;
            transition: all 0.3s ease;
        }
        
        .image-dot:hover {
            background-color: var(--primary-green);
            transform: scale(1.2);
        }
        
        .image-dot.active {
            background-color: var(--primary-green);
            transform: scale(1.2);
        }
        
        /* Уведомления */
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
        
        /* Анимации */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
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