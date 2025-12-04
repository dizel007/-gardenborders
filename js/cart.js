// cart.js (полностью переписанный)
document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart module loaded');
    
    // Если cartState еще не создан, создаем его
    if (!window.cartState) {
        window.cartState = {
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            getCount: function() {
                return this.cart.reduce((total, item) => total + (item.quantity || 0), 0);
            },
            getCart: function() {
                return [...this.cart];
            },
            getTotal: function() {
                return this.cart.reduce((total, item) => total + ((item.price || 0) * (item.quantity || 0)), 0);
            }
        };
    }
    
    renderCartItems();
    setupCartEvents();
    updateCartCounter();
});

// Обновление счетчика корзины
function updateCartCounter() {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement && window.cartState) {
        cartCountElement.textContent = window.cartState.getCount();
    }
}

// Отображение товаров в корзине
function renderCartItems() {
    const cartItemsContainer = document.getElementById('cartItems');
    if (!cartItemsContainer) return;
    
    // Получаем текущее состояние корзины
    const cart = window.cartState ? window.cartState.getCart() : [];
    
    // Проверяем наличие товаров
    if (!cart || cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-basket"></i>
                <p>Ваша корзина пуста</p>
                <a href="#products" class="continue-shopping" onclick="toggleCart()">Продолжить покупки</a>
            </div>
        `;
        
        const totalPriceElement = document.querySelector('.total-price');
        if (totalPriceElement) totalPriceElement.textContent = '0 ₽';
        
        return;
    }
    
    // Отображаем товары
    cartItemsContainer.innerHTML = '';
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.dataset.id = item.id;
        
        // Проверяем тип изображения
        const imageElement = item.image && (item.image.includes('.jpg') || item.image.includes('.png') || item.image.includes('.jpeg'))
            ? `<img src="images/products/${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='images/products/default.jpg'; this.nextElementSibling.style.display='flex';">`
            : `<i class="${item.image || 'fas fa-box'}"></i>`;
        
        cartItem.innerHTML = `
            <div class="cart-item-image">
                ${imageElement}
            </div>
            <div class="cart-item-details">
                <div class="cart-item-title">${item.name}</div>
                <div class="cart-item-category">${getCategoryName(item.category)}</div>
                <div class="cart-item-price">${item.price} ₽/шт</div>
                <div class="cart-item-controls">
                    <button class="quantity-btn" onclick="updateCartItemQuantity(${item.id}, -1)">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateCartItemQuantity(${item.id}, 1)">+</button>
                    <button class="remove-item" onclick="removeCartItem(${item.id})">
                        <i class="fas fa-trash"></i> Удалить
                    </button>
                </div>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
    });
    
    const totalPriceElement = document.querySelector('.total-price');
    if (totalPriceElement && window.cartState) {
        totalPriceElement.textContent = `${window.cartState.getTotal()} ₽`;
    }
}

// Обновление количества товара
function updateCartItemQuantity(productId, change) {
    // Проверяем наличие товара в корзине
    const cart = window.cartState ? window.cartState.getCart() : [];
    const itemIndex = cart.findIndex(item => item.id === productId);
    
    if (itemIndex === -1) return;
    
    const currentItem = cart[itemIndex];
    const newQuantity = currentItem.quantity + change;
    
    if (newQuantity < 1) {
        removeCartItem(productId);
        return;
    }
    
    // Обновляем локальное хранилище напрямую
    const savedCart = JSON.parse(localStorage.getItem('cart')) || [];
    const savedItemIndex = savedCart.findIndex(item => item.id === productId);
    
    if (savedItemIndex > -1) {
        savedCart[savedItemIndex].quantity = newQuantity;
        localStorage.setItem('cart', JSON.stringify(savedCart));
    }
    
    // Обновляем cartState
    if (window.cartState && window.cartState.cart) {
        const cartStateItemIndex = window.cartState.cart.findIndex(item => item.id === productId);
        if (cartStateItemIndex > -1) {
            window.cartState.cart[cartStateItemIndex].quantity = newQuantity;
        }
    }
    
    // Обновляем отображение
    updateCartCounter();
    renderCartItems();
    
    if (window.showNotification) {
        const action = change > 0 ? 'увеличено' : 'уменьшено';
        window.showNotification(`Количество товара "${currentItem.name}" ${action} до ${newQuantity} шт.`, 'info');
    }
}

