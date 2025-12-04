<?php
// includes/database.php
class ProductDatabase {
    private static $stockFile = 'data/stock.json';
    private static $ordersFile = 'data/orders.json';
    
    // Получение информации о товаре по ID
    public static function getProductById($id) {
        require_once __DIR__ . '/../products.php';
        global $products;
        
        foreach ($products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        return null;
    }
    
    // Получение текущего количества на складе (из оригинального массива)
    public static function getStockQuantity($productId) {
        $product = self::getProductById($productId);
        return $product ? $product['inStock'] : 0;
    }
    
    // Проверка доступности товара
    public static function checkAvailability($productId, $quantity) {
        $currentStock = self::getStockQuantity($productId);
        return $currentStock >= $quantity;
    }
    
    // Резервирование товара (уменьшение остатка в stock.json)
    public static function reserveProduct($productId, $quantity) {
        $stock = self::getStockData();
        
        // Если товара нет в stock.json, используем оригинальное значение
        if (!isset($stock[$productId])) {
            $product = self::getProductById($productId);
            $stock[$productId] = $product ? $product['inStock'] : 0;
        }
        
        if ($stock[$productId] < $quantity) {
            return false;
        }
        
        $stock[$productId] -= $quantity;
        return self::saveStockData($stock);
    }
    
    // Отмена резервирования
    public static function cancelReservation($productId, $quantity) {
        $stock = self::getStockData();
        
        if (!isset($stock[$productId])) {
            $product = self::getProductById($productId);
            $stock[$productId] = $product ? $product['inStock'] : 0;
        }
        
        $stock[$productId] += $quantity;
        return self::saveStockData($stock);
    }
    
    // Получение данных о складе из файла
    private static function getStockData() {
        if (!file_exists(self::$stockFile)) {
            // Создаем начальные данные из products.php
            require_once __DIR__ . '/../products.php';
            global $products;
            
            $stock = [];
            foreach ($products as $product) {
                $stock[$product['id']] = $product['inStock'];
            }
            self::saveStockData($stock);
            return $stock;
        }
        
        $json = file_get_contents(self::$stockFile);
        $data = json_decode($json, true);
        return $data ?: [];
    }
    
    // Сохранение данных о складе
    private static function saveStockData($stock) {
        $json = json_encode($stock, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $dir = dirname(self::$stockFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return file_put_contents(self::$stockFile, $json) !== false;
    }
    
    // Сохранение заказа
    public static function saveOrder($orderData) {
        // Загружаем существующие заказы
        $orders = [];
        if (file_exists(self::$ordersFile)) {
            $json = file_get_contents(self::$ordersFile);
            $orders = json_decode($json, true) ?: [];
        }
        
        // Добавляем новый заказ
        $orders[] = $orderData;
        
        // Сохраняем
        $dir = dirname(self::$ordersFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        $json = json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents(self::$ordersFile, $json) !== false;
    }
}