// cart-state.js
class CartState {
      
    constructor() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
        this.listeners = [];
    }

    // Подписка на изменения
    subscribe(listener) {
        this.listeners.push(listener);
    }

    // Уведомление подписчиков
    notify() {
        this.listeners.forEach(listener => listener(this.cart));
    }

    // Добавление товара
    // addItem(product, quantity = 1) {
    //     console.log('Тип images:');
    //     const existingItemIndex = this.cart.findIndex(item => item.id === product.id);
    //     console.log('Тип images:', product);
    //     if (existingItemIndex > -1) {
    //         // Если товар уже в корзине - увеличиваем количество
    //         this.cart[existingItemIndex].quantity += quantity;
    //     } else {
    //         // Добавляем новый товар
    //         this.cart.push({
    //             id: product.id,
    //             name: product.name,
    //             price: product.price,
    //             image: product.images ? product.images[0] : 'default.jpg',
    //             category: product.category,
    //             quantity: quantity
    //         });
    //     }
         
    //     this.save();
    //     this.notify();
    //     return true;
    // }

    // Обновление количества
    updateQuantity(productId, change) {

        console.log('sssssssssss');

        const itemIndex = this.cart.findIndex(item => item.id === productId);
        
        if (itemIndex === -1) return false;
        
        const newQuantity = this.cart[itemIndex].quantity + change;
        
        if (newQuantity < 1) {
            this.removeItem(productId);
            return true;
        }
        
        this.cart[itemIndex].quantity = newQuantity;
        this.save();
        this.notify();
        return true;
    }

    // Удаление товара
    removeItem(productId) {
        const initialLength = this.cart.length;
        this.cart = this.cart.filter(item => item.id !== productId);
        
        if (this.cart.length !== initialLength) {
            this.save();
            this.notify();
            return true;
        }
        return false;
    }

    // Очистка корзины
    clear() {
        this.cart = [];
        this.save();
        this.notify();
    }

    // Получение общего количества
    getCount() {
        return this.cart.reduce((total, item) => total + (item.quantity || 0), 0);
    }

    // Получение общей суммы
    getTotal() {
        return this.cart.reduce((total, item) => total + ((item.price || 0) * (item.quantity || 0)), 0);
    }

    // Сохранение в localStorage
    save() {
        localStorage.setItem('cart', JSON.stringify(this.cart));
        
        // Также обновляем глобальное состояние если оно существует
        if (window.AppState) {
            window.AppState.cart = [...this.cart];
            window.AppState.cartCount = this.getCount();
            window.AppState.cartTotal = this.getTotal();
        }
    }

    // Получение копии корзины
    getCart() {
        return [...this.cart];
    }
}

// Создаем глобальный экземпляр
window.cartState = new CartState();