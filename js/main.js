// main.js (обновленная часть)
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация глобального состояния через cartState
    initAppState();
   
    // Подписываемся на изменения корзины
    if (window.cartState) {
        window.cartState.subscribe((cart) => {
            updateCartCounter();
        });
    }
});

// Инициализация состояния приложения
function initAppState() {
    if (!window.AppState) {
        window.AppState = {
            products: [],
            cart: window.cartState ? window.cartState.getCart() : [],
            cartCount: window.cartState ? window.cartState.getCount() : 0,
            cartTotal: window.cartState ? window.cartState.getTotal() : 0
        };
    }
}

// Обновление счетчика корзины
function updateCartCounter() {
    const cartCount = window.cartState ? window.cartState.getCount() : 
                     (window.AppState ? window.AppState.cartCount : 0);
    
    const counter = document.querySelector('.cart-count');
    if (counter) {
        counter.textContent = cartCount;
    }
}


// Открытие/закрытие модальных окон
function openConsultation() {
    document.getElementById('consultationModal').style.display = 'flex';
}

function closeConsultation() {
    document.getElementById('consultationModal').style.display = 'none';
}


// Эффект пульсации для значка корзины
function pulseCartIcon() {
    const cartIcon = document.querySelector('.cart-icon');
    if (cartIcon) {
        cartIcon.style.animation = 'pulse 0.5s ease';
        setTimeout(() => {
            cartIcon.style.animation = '';
        }, 500);
    }
}

// Делаем функции доступными глобально
window.showNotification = showNotification;
window.openConsultation = openConsultation;
window.closeConsultation = closeConsultation;
// window.openPartnership = openPartnership;
window.pulseCartIcon = pulseCartIcon;