

<?php 
session_start();
require_once "header.php";
require_once "products.php";
?>
   
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
                            <span> Собственное производство</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fa-solid fa-thumbs-up"></i>
                            <span>Любые объемы под заказ</span>
                        </div>
                           <div class="hero-feature">
                            <i class="fas fa-house"></i>
                            <span>Сделано в РФ</span>
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
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h3>Образцы бесплатно</h3>
                    <p>Предоставляем образцы для презентации клиентам</p>
                </div>


                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <h3>Скидка за ОПТ</h3>
                    <p>Специальные оптовые цены для дизайнеров и дилеров</p>
            <a href="pages/dealers.php">
                <div class="designer-cta">
                    <button class="partner-btn" onclick="openPartnership()">
                        <i class="fas fa-handshake"></i> Стать дилером
                    </button>
                </div>
             </a>

                </div>

                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Техническая поддержка</h3>
                    <p>Консультации по монтажу и дизайну от наших специалистов</p>
                </div>
                <!-- <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <h3>Индивидуальные решения</h3>
                    <p>Изготовление бордюров по вашим чертежам и эскизам</p>
                </div> -->
            </div>
 
        </section>



        <!-- Дизайн-проекты -->
        <section id="design" class="design-projects">
            <div class="section-header">
                <h2><i class="fas fa-paint-brush"></i> Идеи для вашего сада</h2>
                <p class="section-subtitle">Вдохновляйтесь готовыми решениями</p>
            </div>
            <div class="projects-grid">
                <!-- <div class="project-card">
                    <div class="project-image" style="background-color: #e8f5e9;">
                        <i class="fas fa-carrot"></i>
                    </div>
                    <div class="project-info">
                        <h3>Аккуратные грядки</h3>
                        <p>Идеальные огородные зоны с четкими границами</p>
                        <span class="project-tag">Огород</span>
                    </div>
                </div> -->
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
                    <h3>Доставка</h3>
                    <p>Доставка по Москве и области транспортной компанией</p>
                    <span class="delivery-time">1-2 дня</span>
                </div>
                <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>По России</h3>
                    <p>Доставка в ПВЗ любого города<br><b>Ozon логистикой</b></p>
                    <span class="delivery-time">3-7 дней</span>
                </div>
                <!-- <div class="delivery-option">
                    <div class="delivery-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Монтаж</h3>
                    <p>Услуги профессионального монтажа под ключ</p>
                    <span class="delivery-time">По договоренности</span>
                </div> -->
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
<?php require_once "footer.php";?>
</body>
</html>