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
    <link rel="stylesheet" href="aboutus.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logoWhite.png">
</head>
<body>
    <section id="header">
        <a href="index.php"><img src="images/logoWhite.png" id="logo"></a>
            <ul id="navbar">
                <li><a href="index.php">Menu</a></li>
                <li><a class="active" href="aboutus.php">About Us</a></li>
                <?php if ($_SESSION['is_logged_in']): ?>
                    <li>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></li>
                    <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                <?php endif; ?>
            </ul>
    </section>
    <video autoplay loop muted plays-inline>
        <source src="media/AboutBread.mp4" type="video/mp4">
    </video>
    <div class="slider">
        <div class="list">
            <div class="item">
                <div class="content">
                    <div class="title">JeCole's</div>
                    <div class="type">Bakery</div>
                    <div class="description">
                        Welcome to our online bakery! a convenient platform where fresh, delicious breada
                        is just a few clicks away! Our project aims to make it easier for customers to enjoy high-quality,
                        artisan bread without leaving the comfort of their homes. With a wide variety of bread options to
                        choose from, our website allows users to browse, order, and have their favorite loaves delivered
                        right to their doorstep. Founded in 2024, Jecole's Bakery began with a vision to bring the authentic 
                        flavors of French pastry to Manila, Philippines. Drawing inspiration from the rich baking traditions 
                        of France, the bakery was established to introduce Filipinos to exquisite breads, pastries, and desserts. 
                        With a focus on quality ingredients and traditional techniques, Jecole's Bakery quickly gained a reputation 
                        for offering a taste of France in the heart of Manila, becoming a destination for those seeking artisanal 
                        baked goods with a French flair.
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="content">
                    <div class="title">About our</div>
                    <div class="type">Breads</div>
                        <div class="description">
                            Jecole's Bakery, brings the timeless elegance of French baking to your table.a
                            Specializing in classic French breads, we offer a selection that showcases the rich, flavorful
                            tradition of French cuisine. From the perfect baguette to artisanal loaves, each bread is crafted
                            with passion and precision to bring you an authentic taste of France in every bite. 
                            Jecole's French pastries offers a sensory experience that begins with their delicate, golden-brown
                            crusts and ends with rich, flavorful fillings. Each bite is a symphony of textures—light and flaky 
                            layers that melt in your mouth, often giving way to smooth creams or rich chocolate centers. The buttery, 
                            slightly sweet aroma entices the senses, while the balanced flavors of almond, vanilla, or fruit add a
                            touch of sophistication. Whether you're enjoying a croissant, éclair, or tart, these pastries deliver a 
                            perfect blend of crispiness and softness, making every bite a luxurious treat. At Jecole's Bakery, we
                            believe that every loaf tells a story, and we are excited to share ours with you.
                       </div>                  
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="title">JeCole's</div>
                        <div class="type">Developers</div>
                        <div class="description">
                            Jeremy Dimasacat -
                            The team behind the Jecole’s Bakery website is a dynamic group of talented
                            developers who have worked to bring the charm of our bakery into the digital world. With a
                            shared passion for both technology and the art of baking, they’ve crafted a user-friendly, visually
                            appealing platform that captures the essence of our French-inspired creations. Now, Jecole’s
                            Bakery is just a click away, bringing the aroma of freshly baked bread into your home from
                            wherever you are.
                        </div>
                        
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="title">JeCole's</div>
                        <div class="type">Developers</div>
                        <div class="description">
                            Jay Bhie Bite - The team behind the Jecole’s Bakery website is a dynamic group
                            of talented developers who have worked to bring the charm of our bakery into the digital world.
                            With a shared passion for both technology and the art of baking, they’ve crafted a user-friendly,
                            visually appealing platform that captures the essence of our French-inspired creations. Now,
                            Jecole’s Bakery is just a click away, bringing the aroma of freshly baked bread into your home
                            from wherever you are.
                        </div>
                                        
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="title">JeCole's</div>
                        <div class="type">Developers</div>
                        <div class="description">
                            Nikolai Ng - The team behind the Jecole’s Bakery website is a dynamic group of
                            talented developers who have worked to bring the charm of our bakery into the digital world.
                            With a shared passion for both technology and the art of baking, they’ve crafted a user-friendly,
                            visually appealing platform that captures the essence of our French-inspired creations. Now,
                            Jecole’s Bakery is just a click away, bringing the aroma of freshly baked bread into your home
                            from wherever you are.
                        </div>
                                     
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="title">JeCole's</div>
                        <div class="type">Developers</div>
                            <div class="description">
                                Jizel Vergara - The team behind the Jecole’s Bakery website is a dynamic group
                                of talented developers who have worked to bring the charm of our bakery into the digital world.
                                With a shared passion for both technology and the art of baking, they’ve crafted a user-friendly,
                                visually appealing platform that captures the essence of our French-inspired creations. Now,
                                Jecole’s Bakery is just a click away, bringing the aroma of freshly baked bread into your home
                                from wherever you are.
                            </div>
                            
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="title">JeCole's</div>
                            <div class="type">Developers</div>
                                <div class="description">
                                    Rochelle Salucop - The team behind the Jecole’s Bakery website is a dynamic
                                    group of talented developers who have worked to bring the charm of our bakery into the digital
                                    world. With a shared passion for both technology and the art of baking, they’ve crafted a
                                    user-friendly, visually appealing platform that captures the essence of our French-inspired
                                    creations. Now, Jecole’s Bakery is just a click away, bringing the aroma of freshly baked bread
                                    into your home from wherever you are.
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail">
                        <div class="item">
                            <img src="images/roch.jpg"alt="">
                        </div>
                        <div class="item">
                            <img src="images/logo.jpg" alt="">
                        </div>
                        <div class="item">
                            <img src="images/CA.jpg"alt="">
                        </div>
                        <div class="item">
                            <img src="images/me.jpg"alt="">
                        </div>
                        <div class="item">
                            <img src="images/jay.jpg"alt="">
                        </div>
                        <div class="item">
                            <img src="images/ng.jpg"alt="">
                        </div>
                        <div class="item">
                            <img src="images/jizel.jpg"alt="">
                        </div>
                    </div>
                    <div class="nextPrevArrows">
                        <button class="prev"> < </button>
                        <button class="next"> > </button>
                    </div>
    </div>
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
    <script src="scripts/aboutus.js"></script>
</body>
</html>


