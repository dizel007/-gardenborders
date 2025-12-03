// Управление UI корзины
document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart module loaded');
    renderCartItems();
    setupCartEvents();
    updateCartCounter();
});

// Обновление счетчика корзины
function updateCartCounter() {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement && window.AppState && window.AppState.cartCount !== undefined) {
        cartCountElement.textContent = window.AppState.cartCount;
    }
}

// Отображение товаров в корзине
function renderCartItems() {
    const cartItemsContainer = document.getElementById('cartItems');
    if (!cartItemsContainer) return;
    
    // Убедимся что AppState инициализирован
    if (!window.AppState) {
        window.AppState = {
            products: [],
            cart: [],
            cartCount: 0,
            cartTotal: 0
        };
    }
    
    // Загружаем из localStorage если пусто
    if (!window.AppState.cart || window.AppState.cart.length === 0) {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            try {
                window.AppState.cart = JSON.parse(savedCart);
                if (window.updateCartTotals) window.updateCartTotals();
                if (window.updateCartCounter) window.updateCartCounter(); // Добавлено
            } catch (e) {
                console.error('Ошибка загрузки корзины:', e);
                window.AppState.cart = [];
            }
        }
    }
    
    // Проверяем наличие товаров
    if (!window.AppState.cart || window.AppState.cart.length === 0) {
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
    window.AppState.cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.dataset.id = item.id;
        cartItem.innerHTML = `
            <div class="cart-item-image">
                <i class="${item.image}"></i>
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
    if (totalPriceElement && window.AppState) {
        totalPriceElement.textContent = `${window.AppState.cartTotal || 0} ₽`;
    }
}

// Обновление количества товара
function updateCartItemQuantity(productId, change) {
    // Убедимся что AppState инициализирован
    if (!window.AppState) {
        window.AppState = {
            products: [],
            cart: [],
            cartCount: 0,
            cartTotal: 0
        };
    }
    
    if (!window.AppState.cart) window.AppState.cart = [];
    
    const itemIndex = window.AppState.cart.findIndex(item => item.id === productId);
    if (itemIndex === -1) return;
    
    const newQuantity = window.AppState.cart[itemIndex].quantity + change;
    
    if (newQuantity < 1) {
        removeCartItem(productId);
        return;
    }
    
    // Проверяем наличие
    const product = window.productsData ? 
        window.productsData.find(p => p.id === productId) : null;
    
    if (product && newQuantity > product.inStock) {
        if (window.showNotification) {
            window.showNotification(`Нельзя добавить больше товара. В наличии только ${product.inStock} шт.`, 'error');
        }
        return;
    }
    
    window.AppState.cart[itemIndex].quantity = newQuantity;
    
    // Обновляем состояние
    if (window.updateCartTotals) window.updateCartTotals();
    if (window.updateCartUI) window.updateCartUI();
    if (window.updateCartCounter) window.updateCartCounter(); // Добавлено
    
    // Сохраняем и обновляем
    if (window.saveCartToStorage) window.saveCartToStorage();
    renderCartItems();
    
    if (window.showNotification) {
        const action = change > 0 ? 'увеличено' : 'уменьшено';
        window.showNotification(`Количество товара "${window.AppState.cart[itemIndex].name}" ${action} до ${newQuantity} шт.`, 'info');
    }
}

// Удаление товара из корзины
function removeCartItem(productId) {
    console.log('Removing item:', productId);
    
    // Убедимся что AppState инициализирован
    if (!window.AppState) {
        window.AppState = {
            products: [],
            cart: [],
            cartCount: 0,
            cartTotal: 0
        };
    }
    
    if (!window.AppState.cart) window.AppState.cart = [];
    
    // Находим товар перед удалением
    const itemIndex = window.AppState.cart.findIndex(item => item.id === productId);
    if (itemIndex === -1) return;
    
    const itemName = window.AppState.cart[itemIndex].name;
    
    // УДАЛЯЕМ товар - создаем новый массив без этого элемента
    window.AppState.cart = window.AppState.cart.filter(item => item.id !== productId);
    
    console.log('Cart after removal:', window.AppState.cart);
    
    // Обновляем состояние
    if (window.updateCartTotals) window.updateCartTotals();
    if (window.updateCartUI) window.updateCartUI();
    if (window.updateCartCounter) window.updateCartCounter(); // Добавлено
    
    // Сохраняем и обновляем
    if (window.saveCartToStorage) window.saveCartToStorage();
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

// Оформление заказа
function checkout() {
    if (!window.AppState || !window.AppState.cart || window.AppState.cart.length === 0) {
        if (window.showNotification) {
            window.showNotification('Корзина пуста. Добавьте товары перед оформлением заказа.', 'error');
        }
        return;
    }
    
    if (window.showNotification) {
        window.showNotification(`Заказ на сумму ${window.AppState.cartTotal} ₽ оформлен! Менеджер свяжется с вами в течение 15 минут.`, 'success');
    }
    
    // Очищаем корзину
    window.AppState.cart = [];
    
    // Обновляем состояние
    if (window.updateCartTotals) window.updateCartTotals();
    if (window.updateCartUI) window.updateCartUI();
    if (window.updateCartCounter) window.updateCartCounter(); // Добавлено
    
    // Сохраняем и обновляем
    if (window.saveCartToStorage) window.saveCartToStorage();
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
window.updateCartCounter = updateCartCounter; // Добавлено