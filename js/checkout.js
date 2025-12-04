
    // JavaScript для взаимодействия с выбором опций
    document.addEventListener('DOMContentLoaded', function() {
        // Получаем элементы
        const deliveryOptions = document.querySelectorAll('.delivery-option');
        const paymentOptions = document.querySelectorAll('.payment-option');
        const cashPaymentOption = document.querySelector('.payment-option input[value="cash"]').closest('.payment-option');
        const cardPaymentOption = document.querySelector('.payment-option input[value="card"]').closest('.payment-option');
        const cashRadio = document.querySelector('input[value="cash"]');
        const cardRadio = document.querySelector('input[value="card"]');
        
        // Функция для проверки возможности оплаты наличными
        function checkCashPaymentAvailability() {
            const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
            
            if (selectedDelivery && selectedDelivery.value === 'pickup') {
                // Для самовывоза - наличные доступны
                cashPaymentOption.classList.remove('disabled');
                cashRadio.disabled = false;
                
                // Добавляем/удаляем лейбл
                let disabledLabel = cashPaymentOption.querySelector('.disabled-label');
                if (disabledLabel) {
                    disabledLabel.remove();
                }
            } else {
                // Для других способов доставки - наличные недоступны
                cashPaymentOption.classList.add('disabled');
                cashRadio.disabled = true;
                
                // Если наличные были выбраны - переключаем на карту
                if (cashRadio.checked) {
                    cardRadio.checked = true;
                    cashPaymentOption.classList.remove('selected');
                    cardPaymentOption.classList.add('selected');
                }
                
                // Добавляем лейбл "Только для самовывоза"
                let disabledLabel = cashPaymentOption.querySelector('.disabled-label');
                if (!disabledLabel) {
                    disabledLabel = document.createElement('span');
                    disabledLabel.className = 'disabled-label';
                    disabledLabel.textContent = 'Только для самовывоза';
                    cashPaymentOption.appendChild(disabledLabel);
                }
            }
        }
        
        // Обработка выбора способа доставки
        deliveryOptions.forEach(option => {
            option.addEventListener('click', function() {
                deliveryOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                
                // Проверяем доступность наличных
                checkCashPaymentAvailability();
            });
        });
        
        // Обработка выбора способа оплаты (только если не заблокирован)
        paymentOptions.forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio.disabled) return; // Не позволяем выбирать заблокированный
                
                paymentOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
        
        // Инициализация при загрузке
        checkCashPaymentAvailability();
        
        // Простой ввод телефона - только цифры
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            // Убираем placeholder с маской, ставим простой
            phoneInput.placeholder = "79161234567";
            
            // Разрешаем ввод только цифр и клавиш управления
            phoneInput.addEventListener('input', function(e) {
                // Убираем все не-цифры
                this.value = this.value.replace(/\D/g, '');
                
                // Ограничиваем длину (11 цифр для российских номеров)
                if (this.value.length > 11) {
                    this.value = this.value.substring(0, 11);
                }
            });
            
            // Запрещаем ввод букв и других символов
            phoneInput.addEventListener('keydown', function(e) {
                // Разрешаем: цифры, Backspace, Delete, Tab, стрелки
                if ((e.key >= '0' && e.key <= '9') || 
                    e.key === 'Backspace' || 
                    e.key === 'Delete' ||
                    e.key === 'Tab' ||
                    e.key === 'ArrowLeft' ||
                    e.key === 'ArrowRight' ||
                    e.key === 'ArrowUp' ||
                    e.key === 'ArrowDown' ||
                    e.key === 'Home' ||
                    e.key === 'End') {
                    return;
                }
                
                // Блокируем все остальные клавиши
                e.preventDefault();
            });
            
            // При фокусе - показываем подсказку
            phoneInput.addEventListener('focus', function() {
                // Создаем подсказку если её нет
                let hint = this.parentElement.querySelector('.phone-hint');
                if (!hint) {
                    hint = document.createElement('div');
                    hint.className = 'phone-hint';
                    hint.style.fontSize = '12px';
                    hint.style.color = '#666';
                    hint.style.marginTop = '5px';
                    hint.innerHTML = 'Введите 11 цифр номера телефона, например: 79161234567';
                    this.parentElement.appendChild(hint);
                }
            });
            
            // При потере фокуса - убираем подсказку
            phoneInput.addEventListener('blur', function() {
                const hint = this.parentElement.querySelector('.phone-hint');
                if (hint) {
                    hint.remove();
                }
            });
        }
        
        // Автоматическое форматирование ФИО (первая буква заглавная)
        const fullNameInput = document.getElementById('full_name');
        if (fullNameInput) {
            fullNameInput.addEventListener('blur', function() {
                if (this.value) {
                    // Приводим каждое слово к виду с заглавной буквы
                    this.value = this.value
                        .toLowerCase()
                        .split(' ')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');
                }
            });
        }
        
        // Валидация формы при отправке
        const form = document.getElementById('checkoutForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                // Сбрасываем все ошибки
                form.querySelectorAll('.error-message').forEach(error => error.remove());
                form.querySelectorAll('input, textarea').forEach(field => {
                    field.style.borderColor = '';
                });
                
                // Проверка обязательных полей
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#f44336';
                        
                        // Показываем ошибку
                        let errorDiv = field.parentElement.querySelector('.error-message');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message';
                            errorDiv.style.color = '#f44336';
                            errorDiv.style.fontSize = '12px';
                            errorDiv.style.marginTop = '5px';
                            errorDiv.textContent = 'Это поле обязательно для заполнения';
                            field.parentElement.appendChild(errorDiv);
                        }
                    }
                });
                
                // Проверка телефона
                const phone = document.getElementById('phone');
                if (phone && phone.value) {
                    // Проверяем, что только цифры
                    const phoneDigits = phone.value.replace(/\D/g, '');
                    
                    // Проверяем длину (российский номер: 11 цифр, начинается с 7 или 8)
                    if (phoneDigits.length !== 11) {
                        isValid = false;
                        phone.style.borderColor = '#f44336';
                        
                        let errorDiv = phone.parentElement.querySelector('.error-message');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message';
                            errorDiv.style.color = '#f44336';
                            errorDiv.style.fontSize = '12px';
                            errorDiv.style.marginTop = '5px';
                            errorDiv.textContent = 'Введите 11 цифр номера телефона';
                            phone.parentElement.appendChild(errorDiv);
                        }
                    } else if (!phoneDigits.startsWith('7') && !phoneDigits.startsWith('8')) {
                        isValid = false;
                        phone.style.borderColor = '#f44336';
                        
                        let errorDiv = phone.parentElement.querySelector('.error-message');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message';
                            errorDiv.style.color = '#f44336';
                            errorDiv.style.fontSize = '12px';
                            errorDiv.style.marginTop = '5px';
                            errorDiv.textContent = 'Номер телефона должен начинаться с 7 или 8';
                            phone.parentElement.appendChild(errorDiv);
                        }
                    }
                }
                
                // Проверка email если указан
                const email = document.getElementById('email');
                if (email && email.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email.value)) {
                        isValid = false;
                        email.style.borderColor = '#f44336';
                        
                        let errorDiv = email.parentElement.querySelector('.error-message');
                        if (!errorDiv) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message';
                            errorDiv.style.color = '#f44336';
                            errorDiv.style.fontSize = '12px';
                            errorDiv.style.marginTop = '5px';
                            errorDiv.textContent = 'Введите корректный email адрес';
                            email.parentElement.appendChild(errorDiv);
                        }
                    }
                }
                
                if (!isValid) {
                    e.preventDefault();
                    
                    // Прокручиваем к первой ошибке
                    const firstError = form.querySelector('[style*="border-color: rgb(244, 67, 54)"]');
                    if (firstError) {
                        firstError.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                        
                        // Фокусируемся на поле с ошибкой
                        setTimeout(() => {
                            firstError.focus();
                        }, 500);
                    }
                } else {
                    // Если валидация прошла успешно, форматируем телефон перед отправкой
                    if (phone && phone.value) {
                        const phoneDigits = phone.value.replace(/\D/g, '');
                        if (phoneDigits.length === 11) {
                            // Форматируем в красивый вид для отправки на сервер
                            phone.value = '+7 (' + phoneDigits.substring(1, 4) + ') ' + 
                                         phoneDigits.substring(4, 7) + '-' + 
                                         phoneDigits.substring(7, 9) + '-' + 
                                         phoneDigits.substring(9, 11);
                        }
                    }
                }
            });
        }
        
        // Добавляем стили для подсказок ошибок
        const style = document.createElement('style');
        style.textContent = `
            .phone-hint {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
                animation: fadeIn 0.3s ease;
            }
            
            .error-message {
                color: #f44336;
                font-size: 12px;
                margin-top: 5px;
                display: block;
                animation: fadeIn 0.3s ease;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-5px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            /* Подсветка обязательных полей */
            .form-group label[for]:after {
                content: ' *';
                color: #f44336;
            }
            
            .form-group label[for="email"]:after {
                content: ''; /* Email не обязателен */
            }
        `;
        document.head.appendChild(style);
    });
