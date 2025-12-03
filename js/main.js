// Глобальный объект состояния приложения
window.AppState = {
    products: [],
    cart: [],
    cartCount: 0,
    cartTotal: 0
};

// Основные функции сайта
document.addEventListener('DOMContentLoaded', function() {
    console.log('Сайт магазина загружен');
    
    // Инициализация состояния
    initAppState();
    
    // Плавная прокрутка к секциям
    initSmoothScroll();
    
    // Обновление года в футере
    updateFooterYear();
    
   
    // Инициализация форм
    initForms();
    
    // Инициализация отслеживания прокрутки для активного меню
    initScrollTracking();
});

// Инициализация состояния приложения
function initAppState() {
    // Загружаем корзину из localStorage
    loadCartFromStorage();
}

// Загрузка корзины из localStorage
function loadCartFromStorage() {
    const savedCart = localStorage.getItem('cart');
    if (savedCart) {
        try {
            window.AppState.cart = JSON.parse(savedCart);
            updateCartTotals();
            updateCartUI();
            updateCartCounter(); // Добавлено
        } catch (e) {
            console.error('Ошибка загрузки корзины:', e);
            window.AppState.cart = [];
        }
    }
}

// Обновление UI корзины
function updateCartUI() {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = window.AppState.cartCount || 0;
    }
}

// Обновление счетчика корзины
function updateCartCounter() {
    if (!window.AppState) return;
    
    window.AppState.cartCount = window.AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
    const counter = document.querySelector('.cart-count');
    if (counter) counter.textContent = window.AppState.cartCount;
}

// Обновление итогов корзины
function updateCartTotals() {
    if (!window.AppState) return;
    
    window.AppState.cartCount = window.AppState.cart.reduce((total, item) => total + (item.quantity || 0), 0);
    window.AppState.cartTotal = window.AppState.cart.reduce((total, item) => total + ((item.price || 0) * (item.quantity || 0)), 0);
}

// Сохранение корзины в localStorage
function saveCartToStorage() {
    if (window.AppState && window.AppState.cart) {
        localStorage.setItem('cart', JSON.stringify(window.AppState.cart));
    }
}

// Плавная прокрутка с учетом фиксированной навигации
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                updateActiveNav(this);
                return;
            }
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const nav = document.querySelector('.main-nav');
                const navHeight = nav ? nav.offsetHeight : 70;
                const currentPosition = window.pageYOffset;
                const targetPosition = targetElement.getBoundingClientRect().top + currentPosition - navHeight;
                
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                updateActiveNav(this);
            }
        });
    });
}

// Обновление активного пункта меню
function updateActiveNav(clickedLink) {
    document.querySelectorAll('.nav-list a').forEach(link => {
        link.classList.remove('active');
    });
    clickedLink.classList.add('active');
}

// Обновление активного пункта меню при прокрутке
function initScrollTracking() {
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-list a[href^="#"]');
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const navHeight = document.querySelector('.main-nav').offsetHeight;
            
            if (window.pageYOffset >= (sectionTop - navHeight - 100)) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
        
        if (window.pageYOffset < 100) {
            navLinks.forEach(link => link.classList.remove('active'));
            const firstLink = document.querySelector('.nav-list a[href="#"]');
            if (firstLink) firstLink.classList.add('active');
        }
    });
}

// Обновление года в футере
function updateFooterYear() {
    const year = new Date().getFullYear();
    const footerYear = document.querySelector('.footer-bottom p');
    if (footerYear) {
        footerYear.innerHTML = footerYear.innerHTML.replace('2023', year);
    }
}


// Обработка форм
function initForms() {
    document.addEventListener('submit', function(e) {
        if (e.target.matches('form')) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Отправка...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Отправлено!';
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    form.reset();
                    showNotification('Сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.', 'success');
                }, 2000);
            }, 1500);
        }
    });
}

// Показать уведомление
function showNotification(message, type = 'success') {
    const existingNotifications = document.querySelectorAll('.notification.show');
    existingNotifications.forEach(notification => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    });
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    let icon = 'fas fa-check-circle';
    if (type === 'error') icon = 'fas fa-exclamation-circle';
    if (type === 'info') icon = 'fas fa-info-circle';
    
    notification.innerHTML = `
        <i class="${icon}"></i>
        <span>${message}</span>
        <button class="notification-close" onclick="this.parentElement.classList.remove('show')">
            &times;
        </button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 500);
        }, 5000);
    }, 10);
}

// Открытие/закрытие модальных окон
function openConsultation() {
    document.getElementById('consultationModal').style.display = 'flex';
}

function closeConsultation() {
    document.getElementById('consultationModal').style.display = 'none';
}

function openPartnership() {
    showNotification('Спасибо за интерес к партнерской программе! Наш менеджер свяжется с вами в течение 2 часов.', 'success');
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

// Вспомогательная функция для случайных чисел
function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Делаем функции доступными глобально
window.showNotification = showNotification;
window.openConsultation = openConsultation;
window.closeConsultation = closeConsultation;
window.openPartnership = openPartnership;
window.saveCartToStorage = saveCartToStorage;
window.pulseCartIcon = pulseCartIcon;
window.updateCartTotals = updateCartTotals;
window.updateCartUI = updateCartUI;
window.updateCartCounter = updateCartCounter; // Добавлено
window.loadCartFromStorage = loadCartFromStorage; // Добавлено