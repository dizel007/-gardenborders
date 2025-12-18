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
                    <p><i class="fas fa-phone-alt"></i>7 (950) 540-40-24</p>
                    <p><i class="fas fa-envelope"></i> info@gardenborders.ru</p>
                    <p><i class="fas fa-map-marker-alt"></i> г. Москва, п.Московский, д.Саларьево, вл.3, стр.1</p>
                    <p><i class="fas fa-clock"></i> Пн-Вс: 8:00-21:00</p>
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
    <!-- <script src="js/cart-state.js"></script> -->
    <script src="js/cart.js"></script>