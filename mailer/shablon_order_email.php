<?php
// $orderData = array(
//     'customer' => array(
//         'full_name' => 'Петручиио',
//         'phone' => '+7 (999) 999-99-99',
//         'email' => 'dizel003337@yandex.ru'
//     ),
//     'delivery' => array(
//         'method' => 'pickup',
//         'address' => '',
//     ),
//     'payment' => array(
//         'method' => 'cash'
//     ),
//     'comment' => '', 
//     'cart_items' => array(
//         array(
//             'id' => '1',
//             'name' => 'Бордюр садовый пластиковый Длина 10 метров высота 38 мм + 30 якорей',
//             'price' => '1000',
//             'image' => '6210_1.jpg',
//             'category' => 'КРОКУС',
//             'quantity' => '1',
//             'article' => '6210',
//             'total' => '3333'
//         ),
//         array(
//             'id' => '2',
//             'name' => 'Пластиковый бордюр садовый черный КРОКУС L10000 Н55 + 30 якорей',
//             'price' => '1200',
//             'image' => '6211_1.jpg',
//             'category' => 'КРОКУС',
//             'quantity' => '1',
//             'article' => '6211',
//             'total' => '3333'
//         )
//     ),
//     'total_amount' => 2800,
//     'order_date' => '2025-12-30 15:37:24',
//     'order_number' => 'GB-20251230-5790'
// );

// Преобразуем данные для совместимости
$order_data = [
    'order_number' => $orderData['order_number'],
    'order_date' => $orderData['order_date'],
    'customer_name' => $orderData['customer']['full_name'],
    'customer_phone' => $orderData['customer']['phone'],
    'customer_email' => $orderData['customer']['email'],
    'items' => $orderData['cart_items'],
    'subtotal' => 95460, // Это нужно будет рассчитать правильно
    'delivery_cost' => 500,
    'total_amount' => $orderData['total_amount'],
    'delivery_type' => ($orderData['delivery']['method'] == 'pickup') ? 'Самовывоз' : 'Курьером',
    'delivery_address' => $orderData['delivery']['address'] ?: 'Самовывоз',
    'delivery_date' => '15.12.2023',
    'delivery_time' => '14:00 - 18:00',
    'payment_type' => ($orderData['payment']['method'] == 'cash') ? 'Наличными' : 'Картой онлайн',
    'payment_status' => ($orderData['payment']['method'] == 'cash') ? 'Ожидает оплаты' : 'Оплачено',
    'customer_comment' => $orderData['comment'],
    'promo_code' => 'WINTER10',
    'discount' => 1000
];

// Начинаем запись в переменную $content
$content = '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ №' . htmlspecialchars($order_data['order_number']) . '</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .email-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .order-number {
            font-size: 24px;
            font-weight: 600;
            margin: 15px 0;
        }
        
        .order-date {
            opacity: 0.9;
            font-size: 14px;
        }
        
        .content {
            padding: 30px;
        }
        
        .section {
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        
        .section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            color: #2e7d32;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2e7d32;
        }
        
        .customer-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        
        .info-item {
            margin-bottom: 10px;
        }
        
        .info-label {
            font-weight: 600;
            color: #666;
            display: block;
            font-size: 14px;
        }
        
        .info-value {
            font-size: 16px;
            margin-top: 5px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .items-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .items-table tr:last-child td {
            border-bottom: none;
        }
        
        .item-name {
            font-weight: 500;
        }
        
        .item-price {
            text-align: right;
        }
        
        .totals {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }
        
        .comment-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            font-style: italic;
            border-left: 4px solid #2e7d32;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background: #28a745;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        
        .contact-info {
            margin-top: 10px;
            font-size: 13px;
        }
        
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #2e7d32;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: 500;
        }
        
        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }
            
            .customer-info {
                grid-template-columns: 1fr;
            }
            
            .items-table {
                font-size: 14px;
            }
            
            .items-table th,
            .items-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Шапка письма -->
        <div class="header">
            <div class="logo">✨ GardenBorders</div>
            <h1>Спасибо за ваш заказ!</h1>
            <div class="order-number">Заказ № ' . htmlspecialchars($order_data['order_number']) . '</div>
            <div class="order-date">' . htmlspecialchars($order_data['order_date']) . '</div>
        </div>
        
        <!-- Основное содержимое -->
        <div class="content">
            <!-- Информация о покупателе -->
            <div class="section">
                <h2 class="section-title">📋 Информация о покупателе</h2>
                <div class="customer-info">
                    <div class="info-item">
                        <span class="info-label">ФИО:</span>
                        <div class="info-value">' . htmlspecialchars($order_data['customer_name']) . '</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Телефон:</span>
                        <div class="info-value">' . htmlspecialchars($order_data['customer_phone']) . '</div>
                    </div>
                </div>
            </div>
            
            <!-- Состав заказа -->
            <div class="section">
                <h2 class="section-title">🛒 Состав заказа</h2>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Сумма</th>
                        </tr>
                    </thead>
                    <tbody>';

