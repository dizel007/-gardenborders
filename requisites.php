<?php
// Подключаем базу данных товаров
session_start();
require_once 'includes/database.php';
require_once 'products.php'; // Подключаем напрямую

?>
<!-- шапка -->
<?php require_once "header.php";?>
    <link rel="stylesheet" href="styles/requisites.css">
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
<?php require_once "footer.php";?>

   <script src="js/checkout.js"></script>
   <script src="js/requisites.js"></script>

</body>
</html>