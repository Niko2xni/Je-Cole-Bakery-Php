<?php
session_start();

if (!isset($_SESSION['is_logged_in'])) {
    $_SESSION['is_logged_in'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je'Cole's Bakery</title>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/tab.png">
</head>
<body>
    <section id="header">
        <a href="index.php"><img src="images/logoWhite.png" id="logo"></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="index.php">Menu</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="#" id="openCart">Cart</a></li>
                <?php if ($_SESSION['is_logged_in']): ?>
                    <li>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></li>
                    <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </section>

    <section id = "menupage">
        <div id = "title">
            <video autoplay loop muted plays-inline>
                <source src="media/paris.mp4" type="video/mp4">
            </video>
            <img src="images/logoWhite.png" id="logo1">
            <p id="subtext"> So fast, so good! The home of freshly baked French pastries. </p>
            <p id="pageName">Menu</p>
        </div>
    
        <div id = "menuItems">
            <div class ="product-item">
                <img src="images/croissant.png" class="pic">
                <p class="text"> Classic Croissant </p>
                <h4 class="text_price"> PHP 40 </h4>
                <button class="text_button" onclick="addToCart('Classic Croissant', 40.00)"> ADD TO CART</button>
            </div>
            
            <div class ="product-item">
                <img src="images/baguette.png" class="pic">
                <p class="text"> Medium Baguette </p>
                <h4 class="text_price"> PHP 89 </h4>
                <button class="text_button" onclick="addToCart('Medium Baguette', 89.00)"> ADD TO CART</button>
            </div>
    
            <div class ="product-item">
                <img src="images/Pan au Chocolat.png" class="pic">
                <p class="text"> Pan au Chocolat </p>
                <h4 class="text_price"> PHP 45 </h4>
               <button class="text_button" onclick="addToCart('Pan au Chocolat', 45.00)"> ADD TO CART</button>        
            </div>
    
            <div class="product-item">
                <img src="images/Strawberry Macaroons.png" class="pic">
                <p class="text"> Strawberry Macaroons </p>
                <h4 class="text_price"> PHP 30 </h4>
                <button class="text_button" onclick="addToCart('Strawberry Macaroons', 30.00)"> ADD TO CART</button>
            </div>
    
            <div class="product-item">
               <img src="images/Eclair.png" class="pic">
                <p class="text"> Eclair </p>
                <h4 class="text_price"> PHP 25 </h4>
                <button class="text_button" onclick="addToCart('Eclair', 25.00)"> ADD TO CART</button>        
            </div>
                
            <div class="product-item">
                <img src="images/Paris-Brest.png" class="pic">
                <p class="text"> Paris-Brest </p>
                <h4 class="text_price"> PHP 129 </h4>
                <button class="text_button" onclick="addToCart('Paris-Brest', 129.00)"> ADD TO CART</button>
            </div>
        </div>
    
        <div class="cart">
            <div class="cartTab">
                <div class="cartLogo">
                    <img src="images/logoWhite.png" id="cartLogo">
                </div>
                <hr>
                <table class="cartList">
                    <thead>
                        <tr class="upperRow">
                            <th>Item</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <ul id="cartItem"></ul>
                            </td>
                            <td style="text-align: right;">
                                <ul id="cartPrice"></ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="cartTotalRow">
                    <p>Total:</p>
                    <p id="cartTotal">₱ 0.00</p>
                </div>
            </div>
            <div class="checkOutTab">
                <div class="checkOut">Checkout</div>
                <div id="closeCart">Close</div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="login.php">Log in</a>
                <a href="index.html">Menu</a>
                <a href="aboutus.html">About us</a>
            </div>

            <div class="footer-social">
                <a href="https://www.facebook.com/">Facebook</a>
                <a href="https://x.com/?lang=en">Twitter</a>
                <a href="https://www.instagram.com/">Instagram</a>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-copyright">
                <p>© 2024, Je'Cole's Bakery Online Quiapo Manila</p>
                <p>Je'Cole's Bakery Online</p>
            </div>
        </div>
    </footer>
    <script src="scripts/menu.js"></script>
</body>
</html>