// products.js (для главной страницы)
document.addEventListener('DOMContentLoaded', function() {
    console.log('Products module for homepage loaded');
    
    // Инициализация фильтрации на главной (если есть)
    const filterButtons = document.querySelectorAll('.filter-btn');
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Перенаправляем на страницу каталога с фильтром
                const category = this.dataset.category;
                window.location.href = `products.php?category=${category}`;
            });
        });
    }
});