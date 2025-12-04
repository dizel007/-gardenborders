<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GardenBorders | Пластиковые бордюры для ландшафтного дизайна</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/cart.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Шапка сайта - ВЕРХНЯЯ ИНФОРМАЦИОННАЯ ЧАСТЬ -->
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
                <div class="work-time">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span>Ежедневно 8:00-18:00</span>
                        <span class="work-description">Консультация специалиста</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ФИКСИРОВАННАЯ НАВИГАЦИЯ С МЕНЮ И КОРЗИНОЙ -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <ul class="nav-list">
                <li><a href="#" class="active"><i class="fas fa-home"></i> Главная</a></li>
                <li><a href="#products"><i class="fas fa-th-large"></i> Каталог</a></li>
                <li><a href="#design"><i class="fas fa-paint-brush"></i> Дизайн-проекты</a></li>
                <li><a href="#for-designers"><i class="fas fa-user-tie"></i> Дизайнерам</a></li>
                <li><a href="#delivery"><i class="fas fa-truck"></i> Доставка</a></li>
                <li><a href="#contacts"><i class="fas fa-address-book"></i> Контакты</a></li>
            </ul>
            <div class="header-actions">
                <button class="consult-btn" onclick="openConsultation()">
                    <i class="fas fa-comments"></i> Консультация
                </button>
                <div class="cart-icon" onclick="toggleCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Основное содержимое -->
    <main class="container">
        <!-- Герой-секция -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Пластиковые бордюры для идеального ландшафта</h1>
                    <p class="hero-subtitle">Создайте аккуратные грядки, цветники и дорожки с профессиональными бордюрами от производителя</p>
                    <div class="hero-features">
                        <div class="hero-feature">
                            <i class="fas fa-award"></i>
                            <span>Гарантия 10 лет</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-palette"></i>
                            <span>20+ цветов и текстур</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-ruler-combined"></i>
                            <span>Любые размеры под заказ</span>
                        </div>
                    </div>
                    <a href="#products" class="cta-button">
                        <i class="fas fa-shopping-basket"></i> Смотреть каталог
                    </a>
                </div>
                <div class="hero-image">
                    <div class="image-placeholder">
                        <i class="fas fa-tree"></i>
                        <i class="fas fa-seedling"></i>
                        <i class="fas fa-spa"></i>
                    </div>
                </div>
            </div>
        </section>

    <!-- Основное содержимое -->
    <main class="container">


        <!-- Каталог товаров -->
        <section id="products" class="products-section">
         <?php include 'body_site.php'; ?>
        </section>


        <!-- Блок для ландшафтных дизайнеров -->
        <section id="for-designers" class="designers-section">
            <div class="section-header">
                <h2><i class="fas fa-user-tie"></i> Для ландшафтных дизайнеров</h2>
                <p class="section-subtitle">Специальные условия сотрудничества</p>
            </div>
            <div class="designer-benefits">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <h3>Скидка до 40%</h3>
                    <p>Специальные оптовые цены для дизайнеров и подрядчиков</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h3>Образцы бесплатно</h3>
                    <p>Предоставляем образцы для презентации клиентам</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Техническая поддержка</h3>
                    <p>Консультации по монтажу и дизайну от наших специалистов</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <h3>Индивидуальные решения</h3>
                    <p>Изготовление бордюров по вашим чертежам и эскизам</p>
                </div>
            </div>
            <div class="designer-cta">
                <button class="partner-btn" onclick="openPartnership()">
                    <i class="fas fa-handshake"></i> Стать партнером
                </button>
            </div>
        </section>



        <!-- Дизайн-проекты -->
        <section id="design" class="design-projects">
            <div class="section-header">
                <h2><i class="fas fa-paint-brush"></i> Идеи для вашего сада</h2>
                <p class="section-subtitle">Вдохновляйтесь готовыми решениями</p>
            </div>
            <div class="projects-grid">
                <div class="project-card">
                    <div class="project-image" style="background-color: #e8f5e9;">
                        <i class="fas fa-carrot"></i>
                    </div>
                    <div class="project-info">
                        <h3>Аккуратные грядки</h3>
                        <p>Идеальные огородные зоны с четкими границами</p>
                        <span class="project-tag">Огород</span>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image" style="background-color: #f3e5f5;">
                        <i class="fas fa-spa"></i>
                    </div>
                    <div class="project-info">
                        <h3>Цветочные композиции</h3>
                        <p>Многоуровневые клумбы и рабатки</p>
                        <span class="project-tag">Клумбы</span>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image" style="background-color: #e3f2fd;">
                        <i class="fas fa-road"></i>
                    </div>
                    <div class="project-info">
                        <h3>Садовые дорожки</h3>
                        <p>Четкое зонирование территории</p>
                        <span class="project-tag">Дорожки</span>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image" style="background-color: #fff3e0;">
                        <i class="fas fa-tree"></i>
                    </div>
                    <div class="project-info">
                        <h3>Приствольные круги</h3>
                        <p>Аккуратное оформление деревьев</p>
                        <span class="project-tag">Деревья</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Информация о доставке -->
        <section id="delivery" class="delivery-section">
            <div class="section-header">
                <h2><i class="fas fa-truck"></i> Доставка и монтаж</h2>
                <p class="section-subtitle">Быстро и профессионально</p>
            </div>
            <div class="delivery-options">
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-store-alt"></i>
                    </div>
                    <h3>Самовывоз</h3>
                    <p>Заберите заказ с нашего склада в Москве</p>
                    <span class="delivery-time">Сегодня</span>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h3>Наша доставка</h3>
                    <p>Доставка по Москве и области нашим транспортом</p>
                    <span class="delivery-time">1-2 дня</span>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>По России</h3>
                    <p>Доставка в любой город транспортными компаниями</p>
                    <span class="delivery-time">3-7 дней</span>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Монтаж</h3>
                    <p>Услуги профессионального монтажа под ключ</p>
                    <span class="delivery-time">По договоренности</span>
                </div>
            </div>
        </section>

        <!-- О нас -->
        <section class="about-section">
            <div class="section-header">
                <h2><i class="fas fa-leaf"></i> О компании GardenBorders</h2>
                <p class="section-subtitle">Мы создаем красоту для вашего сада</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <p>Мы - команда энтузиастов и профессионалов, которая уже более 12 лет создает качественные пластиковые бордюры для ландшафтного дизайна. Наша продукция помогает садоводам, дачникам и профессиональным дизайнерам создавать ухоженные и красивые садовые пространства.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-recycle"></i>
                            <div>
                                <h4>Экологичность</h4>
                                <p>Используем только безопасные материалы</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-sun"></i>
                            <div>
                                <h4>Устойчивость к УФ</h4>
                                <p>Не выцветают на солнце</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-snowflake"></i>
                            <div>
                                <h4>Морозостойкость</h4>
                                <p>Выдерживают российские зимы</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <div class="image-placeholder">
                        <i class="fas fa-gem"></i>
                        <p>Качество проверенное временем</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Корзина покупок -->
    <div class="cart-overlay" id="cartOverlay"></div>
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3><i class="fas fa-shopping-cart"></i> Корзина</h3>
            <button class="close-cart" onclick="toggleCart()">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- Товары в корзине будут добавляться здесь -->
            <div class="empty-cart">
                <i class="fas fa-shopping-basket"></i>
                <p>Ваша корзина пуста</p>
                <a href="#products" class="continue-shopping" onclick="toggleCart()">Продолжить покупки</a>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-summary">
                <div class="cart-total">
                    <span>Итого:</span>
                    <span class="total-price">0 ₽</span>
                </div>
                <div class="cart-discount">
                    <i class="fas fa-tag"></i>
                    <span>Для дизайнеров скидка до 40%</span>
                </div>
            </div>
            <button class="checkout-btn" onclick="checkout()">
                <i class="fas fa-check-circle"></i> Оформить заказ
            </button>
            <div class="secure-payment">
                <i class="fas fa-shield-alt"></i>
                <span>Безопасная оплата</span>
            </div>
        </div>
    </div>

    <!-- Форма консультации -->
    <div class="consultation-modal" id="consultationModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeConsultation()">&times;</button>
            <h3><i class="fas fa-comments"></i> Бесплатная консультация</h3>
            <p>Наш специалист поможет подобрать идеальные бордюры для вашего проекта</p>
            <form id="consultationForm">
                <input type="text" placeholder="Ваше имя" required>
                <input type="tel" placeholder="Телефон" required>
                <textarea placeholder="Опишите ваш проект или задайте вопрос"></textarea>
                <button type="submit" class="submit-consult">
                    <i class="fas fa-paper-plane"></i> Отправить заявку
                </button>
            </form>
        </div>
    </div>

    <!-- Подвал -->
    <footer id="contacts">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-leaf"></i>
                        <span>Garden<span class="logo-highlight">Borders</span></span>
                    </div>
                    <p>Профессиональные решения для ландшафтного дизайна</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-vk"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p><i class="fas fa-phone-alt"></i> 8 (800) 350-25-25</p>
                    <p><i class="fas fa-envelope"></i> info@gardenborders.ru</p>
                    <p><i class="fas fa-map-marker-alt"></i> Москва, ул. Садовая, 42</p>
                    <p><i class="fas fa-clock"></i> Пн-Вс: 8:00-21:00</p>
                </div>
                <div class="footer-section">
                    <h4>Для дизайнеров</h4>
                    <a href="#for-designers">Партнерская программа</a>
                    <a href="#">Каталог для дизайнеров</a>
                    <a href="#">Техническая документация</a>
                    <a href="#">Образцы продукции</a>
                </div>
                <div class="footer-section">
                    <h4>Полезное</h4>
                    <a href="#design">Идеи для сада</a>
                    <a href="#">Инструкции по монтажу</a>
                    <a href="#">Уход за бордюрами</a>
                    <a href="#delivery">Доставка и оплата</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 GardenBorders. Все права защищены.</p>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-mir"></i>
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Подключение скриптов -->
    <script src="js/main.js"></script>
    <script src="js/products.js"></script>
    <script src="js/cart-state.js"></script>
    <script src="js/cart.js"></script>
</body>
</html>