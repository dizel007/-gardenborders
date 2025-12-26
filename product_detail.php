<?php
// product-detail.php
session_start();
require_once "config.php";
require_once "products.php";


// Получаем ID товара из URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Получаем товар из БД
$product = null;
foreach ($products as $prod) {
    if ($prod['id'] === $productId) {
        $currentProduct = $prod;
        break;
    }
}

// Если товар не найден - перенаправляем на главную
if (!$currentProduct) {
    header('Location: index.php');
    exit();
}


// Получаем товары из той же категории (макс 4)
//**********************************************************************************************
// Находим выбпраннную категорию после смены категории и фильтруем товары для вывода
//**********************************************************************************************

$category_related = $currentProduct['category_eng'];
$relatedProducts_temp = array_filter($products, function($product) use ($category_related) {
        return $product['category_eng'] === $category_related;
    });

$limit = 4; // количество выводимых товаров

// Выбираем либо все элементы, либо случайные 4
if (count($relatedProducts_temp) <= $limit) {
    $relatedProducts = $relatedProducts_temp; // выбираем все
} else {
    shuffle($relatedProducts_temp);
    $relatedProducts = array_slice($relatedProducts_temp, 0, $limit);
}


require_once "header.php";

// Функция для названия категории

?>

<!-- Основной контент -->
<link rel="stylesheet" href="<?php echo $main_path;?>styles/produts_detail.css">

<main class="container">
    <!-- Хлебные крошки -->
    <div class="breadcrumbs">
        <a href="index.php"><i class="fas fa-home"></i> Главная</a>
        <span><i class="fas fa-chevron-right"></i></span>
        <a href="index.php?category=<?php echo $currentProduct['category_eng']."#products"; ?>">
            <?php echo ($currentProduct['category']); ?>
        </a>
        <span><i class="fas fa-chevron-right"></i></span>
        <span class="current"><?php echo htmlspecialchars($currentProduct['name']); ?></span>
    </div>

        <div class="product-detail-container">
            <!-- Галерея изображений -->
            <div class="product-gallery">
                <!-- Основное изображение -->
                <div class="main-image-container">
                    <?php if (!empty($currentProduct['images'])): ?>
                        <img src="images/products/<?php echo $currentProduct['images'][0]; ?>" 
                             alt="<?php echo htmlspecialchars($currentProduct['name']); ?>" 
                             id="mainProductImage"
                             class="main-product-image"
                             onerror="this.onerror=null; this.src='images/products/default.jpg';">
                    <?php else: ?>
                        <div class="default-image-large">
                            <i class="fas fa-box"></i>
                            <p>Изображение товара</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Миниатюры -->
                <?php if (!empty($currentProduct['images']) && count($currentProduct['images']) > 1): ?>
                <div class="image-thumbnails">
                    <?php foreach ($currentProduct['images'] as $index => $image): ?>
                        <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" 
                             onmouseover="changeProductImage_detail_product(<?php echo $index; ?>, 'images/products/<?php echo $image; ?>')">
                            <img src="images/products/<?php echo $image; ?>" 
                                 alt="<?php echo htmlspecialchars($currentProduct['name']); ?> - фото <?php echo $index + 1; ?>"
                                 onerror="this.onerror=null; this.src='images/products/default.jpg';">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Информация о товаре -->
            <div class="product-info-detail">
                <h1 class="product-title-detail"><?php echo htmlspecialchars($currentProduct['name']); ?></h1>
                
                <?php if ($currentProduct['category']): ?>
                <div class="product-category-detail">
                    <i class="fas fa-tag"></i>
                    <?php echo htmlspecialchars($currentProduct['category']); ?>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($currentProduct['article'])): ?>
                <div class="product-article">
                    <span>Артикул:</span>
                    <strong><?php echo htmlspecialchars($currentProduct['article']); ?></strong>
                </div>
                <?php endif; ?>
                
                <!-- Цена и наличие -->
                <div class="product-price-section">
                    <div class="price-detail">
                        <span class="current-price"><?php echo number_format($currentProduct['price'], 0, '', ' '); ?> ₽</span>
                    <!-- </div>
                    
                    <div class="stock-status"> -->
                        <?php if ($currentProduct['inStock'] > 0): ?>
                            <span class="in-stock">
                                <i class="fas fa-check-circle"></i>
                                В наличии
                            </span>
                            <?php if ($currentProduct['inStock'] < 10): ?>
                                <span class="stock-count">(осталось <?php echo $currentProduct['inStock']; ?> шт.)</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="out-of-stock">
                                <i class="fas fa-times-circle"></i>
                                Нет в наличии
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Описание -->
                <?php if (!empty($currentProduct['description'])): ?>
                <div class="product-description-detail">
                    <h3>Описание</h3>
                    <p><?php echo nl2br(htmlspecialchars($currentProduct['description'])); ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Характеристики -->
                <?php if (!empty($currentProduct['length']) || !empty($currentProduct['width']) || !empty($currentProduct['height'])): ?>
                <div class="product-characteristics">
                    <h3>Характеристики</h3>
                    <ul>
                        <?php if (!empty($currentProduct['length'])): ?>
                            <li>
                                <span class="char-name">Длина:</span>
                                <span class="char-value"><?php echo htmlspecialchars($currentProduct['length']); ?> см</span>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($currentProduct['width'])): ?>
                            <li>
                                <span class="char-name">Ширина:</span>
                                <span class="char-value"><?php echo htmlspecialchars($currentProduct['width']); ?> см</span>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($currentProduct['height'])): ?>
                            <li>
                                <span class="char-name">Высота:</span>
                                <span class="char-value"><?php echo htmlspecialchars($currentProduct['height']); ?> см</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <!-- Добавление в корзину -->
                <div class="product-actions">
                         <button class="add-to-cart" 
                                onclick="addToCart(<?php echo $productId; ?>, event)" 
                                <?php echo $currentProduct['inStock'] === 0 ? 'disabled' : ''; ?>>
                            <i class="fas fa-cart-plus"></i> 
                            <?php echo $currentProduct['inStock'] === 0 ? 'Нет в наличии' : 'Добавить в корзину'; ?>
                        </button>
                </div>
                
                <!-- Информация о доставке -->
                <div class="product-features-detail">
                    <div class="feature">
                        <i class="fas fa-truck"></i>
                        <span>Доставка по всей России</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <span>Гарантия 10 лет</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Официальный производитель</span>
                    </div>
                </div>
            </div>
        </div>

    <!-- Похожие товары -->

