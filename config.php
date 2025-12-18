<?php


// полный адрес страницы
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host . "/";

// Для CSS используем абсолютные URL
$TEST = "!gardenborders/";

$main_path = $base_url.$TEST ;
$EMAIL_for_letters = 'dizel007@yandex.ru';


?>