// cart.js
document.addEventListener('DOMContentLoaded', function() {
    // console.log('Cart module loaded');
    
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

// Отображение товаров в корзине - ИСПРАВЛЕННАЯ ВЕРСИЯ
function renderCartItems() {
    const cartItemsContainer = document.getElementById('cartItems');

    if (!cartItemsContainer) return;
    
    // Получаем текущее состояние корзины
    const cart = window.cartState ? window.cartState.getCart() : [];
     console.log(cart);   
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
    
    // Загружаем актуальные данные о наличии через AJAX
    loadProductAvailability(cart).then(availabilityData => {

        // Отображаем товары
        cartItemsContainer.innerHTML = '';
        cart.forEach(item => {
            // Получаем информацию о наличии из данных или устанавливаем "в наличии" по умолчанию
            const productAvailability = availabilityData[item.id] || {
                inStock: 100, // Большое число по умолчанию
                name: item.name
            };
            
            const currentStock = productAvailability.inStock || 100;
            const isOutOfStock = currentStock === 0;
            const isLowStock = currentStock > 0 && currentStock < item.quantity;
            
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.dataset.id = item.id;
            
            if (isOutOfStock) {
                cartItem.classList.add('out-of-stock');
            } else if (isLowStock) {
                cartItem.classList.add('low-stock');
            }
            
            // Проверяем тип изображения

            console.log(item.image);
            const imageElement = item.image && (item.image.includes('.jpg') || item.image.includes('.png') || item.image.includes('.jpeg'))
                ? `<img src="images/products/${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='images/products/default.jpg'; this.nextElementSibling.style.display='flex';">`
                : `<i class="${item.image || 'fas fa-box'}"></i>`;

            // Сообщение о наличии - ТОЛЬКО если действительно нет в наличии
            let stockMessage = '';
            if (isOutOfStock) {
                stockMessage = '<div class="stock-warning" style="color: #f44336; font-size: 12px; margin-top: 5px;"><i class="fas fa-exclamation-circle"></i> Товар закончился</div>';
            } else if (isLowStock) {
                stockMessage = `<div class="stock-warning" style="color: #ff9800; font-size: 12px; margin-top: 5px;"><i class="fas fa-exclamation-triangle"></i> На складе осталось только ${currentStock} шт.</div>`;
            }
            
            cartItem.innerHTML = `
                <div class="cart-item-image">
                    ${imageElement}
                </div>
                <div class="cart-item-details">
                    <div class="cart-item-title">${item.name}</div>
                    <div class="cart-item-price">${item.price} ₽/шт</div>
                    ${stockMessage}
                    <div class="cart-item-controls">
                        <button class="quantity-btn" onclick="updateCartItemQuantity(${item.id}, -1)" ${isOutOfStock ? 'disabled' : ''}>-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateCartItemQuantity(${item.id}, 1)" ${isOutOfStock ? 'disabled' : ''}>+</button>
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
    }).catch(error => {
        console.error('Ошибка загрузки данных о наличии:', error);
        // Если не удалось загрузить данные, показываем товары без проверки наличия
        renderCartItemsFallback(cart);
    });
}

// Запасной вариант отображения без проверки наличия
function renderCartItemsFallback(cart) {
    const cartItemsContainer = document.getElementById('cartItems');
    if (!cartItemsContainer) return;
    
    cartItemsContainer.innerHTML = '';
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.dataset.id = item.id;
        
        const imageElement = item.image && (item.image.includes('.jpg') || item.image.includes('.png') || item.image.includes('.jpeg'))
            ? `<img src="images/products/${item.image}" alt="${item.name}" onerror="this.onerror=null; this.src='images/products/default.jpg';">`
            : `<i class="${item.image || 'fas fa-box'}"></i>`;
        
        cartItem.innerHTML = `
            <div class="cart-item-image">
                ${imageElement}
            </div>
            <div class="cart-item-details">
                <div class="cart-item-title">${item.name}</div>
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

// Загрузка актуальных данных о наличии товаров
function loadProductAvailability(cartItems) {
    return new Promise((resolve, reject) => {
        // Получаем ID товаров из корзины
        const productIds = cartItems.map(item => item.id);
        
        // Если нет товаров, возвращаем пустой объект
        if (productIds.length === 0) {
            resolve({});
            return;
        }
        
        // Используем AJAX для получения актуальных данных о наличии
        fetch('get-product-availability.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ productIds: productIds })
        })
        .then(response => response.json())
        .then(data => {
            resolve(data);
        })
        .catch(error => {
            console.error('Error loading product availability:', error);
            reject(error);
        });
    });
}

// Обновление количества товара с проверкой наличия - ИСПРАВЛЕННАЯ ВЕРСИЯ
function updateCartItemQuantity(productId, change) {
    // Сначала загружаем актуальные данные о наличии
    fetch('get-product-availability.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ productIds: [productId] })
    })
    .then(response => response.json())
    .then(availabilityData => {
        const productData = availabilityData[productId];
        
        // Проверяем наличие на складе при увеличении
        if (change > 0 && productData) {
            const cart = window.cartState ? window.cartState.getCart() : [];
            const itemIndex = cart.findIndex(item => item.id === productId);
            const currentQuantity = itemIndex > -1 ? cart[itemIndex].quantity : 0;
            
            if (currentQuantity >= productData.inStock) {
                if (window.showNotification) {
                    window.showNotification(`Нельзя добавить больше товара. В наличии только ${productData.inStock} шт.`, 'error');
                }
                return;
            }
        }
        
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
    })
    .catch(error => {
        console.error('Error checking availability:', error);
        // Если не удалось проверить наличие, все равно обновляем количество
        updateCartItemQuantityFallback(productId, change);
    });
}

// Запасной вариант обновления количества без проверки наличия
function updateCartItemQuantityFallback(productId, change) {
    const cart = window.cartState ? window.cartState.getCart() : [];
    const itemIndex = cart.findIndex(item => item.id === productId);
    
    if (itemIndex === -1) return;
    
    const currentItem = cart[itemIndex];
    const newQuantity = currentItem.quantity + change;
    
    if (newQuantity < 1) {
        removeCartItem(productId);
        return;
    }
    
    // Обновляем локальное хранилище
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
    renderCartItemsFallback(cart);
    
    if (window.showNotification) {
        const action = change > 0 ? 'увеличено' : 'уменьшено';
        window.showNotification(`Количество товара "${currentItem.name}" ${action} до ${newQuantity} шт.`, 'info');
    }
}

// Удаление товара из корзины (остается без изменений)
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

// Остальные функции остаются без изменений...
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
    const cart = window.cartState ? window.cartState.getCart() : [];
    
    if (!cart || cart.length === 0) {
        if (window.showNotification) {
            window.showNotification('Корзина пуста. Добавьте товары перед оформлением заказа.', 'error');
        }
        return;
    }
    
    // Загружаем актуальные данные о наличии перед оформлением
    fetch('get-product-availability.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ productIds: cart.map(item => item.id) })
    })
    .then(response => response.json())
    .then(availabilityData => {
        // Проверяем наличие товаров перед оформлением
        let hasOutOfStock = false;
        let outOfStockItems = [];
        
        cart.forEach(item => {
            const product = availabilityData[item.id];
            if (product && item.quantity > product.inStock) {
                hasOutOfStock = true;
                outOfStockItems.push({
                    name: item.name,
                    requested: item.quantity,
                    available: product.inStock
                });
            }
        });
        
        if (hasOutOfStock) {
            let errorMessage = 'Некоторые товары недоступны в запрошенном количестве:\n';
            outOfStockItems.forEach(item => {
                errorMessage += `\n- ${item.name}: запрошено ${item.requested} шт., в наличии ${item.available} шт.`;
            });
            
            if (window.showNotification) {
                window.showNotification(errorMessage, 'error');
            }
            return;
        }
        
        const total = window.cartState ? window.cartState.getTotal() : 0;
        
        // Создаем форму для отправки данных на сервер
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'checkout.php';
        form.style.display = 'none';
        
        // Добавляем данные корзины
        const cartInput = document.createElement('input');
        cartInput.type = 'hidden';
        cartInput.name = 'cart_items';
        cartInput.value = JSON.stringify(cart);
        form.appendChild(cartInput);
        
        // Добавляем форму на страницу и отправляем
        document.body.appendChild(form);
        form.submit();
    })
    .catch(error => {
        console.error('Error checking availability:', error);
        // Если не удалось проверить наличие, все равно оформляем заказ
        const total = window.cartState ? window.cartState.getTotal() : 0;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'checkout.php';
        form.style.display = 'none';
        
        const cartInput = document.createElement('input');
        cartInput.type = 'hidden';
        cartInput.name = 'cart_items';
        cartInput.value = JSON.stringify(cart);
        form.appendChild(cartInput);
        
        document.body.appendChild(form);
        form.submit();
    });
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



// Экспортируем функции глобально
window.renderCartItems = renderCartItems;
window.updateCartItemQuantity = updateCartItemQuantity;
window.removeCartItem = removeCartItem;
window.toggleCart = toggleCart;
window.checkout = checkout;
window.updateCartCounter = updateCartCounter;