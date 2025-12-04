<?php

// products.php
$products = [
    // Для грядок
    [
        'id' => 1, 
        'name' => "Пластиковый садовый бордюр Кантри черный, длина 10 м, высота 110 мм", 
        'price' => 450, 
        'category' => 'classic', 
        'images' => ['bordur_classic_1.jpg', 'bordur_classic_2.jpg', 'bordur_classic_3.jpg'], // массив изображений
        'description' => 'Профилированный бордюр для аккуратных грядок', 
        'inStock' => 17, 
        'colors' => 3, 
        'badge' => 'Хит'
    ],
    [
        'id' => 2, 
        'name' => "Пластиковый садовый бордюр Кантри коричневый, длина 10 м, высота 110 мм", 
        'price' => 850, 
        'category' => 'classic', 
        'images' => ['bordur_classic_brown_1.jpg', 'bordur_classic_brown_2.jpg'], 
        'description' => 'Профилированный бордюр для аккуратных грядок', 
        'inStock' => 6, 
        'colors' => 3, 
        'badge' => null
    ],
    [
        'id' => 3, 
        'name' => "Пластиковый садовый бордюр Кантри зеленый, длина 10 м, высота 110 мм", 
        'price' => 1250, 
        'category' => 'classic', 
        'images' => ['bordur_classic_green_1.jpg', 'bordur_classic_green_2.jpg', 'bordur_classic_green_3.jpg'], 
        'description' => 'Профилированный бордюр для аккуратных грядок', 
        'inStock' => 5, 
        'colors' => 3, 
        'badge' => null
    ],
    // ... остальные товары с аналогичным добавлением массива images
    [
        'id' => 4, 
        'name' => "Бордюр Грядка-Профи с дренажем", 
        'price' => 1550, 
        'category' => 'classic', 
        'images' => ['bordur_garden_1.jpg'], 
        'description' => 'С системой дренажа и креплений', 
        'inStock' => 7, 
        'colors' => 4, 
        'badge' => 'Новинка'
    ],
    [
        'id' => 5, 
        'name' => "Бордюр Грядка-Профи угловой", 
        'price' => 650, 
        'category' => 'classic', 
        'images' => ['bordur_corner_1.jpg', 'bordur_corner_2.jpg'], 
        'description' => 'Угловой элемент для профилированного бордюра', 
        'inStock' => 6, 
        'colors' => 3, 
        'badge' => null
    ],
    
    // Для цветников
    [
        'id' => 6, 
        'name' => "Бордюр Цветник-Волна 50см", 
        'price' => 520, 
        'category' => 'wave', 
        'images' => ['bordur_wave_1.jpg', 'bordur_wave_2.jpg', 'bordur_wave_3.jpg', 'bordur_wave_4.jpg'], 
        'description' => 'Волнистый бордюр для изящных цветников', 
        'inStock' => 7, 
        'colors' => 5, 
        'badge' => null
    ],
    [
        'id' => 7, 
        'name' => "Бордюр Цветник-Волна 100см", 
        'price' => 980, 
        'category' => 'wave', 
        'images' => ['bordur_wave_large_1.jpg', 'bordur_wave_large_2.jpg'], 
        'description' => 'Волнистый бордюр для изящных цветников', 
        'inStock' => 5, 
        'colors' => 5, 
        'badge' => 'Хит'
    ],
    [
        'id' => 8, 
        'name' => "Бордюр Цветник-Волна 150см", 
        'price' => 1450, 
        'category' => 'wave', 
        'images' => ['bordur_wave_xl_1.jpg'], 
        'description' => 'Волнистый бордюр для изящных цветников', 
        'inStock' => 6, 
        'colors' => 5, 
        'badge' => null
    ],
    // ... остальные товары
];