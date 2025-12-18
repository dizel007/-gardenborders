    <!-- Показываем ошибки оформления заказа если они есть -->
    <?php
       
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
                        <span class="phone-number">7 (950) 540-40-24</span>
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


        <!-- ФИКСИРОВАННАЯ НАВИГАЦИЯ С МЕНЮ И КОРЗИНОЙ -->
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <ul class="nav-list">
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
