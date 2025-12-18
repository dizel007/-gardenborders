<?php
require_once ("../_no_git/contact_info.php");  
require_once "../config.php";
require_once "../_no_git/secret_info.php";  
require_once "../mailer/send_mail.php";

session_start();
    $content = "=== КОНСУЛЬТАЦИЯ  ===\n\n";
    foreach ($_POST as $key => $value) {
        $label = [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'message' => 'Сообщние ',
            'consent' => 'Согласие на обработку',
            
        ][$key] ?? $key;
        
        $content .= "$label: $value\n\n";
    }


// print_r ($_POST);
    // Отправляем email (опционально)
send_many_emails($EMAIL_for_letters, 'Консультация',  $content, $mail_for_send_letter, $mail_pass);








?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявка отправлена | GardenBorders</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
  <style>
    body {
        padding-top: 0;
    }
  </style>
  
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
        </div>
    </div>

    <!-- Основное содержимое -->
    <main class="container">
        <div class="success-message" style="margin: 100px auto; max-width: 600px; text-align: center;">
            <div class="success-icon" style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px;">
                <i class="fas fa-check" style="font-size: 50px; color: white;"></i>
            </div>
            
            <h1 style="color: var(--primary-green); margin-bottom: 20px;">Спасибо за заявку!</h1>
            
            <p style="font-size: 18px; color: var(--dark-gray); margin-bottom: 30px;">
                Ваша заявка на консультацию успешно отправлена. Наш специалист свяжется с вами 
                в ближайшее время для обсуждения вашего проекта.
            </p>
            
            <div class="next-steps" style="background: var(--light-green); padding: 25px; border-radius: var(--radius); margin-bottom: 40px; text-align: left;">
                <h3 style="color: var(--primary-green); margin-bottom: 15px;">
                    <i class="fas fa-info-circle"></i> Что будет дальше?
                </h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-phone" style="color: var(--primary-green); margin-top: 3px;"></i>
                        <span>В течение 30 минут с вами свяжется наш специалист</span>
                    </li>
                    <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-comments" style="color: var(--primary-green); margin-top: 3px;"></i>
                        <span>Мы обсудим ваш проект и ответим на все вопросы</span>
                    </li>
                    <li style="display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-calendar-alt" style="color: var(--primary-green); margin-top: 3px;"></i>
                        <span>Подберем оптимальное решение и согласуем сроки</span>
                    </li>
                </ul>
            </div>
            
            <div class="action-buttons" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="../index.php" class="cta-button" style="text-decoration: none;">
                    <i class="fas fa-home"></i> Вернуться на главную
                </a>
                <a href="../index.php#products" class="cta-button" style="background: linear-gradient(135deg, var(--sky-blue), #1976d2); text-decoration: none;">
                    <i class="fas fa-th-large"></i> Смотреть каталог
                </a>
            </div>
            
            <p style="margin-top: 30px; color: #666; font-size: 14px;">
                <i class="fas fa-clock"></i> Рабочее время: ежедневно с 8:00 до 21:00
                <br>
                <i class="fas fa-phone"></i> Телефон: <?php echo $contact_telefon; ?>
            </p>
        </div>
    </main>

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
                </div>
                <div class="footer-section">
                    <h4>Контакты</h4>
                    <p><i class="fas fa-phone-alt"></i><?php echo $contact_telefon; ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo $contact_email; ?></p>
                    <p><i class="fas fa-clock"></i> <?php echo $work_time; ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y');?> GardenBorders. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        // Автоматический редирект через 10 секунд
        // setTimeout(function() {
        //     window.location.href = '../index.php';
        // }, 10000);
        
        // Показываем таймер
        document.addEventListener('DOMContentLoaded', function() {
            let countdown = 10;
            const timerElement = document.createElement('p');
            timerElement.style.color = '#666';
            timerElement.style.marginTop = '15px';
            timerElement.style.fontSize = '14px';
            timerElement.innerHTML = `Автоматический переход на главную через <span id="countdown">10</span> секунд`;
            
            const successDiv = document.querySelector('.success-message');
            successDiv.appendChild(timerElement);
            
            const countdownElement = document.getElementById('countdown');
            const countdownInterval = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;
                
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                }
            }, 1000);
        });
    </script>
</body>
</html>