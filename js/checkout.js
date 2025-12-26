// JavaScript для взаимодействия с выбором опций
document.addEventListener('DOMContentLoaded', function() {
    // Получаем элементы
    const deliveryOptions = document.querySelectorAll('.delivery-option');
    const paymentOptions = document.querySelectorAll('.payment-option');
    const cashPaymentOption = document.querySelector('.payment-option input[value="cash"]').closest('.payment-option');
    const cardPaymentOption = document.querySelector('.payment-option input[value="card"]').closest('.payment-option');
    const cashRadio = document.querySelector('input[value="cash"]');
    const cardRadio = document.querySelector('input[value="card"]');
    const addressSection = document.getElementById('addressSection');
    const addressInput = document.getElementById('delivery_address');
    
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
    
    // Функция для отображения/скрытия поля адреса
    function toggleAddressField() {
        const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
        
        if (selectedDelivery && selectedDelivery.value === 'pickup') {
            // Для самовывоза скрываем поле адреса
            if (addressSection) {
                addressSection.style.display = 'none';
                if (addressInput) {
                    addressInput.removeAttribute('required');
                    addressInput.value = '';
                }
            }
        } else {
            // Для других способов доставки показываем поле адреса
            if (addressSection) {
                addressSection.style.display = 'block';
                if (addressInput) {
                    addressInput.setAttribute('required', 'required');
                    
                    // Прокручиваем к полю адреса для лучшего UX
                    setTimeout(() => {
                        addressInput.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                    }, 300);
                }
            }
        }
    }
    
// Обработка выбора способа доставки
deliveryOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Проверяем, не заблокирована ли опция
        if (this.classList.contains('disabled')) return;
        
        deliveryOptions.forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        
        // Проверяем доступность наличных
        checkCashPaymentAvailability();
        
        // Показываем/скрываем поле адреса
        toggleAddressField();
    });
});
    
    // Обработка выбора способа оплаты (только если не заблокирован)
    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            if (radio.disabled) return;
            
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
    
    // Инициализация при загрузке
    checkCashPaymentAvailability();
    toggleAddressField();
    
    // Простой ввод телефона - только цифры
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.placeholder = "79161234567";
        
        phoneInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
            
            if (this.value.length > 11) {
                this.value = this.value.substring(0, 11);
            }
        });
        
        phoneInput.addEventListener('keydown', function(e) {
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
            
            e.preventDefault();
        });
    }
    
    // Автоматическое форматирование ФИО
    const fullNameInput = document.getElementById('full_name');
    if (fullNameInput) {
        fullNameInput.addEventListener('blur', function() {
            if (this.value) {
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
                const phoneDigits = phone.value.replace(/\D/g, '');
                
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
            
            // Проверка адреса доставки если требуется
            const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
            if (selectedDelivery && selectedDelivery.value !== 'pickup' && addressInput) {
                if (!addressInput.value.trim()) {
                    isValid = false;
                    addressInput.style.borderColor = '#f44336';
                    
                    let errorDiv = addressInput.parentElement.querySelector('.error-message');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message';
                        errorDiv.style.color = '#f44336';
                        errorDiv.style.fontSize = '12px';
                        errorDiv.style.marginTop = '5px';
                        errorDiv.textContent = 'Укажите адрес доставки';
                        addressInput.parentElement.appendChild(errorDiv);
                    }
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                
                const firstError = form.querySelector('[style*="border-color: rgb(244, 67, 54)"]');
                if (firstError) {
                    firstError.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    
                    setTimeout(() => {
                        firstError.focus();
                    }, 500);
                }
            } else {
                // Если валидация прошла успешно, форматируем телефон перед отправкой
                if (phone && phone.value) {
                    const phoneDigits = phone.value.replace(/\D/g, '');
                    if (phoneDigits.length === 11) {
                        phone.value = '+7 (' + phoneDigits.substring(1, 4) + ') ' + 
                                     phoneDigits.substring(4, 7) + '-' + 
                                     phoneDigits.substring(7, 9) + '-' + 
                                     phoneDigits.substring(9, 11);
                    }
                }
            }
        });
    }
});


