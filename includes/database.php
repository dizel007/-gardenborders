<?php
// includes/database.php
class ProductDatabase {
    private static $ordersFile = 'data/orders/';
    
    // Сохранение заказа
    public static function saveOrder($orderData) {
       // Добавляем новый заказ
        $orders[] = $orderData;
        $filePath = self::$ordersFile.$orderData['order_number'].".json";
        // Сохраняем
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        $json = json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return file_put_contents($filePath, $json) !== false;
    }
}