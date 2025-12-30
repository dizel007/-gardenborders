<?php


// полный адрес страницы
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/";

// Для CSS используем абсолютные URL
$TEST = "!gardenborders/";

$main_path = $base_url.$TEST ;
$EMAIL_for_letters = 'dizel007@yandex.ru';


$host = "localhost";//имя  сервера
$user = "root";//имя пользователя
$password = ""; 
$db = "gardenborders_zzz"; //имя  базы данных


// Настройка доступности способов доставки
$delivery_available = [
    'pickup' => true,     // Самовывоз - доступен
    'courier' => false,   // Курьерская доставка - недоступна
    'ozon' => false       // ОЗОН Логистика - недоступна
];

      try {  
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
        $pdo->exec('SET NAMES utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
          print "Has errors: " . $e->getMessage();  die();
        }

        
//********************************************************************************************************* */
// НАстройки для СМС отпраки
//********************************************************************************************************* */


// Настройки SMS сервиса (пример для sms.ru)
define('SMS_API_KEY', '97A4F9C2-57EF-FA84-85E4-1B07CAB3409F');
define('SMS_SENDER', 'GardenBorders');
define('SMS_TEST_MODE', true); // true - тестовый режим

// Настройки безопасности
define('CODE_LENGTH', 6);
define('CODE_LIFETIME', 300); // 5 минут в секундах
define('MAX_ATTEMPTS', 3);

?>