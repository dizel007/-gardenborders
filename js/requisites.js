// requisites.js - интерактивность для страницы реквизитов
document.addEventListener('DOMContentLoaded', function() {
    // Копирование реквизитов при клике
    const importantElements = document.querySelectorAll('.important');
    
    importantElements.forEach(element => {
        element.addEventListener('click', function() {
            const textToCopy = this.textContent;
            
            // Используем современный Clipboard API
            navigator.clipboard.writeText(textToCopy).then(() => {
                // Визуальная обратная связь
                const originalText = this.textContent;
                this.textContent = 'Скопировано!';
                this.style.color = '#4CAF50';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.color = '';
                }, 2000);
            }).catch(err => {
                console.error('Ошибка копирования: ', err);
                // Fallback для старых браузеров
                try {
                    const textArea = document.createElement('textarea');
                    textArea.value = textToCopy;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    
                    // Визуальная обратная связь
                    const originalText = this.textContent;
                    this.textContent = 'Скопировано!';
                    this.style.color = '#4CAF50';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.color = '';
                    }, 2000);
                } catch (fallbackErr) {
                    console.error('Fallback также не сработал: ', fallbackErr);
                }
            });
        });
        
        // Добавляем курсор-указатель для элементов с классом important
        element.style.cursor = 'pointer';
        element.title = 'Нажмите, чтобы скопировать';
    });
    
    // Плавная прокрутка для внутренних ссылок
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Анимация при прокрутке
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.requisites-card, .document-card');
        
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementTop < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Инициализация анимации
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Запускаем сразу для видимых элементов
    
    // Подсветка активной навигации
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-list a');
    
    navLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        if (linkHref === currentPage || 
            (linkHref === 'index.php' && currentPage === '') ||
            (linkHref === 'requisites.php' && currentPage === 'requisites.php')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
    
    // Добавление эффекта печати для важных чисел
    const importantNumbers = document.querySelectorAll('.important');
    importantNumbers.forEach(number => {
        number.style.fontFamily = "'Consolas', 'Monaco', monospace";
        number.style.letterSpacing = '1px';
    });
    
    // Анимация загрузки документов
    const documentCards = document.querySelectorAll('.document-card');
    documentCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
});