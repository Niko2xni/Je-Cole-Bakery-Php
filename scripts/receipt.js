document.addEventListener('DOMContentLoaded', function() {

    const storedFname = localStorage.getItem("fname"); 
    const storedLname = localStorage.getItem("lname");
    const storedEmail = localStorage.getItem("email");
    const storedNumber = localStorage.getItem("number");

    //new deliv
    const storedHouse = localStorage.getItem("house");
    const storedStreet = localStorage.getItem("street");
    const storedBarangay = localStorage.getItem("barangay");
    const storedCity = localStorage.getItem("city");
    const storedPostalCode = localStorage.getItem("postalCode");

    //new order details
    const storedCart = JSON.parse(localStorage.getItem("cart"));
    const storedTotalPrice = localStorage.getItem("totalPrice");

    if (storedFname && storedLname && storedEmail && storedNumber) {
 
        document.querySelector("#customerInfo tr:nth-child(2) td:nth-child(2)").textContent = storedFname;
        document.querySelector("#customerInfo tr:nth-child(3) td:nth-child(2)").textContent = storedLname;
        document.querySelector("#customerInfo tr:nth-child(4) td:nth-child(2)").textContent = storedEmail;
        document.querySelector("#customerInfo tr:nth-child(5) td:nth-child(2)").textContent = storedNumber;
    } else {
        alert("No customer data found! Please fill out the sign-up form.");
    }

    //new deliv details
    if (storedHouse && storedStreet && storedBarangay && storedCity && storedPostalCode) {
        document.querySelector("#customerInfo tr:nth-child(6) td:nth-child(2)").textContent = storedHouse;
        document.querySelector("#customerInfo tr:nth-child(7) td:nth-child(2)").textContent = storedStreet;
        document.querySelector("#customerInfo tr:nth-child(8) td:nth-child(2)").textContent = storedBarangay;
        document.querySelector("#customerInfo tr:nth-child(9) td:nth-child(2)").textContent = storedPostalCode;
        document.querySelector("#customerInfo tr:nth-child(10) td:nth-child(2)").textContent = storedCity;
    }

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