// Добавляем товары в таблицу
foreach ($order_data['items'] as $item) {
    $content .= '
                        <tr>
                            <td class="item-name">' . htmlspecialchars($item['name']) . '</td>
                            <td>' . $item['quantity'] . ' шт.</td>
                            <td class="item-price">' . number_format($item['price'], 0, ',', ' ') . ' ₽</td>
                            <td class="item-price">' . number_format($item['total'], 0, ',', ' ') . ' ₽</td>
                        </tr>';
}

$content .= '
                    </tbody>
                </table>
                
                <!-- Итоги -->
                <div class="totals">';

// Добавляем промокод если есть
if (isset($order_data['promo_code'])) {
    $content .= '
                    <div class="total-row">
                        <span>Промокод "' . htmlspecialchars($order_data['promo_code']) . '":</span>
                        <span>-' . number_format($order_data['discount'], 0, ',', ' ') . ' ₽</span>
                    </div>';
}

$content .= '
                    <div class="total-row">
                        <span>Сумма товаров:</span>
                        <span>' . number_format($order_data['subtotal'], 0, ',', ' ') . ' ₽</span>
                    </div>
                    
                    <div class="total-row">
                        <span>Доставка (' . htmlspecialchars($order_data['delivery_type']) . '):</span>
                        <span>' . number_format($order_data['delivery_cost'], 0, ',', ' ') . ' ₽</span>
                    </div>
                    
                    <div class="total-row">
                        <span>Итого к оплате:</span>
                        <span>' . number_format($order_data['total_amount'], 0, ',', ' ') . ' ₽</span>
                    </div>
                </div>
            </div>
            
            <!-- Доставка и оплата -->
            <div class="section">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <!-- Доставка -->
                    <div>
                        <h2 class="section-title">🚚 Доставка</h2>
                        <div class="info-item">
                            <span class="info-label">Способ:</span>
                            <div class="info-value">' . htmlspecialchars($order_data['delivery_type']) . '</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Адрес:</span>
                            <div class="info-value">' . nl2br(htmlspecialchars($order_data['delivery_address'])) . '</div>
                        </div>';

// Добавляем дату и время доставки если есть
if (isset($order_data['delivery_date'])) {
    $content .= '
                        <div class="info-item">
                            <span class="info-label">Дата доставки:</span>
                            <div class="info-value">' . htmlspecialchars($order_data['delivery_date']) . '</div>
                        </div>';
}

if (isset($order_data['delivery_time'])) {
    $content .= '
                        <div class="info-item">
                            <span class="info-label">Временной интервал:</span>
                            <div class="info-value">' . htmlspecialchars($order_data['delivery_time']) . '</div>
                        </div>';
}

$content .= '
                    </div>
                    
                    <!-- Оплата -->
                    <div>
                        <h2 class="section-title">💳 Оплата</h2>
                        <div class="info-item">
                            <span class="info-label">Способ оплаты:</span>
                            <div class="info-value">' . htmlspecialchars($order_data['payment_type']) . '</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Статус оплаты:</span>
                            <div class="info-value">
                                <span class="status-badge">' . htmlspecialchars($order_data['payment_status']) . '</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

// Добавляем комментарий если есть
if (!empty($order_data['customer_comment'])) {
    $content .= '
            <!-- Комментарий -->
            <div class="section">
                <h2 class="section-title">💬 Комментарий к заказу</h2>
                <div class="comment-box">
                    ' . nl2br(htmlspecialchars($order_data['customer_comment'])) . '
                </div>
            </div>';
}

$content .= '
        </div>
        
        <!-- Подвал -->
        <div class="footer">
            <p>© ' . date('Y') . ' GardenBorders. Все права защищены.</p>
            <div class="contact-info">
                <p>Телефон: +7 (800) 123-45-67</p>
                <p>Email: support@gardenborders.ru</p>
                <p>Сайт: <a href="https://gardenborders.ru" style="color: #667eea;">gardenborders.ru</a></p>
            </div>
        </div>
    </div>
</body>
</html>';

// Теперь переменная $content содержит весь HTML код
// Вы можете использовать её для отправки письма:
// echo $content; // Для тестирования

// Пример отправки письма:
/*
$to = $order_data['customer_email'];
$subject = "Заказ №" . $order_data['order_number'] . " оформлен";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: GardenBorders <noreply@gardenborders.ru>\r\n";

if (mail($to, $subject, $content, $headers)) {
    echo "Письмо отправлено успешно!";
} else {
    echo "Ошибка отправки письма!";
}
*/
?>

<?php
// Для тестирования можно вывести содержимое переменной
// echo $content;
?>