<?php if (!empty($relatedProducts)): ?>
     <div class="container">
        <div class="products-grid">
            <?php foreach ($relatedProducts as $product): ?>
                <div class="product-card" data-category="<?php echo $product['category']; ?>" data-id="<?php echo $product['id']; ?>">
                    <?php if ($product['badge']): ?>
                        <div class="product-badge <?php echo $product['badge'] === 'PRO' ? 'pro' : ''; ?>">
                            <?php echo $product['badge']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Изображение товара -->
                    <div class="product-image">
                        <?php if (!empty($product['images']) && is_array($product['images'])): ?>
                            <img src="<?php echo getProductImage($product['images'][0] ?? '', $defaultImage, $imagePath); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="main-product-image"
                                 data-product-id="<?php echo $product['id']; ?>"
                                 onerror="this.onerror=null; this.src='<?php echo $imagePath . $defaultImage; ?>';">
                        <?php else: ?>
                            <img src="<?php echo $imagePath . $defaultImage; ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 class="main-product-image"
                                 data-product-id="<?php echo $product['id']; ?>">
                        <?php endif; ?>
                        
                        <!-- Навигация по изображениям -->
                        <?php if (!empty($product['images']) && is_array($product['images']) && count($product['images']) > 1): ?>
                            <div class="image-navigation" data-product-id="<?php echo $product['id']; ?>">
                                <?php foreach ($product['images'] as $index => $image): ?>
                                    <button class="image-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                                            data-index="<?php echo $index; ?>"
                                            data-image="<?php echo getProductImage($image, $defaultImage, $imagePath); ?>"
                                            onmouseover="changeProductImage(<?php echo $product['id']; ?>, <?php echo $index; ?>, '<?php echo getProductImage($image, $defaultImage, $imagePath); ?>')">
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-info">
                        <!-- Цена и остаток товара (сразу под изображением) -->
                        <div class="product-meta-top">
                            <div class="product-price"><?php echo number_format($product['price'], 0, '', ' '); ?> ₽</div>
                            <div class="product-stock">
                                <i class="fas fa-<?php echo $product['inStock'] > 0 ? 'check-circle' : 'times-circle'; ?>"></i>
                                <span class="stock-<?php 
                                    if ($product['inStock'] === 0) echo 'low';
                                    elseif ($product['inStock'] <= 3) echo 'medium';
                                    else echo 'high';
                                ?>">
                                    <?php 
                                    if ($product['inStock'] === 0) {
                                        echo 'Нет в наличии';
                                    } elseif ($product['inStock'] <= 3) {
                                        echo "Осталось {$product['inStock']} шт.";
                                    } else {
                                        echo "В наличии: {$product['inStock']} шт.";
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Название товара -->
                        <div class="product-title-wrapper">
                            <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="product-title-link">
                                <div class="product-title"><?php echo htmlspecialchars($product['name']); ?></div>
                            </a>
             
                        </div>
                        
             
                        
                        <!-- Кнопка "Добавить в корзину" (в самом низу) -->
                        <button class="add-to-cart" 
                                onclick="addToCart(<?php echo $product['id']; ?>, event)" 
                                <?php echo $product['inStock'] === 0 ? 'disabled' : ''; ?>>
                            <i class="fas fa-cart-plus"></i> 
                            <?php echo $product['inStock'] === 0 ? 'Нет в наличии' : 'Добавить в корзину'; ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>





</div>

   <?php endif; ?>

</main>











<!-- JavaScript -->
<script>

// Функция смены изображения
function changeProductImage_detail_product(index, imagePath) {
    const mainImage = document.getElementById('mainProductImage');
    if (!mainImage) return;
    
    // Проверяем изображение перед загрузкой
    const img = new Image();
    img.onload = function() {
        mainImage.src = imagePath;
        
        // Обновляем активную миниатюру
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        if (thumbnails[index]) {
            thumbnails[index].classList.add('active');
        }
    };
    img.onerror = function() {
        mainImage.src = 'images/products/default.jpg';
    };
    img.src = imagePath;
}




// Делаем функции глобальными
window.changeProductImage_detail_product = changeProductImage_detail_product;


// Обработка ввода количества
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('productQuantity');
    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value) || 1;
            const maxStock = currentProduct.inStock;
            
            if (value < 1) value = 1;
            if (value > maxStock) value = maxStock;
            
            this.value = value;
        });
    }
});
</script>


<script src="js/catalog.js"></script>
<?php require_once "footer.php"; ?>