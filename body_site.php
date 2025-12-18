
<?php 
// body_site.php




?>


    <div class="container">
        <!-- Заголовок -->
        <div class="section-header" style="margin-top: 60px;">
            <h2><i class="fas fa-th-large"></i> Каталог бордюров</h2>
            <p class="section-subtitle">Выберите идеальное решение для вашего сада</p>
        </div>

        <!-- Фильтры -->
        <div class="category-filter">
            <a href="?category=all#products" class="filter-btn <?php echo $category === 'all' ? 'active' : ''; ?>">
                Все бордюры
            </a>


        <?php 

        foreach ($categories as $name_category=>$category_eng)
            echo "<a href=\"?category={$category_eng}#products\" class=\"filter-btn 
        <?php echo $category_eng === '{$category_eng}' ? 'active' : ''; ?>\">".$name_category."</a>";
        ?>
                   </div>

        <!-- Сообщение если товаров нет -->
        <?php if (empty($filteredProducts)): ?>
            <div class="no-products">
                <i class="fas fa-search"></i>
                <h3>Товары не найдены</h3>
                <p>Попробуйте выбрать другую категорию</p>
            </div>
        <?php endif; ?>

        <!-- Сетка товаров -->
        <div class="products-grid">
            <?php foreach ($filteredProducts as $product): ?>
                <div class="product-card" data-category="<?php echo $product['category']; ?>" data-id="<?php echo $product['id']; ?>">
                    <?php if ($product['badge']): ?>
                        <div class="product-badge <?php echo $product['badge'] === 'PRO' ? 'pro' : ''; ?>">
                            <?php echo $product['badge']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-image">
                        <!-- Основное изображение товара -->
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
                        
                        <!-- Навигация по изображениям (кружочки) -->
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
                     <div class="product-category"><?php echo $product['category']; ?></div>

                        <div class="product-title"><?php echo htmlspecialchars($product['name']); ?></div>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        
                                       
                        <div class="product-meta">
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
                                        echo "Осталось всего {$product['inStock']} шт.";
                                    } else {
                                        echo "В наличии: {$product['inStock']} шт.";
                                    }
                                    ?>
                                </span>
                            </div>
                              <div class="product-price"><?php echo number_format($product['price'], 0, '', ' '); ?> ₽</div>
                        </div>
                        
                        <!-- <div class="product-price"><?php echo number_format($product['price'], 0, '', ' '); ?> ₽</div> -->
                                   
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

    <!-- Подключение JS -->
<script> 
        const productsData = <?php echo json_encode($products); ?>;
        const imagePath = "<?php echo $imagePath; ?>";
        const defaultImage = "<?php echo $imagePath . $defaultImage; ?>";
        
        // Инициализация глобального состояния корзины
        let AppState = {
            products: productsData,
            cart: JSON.parse(localStorage.getItem('cart')) || [],
            cartCount: 0,
            cartTotal: 0
        };

</script>

  <script src="js/catalog.js"></script>


    