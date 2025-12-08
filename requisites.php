<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реквизиты компании - GardenBorders</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="styles/requisites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Шапка сайта -->
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
                        <span class="phone-number">+7 (950) 540-40-24</span>
                        <span class="phone-description">Бесплатно по России</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Навигация -->
    <nav class="main-nav">
        <div class="container">
            <ul class="nav-list">
                <li><a href="index.php"><i class="fas fa-home"></i> Главная</a></li>
                <li><a href="index.php#products"><i class="fas fa-th-large"></i> Каталог</a></li>
                <li><a href="requisites.php" class="active"><i class="fas fa-file-invoice"></i> Реквизиты</a></li>
            </ul>
            <div class="header-actions">
                <a href="index.php" class="consult-btn">
                    <i class="fas fa-store"></i> Вернуться в магазин
                </a>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <main class="requisites-container">
        <div class="requisites-header">
            <h1><i class="fas fa-file-invoice-dollar"></i> Реквизиты компании</h1>
            <p>Официальные реквизиты ИП Зелизко Дмитрий Иванович для юридических лиц и бухгалтерских документов</p>
        </div>
        
        <div class="requisites-content">
            <!-- Основные реквизиты -->
            <div class="requisites-section">
                <h2><i class="fas fa-building"></i> Общая информация</h2>
                <div class="requisites-grid">
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Полное наименование</h3>
                            <p>Индивидуальный предприниматель Зелизко Дмитрий Иванович</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-signature"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Сокращенное наименование</h3>
                            <p>ИП Зелизко Дмитрий Иванович</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>ИНН</h3>
                            <p class="important">860223446952</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-passport"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>ОГРИП</h3>
                            <p class="important">321665800015831</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>ОКПО</h3>
                            <p class="important">2005383236</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Банковские реквизиты -->
            <div class="requisites-section">
                <h2><i class="fas fa-university"></i> Банковские реквизиты</h2>
                <div class="requisites-grid">
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Расчетный счет</h3>
                            <p class="important">40802810900000164203</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-bank"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Банк</h3>
                            <p>ООО "ОЗОН Банк"</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Корреспондентский счет</h3>
                            <p>30101810645374525068</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>БИК</h3>
                            <p class="important">044525068</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Контактная информация -->
            <div class="requisites-section">
                <h2><i class="fas fa-address-book"></i> Контактная информация</h2>
                <div class="requisites-grid">
                   
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Телефон</h3>
                            <p class="important">+7 (950) 540-40-24</p>
                            <p class="small-text">Бесплатно по России</p>
                        </div>
                    </div>
                    
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Email</h3>
                            <p class="important">sellers@gardenborders.ru</p>
                            <p class="small-text">Для бухгалтерских документов</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Руководство -->
            <div class="requisites-section">
                <h2><i class="fas fa-user-tie"></i> Руководство компании</h2>
                <div class="requisites-grid">
                    <div class="requisites-card">
                        <div class="requisites-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="requisites-details">
                            <h3>Генеральный директор</h3>
                            <p>Зелизко Дмитрий Иванович</p>
                            <p class="small-text">Действует на основании Устава</p>
                        </div>
                    </div>
                   
                </div>
            </div>
            
            <!-- Документы для скачивания -->
            <div class="requisites-section">
                <h2><i class="fas fa-download"></i> Документы для скачивания</h2>
                <div class="documents-grid">
                    <a href="docs/card_ozon_bank.pdf" class="document-card" target="_blank">
                        <div class="document-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="document-details">
                            <h3>Реквизиты в формате PDF</h3>
                            <p>Официальные реквизиты для печати (PDF, 150 КБ)</p>
                        </div>
                        <div class="document-download">
                            <i class="fas fa-download"></i>
                        </div>
                    </a>
                    

                </div>
            </div>
            
            <!-- Важная информация -->
            <div class="info-section">
                <div class="info-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="info-content">
                    <h3>Важная информация</h3>
                    <ul>
                        <li>Реквизиты действительны для выставления счетов и договоров</li>
                        <li>Все платежные документы должны содержать полное наименование компании</li>
                        <li>При оплате от юридических лиц обязательно указывать ИНН и КПП</li>
                        <li>Счета выставляются только на официальные реквизиты контрагента</li>
                        <li>Срок обработки платежей - до 3 рабочих дней</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!-- Подвал -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-leaf"></i>
                        <span>Garden<span class="logo-highlight">Borders</span></span>
                    </div>
                    <p>Профессиональные решения для ландшафтного дизайна</p>
                    <div class="footer-links">
                        <a href="requisites.php"><i class="fas fa-file-invoice"></i> Реквизиты компании</a>
                        <a href="privacy.php"><i class="fas fa-shield-alt"></i> Политика конфиденциальности</a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p><i class="fas fa-phone-alt"></i> 7 (950) 540-40-24</p>
                    <p><i class="fas fa-envelope"></i> info@gardenborders.ru</p>
                    <p><i class="fas fa-map-marker-alt"></i> Москва, ул. Садовая, 42</p>
                    <p><i class="fas fa-clock"></i> Пн-Пт: 8:00-18:00</p>
                </div>
                <div class="footer-section">
                    <h4>Бухгалтерия</h4>
                    <p><i class="fas fa-envelope"></i> sellers@gardenborders.ru</p>
                    <p><i class="fas fa-phone-alt"></i> +7 (950) 540-40-24</p>
                    <p><i class="fas fa-file-invoice-dollar"></i> ИНН: 860223446952</p>
                    <p><i class="fas fa-building"></i> ОГРИП: 321665800015831</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> GardenBorders. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script src="js/requisites.js"></script>
</body>
</html>