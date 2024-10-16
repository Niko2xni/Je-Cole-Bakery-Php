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

        //new storing
        const house = document.getElementById("house").value;
        const street = document.getElementById("street").value;
        const barangay = document.getElementById("barangay").value;
        const city = document.getElementById("city").value;
        const postalCode = document.getElementById("postalCode").value;
        const paymentMethod = document.getElementById("paymentMethod").value;

        //save localstorage
        localStorage.setItem("house", house);
        localStorage.setItem("street", street);
        localStorage.setItem("barangay", barangay);
        localStorage.setItem("city", city);
        localStorage.setItem("postalCode", postalCode);
        localStorage.setItem("paymentMethod", paymentMethod);

        alert("Thank you for ordering! Your order is now being processed");
        window.location.href = "receipt.html";
    });
});

