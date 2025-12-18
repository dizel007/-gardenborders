<?php
// Установка часового пояса для всего приложения
ini_set('date.timezone', 'Europe/Moscow');
date_default_timezone_set('Europe/Moscow');

$host="localhost";//имя  сервера
$user="root";//имя пользователя
$password=""; 
$db="gardenborders_zzz"; //имя  базы данных


// Путь к папке с изображениями
$imagePath = "images/products/";
$defaultImage = "default.jpg";



      try {  
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $password);
        $pdo->exec('SET NAMES utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
          print "Has errors: " . $e->getMessage();  die();
        }


   
//**********************************************************************************************
// Доставем все товары из БД
//**********************************************************************************************/

    $stmt = $pdo->prepare("SELECT * FROM stocks");
    $stmt->execute([]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Делаем ID числом  для JS а то оно не находит товар по ID
foreach ($products as &$one_product) {
        $one_product['id'] = (int)$one_product['id'];
      //  $one_product['images'] = ['krokus55_1.jpg', 'krokus55_2.jpg', 'krokus55_3.jpg'];
   }

//**********************************************************************************************
// Достаем зарезервированные товары  ЖДо этого удаляем старые записи
//**********************************************************************************************/
// Удаляем все старше двух дней *****************************************************
    $stmt = $pdo->prepare("
        DELETE FROM reserv_stocks 
        WHERE `reserve_time` < DATE_SUB(NOW(), INTERVAL 2 DAY)
    ");
    $stmt->execute();

/// вычитываем резервы 
    $dateTimeNow = date('Y-m-d H:i:s');
    $stmt = $pdo->prepare("SELECT * FROM reserv_stocks 
                           WHERE CAST(`reserve_time` AS DATETIME) > CAST(:dateTimeNow AS DATETIME)");    
    $stmt->execute([':dateTimeNow' => $dateTimeNow]);
    $reserev_Stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($reserev_Stocks as $one_stock) {
  $reserev_Article[$one_stock['article']] = @$reserev_Article[$one_stock['article']] + $one_stock['quantity'];
}


// echo "<pre>";
// print_r($reserev_Stocks);

// die();
//**********************************************************************************************
// Формируем остатки без учета зарезервированных товаров
//**********************************************************************************************/
if (isset($reserev_Article)) {
  foreach ($products as &$one_product) {
    foreach ($reserev_Article as $key=>$reserev_quantity) {
      if ($one_product['article'] == $key) {
        $one_product['inStock'] = $one_product['inStock'] - $reserev_quantity;
        break;
      }
    } 
  }
}
// echo "<pre>";
// print_r($reserev_Article);
// die();
//**********************************************************************************************
// Доставем название картинок к товарам из БД
//**********************************************************************************************/
    $stmt = $pdo->prepare("SELECT * FROM article_images");
    $stmt->execute([]);
    $article_images = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Делаем ID числом  для JS а то оно не находит товар по ID
foreach ($products as &$one_product) {
  foreach ($article_images as $i_item) {
    if ($i_item['article'] == $one_product['article'])
      $one_product['images'][] = $i_item['image'];
  }
        
      
   }
    // echo "<pre>";
    // print_r($products);
    // die();

//**********************************************************************************************
// Создаем массив категорий из товаров
//**********************************************************************************************

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

//**********************************************************************************************
// Находим выбпраннную категорию после смены категории
//**********************************************************************************************

$category = $_GET['category'] ?? 'all';
$filteredProducts = $category === 'all' ? $products : array_filter($products, 
    function($product) use ($category) {
        return $product['category_eng'] === $category;
    });

  
//**********************************************************************************************
// Функция для проверки существования изображения
//**********************************************************************************************

function getProductImage($imageName, $defaultImage, $imagePath) {
    $fullPath = $imagePath . $imageName;
    if (file_exists($fullPath)) {
        return $fullPath;
    }
    return $imagePath . $defaultImage;
}
?>