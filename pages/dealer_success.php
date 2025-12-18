<?php

// dealers.php в папке pages/
session_start();

// Подключаем header.php
require_once  '../header_styles.php';

?>
  <style>
    body {
        margin-top: 0;
        padding-top:0;
    }
        .success-container {
            margin: 10px auto;
            max-width: 1200px;
            background: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
        }
        
        .success-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }
        
        .success-icon i {
            font-size: 60px;
            color: white;
        }
        
        .next-steps {
            text-align: left;
            margin-top: 40px;
            padding: 25px;
            background: var(--light-green);
            border-radius: var(--radius);
        }
        
        .next-steps h3 {
            color: var(--primary-green);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
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

    <main class="container">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-handshake"></i>
            </div>
            
            <h1 style="color: var(--primary-green); margin-bottom: 20px;">Заявка на дилерство принята!</h1>
            
            <p style="font-size: 18px; color: var(--dark-gray); margin-bottom: 20px; line-height: 1.6;">
                Благодарим за интерес к сотрудничеству с GardenBorders. 
                Ваша заявка успешно отправлена и будет обработана в течение 1-2 рабочих дней.
            </p>
            
            <p style="font-size: 16px; color: #666; margin-bottom: 30px;">
                Наш менеджер свяжется с вами по указанному телефону для обсуждения деталей 
                и согласования условий сотрудничества.
            </p>
            
            <div class="next-steps">
                <h3><i class="fas fa-tasks"></i> Что будет дальше?</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div style="background: white; padding: 15px; border-radius: var(--radius);">
                        <h4 style="color: var(--primary-green); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-phone" style="font-size: 14px;"></i>
                            Звонок менеджера
                        </h4>
                        <p style="font-size: 14px; color: #666;">В течение 24 часов с вами свяжется наш менеджер</p>
                    </div>
                    <div style="background: white; padding: 15px; border-radius: var(--radius);">
                        <h4 style="color: var(--primary-green); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-file-contract"></i>
                            Обсуждение условий
                        </h4>
                        <p style="font-size: 14px; color: #666;">Согласование условий дилерского договора</p>
                    </div>
                    <div style="background: white; padding: 15px; border-radius: var(--radius);">
                        <h4 style="color: var(--primary-green); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-graduation-cap"></i>
                            Обучение и старт
                        </h4>
                        <p style="font-size: 14px; color: #666;">Обучение продукту и начало сотрудничества</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-bottom" style="text-align: center;">
                <p>&copy; <?php echo date('Y');?> GardenBorders. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        // Автоматический редирект через 15 секунд
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 15000);
        
        // Таймер
        document.addEventListener('DOMContentLoaded', function() {
            let countdown = 15;
            const timerElement = document.createElement('p');
            timerElement.style.color = '#666';
            timerElement.style.marginTop = '20px';
            timerElement.style.fontSize = '14px';
            timerElement.innerHTML = `Автоматический переход на главную через <span id="countdown" style="font-weight: 600; color: var(--primary-green);">15</span> секунд`;
            
            document.querySelector('.success-container').appendChild(timerElement);
            
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