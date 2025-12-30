<?php 
require_once '../config.php';
require_once 'config.php'; 

?>
<?php

// формируем коризину в сессиях, чтобы дальше ее получить
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cart_items'])) {
    $_SESSION['order_data']['cart_items'] = json_decode($_POST['cart_items'], true);
}
// Смотрим есть ли токен у пользователя или нужна авторизация
 $stop_token_expires = date('Y-m-d H:i:s');

if (isset($_COOKIE['trusted_device']) && (isset($_COOKIE['login_phone'])))  {
    $login_phone = $_COOKIE['login_phone'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = $login_phone");
    $stmt-> execute([]);
    $data_select_user = $stmt->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
//  print_r($data_select_user);

// Проверяем совпадение токена и срок годности токена
$token_from_cookie = $_COOKIE['trusted_device'];
$hash_from_database = $data_select_user['trusted_token'];

$good_token_test = true; // показывает годен ли токен для работы 
// Сравниваем (password_verify сама разберется с солью)
       if (!password_verify($token_from_cookie, $hash_from_database)) {
            $good_token_test = false;
            unset($_COOKIE['trusted_device']); // удаляем из глобального массива
            unset($_COOKIE['login_phone']); // удаляем из глобального массива
         }

// ****************  Проверяем время жизни токена **********************************
       if (strtotime($data_select_user['token_expires']) < time()) {
            $good_token_test = false;
            unset($_COOKIE['trusted_device']); // удаляем из глобального массива
            unset($_COOKIE['login_phone']); // удаляем из глобального массива
        }

// Если токен не прошел признаки достоверности то уходим на подтверждение телефона
if ($good_token_test) {
        header('Location: ../checkout.php');
}


// Ghjdth
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход по SMS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <div class="logo">
                    <h1>Авторизация</h1>
            </div>
            
            <!-- Шаг 1: Ввод телефона -->
            <div id="step1" class="step active">
                <form id="phoneForm">
                    <div class="input-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i> Номер телефона
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone"
                            placeholder="+7 (999) 123-45-67"
                            required
                            autocomplete="off"
                        >
                        <small class="hint">Формат: +7XXXXXXXXXX</small>
                        <div class="error" id="phoneError"></div>
                        <div class="error" id="codeError"></div>
                    </div>
                    



                    <!-- Чекбокс согласия -->
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   id="privacyCheckbox" 
                                   class="checkbox-input" 
                                   required>
                            <span class="checkbox-text">
                                Я соглашаюсь на обработку 
                                <a href="../pages/privacy_policy.php" class="checkbox-link" id="openPrivacy" target ="_blank">персональных данных</a>
                                в соответствии с Федеральным законом № 152-ФЗ
                            </span>
                        </label>
                        <div class="checkbox-error" id="checkboxError">
                            Необходимо согласие на обработку персональных данных
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="sendSmsBtn">
                        <span>Отправить код</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
            
            <!-- Шаг 2: Ввод кода -->
            <div id="step2" class="step">
                <form id="codeForm">
                    <div class="input-group">
                        <label for="code">
                            <i class="fas fa-sms"></i> Код из SMS
                        </label>
                        <div class="code-inputs">
                            <?php for($i = 0; $i < 6; $i++): ?>
                                <input 
                                    type="text" 
                                    class="code-input"
                                    maxlength="1"
                                    data-index="<?php echo $i; ?>"
                                    autocomplete="off"
                                >
                            <?php endfor; ?>
                        </div>
                        <small class="hint">Введите 6-значный код из SMS</small>
                        <div class="error" id="codeError"></div>
                    </div>
                    
                    <div class="timer">
                        <i class="fas fa-clock"></i>
                        <span>Код действителен: <span id="countdown">05:00</span></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="verifyBtn">
                        <span>Подтвердить</span>
                        <i class="fas fa-check"></i>
                    </button>
                    
                    <button type="button" class="btn btn-secondary" id="backBtn">
                        <i class="fas fa-arrow-left"></i> Изменить номер
                    </button>
                </form>
            </div>
            
            <div class="loader" id="loader">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let timerInterval;
            let timeLeft = 300; // 5 минут
            
            // Форматирование телефона
            $('#phone').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                
                if (value.startsWith('8')) {
                    value = '+7' + value.slice(1);
                } else if (value.startsWith('7')) {
                    value = '+7' + value.slice(1);
                } else if (!value.startsWith('+')) {
                    value = '+7' + value;
                }
                
                // Форматирование
                let formatted = value.slice(0, 2);
                if (value.length > 2) formatted += ' ' + value.slice(2, 5);
                if (value.length > 5) formatted += ' ' + value.slice(5, 8);
                if (value.length > 8) formatted += '-' + value.slice(8, 10);
                if (value.length > 10) formatted += '-' + value.slice(10, 12);
                
                $(this).val(formatted);
            });
            
            // Отправка SMS
            $('#phoneForm').on('submit', function(e) {
                e.preventDefault();
                
                const phone = $('#phone').val().replace(/[^\d+]/g, '');
                
                if (!phone.match(/^\+7\d{10}$/)) {
                    showError('phoneError', 'Введите корректный номер телефона');
                    return;
                }
                
                showLoader();
                
                $.ajax({
                    url: 'send-sms.php',
                    type: 'POST',
                    data: { phone: phone },
                    dataType: 'json',
                    success: function(response) {
                        hideLoader();
                        
                        if (response.success) {
                            $('#step1').removeClass('active');
                            $('#step2').addClass('active');
                            startTimer();
                            focusFirstCodeInput();
                        } else {
                            showError('phoneError', response.message);
                        }
                    },
                    error: function() {
                        hideLoader();
                        showError('phoneError', 'Ошибка сервера');
                    }
                });
            });
            
            // Работа с полями кода
            $('.code-input').on('input', function() {
                const index = $(this).data('index');
                const value = $(this).val();
                
                if (value && index < 5) {
                    $(`.code-input[data-index="${index + 1}"]`).focus();
                }
                
                // Автоматическая отправка при заполнении всех полей
                if (index === 5 && value) {
                    setTimeout(submitCode, 300);
                }
            });
            
            $('.code-input').on('keydown', function(e) {
                const index = $(this).data('index');
                
                // Удаление и переход назад
                if (e.key === 'Backspace' && !$(this).val() && index > 0) {
                    $(`.code-input[data-index="${index - 1}"]`).focus().val('');
                }
                
                // Навигация стрелками
                if (e.key === 'ArrowLeft' && index > 0) {
                    $(`.code-input[data-index="${index - 1}"]`).focus();
                }
                if (e.key === 'ArrowRight' && index < 5) {
                    $(`.code-input[data-index="${index + 1}"]`).focus();
                }
            });
            
            function submitCode() {
                const code = $('.code-input').map(function() {
                    return $(this).val();
                }).get().join('');
                
                if (code.length !== 6) {
                    showError('codeError', 'Введите полный код');
                    return;
                }
                
                showLoader();
                
                $.ajax({
                    url: 'verify.php',
                    type: 'POST',
                    data: {
                        phone: $('#phone').val().replace(/[^\d+]/g, ''),
                        code: code
                    },
                    dataType: 'json',
                    success: function(response) {
                        hideLoader();
                        
                        if (response.success) {
                            window.location.href = '../checkout.php';
                        } else {
                            if (response.die_stop) {
                            $('#step2').removeClass('active');
                            $('#step1').addClass('active');
                             showError('codeError', response.message);
                            $('.code-input').val('').first().focus();

                            }
                            showError('codeError', response.message);
                            $('.code-input').val('').first().focus();
                        }
                    },
                    error: function() {
                        hideLoader();
                        showError('codeError', 'Ошибка сервера');
                    }
                });
            }
            
            // Подтверждение кода
            $('#codeForm').on('submit', function(e) {
                e.preventDefault();
                submitCode();
            });
            
            // Назад
            $('#backBtn').on('click', function() {
                $('#step2').removeClass('active');
                $('#step1').addClass('active');
                $('.code-input').val('');
                clearInterval(timerInterval);
                $('#countdown').text('05:00');
                timeLeft = 300;
            });
            
            // Таймер
            function startTimer() {
                clearInterval(timerInterval);
                timeLeft = 300;
                
                timerInterval = setInterval(function() {
                    timeLeft--;
                    
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    
                    $('#countdown').text(
                        minutes.toString().padStart(2, '0') + ':' + 
                        seconds.toString().padStart(2, '0')
                    );
                    
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        showError('codeError', 'Срок действия кода истек');
                    }
                }, 1000);
            }
            
            function focusFirstCodeInput() {
                $('.code-input').first().focus();
            }
            
            function showError(elementId, message) {
                $('#' + elementId).text(message).show();
                setTimeout(() => {
                    $('#' + elementId).hide();
                }, 5000);
            }
            
            function showLoader() {
                $('#loader').fadeIn();
                $('button').prop('disabled', true);
            }
            
            function hideLoader() {
                $('#loader').fadeOut();
                $('button').prop('disabled', false);
            }
        });
    </script>
</body>
</html>