// Удаление товара из корзины - КЛЮЧЕВАЯ ИСПРАВЛЕННАЯ ФУНКЦИЯ
function removeCartItem(productId) {
    console.log('Removing item:', productId);
    
    // Получаем текущую корзину из localStorage
    let savedCart = JSON.parse(localStorage.getItem('cart')) || [];
    console.log('Cart before removal:', savedCart);
    
    // Находим товар перед удалением
    const itemIndex = savedCart.findIndex(item => item.id === productId);
    if (itemIndex === -1) return;
    
    const itemName = savedCart[itemIndex].name;
    
    // Удаляем товар
    savedCart = savedCart.filter(item => item.id !== productId);
    console.log('Cart after removal:', savedCart);
    
    // Сохраняем ОБНОВЛЕННУЮ корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(savedCart));
    
    // Обновляем cartState
    if (window.cartState) {
        window.cartState.cart = savedCart;
    }
    
    // Обновляем AppState
    if (window.AppState) {
        window.AppState.cart = savedCart;
        window.AppState.cartCount = savedCart.reduce((total, item) => total + (item.quantity || 0), 0);
    }
    
    // Обновляем отображение
    updateCartCounter();
    renderCartItems();
    
    if (window.showNotification) {
        window.showNotification(`Товар "${itemName}" удален из корзины`, 'success');
    }
}

// Показать/скрыть корзину
function toggleCart() {
    const cartSidebar = document.getElementById('cartSidebar');
    const cartOverlay = document.getElementById('cartOverlay');
    
    if (!cartSidebar || !cartOverlay) return;
    
    const isOpening = !cartSidebar.classList.contains('open');
    
    cartSidebar.classList.toggle('open');
    cartOverlay.style.display = cartSidebar.classList.contains('open') ? 'block' : 'none';
    
    document.body.style.overflow = cartSidebar.classList.contains('open') ? 'hidden' : '';
    
    if (isOpening) {
        renderCartItems();
    }
}

// Оформление заказа - ОЧИЩАЕМ КОРЗИНУ ПОЛНОСТЬЮ
function checkout() {
    const cart = window.cartState ? window.cartState.getCart() : [];
    
    if (!cart || cart.length === 0) {
        if (window.showNotification) {
            window.showNotification('Корзина пуста. Добавьте товары перед оформлением заказа.', 'error');
        }
        return;
    }
    
    const total = window.cartState ? window.cartState.getTotal() : 0;
    
    if (window.showNotification) {
        window.showNotification(`Заказ на сумму ${total} ₽ оформлен! Менеджер свяжется с вами в течение 15 минут.`, 'success');
    }
    
    // ПОЛНОСТЬЮ очищаем корзину
    localStorage.removeItem('cart');
    
    // Обновляем все состояния
    if (window.cartState) {
        window.cartState.cart = [];
    }
    
    if (window.AppState) {
        window.AppState.cart = [];
        window.AppState.cartCount = 0;
        window.AppState.cartTotal = 0;
    }
    
    // Обновляем отображение
    updateCartCounter();
    renderCartItems();
    
    setTimeout(() => toggleCart(), 1000);
}

// Настройка событий
function setupCartEvents() {
    const cartOverlay = document.getElementById('cartOverlay');
    if (cartOverlay) {
        cartOverlay.addEventListener('click', toggleCart);
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cartSidebar = document.getElementById('cartSidebar');
            if (cartSidebar && cartSidebar.classList.contains('open')) {
                toggleCart();
            }
        }
    });
}

// Вспомогательные функции
function getCategoryName(category) {
    const categories = {
        'classic': 'Для грядок',
        'wave': 'Для цветников',
        'stone': 'Для дорожек',
        'decor': 'Декоративные',
        'pro': 'PRO серия'
    };
    return categories[category] || category;
}

// Экспортируем функции глобально
window.renderCartItems = renderCartItems;
window.updateCartItemQuantity = updateCartItemQuantity;
window.removeCartItem = removeCartItem;
window.toggleCart = toggleCart;
window.checkout = checkout;
window.updateCartCounter = updateCartCounter;