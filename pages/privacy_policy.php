<?php
session_start();
require_once "../header_styles.php";
require_once "../_no_git/contact_info.php";
?>
  <style>
    body {
        padding-top: 0;
    }
  </style>
    <div class="top-header">
        <div class="container">
            <div class="header-left">
                <div class="logo">
                    <i class="fas fa-leaf"></i>
                    <span>Garden<span class="logo-highlight">Borders</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Основное содержимое -->
    <main class="container">
        <!-- Герой-секция -->
        <section class="hero" style="padding: 140px 0 60px;">
            <div class="container">
                <div class="hero-content">
                    <h1>Политика конфиденциальности</h1>
                    <p class="hero-subtitle">Обработка персональных данных в компании GardenBorders</p>
                    <div class="hero-features">
                        <div class="hero-feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Защита данных</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-lock"></i>
                            <span>Конфиденциальность</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-gavel"></i>
                            <span>Соответствие ФЗ-152</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="image-placeholder" style="background: linear-gradient(135deg, #2196f3, #1976d2);">
                        <i class="fas fa-user-shield" style="font-size: 80px;"></i>
                        <p style="margin-top: 20px; font-size: 18px;">Ваши данные в безопасности</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Основной контент -->
        <section class="about-section" style="margin-top: 60px;">
            <div class="section-header">
                <h2><i class="fas fa-file-contract"></i> Политика обработки персональных данных</h2>
                <p class="section-subtitle">Обновлено: <?php echo date('d.m.Y'); ?></p>
            </div>
            
            <div class="privacy-content" style="max-width: 900px; margin: 0 auto;">
                <!-- Введение -->
                <div class="privacy-section" style="margin-bottom: 40px; padding: 30px; background: var(--light-green); border-radius: var(--radius);">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-info-circle"></i> Общие положения
                    </h3>
                    <p style="line-height: 1.8; color: var(--dark-gray); margin-bottom: 15px;">
                        Настоящая политика обработки персональных данных составлена в соответствии с требованиями 
                        Федерального закона от 27.07.2006 № 152-ФЗ «О персональных данных» и определяет порядок обработки 
                        персональных данных и меры по обеспечению безопасности персональных данных, предпринимаемые 
                        GardenBorders (далее – Оператор).
                    </p>
                    <p style="line-height: 1.8; color: var(--dark-gray);">
                        Оператор ставит своей важнейшей целью и условием осуществления своей деятельности соблюдение прав 
                        и свобод человека и гражданина при обработке его персональных данных, в том числе защиты прав на 
                        неприкосновенность частной жизни, личную и семейную тайну.
                    </p>
                </div>

                <!-- Основные понятия -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-book"></i> Основные понятия
                    </h3>
                    <div style="background: white; padding: 25px; border-radius: var(--radius); box-shadow: var(--shadow);">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                <strong style="color: var(--primary-green);">Персональные данные</strong> — любая информация, 
                                относящаяся прямо или косвенно к определенному или определяемому физическому лицу (субъекту персональных данных).
                            </li>
                            <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                <strong style="color: var(--primary-green);">Обработка персональных данных</strong> — любое действие 
                                (операция) или совокупность действий (операций), совершаемых с использованием средств автоматизации 
                                или без использования таких средств с персональными данными.
                            </li>
                            <li style="margin-bottom: 15px;">
                                <strong style="color: var(--primary-green);">Безопасность персональных данных</strong> — защищенность 
                                персональных данных от неправомерного или случайного доступа к ним, уничтожения, изменения, 
                                блокирования, копирования, предоставления, распространения.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Цели обработки -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-bullseye"></i> Цели обработки персональных данных
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        <div style="background: white; padding: 25px; border-radius: var(--radius); box-shadow: var(--shadow); border-top: 4px solid var(--primary-green);">
                            <h4 style="color: var(--primary-green); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-shopping-cart"></i> Оформление заказов
                            </h4>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">
                                Обработка заказов, доставка товаров, предоставление услуг, обработка платежей
                            </p>
                        </div>
                        <div style="background: white; padding: 25px; border-radius: var(--radius); box-shadow: var(--shadow); border-top: 4px solid var(--accent-orange);">
                            <h4 style="color: var(--accent-orange); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-comments"></i> Обратная связь
                            </h4>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">
                                Ответы на вопросы, консультации, обратная связь с клиентами
                            </p>
                        </div>
                        <div style="background: white; padding: 25px; border-radius: var(--radius); box-shadow: var(--shadow); border-top: 4px solid var(--sky-blue);">
                            <h4 style="color: var(--sky-blue); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-envelope"></i> Рассылка
                            </h4>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">
                                Информирование о новинках, акциях, специальных предложениях (только с согласия)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Категории данных -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-database"></i> Категории обрабатываемых персональных данных
                    </h3>
                    <div style="background: white; padding: 30px; border-radius: var(--radius); box-shadow: var(--shadow);">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                            <div style="padding: 15px; background: var(--light-green); border-radius: var(--radius);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <i class="fas fa-user" style="color: var(--primary-green);"></i>
                                    <span style="font-weight: 600;">ФИО</span>
                                </div>
                            </div>
                            <div style="padding: 15px; background: var(--light-green); border-radius: var(--radius);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <i class="fas fa-phone" style="color: var(--primary-green);"></i>
                                    <span style="font-weight: 600;">Телефон</span>
                                </div>
                            </div>
                            <div style="padding: 15px; background: var(--light-green); border-radius: var(--radius);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <i class="fas fa-envelope" style="color: var(--primary-green);"></i>
                                    <span style="font-weight: 600;">Email</span>
                                </div>
                            </div>
                            <div style="padding: 15px; background: var(--light-green); border-radius: var(--radius);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--primary-green);"></i>
                                    <span style="font-weight: 600;">Адрес</span>
                                </div>
                            </div>
                        </div>
                        <p style="margin-top: 20px; color: #666; font-size: 14px;">
                            <i class="fas fa-info-circle" style="color: var(--accent-orange);"></i> 
                            Мы не обрабатываем специальные категории персональных данных, касающиеся расовой, 
                            национальной принадлежности, политических взглядов, религиозных или философских убеждений, 
                            состояния здоровья, интимной жизни.
                        </p>
                    </div>
                </div>

                <!-- Правовые основания -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-balance-scale"></i> Правовые основания обработки
                    </h3>
                    <div style="background: #e8f5e9; padding: 25px; border-radius: var(--radius); border-left: 4px solid var(--primary-green);">
                        <p style="line-height: 1.8; color: var(--dark-gray); margin-bottom: 15px;">
                            Оператор обрабатывает персональные данные Пользователя только в случае их заполнения и/или отправки 
                            Пользователем самостоятельно через специальные формы, расположенные на сайте. 
                        </p>
                        <p style="line-height: 1.8; color: var(--dark-gray);">
                            Заполняя соответствующие формы и/или отправляя свои персональные данные Оператору, 
                            Пользователь выражает свое согласие с данной Политикой.
                        </p>
                    </div>
                </div>

                <!-- Порядок и условия -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-cogs"></i> Порядок и условия обработки
                    </h3>
                    <div style="background: white; padding: 30px; border-radius: var(--radius); box-shadow: var(--shadow);">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                            <div>
                                <h4 style="color: var(--primary-green); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-clock"></i> Сроки обработки
                                </h4>
                                <p style="color: #666; line-height: 1.6;">
                                    Обработка персональных данных осуществляется в течение срока, необходимого для достижения целей обработки.
                                </p>
                            </div>
                            <div>
                                <h4 style="color: var(--primary-green); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-ban"></i> Уничтожение данных
                                </h4>
                                <p style="color: #666; line-height: 1.6;">
                                    Персональные данные уничтожаются при достижении целей обработки или при отзыве согласия.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Права субъекта -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-user-check"></i> Права субъекта персональных данных
                    </h3>
                    <div style="background: #fff3e0; padding: 30px; border-radius: var(--radius); border-left: 4px solid var(--accent-orange);">
                        <p style="color: var(--dark-gray); margin-bottom: 20px; font-weight: 600;">
                            Пользователь имеет право:
                        </p>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 12px; padding-left: 25px; position: relative;">
                                <i class="fas fa-check" style="color: var(--primary-green); position: absolute; left: 0; top: 5px;"></i>
                                <span>Получать информацию, касающуюся обработки его персональных данных</span>
                            </li>
                            <li style="margin-bottom: 12px; padding-left: 25px; position: relative;">
                                <i class="fas fa-check" style="color: var(--primary-green); position: absolute; left: 0; top: 5px;"></i>
                                <span>Требовать уточнения, блокирования или уничтожения его персональных данных</span>
                            </li>
                            <li style="margin-bottom: 12px; padding-left: 25px; position: relative;">
                                <i class="fas fa-check" style="color: var(--primary-green); position: absolute; left: 0; top: 5px;"></i>
                                <span>Отозвать согласие на обработку персональных данных</span>
                            </li>
                            <li style="margin-bottom: 12px; padding-left: 25px; position: relative;">
                                <i class="fas fa-check" style="color: var(--primary-green); position: absolute; left: 0; top: 5px;"></i>
                                <span>Обжаловать действия или бездействие Оператора в уполномоченный орган</span>
                            </li>
                        </ul>
                        
                        <div style="margin-top: 25px; padding: 20px; background: white; border-radius: var(--radius);">
                            <p style="color: var(--dark-gray); margin-bottom: 10px; font-weight: 600;">
                                <i class="fas fa-exclamation-circle" style="color: var(--accent-orange);"></i> Как реализовать права?
                            </p>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">
                                Для реализации своих прав направьте письменное заявление на email: 
                                <a href="mailto:privacy@gardenborders.ru" style="color: var(--primary-green); text-decoration: none; font-weight: 600;">
                                    privacy@gardenborders.ru
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Безопасность данных -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-lock"></i> Безопасность персональных данных
                    </h3>
                    <div style="background: white; padding: 30px; border-radius: var(--radius); box-shadow: var(--shadow);">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                            <div style="text-align: center; padding: 20px; background: #f5f5f5; border-radius: var(--radius);">
                                <i class="fas fa-key" style="font-size: 40px; color: var(--primary-green); margin-bottom: 15px;"></i>
                                <h4 style="color: var(--dark-gray); margin-bottom: 10px;">Шифрование</h4>
                                <p style="color: #666; font-size: 14px;">Использование современных методов шифрования</p>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f5f5f5; border-radius: var(--radius);">
                                <i class="fas fa-shield-alt" style="font-size: 40px; color: var(--primary-green); margin-bottom: 15px;"></i>
                                <h4 style="color: var(--dark-gray); margin-bottom: 10px;">Защита</h4>
                                <p style="color: #666; font-size: 14px;">Защита от несанкционированного доступа</p>
                            </div>
                            <div style="text-align: center; padding: 20px; background: #f5f5f5; border-radius: var(--radius);">
                                <i class="fas fa-user-lock" style="font-size: 40px; color: var(--primary-green); margin-bottom: 15px;"></i>
                                <h4 style="color: var(--dark-gray); margin-bottom: 10px;">Контроль доступа</h4>
                                <p style="color: #666; font-size: 14px;">Строгий контроль доступа сотрудников</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Контакты -->
                <div class="privacy-section" style="margin-bottom: 40px;">
                    <h3 style="color: var(--primary-green); margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-headset"></i> Контакты и обратная связь
                    </h3>
                    <div style="background: linear-gradient(135deg, var(--light-green), #ffffff); padding: 30px; border-radius: var(--radius);">
                        <p style="color: var(--dark-gray); margin-bottom: 20px;">
                            По всем вопросам, касающимся обработки персональных данных, вы можете обратиться:
                        </p>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                            <div style="background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow);">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                                    <i class="fas fa-envelope" style="color: var(--primary-green); font-size: 20px;"></i>
                                    <div>
                                        <h4 style="color: var(--dark-gray); margin: 0;">Email</h4>
                                        <a href="mailto:privacy@gardenborders.ru" style="color: var(--primary-green); text-decoration: none; font-weight: 600;">
                                           <?php echo $contact_email ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow);">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                                    <i class="fas fa-phone-alt" style="color: var(--primary-green); font-size: 20px;"></i>
                                    <div>
                                        <h4 style="color: var(--dark-gray); margin: 0;">Телефон</h4>
                                        <a style="color: var(--primary-green); text-decoration: none; font-weight: 600;">
                                            <?php echo $contact_telefon ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div style="background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow);">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--primary-green); font-size: 20px;"></i>
                                    <div>
                                        <h4 style="color: var(--dark-gray); margin: 0;">Адрес</h4>
                                        <p style="color: #666; margin: 0; font-size: 14px;">
                                            г. Москва, п.Московский, д.Саларьево, вл.3, стр.1
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Заключение -->
                <div class="privacy-section" style="margin-bottom: 40px; padding: 30px; background: var(--primary-green); border-radius: var(--radius); color: white;">
                    <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-file-signature"></i> Заключительные положения
                    </h3>
                    <p style="line-height: 1.8; margin-bottom: 15px; opacity: 0.9;">
                        Оператор имеет право вносить изменения в настоящую Политику конфиденциальности без согласия Пользователя.
                    </p>
                    <p style="line-height: 1.8; margin-bottom: 15px; opacity: 0.9;">
                        Новая редакция Политики вступает в силу с момента ее размещения на сайте, если иное не предусмотрено 
                        новой редакцией Политики.
                    </p>
                    <p style="line-height: 1.8; opacity: 0.9;">

                    </p>
                </div>

                <!-- Дата и кнопка -->
                <div style="text-align: center; margin-top: 60px; padding-top: 40px; border-top: 2px solid var(--light-green);">
                    <p style="color: #666; margin-bottom: 30px; font-size: 14px;">
                        <i class="fas fa-calendar-alt"></i> Документ вступил в силу: 01 января 2023 года
                    </p>
                    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                        <a href="../" class="cta-button" style="text-decoration: none;">
                            <i class="fas fa-home"></i> Вернуться на главную
                        </a>
                        <button onclick="window.print()" class="cta-button" style="background: linear-gradient(135deg, #795548, #5d4037); border: none; cursor: pointer;">
                            <i class="fas fa-print"></i> Распечатать политику
                        </button>
                        <a href="#top" class="cta-button" style="background: linear-gradient(135deg, #2196f3, #1976d2); text-decoration: none;">
                            <i class="fas fa-arrow-up"></i> Наверх
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /* Дополнительные стили для печати */
        @media print {
            .main-nav, .top-header, footer, .cta-button {
                display: none !important;
            }
            
            body {
                padding-top: 0;
            }
            
            .privacy-content {
                max-width: 100% !important;
            }
            
            .privacy-section {
                break-inside: avoid;
            }
        }
        
        /* Анимации */
        .privacy-section {
            animation: fadeIn 0.6s ease forwards;
            opacity: 0;
        }
        
        .privacy-section:nth-child(1) { animation-delay: 0.1s; }
        .privacy-section:nth-child(2) { animation-delay: 0.2s; }
        .privacy-section:nth-child(3) { animation-delay: 0.3s; }
        .privacy-section:nth-child(4) { animation-delay: 0.4s; }
        .privacy-section:nth-child(5) { animation-delay: 0.5s; }
        .privacy-section:nth-child(6) { animation-delay: 0.6s; }
        .privacy-section:nth-child(7) { animation-delay: 0.7s; }
        .privacy-section:nth-child(8) { animation-delay: 0.8s; }
        .privacy-section:nth-child(9) { animation-delay: 0.9s; }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</body>
</html>