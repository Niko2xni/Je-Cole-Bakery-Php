let openCart = document.querySelector('#openCart');
let closeCart = document.querySelector('#closeCart');
let body = document.querySelector('body');
let checkOut = document.querySelector('.checkOut');
var cart = [];
var totalPrice = 0.00;

document.addEventListener('DOMContentLoaded', loadCart);

function addToCart(name, price) {
    // Create an item object to send to the server
    const item = {
        name: name,
        price: price
    };

    // Send the item to the PHP server using AJAX (fetch)
    fetch('/scripts/add-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(item) // Convert the item object to JSON
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Show the server response (e.g., "Item added to cart")
        loadCart(); // Reload the cart to show updated items
    })
    .catch(error => {
        console.error('Error adding item to cart:', error);
    });
}

function removeFromCart(index) {
    // Send an AJAX request to remove the item from the server session
    fetch('/scripts/remove-from-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ index: index }) // Send the index of the item to remove
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Show the server response (e.g., "Item removed")
        loadCart(); // Reload the cart to show updated items
    })
    .catch(error => {
        console.error('Error removing item from cart:', error);
    });
}

function loadCart() {
    // Fetch the cart items from the server
    fetch('/scripts/get-cart.php')
        .then(response => response.json())
        .then(items => {
            cart = items; // Update the `cart` array with the items fetched from the server
            
            // Now, update the cart display
            var cartItem = document.getElementById('cartItem');
            var cartPrice = document.getElementById('cartPrice');
            var cartTotal = document.getElementById('cartTotal');

            cartItem.innerHTML = '';
            cartPrice.innerHTML = '';

            totalPrice = 0.00;

            items.forEach((item, index) => {
                const addedItems = document.createElement('li');
                const bills = document.createElement('li');

                addedItems.textContent = item.name;
                bills.textContent = '₱' + item.price.toFixed(2);

                totalPrice += item.price;

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.onclick = function () {
                    removeFromCart(index); // You can handle removal logic similarly via AJAX
                };

                addedItems.appendChild(removeButton);
                cartItem.appendChild(addedItems);
                cartPrice.appendChild(bills);
            });

            cartTotal.textContent = '₱' + totalPrice.toFixed(2);
        })
        .catch(error => {
            console.error('Error loading cart:', error);
        });
}

openCart.addEventListener('click', ()=>{
    body.classList.add('active');
});

closeCart.addEventListener('click', ()=>{
    body.classList.remove('active');
});

checkOut.addEventListener('click', ()=>{
    if (cart.length === 0) {
        alert('You need to add an item first!');
    } else {
        localStorage.setItem("cart", JSON.stringify(cart)); //add this for cart
        localStorage.setItem("totalPrice", totalPrice.toFixed(2));
        window.location.href = "delivery.html";
    }
});