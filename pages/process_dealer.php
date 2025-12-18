<?php
require_once "../config.php";
require_once "../_no_git/secret_info.php";  
require_once "../mailer/send_mail.php";



// process_dealer.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Собираем данные
    $data = [
        'full_name' => htmlspecialchars(trim($_POST['full_name'] ?? '')),
        'phone' => htmlspecialchars(trim($_POST['phone'] ?? '')),
        'email' => htmlspecialchars(trim($_POST['email'] ?? '')),
        'city' => htmlspecialchars(trim($_POST['city'] ?? '')),
        'company' => htmlspecialchars(trim($_POST['company'] ?? '')),
        'experience' => htmlspecialchars(trim($_POST['experience'] ?? '')),
        'has_store' => htmlspecialchars(trim($_POST['has_store'] ?? '')),
        'volume' => htmlspecialchars(trim($_POST['volume'] ?? '')),
        'message' => htmlspecialchars(trim($_POST['message'] ?? '')),
        'consent' => isset($_POST['consent']) ? 'Да' : 'Нет',
        'date' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR']
    ];
    
    // Проверяем согласие
    if (!isset($_POST['consent'])) {
        header('Location: dealers.php?error=consent_required');
        exit;
    }
    
    // Сохраняем заявку (можно в файл или БД)
    $filename = 'dealer_applications/' . date('Y-m-d') . '_' . uniqid() . '.txt';
    
    // Создаем директорию если нет
    if (!is_dir('dealer_applications')) {
        mkdir('dealer_applications', 0755, true);
    }
    
    // Формируем содержимое
    $content = "=== ЗАЯВКА НА ДИЛЕРСТВО ===\n\n";
    foreach ($data as $key => $value) {
        $label = [
            'full_name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'city' => 'Город',
            'company' => 'Компания',
            'experience' => 'Опыт работы',
            'has_store' => 'Торговая точка',
            'volume' => 'Объем закупок',
            'message' => 'Доп. информация',
            'consent' => 'Согласие на обработку',
            'date' => 'Дата отправки',
            'ip' => 'IP адрес'
        ][$key] ?? $key;
        
        $content .= "$label: $value\n";
    }
    
    file_put_contents($filename, $content);
    
    // Отправляем email (опционально)
send_many_emails($EMAIL_for_letters, 'Запрос дилерства',  $content, $mail_for_send_letter, $mail_pass);

    // Редирект на страницу успеха
    header('Location: dealer_success.php');
    exit;
} else {
    header('Location: dealers.php');
    exit;
}