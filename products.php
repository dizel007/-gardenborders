<?php
// Данные о товарах
$products = [
    // Для грядок
    ['id' => 1, 'name' => "Пластиковый садовый бордюр Кантри черный, длина 10 м, высота 110 мм", 'price' => 450, 'category' => 'classic', 'image' => 'fas fa-carrot', 'description' => 'Профилированный бордюр для аккуратных грядок', 'inStock' => 7, 'colors' => 3, 'badge' => 'Хит'],
    ['id' => 2, 'name' => "Пластиковый садовый бордюр Кантри коричневый, длина 10 м, высота 110 мм", 'price' => 850, 'category' => 'classic', 'image' => 'fas fa-carrot', 'description' => 'Профилированный бордюр для аккуратных грядок', 'inStock' => 6, 'colors' => 3, 'badge' => null],
    ['id' => 3, 'name' => "Пластиковый садовый бордюр Кантри зеленый, длина 10 м, высота 110 мм", 'price' => 1250, 'category' => 'classic', 'image' => 'fas fa-carrot', 'description' => 'Профилированный бордюр для аккуратных грядок', 'inStock' => 5, 'colors' => 3, 'badge' => null],
    ['id' => 4, 'name' => "Бордюр Грядка-Профи с дренажем", 'price' => 1550, 'category' => 'classic', 'image' => 'fas fa-carrot', 'description' => 'С системой дренажа и креплений', 'inStock' => 7, 'colors' => 4, 'badge' => 'Новинка'],
    ['id' => 5, 'name' => "Бордюр Грядка-Профи угловой", 'price' => 650, 'category' => 'classic', 'image' => 'fas fa-carrot', 'description' => 'Угловой элемент для профилированного бордюра', 'inStock' => 6, 'colors' => 3, 'badge' => null],
    
    // Для цветников
    ['id' => 6, 'name' => "Бордюр Цветник-Волна 50см", 'price' => 520, 'category' => 'wave', 'image' => 'fas fa-spa', 'description' => 'Волнистый бордюр для изящных цветников', 'inStock' => 7, 'colors' => 5, 'badge' => null],
    ['id' => 7, 'name' => "Бордюр Цветник-Волна 100см", 'price' => 980, 'category' => 'wave', 'image' => 'fas fa-spa', 'description' => 'Волнистый бордюр для изящных цветников', 'inStock' => 5, 'colors' => 5, 'badge' => 'Хит'],
    ['id' => 8, 'name' => "Бордюр Цветник-Волна 150см", 'price' => 1450, 'category' => 'wave', 'image' => 'fas fa-spa', 'description' => 'Волнистый бордюр для изящных цветников', 'inStock' => 6, 'colors' => 5, 'badge' => null],
    ['id' => 9, 'name' => "Бордюр Цветник-Волна двойной", 'price' => 1950, 'category' => 'wave', 'image' => 'fas fa-spa', 'description' => 'Двойной волнистый бордюр для многоуровневых клумб', 'inStock' => 5, 'colors' => 4, 'badge' => null],
    ['id' => 10, 'name' => "Бордюр Цветник-Волна угловой", 'price' => 750, 'category' => 'wave', 'image' => 'fas fa-spa', 'description' => 'Угловой элемент для волнистого бордюра', 'inStock' => 7, 'colors' => 5, 'badge' => null],
    
    // Для дорожек
    ['id' => 11, 'name' => "Бордюр Дорожка-Камень 50см", 'price' => 620, 'category' => 'stone', 'image' => 'fas fa-road', 'description' => 'Бордюр с текстурой натурального камня', 'inStock' => 6, 'colors' => 2, 'badge' => 'Хит'],
    ['id' => 12, 'name' => "Бордюр Дорожка-Камень 100см", 'price' => 1180, 'category' => 'stone', 'image' => 'fas fa-road', 'description' => 'Бордюр с текстурой натурального камня', 'inStock' => 5, 'colors' => 2, 'badge' => null],
    ['id' => 13, 'name' => "Бордюр Дорожка-Камень 150см", 'price' => 1750, 'category' => 'stone', 'image' => 'fas fa-road', 'description' => 'Бордюр с текстурой натурального камня', 'inStock' => 7, 'colors' => 2, 'badge' => null],
    ['id' => 14, 'name' => "Бордюр Дорожка-Камень декоративный", 'price' => 2100, 'category' => 'stone', 'image' => 'fas fa-road', 'description' => 'Декоративный бордюр с текстурой камня', 'inStock' => 5, 'colors' => 3, 'badge' => 'Премиум'],
    ['id' => 15, 'name' => "Бордюр Дорожка-Камень угловой", 'price' => 850, 'category' => 'stone', 'image' => 'fas fa-road', 'description' => 'Угловой элемент для бордюра под камень', 'inStock' => 6, 'colors' => 2, 'badge' => null],
    
    // Декоративные
    ['id' => 16, 'name' => "Бордюр Декоративный Рисунок 50см", 'price' => 580, 'category' => 'decor', 'image' => 'fas fa-paint-brush', 'description' => 'Декоративный бордюр с растительным орнаментом', 'inStock' => 7, 'colors' => 4, 'badge' => null],
    ['id' => 17, 'name' => "Бордюр Декоративный Рисунок 100см", 'price' => 1080, 'category' => 'decor', 'image' => 'fas fa-paint-brush', 'description' => 'Декоративный бордюр с растительным орнаментом', 'inStock' => 5, 'colors' => 4, 'badge' => 'Новинка'],
    ['id' => 18, 'name' => "Бордюр Декоративный Рисунок 150см", 'price' => 1580, 'category' => 'decor', 'image' => 'fas fa-paint-brush', 'description' => 'Декоративный бордюр с растительным орнаментом', 'inStock' => 6, 'colors' => 4, 'badge' => null],
    ['id' => 19, 'name' => "Бордюр Декоративный Ажурный", 'price' => 2350, 'category' => 'decor', 'image' => 'fas fa-paint-brush', 'description' => 'Ажурный декоративный бордюр для изысканных садов', 'inStock' => 5, 'colors' => 2, 'badge' => 'Люкс'],
    ['id' => 20, 'name' => "Бордюр Декоративный угловой", 'price' => 780, 'category' => 'decor', 'image' => 'fas fa-paint-brush', 'description' => 'Угловой элемент для декоративного бордюра', 'inStock' => 7, 'colors' => 4, 'badge' => null],
    
    // PRO серия
    ['id' => 21, 'name' => "Бордюр PRO Дизайнерский 100см", 'price' => 1450, 'category' => 'pro', 'image' => 'fas fa-gem', 'description' => 'PRO серия для профессиональных дизайнеров', 'inStock' => 4, 'colors' => 6, 'badge' => 'PRO'],
    ['id' => 22, 'name' => "Бордюр PRO Дизайнерский 150см", 'price' => 2150, 'category' => 'pro', 'image' => 'fas fa-gem', 'description' => 'PRO серия для профессиональных дизайнеров', 'inStock' => 3, 'colors' => 6, 'badge' => 'PRO'],
    ['id' => 23, 'name' => "Бордюр PRO Гибкий 5м", 'price' => 3850, 'category' => 'pro', 'image' => 'fas fa-gem', 'description' => 'Гибкий бордюр для сложных форм', 'inStock' => 5, 'colors' => 4, 'badge' => 'PRO'],
    ['id' => 24, 'name' => "Бордюр PRO С подсветкой 100см", 'price' => 2950, 'category' => 'pro', 'image' => 'fas fa-gem', 'description' => 'Бордюр со встроенной LED подсветкой', 'inStock' => 3, 'colors' => 3, 'badge' => 'PRO']
];
