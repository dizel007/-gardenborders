
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

        // Функция обновления счетчика корзины
        function updateCartCounter() {
            const cartCount = AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
            const counter = document.querySelector('.cart-count');
            if (counter) counter.textContent = cartCount;
            
            // Обновляем глобальное состояние
            AppState.cartCount = cartCount;
            AppState.cartTotal = AppState.cart.reduce((total, item) => total + ((item.price || 0) * (item.quantity || 0)), 0);
        }

        // Функция добавления в корзину с проверкой наличия
        function addToCart(productId, event) {
            const product = productsData.find(p => p.id === productId);
            if (!product) return;
            
            // Проверяем наличие на складе ПЕРЕД добавлением
            if (product.inStock === 0) {
                showNotification('Товар отсутствует в наличии', 'error');
                return;
            }
            
            // Получаем текущую корзину
            let savedCart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // Проверяем, сколько уже есть в корзине
            const existingItemIndex = savedCart.findIndex(item => item.id === productId);
            const currentInCart = existingItemIndex > -1 ? savedCart[existingItemIndex].quantity : 0;
            
            // Проверяем, что не превышаем доступное количество
            if (currentInCart >= product.inStock) {
                showNotification(`Нельзя добавить больше товара "${product.name}". В наличии только ${product.inStock} шт.`, 'error');
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
            
            if (existingItemIndex > -1) {
                // Увеличиваем количество существующего товара
                savedCart[existingItemIndex].quantity += 1;
                showNotification(`Товар "${product.name}" добавлен в корзину (${savedCart[existingItemIndex].quantity} шт.)`, 'success');
            } else {
                // Добавляем новый товар
                savedCart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.images ? product.images[0] : 'default.jpg',
                    category: product.category,
                    quantity: 1
                });
                showNotification(`Товар "${product.name}" добавлен в корзину`, 'success');
            }
            
            // Сохраняем ОБНОВЛЕННУЮ корзину
            localStorage.setItem('cart', JSON.stringify(savedCart));
            
            // Обновляем все состояния
            AppState.cart = savedCart;
            AppState.cartCount = savedCart.reduce((total, item) => total + (item.quantity || 0), 0);
            
            // Обновляем глобальное состояние если оно существует
            if (window.cartState) {
                window.cartState.cart = savedCart;
            }
            
            if (window.AppState) {
                window.AppState.cart = savedCart;
                window.AppState.cartCount = AppState.cartCount;
                window.AppState.cartTotal = AppState.cartTotal;
                
                // Вызываем глобальные функции обновления
                if (window.updateCartTotals) window.updateCartTotals();
                if (window.updateCartUI) window.updateCartUI();
                if (window.saveCartToStorage) window.saveCartToStorage();
            }
            
            // Обновляем счетчик
            updateCartCounter();
            
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

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            // Загружаем корзину
            loadCartFromStorage();
            
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
            
            // Обновляем кнопки "Добавить в корзину" в зависимости от наличия
            productsData.forEach(product => {
                if (product.inStock === 0) {
                    const button = document.querySelector(`.product-card[data-id="${product.id}"] .add-to-cart`);
                    if (button) {
                        button.disabled = true;
                        button.innerHTML = '<i class="fas fa-times-circle"></i> Нет в наличии';
                        button.style.background = '#ccc';
                        button.style.cursor = 'not-allowed';
                    }
                }
            });
        });

        // Делаем функции глобальными
        window.changeProductImage = changeProductImage;
        window.addToCart = addToCart;
        window.showNotification = showNotification;
        window.updateCartCounter = updateCartCounter;
        window.loadCartFromStorage = loadCartFromStorage;
        
        // Экспортируем данные товаров глобально для использования в cart.js
        window.productsData = productsData;
    