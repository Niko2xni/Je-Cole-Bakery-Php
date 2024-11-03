let openCartBtn = document.getElementById('openCart');
let closeCartBtn = document.getElementById('closeCart');
let body = document.querySelector('body');
let cartElement = document.querySelector('.cart');
let checkOut = document.getElementById('checkOut');
var cart = [];
var totalPrice = 0.00;

document.addEventListener('DOMContentLoaded', loadCart);

function addToCart(name, price, quantity) {
    quantity = parseInt(quantity);
    if (isNaN(quantity) || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    const item = { name: name, price: price, quantity: quantity };

    fetch('add-to-cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(item)
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            alert(data.message);
        } else {
            alert(data.message);
            loadCart();
        }
    })
    .catch(error => console.error('Error adding item to cart:', error));
}

// Function to remove item from cart
function removeFromCart(index) {
    fetch('remove-from-cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ index: index })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        loadCart();
    })
    .catch(error => console.error('Error removing item from cart:', error));
}

// Function to load the cart
function loadCart() {
    fetch('get-cart.php')
        .then(response => response.json())
        .then(data => {
            cart = data.items;
            updateCart();
        })
        .catch(error => console.error('Error loading cart:', error));
}

// Function to update the cart display
function updateCart() {
    const cartItemsElement = document.getElementById('cartItems');
    const cartTotalElement = document.getElementById('cartTotal');
    let total = 0;

    cartItemsElement.innerHTML = '';

    cart.forEach((item, index) => {
        const itemPrice = parseFloat(item.item_price) || 0;
        const itemQuantity = parseInt(item.item_quantity) || 0;
        const itemTotal = itemPrice * itemQuantity;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.item_name} (x${itemQuantity})</td>
            <td>₱ ${itemTotal.toFixed(2)}</td>
            <td><button onclick="removeFromCart(${index})">X</button></td>
        `;
        cartItemsElement.appendChild(row);
        total += itemTotal;
    });

    cartTotalElement.textContent = `₱ ${total.toFixed(2)}`;
}

function increment() {
    const quantityInput = event.target.parentElement.querySelector('.product_quantity');

    let currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
}

function decrement() {
    const quantityInput = event.target.parentElement.querySelector('.product_quantity');

    let currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}

openCartBtn.addEventListener('click', () => {
    cartElement.classList.add('open');
});

closeCartBtn.addEventListener('click', () => {
    cartElement.classList.remove('open');
});

checkOut.addEventListener('click', () => {
    if (cart.length === 0) {
        alert('You need to add an item first!');
    } else {
        fetch('checkout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cart: cart, totalPrice: totalPrice })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) window.location.href = 'delivery.php';
            else alert('Checkout failed: ' + data.message);
        })
        .catch(error => console.error('Error during checkout:', error));
    }
});