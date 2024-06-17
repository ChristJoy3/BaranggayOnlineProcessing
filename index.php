
<?php
include_once('user/session.php');

if (isLoggedIn()) {
    header("Location: user/Dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baranggay Management System</title>
    <link rel="stylesheet" href="stylesheets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

</head>
<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">BOP <span>SYSTEM.</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#contact" class="menu-btn">Contact Us</a></li>
                <li><a href="../user/login-form.php" class="menu-btn">Log-in</a></li>
                <li><a href="../user/register-form.php" class="menu-btn">Sign Up</a></li>
                
        
                
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Welcome to</div>
                <div class="text-2">Brgy. Cantandog 2</div>
                <div class="text-3">Purok Monggos, Cantandog 2 Hilongos, Leyte <br>Open Hours of Baranggay: Monday to Friday(8:AM to 5PM)</br></div>
                <a href="#about">About Us</a>
            </div>
        </div>
        <div class="pics">
            <img src="tambis.png" alt="">
        </div>
    </section>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About Us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="tambis.png" alt="">
                </div>
                <div class="column right">
                    <div class="text">Baranggay Cantandog 2 Hilongos, Leyte</div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut voluptatum eveniet doloremque autem excepturi eaque, sit laboriosam voluptatem nisi delectus. Facere explicabo hic minus accusamus alias fuga nihil dolorum quae. Explicabo illo unde, odio consequatur ipsam possimus veritatis, placeat, ab molestiae velit inventore exercitationem consequuntur blanditiis omnis beatae. Dolor iste excepturi ratione soluta quas culpa voluptatum repudiandae harum non.</p>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Services</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="far fa-file-alt"></i>
                        <div class="text">Certificate of Indegency</div>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem quia sunt, quasi quo illo enim.</p>
                        <?php if(isset($_SESSION['user_id'])) { ?>
                        <a href="#">Proceed Now</a>
                    <?php } else { ?>
                        <a href="#" onclick="alert('Please log in first.'); return false;">Proceed Now</a>
                    <?php } ?>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="far fa-file-alt"></i>
                        <div class="text">Certificate of Residency</div>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem quia sunt, quasi quo illo enim.</p>
                        <?php if(isset($_SESSION['user_id'])) { ?>
                        <a href="#">Proceed Now</a>
                    <?php } else { ?>
                        <a href="#" onclick="alert('Please log in first.'); return false;">Proceed Now</a>
                    <?php } ?>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="far fa-file-alt"></i>
                        <div class="text">Baranggay Business Permit</div>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem quia sunt, quasi quo illo enim.</p>
                        <?php if(isset($_SESSION['user_id'])) { ?>
                        <a href="#">Proceed Now</a>
                    <?php } else { ?>
                        <a href="#" onclick="alert('Please log in first.'); return false;">Proceed Now</a>
                    <?php } ?>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </section>

    
    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contact Us</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Get in Touch</div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos harum corporis fuga corrupti. Doloribus quis soluta nesciunt veritatis vitae nobis?</p>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title">Kapitan Tutan</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Cantandog - II, Hilongos, Bato, Leyte</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">KapitanTutan@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Message me</div>
                    <form action="#">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" placeholder="Name" required>
                            </div>
                            <div class="field email">
                                <input type="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" placeholder="Subject" required>
                        </div>
                        <div class="field textarea">
                            <textarea cols="30" rows="10" placeholder="Message.." required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <footer>
        <span>Edited by: <a href="#">Team Bangan</a> | <span class="far fa-copyright"></span> 2024 All rights reserved.</span>
    </footer>

    <script src="script.js"></script>
</body>
</html>
