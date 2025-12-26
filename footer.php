<?php ?>


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
            <form id="consultationForm" action="pages/consultation_success.php" method="POST">
                <input type="text" name="name" placeholder="Ваше имя" required>
                <input type="tel" name="phone" placeholder="Телефон" required>
                <input type="email" name="email" placeholder="Email (необязательно)">
                <textarea name="message" placeholder="Опишите ваш проект или задайте вопрос"></textarea>
                
                <!-- Чекбокс согласия -->
                <div class="consent-checkbox">
                    <label>
                        <input type="checkbox" name="consent" required>
                        <span>Я согласен(а) на обработку персональных данных</span>
                    </label>
                    <a href="pages/privacy_policy.php" class="privacy-link" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Политика конфиденциальности
                    </a>
                </div>
                
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
                    <div class="social-links" ancor="footer">
                        <a  href="#footer"><i class="fab fa-instagram"></i></a>
                        <a href="#footer"><i class="fab fa-vk"></i></a>
                        <a href="#footer"><i class="fab fa-youtube"></i></a>
                        <a href="#footer"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p><i class="fas fa-phone-alt"></i><?php echo $contact_telefon?></p>
                    <p><i class="fas fa-envelope"></i><?php echo $contact_email?></p>
                    <p><i class="fas fa-map-marker-alt"></i><?php echo $delivery_adress?> </p>
                    <p><i class="fas fa-clock"></i> Отгрузка Пн-Пт: 8:00-17:00</p>
                    <p><i class="fas"><a href="requisites.php">Контакты</a></i></p>
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
                <p>&copy; <?php echo date('Y');?> GardenBorders. Все права защищены.</p>
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
    <script src="js/cart.js"></script>