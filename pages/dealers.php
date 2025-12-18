<?php
// dealers.php в папке pages/
session_start();

// Подключаем header.php
require_once  '../header_styles.php';

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
        <!-- Герой-секция для дилеров -->
        <section class="hero" style="padding: 140px 0 60px;">
            <div class="container">
                <div class="hero-content">
                    <h1>Станьте дилером GardenBorders</h1>
                    <p class="hero-subtitle">Постройте прибыльный бизнес с лидером рынка пластиковых бордюров</p>
                    <div class="hero-features">
                        <div class="hero-feature">
                            <i class="fas fa-chart-line"></i>
                            <span>Высокая рентабельность</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-shield-alt"></i>
                            <span>Эксклюзивная территория</span>
                        </div>
                        <div class="hero-feature">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Обучение и поддержка</span>
                        </div>
                    </div>
                    <a href="#dealer-form" class="cta-button">
                        <i class="fas fa-user-tie"></i> Отправить заявку
                    </a>
                </div>
                <div class="hero-image">
                    <div class="image-placeholder" style="background: linear-gradient(135deg, #2e7d32, #4caf50);">
                        <i class="fas fa-handshake" style="font-size: 80px;"></i>
                        <p style="margin-top: 20px; font-size: 18px;">Партнерство</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Требования к дилерам -->
        <section class="about-section" style="margin-top: 60px;">
            <div class="section-header">
                <h2><i class="fas fa-clipboard-check"></i> Требования к дилерам</h2>
                <p class="section-subtitle">Что нужно для успешного сотрудничества</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <p>Мы ищем надежных партнеров, готовых развивать рынок качественных пластиковых бордюров в своем регионе. Нам важны не только коммерческие показатели, но и общие ценности.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-store" style="color: #2196f3;"></i>
                            <div>
                                <h4>Розничная точка</h4>
                                <p>Наличие магазина или выставочной площадки</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-users" style="color: #ff9800;"></i>
                            <div>
                                <h4>Команда продаж</h4>
                                <p>Хотя бы 1-2 продавца в штате</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-map-marker-alt" style="color: #4caf50;"></i>
                            <div>
                                <h4>Территория</h4>
                                <p>Готовность развивать определенный регион</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-bullhorn" style="color: #9c27b0;"></i>
                            <div>
                                <h4>Активность</h4>
                                <p>Готовность к рекламным активностям</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <div class="image-placeholder" style="background: linear-gradient(135deg, #2196f3, #1976d2);">
                        <i class="fas fa-award" style="font-size: 80px;"></i>
                        <p style="margin-top: 20px; font-size: 16px; padding: 0 20px;">Надежный партнер</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Этапы сотрудничества -->
        <section class="design-projects" style="margin-top: 60px;">
            <div class="section-header">
                <h2><i class="fas fa-sitemap"></i> Этапы сотрудничества</h2>
                <p class="section-subtitle">Как стать нашим дилером</p>
            </div>
            <div class="projects-grid">
                <div class="project-card">
                    <div class="project-image" style="background-color: #e8f5e9;">
                        <i class="fas fa-file-signature" style="color: #2e7d32; font-size: 60px;"></i>
                    </div>
                    <div class="project-info">
                        <h3>1. Заявка</h3>
                        <p>Заполните форму и отправьте заявку на сотрудничество</p>
                        <span class="project-tag" style="background: #2e7d32; color: white;">Шаг 1</span>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image" style="background-color: #e3f2fd;">
                        <i class="fas fa-phone-alt" style="color: #2196f3; font-size: 60px;"></i>
                    </div>
                    <div class="project-info">
                        <h3>2. Знакомство</h3>
                        <p>Знакомство и обсуждение условий сотрудничества</p>
                        <span class="project-tag" style="background: #2196f3; color: white;">Шаг 2</span>
                    </div>
                </div>
                <div class="project-card">
                    <div class="project-image" style="background-color: #fff3e0;">
                        <i class="fas fa-handshake" style="color: #ff9800; font-size: 60px;"></i>
                    </div>
                    <div class="project-info">
                        <h3>3. Договор</h3>
                        <p>Подписание договора и согласование условий</p>
                        <span class="project-tag" style="background: #ff9800; color: white;">Шаг 3</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- Форма заявки дилера -->
        <section id="dealer-form" class="delivery-section" style="margin-top: 80px; margin-bottom: 80px;">
            <div class="section-header">
                <h2><i class="fas fa-user-tie"></i> Заявка на дилерство</h2>
                <p class="section-subtitle">Заполните форму и мы свяжемся с вами в течение 2 часов</p>
            </div>
            
            <div class="dealer-form-container" style="max-width: 800px; margin: 0 auto;">
                <form id="dealerForm" action="process_dealer.php" method="POST" style="background: white; padding: 40px; border-radius: var(--radius); box-shadow: var(--shadow);">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">ФИО *</label>
                            <input type="text" name="full_name" required 
                                   style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px; transition: var(--transition);"
                                   placeholder="Иванов Иван Иванович">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Телефон *</label>
                            <input type="tel" name="phone" required 
                                   style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;"
                                   placeholder="+7 (999) 123-45-67">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Email *</label>
                            <input type="email" name="email" required 
                                   style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;"
                                   placeholder="email@example.com">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Город *</label>
                            <input type="text" name="city" required 
                                   style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;"
                                   placeholder="Москва">
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Название компании</label>
                        <input type="text" name="company" 
                               style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;"
                               placeholder="ООО 'Ваша компания'">
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Опыт работы в сфере (лет)</label>
                        <select name="experience" style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;">
                            <option value="">Выберите опыт</option>
                            <option value="0">Нет опыта</option>
                            <option value="1-2">1-2 года</option>
                            <option value="3-5">3-5 лет</option>
                            <option value="5+">Более 5 лет</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Наличие торговой точки</label>
                        <div style="display: flex; gap: 20px; margin-top: 10px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="has_store" value="yes" style="width: 18px; height: 18px;">
                                <span>Есть магазин/шоурум</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="has_store" value="planning" style="width: 18px; height: 18px;">
                                <span>Планирую открыть</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="has_store" value="no" style="width: 18px; height: 18px;">
                                <span>Нет, онлайн продажи</span>
                            </label>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Ожидаемый объем закупок в месяц</label>
                        <select name="volume" style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px;">
                            <option value="">Выберите объем</option>
                            <option value="50-100">50-100 тыс. руб.</option>
                            <option value="100-300">100-300 тыс. руб.</option>
                            <option value="300-500">300-500 тыс. руб.</option>
                            <option value="500+">Более 500 тыс. руб.</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--dark-gray);">Дополнительная информация</label>
                        <textarea name="message" rows="4" 
                                  style="width: 100%; padding: 14px; border: 2px solid #e0e0e0; border-radius: var(--radius); font-size: 16px; resize: vertical;"
                                  placeholder="Расскажите о вашей компании, планах по развитию, целевой аудитории..."></textarea>
                    </div>
                    
                    <!-- Чекбокс согласия -->
                    <div style="margin-bottom: 30px; padding: 20px; background: var(--light-green); border-radius: var(--radius); border-left: 4px solid var(--primary-green);">
                        <label style="display: flex; align-items: flex-start; gap: 12px; cursor: pointer; color: var(--dark-gray); font-size: 15px; line-height: 1.5;">
                            <input type="checkbox" name="consent" required 
                                   style="width: 20px; height: 20px; margin-top: 3px; flex-shrink: 0; accent-color: var(--primary-green);">
                            <span>Я согласен(а) на обработку персональных данных и принимаю условия <a href="privacy_policy.php" style="color: var(--primary-green); text-decoration: underline;" target="_blank">Политики конфиденциальности</a> и <a href="dealer_agreement.php" style="color: var(--primary-green); text-decoration: underline;" target="_blank">Договора оферты</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="submit-consult" style="width: 100%; padding: 18px; font-size: 18px;">
                        <i class="fas fa-paper-plane"></i> Отправить заявку на дилерство
                    </button>
                    
                    <p style="text-align: center; margin-top: 20px; color: #666; font-size: 14px;">
                        <i class="fas fa-clock"></i> Обработка заявки: 1-2 рабочих дня
                    </p>
                </form>
            </div>
        </section>

        <!-- FAQ -->
        <section class="about-section" style="margin-top: 60px;">
            <div class="section-header">
                <h2><i class="fas fa-question-circle"></i> Частые вопросы</h2>
                <p class="section-subtitle">Ответы на популярные вопросы о дилерстве</p>
            </div>
            <div class="faq-list" style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item" style="margin-bottom: 20px; border: 2px solid var(--light-green); border-radius: var(--radius); overflow: hidden;">
                    <button class="faq-question" onclick="toggleFaq(this)" 
                            style="width: 100%; padding: 20px; text-align: left; background: white; border: none; font-weight: 600; font-size: 16px; color: var(--dark-gray); cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>Какие документы нужны для сотрудничества?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer" style="padding: 0 20px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        <div style="padding: 20px 0; border-top: 1px solid var(--light-green); color: #666; line-height: 1.6;">
                            Для начала сотрудничества потребуются: свидетельство о регистрации юридического лица или ИП, выписка из ЕГРИП/ЕГРЮЛ, копия паспорта руководителя. Все документы можно предоставить после одобрения заявки.
                        </div>
                    </div>
                </div>
                
                <div class="faq-item" style="margin-bottom: 20px; border: 2px solid var(--light-green); border-radius: var(--radius); overflow: hidden;">
                    <button class="faq-question" onclick="toggleFaq(this)"
                            style="width: 100%; padding: 20px; text-align: left; background: white; border: none; font-weight: 600; font-size: 16px; color: var(--dark-gray); cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>Какой минимальный объем первой закупки?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer" style="padding: 0 20px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        <div style="padding: 20px 0; border-top: 1px solid var(--light-green); color: #666; line-height: 1.6;">
                            Минимальная сумма первой закупки составляет 50,000 рублей. Мы предоставляем бесплатную доставку первой партии товара до вашего склада.
                        </div>
                    </div>
                </div>
                
                <div class="faq-item" style="margin-bottom: 20px; border: 2px solid var(--light-green); border-radius: var(--radius); overflow: hidden;">
                    <button class="faq-question" onclick="toggleFaq(this)"
                            style="width: 100%; padding: 20px; text-align: left; background: white; border: none; font-weight: 600; font-size: 16px; color: var(--dark-gray); cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span>Предоставляете ли вы рекламные материалы?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer" style="padding: 0 20px; max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        <div style="padding: 20px 0; border-top: 1px solid var(--light-green); color: #666; line-height: 1.6;">
                            Да, мы предоставляем полный пакет рекламных материалов: фото и видео контент, каталоги продукции, буклеты, баннеры для сайта, готовые посты для соцсетей и рекламные макеты.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Функция для FAQ
        function toggleFaq(button) {
            const faqItem = button.parentElement;
            const answer = faqItem.querySelector('.faq-answer');
            const icon = button.querySelector('i');
            
            if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                answer.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
            } else {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        }
        
        // Валидация формы
        document.getElementById('dealerForm')?.addEventListener('submit', function(e) {
            const consent = this.querySelector('input[name="consent"]');
            if (!consent.checked) {
                e.preventDefault();
                alert('Необходимо согласие на обработку персональных данных');
                consent.focus();
                return false;
            }
            return true;
        });
        
        // Стили для иконок FAQ
        document.querySelectorAll('.faq-question i').forEach(icon => {
            icon.style.transition = 'transform 0.3s ease';
        });
    </script>


</body>
</html>