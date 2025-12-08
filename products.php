<?php

// products.php
$products = [
    // Для грядок
    [
        'id' => 1, 
        'name' => "Бордюр садовый пластиковый Длина 10 метров высота 38 мм + 30 якорей", 
        'article' => '6210', 
        'price' => 1000, 
        'category' => 'КРОКУС', 
        'category_eng' => 'crokus', 
        'images' => ['krokus38_1.jpg', 'krokus38_2.jpg', 'krokus38_3.jpg'], // массив изображений
        'description' => 'Профилированный бордюр для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 1, 
        'badge' => 'Хит'
    ],
    [
        'id' => 2, 
        'name' => "пластиковый бордюр садовый черный КРОКУС L10000 Н55+30 якорей", 
        'article' => '6211', 
        'price' => 1100, 
        'category' => 'КРОКУС',
        'category_eng' => 'crokus',  
        'images' => ['krokus55_1.jpg', 'krokus55_2.jpg', 'krokus55_3.jpg'], // массив изображений
        'description' => 'Профилированный бордюр для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 1, 
        'badge' => 'Хит'
    ],

/********************************************************************************************************/ 
//  кантри мини
/********************************************************************************************************/ 

    [
        'id' => 4, 
        'name' => "Пластиковый садовый бордюр Кантри черный, длина 10 м, высота 80 мм", 
        'article' => '82400-ч', 
        'price' => 700, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry',  
        'images' => ['cantry_80_black_1.jpg', 'krokus38_1.jpg', 
                     'cantry_80_black_1.jpg', 'cantry_80_black_2.jpg', 'krokus38_1.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

    [
        'id' => 5, 
        'name' => "Пластиковый садовый бордюр Кантри коричневый, длина 10 м, высота 80 мм", 
        'article' => '82400-к', 
        'price' => 800, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_80_brown_1.jpg', 'cantry_80_brown_2.jpg', 'cantry_80_brown_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 4, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

    [
        'id' => 6, 
        'name' => "Пластиковый садовый бордюр Кантри зеленый, длина 10 м, высота 80 мм", 
        'article' => '82400-з', 
        'price' => 800, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_80_green_1.jpg', 'cantry_80_green_2.jpg', 'cantry_80_green_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 3, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

/********************************************************************************************************/ 
//  кантри стандарт 
/********************************************************************************************************/ 
    [
        'id' => 14, 
        'name' => "Пластиковый садовый бордюр Кантри черный, длина 10 м, высота 110 мм", 
        'article' => '82401-ч', 
        'price' => 900, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_110_black_1.jpg', 'cantry_110_black_2.jpg', 'cantry_110_black_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

    [
        'id' => 15, 
        'name' => "Пластиковый садовый бордюр Кантри коричневый, длина 10 м, высота 110 мм", 
        'article' => '82401-к', 
        'price' => 950, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_110_brown_1.jpg', 'cantry_110_brown_2.jpg', 'cantry_110_brown_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 4, 
        'colors' => 1, 
        'badge' => 'ХИТ'
    ],

    [
        'id' => 16, 
        'name' => "Пластиковый садовый бордюр Кантри зеленый, длина 10 м, высота 110 мм", 
        'article' => '82401-з', 
        'price' => 950, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_110_green_1.jpg', 'cantry_110_green_2.jpg', 'cantry_110_green_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 3, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

    
/********************************************************************************************************/ 
//  кантри МАКСИ 
/********************************************************************************************************/ 
    [
        'id' => 24, 
        'name' => "Пластиковый садовый бордюр Кантри черный, длина 10 м, высота 140 мм", 
        'article' => '82402-ч', 
        'price' => 1500, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_140_black_1.jpg', 'cantry_140_black_2.jpg', 'cantry_140_black_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

    [
        'id' => 25, 
        'name' => "Пластиковый садовый бордюр Кантри коричневый, длина 10 м, высота 140 мм", 
        'article' => '82402-к', 
        'price' => 1650, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_140_brown_1.jpg', 'cantry_140_brown_2.jpg', 'cantry_140_brown_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 4, 
        'colors' => 1, 
        'badge' => 'ХИТ'
    ],

    [
        'id' => 26, 
        'name' => "Пластиковый садовый бордюр Кантри зеленый, длина 10 м, высота 140 мм", 
        'article' => '82402-з', 
        'price' => 1650, 
        'category' => 'КАНТРИ',
        'category_eng' => 'kantry', 
        'images' => ['cantry_140_green_1.jpg', 'cantry_140_green_2.jpg', 'cantry_140_green_3.jpg'], // массив изображений
        'description' => 'Садовая бордюрная лента для аккуратных грядок', 
        'inStock' => 3, 
        'colors' => 1, 
        'badge' => 'новинка'
    ],

];





// Путь к папке с изображениями
$imagePath = "images/products/";
$defaultImage = "default.jpg";

// Функция для проверки существования изображения
function getProductImage($imageName, $defaultImage, $imagePath) {
    $fullPath = $imagePath . $imageName;
    if (file_exists($fullPath)) {
        return $fullPath;
    }
    return $imagePath . $defaultImage;
}

// Создаем массив категорий из товаров
    if (isset($products)) {
        $i=0;
        foreach ($products as $product) {
          $categories[$product['category']] = $product['category_eng'];
          $i++;
        }
    } else {
      $categories[] = 'Все бордюры';
    }
     $categories = array_unique($categories);

// Находим выбпраннную категорию после смены категории
$category = $_GET['category'] ?? 'all';
$filteredProducts = $category === 'all' ? $products : array_filter($products, 
    function($product) use ($category) {
        return $product['category_eng'] === $category;
    });

   
?>