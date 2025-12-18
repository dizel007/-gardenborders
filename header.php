    <!-- Показываем ошибки оформления заказа если они есть -->
<?php
require_once ("_no_git/secret_info.php");  
require_once ("_no_git/contact_info.php");  

// Определяем базовый URL

 $copy_date = date('Y');
   
    if (isset($_SESSION['checkout_error'])): ?>
        <div class="error-notification">
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle"></i> Ошибка оформления заказа</h3>
                <p><?php echo nl2br(htmlspecialchars($_SESSION['checkout_error'])); ?></p>
                <button onclick="this.parentElement.parentElement.remove()" class="close-error">×</button>
            </div>
        </div>
        <?php unset($_SESSION['checkout_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['order_error'])): ?>
        <div class="error-notification">
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle"></i> Ошибка при оформлении заказа</h3>
                <p><?php echo nl2br(htmlspecialchars($_SESSION['order_error'])); ?></p>
                <button onclick="this.parentElement.parentElement.remove()" class="close-error">×</button>
            </div>
        </div>
        <?php unset($_SESSION['order_error']); ?>
        
    <?php endif; ?>

 
<?php
// Подлючаем стили 
 require_once "header_styles.php";
 ?>



<body>




     <!-- ФИКСИРОВАННАЯ НАВИГАЦИЯ С МЕНЮ И КОРЗИНОЙ -->
<nav class="main-nav" id="mainNav">
    <div class="container">
       
        <!-- Основное меню (скрывается на маленьких экранах) -->
        <ul class="nav-list" id="navList">
            <li><a href="index.php" class="active"><i class="fas fa-home"></i> Главная</a></li>
            <li><a href="index.php#products"><i class="fas fa-th-large"></i> Каталог</a></li>
            <li><a href="index.php#design"><i class="fas fa-paint-brush"></i> Дизайн-проекты</a></li>
            <li><a href="index.php#for-designers"><i class="fas fa-user-tie"></i> Дизайнерам</a></li>
            <li><a href="index.php#delivery"><i class="fas fa-truck"></i> Доставка</a></li>
            <li><a href="index.php#contacts"><i class="fas fa-address-book"></i> Контакты</a></li>
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
                        <span class="phone-number"><?php echo $contact_telefon?></span>
                        <!-- <span class="phone-description">Бесплатно по России</span> -->
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
