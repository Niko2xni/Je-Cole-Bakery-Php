document.addEventListener("DOMContentLoaded", function() {
    var totalPrice = parseFloat(localStorage.getItem("totalPrice"));
    var cartTotal = document.getElementById('cartTotal');

    cartTotal.textContent = "Total: ₱" + totalPrice.toFixed(2);

    const payButton = document.getElementById('delivery');

    document.getElementById("postalCode").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    payButton.addEventListener('submit', (event) => {
        event.preventDefault();

        alert("Thank you for ordering! Your order is now being processed");
        window.location.href = "receipt.php";
    });
});

