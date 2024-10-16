const loginForm = document.getElementById('login');

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;

    var storedEmail = localStorage.getItem("email");
    var storedPassword = localStorage.getItem("password");

    if (email === storedEmail && pass === storedPassword) {
        alert("Login successfully submitted!");
        window.location.href = "menu.html";
    }
    else {
        alert("Incorrect Username or Password!");
        return
    }

    document.getElementById("login").reset();
});