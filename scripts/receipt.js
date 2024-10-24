document.addEventListener('DOMContentLoaded', function() {

    //new order details
    const storedCart = JSON.parse(localStorage.getItem("cart"));
    const storedTotalPrice = localStorage.getItem("totalPrice");

    //order details
    const orderTable = document.querySelector("#orderInfo");
    if (storedCart && storedCart.length > 0 && storedTotalPrice) {
        // Set total price
        document.querySelector("#orderInfo tr:nth-child(2) td:nth-child(2)").textContent = '₱' + parseFloat(storedTotalPrice).toFixed(2);

        // Add each item from the cart
        storedCart.forEach(item => {
            const row = document.createElement('tr');
            const itemCell = document.createElement('td');
            const priceCell = document.createElement('td');
            
            itemCell.textContent = item.bread;
            priceCell.textContent = '₱' + item.rate.toFixed(2);
            
            row.appendChild(itemCell);
            row.appendChild(priceCell);
            orderTable.appendChild(row);
        });
    } else {
        alert("No order data found!");
    }
});