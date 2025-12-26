<?php


// полный адрес страницы
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/";

// Для CSS используем абсолютные URL
$TEST = "!gardenborders/";

$main_path = $base_url.$TEST ;
$EMAIL_for_letters = 'dizel007@yandex.ru';


$host="localhost";//имя  сервера
$user="root";//имя пользователя
$password=""; 
$db="gardenborders_zzz"; //имя  базы данных


// Настройка доступности способов доставки
$delivery_available = [
    'pickup' => true,     // Самовывоз - доступен
    'courier' => false,   // Курьерская доставка - недоступна
    'ozon' => false       // ОЗОН Логистика - недоступна
];


?>