<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Testimonials | Rudra EduTech";
$currentPage = basename($_SERVER['PHP_SELF']);

/* =========================================================
   DATABASE CONNECTION
========================================================= */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "rudra_edutech";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (!$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}


$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

/* =========================================================
   CONTACT DETAILS
========================================================= */

$phone = "7738699924";
$phoneDisplay = "+91 7738699924";
$email = "vishalkumar167248@gmail.com";
$whatsapp = "917738699924";
$whatsappDisplay = "+91 7738699924";

$testimonials = [];
if (isset($conn) && !$conn->connect_error) {
    $testQuery = "SHOW TABLES LIKE 'testimonials'";
    $testResult = $conn->query($testQuery);
    
    if ($testResult && $testResult->num_rows > 0) {
        $query = "SELECT id, name, role, company, message, rating, image FROM testimonials ORDER BY id DESC";
        $result = $conn->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $testimonials[] = $row;
            }
            $result->free();
        }
    }
    $conn->close();
}

if (empty($testimonials)) {
    $testimonials = [
        [
            "id" => 1,
            "name" => "Aarav Sharma",
            "role" => "Computer Science Student",
            "company" => "Rudra EduTech Batch 2025",
            "message" => "The learning experience at Rudra EduTech completely transformed my coding skills. Real-world projects and clean guidance helped me build confidence in web development.",
            "rating" => 5,
            "image" => "https://pixlr.com/images/generator/simple-generator.webp"
        ],
        [
            "id" => 2,
            "name" => "Priya Verma",
            "role" => "Frontend Developer",
            "company" => "TechNova Solutions",
            "message" => "Rudra EduTech designed our company portal with exceptional precision and modern UI standards. Their professionalism and delivery speed are commendable.",
            "rating" => 5,
            "image" => "https://images.pexels.com/photos/31284696/pexels-photo-31284696.jpeg?cs=srgb&dl=pexels-optical-chemist-340351297-31284696.jpg&fm=jpg"
        ],
        [
            "id" => 3,
            "name" => "Rohan Patil",
            "role" => "Business Owner",
            "company" => "Patil Enterprises",
            "message" => "From website hosting to custom digital solutions, their technical support team has been reliable and prompt throughout. Highly recommended!",
            "rating" => 5,
            "image" => "https://tse1.mm.bing.net/th/id/OIP.UYagQDMo7CCbBLXOPB5etAHaHa?r=0&rs=1&pid=ImgDetMain&o=7&rm=3"
        ],
        [
            "id" => 4,
            "name" => "Sneha Kulkarni",
            "role" => "UI/UX Learner",
            "company" => "Rudra EduTech Academy",
            "message" => "The practical sessions and interactive mentoring helped me secure my first web design internship. Thank you Rudra EduTech team!",
            "rating" => 5,
            "image" => "https://img.freepik.com/premium-photo/wide-angle-photo-blonde-cyberpunk-girl-with-no-glowing-blue-eyes-ina-neon-city_812426-10136.jpg"
        ],
        [
            "id" => 5,
            "name" => "Sneha Kulkarni",
            "role" => "UI/UX Learner",
            "company" => "Rudra EduTech Academy",
            "message" => "The practical sessions and interactive mentoring helped me secure my first web design internship. Thank you Rudra EduTech team!",
            "rating" => 5,
            "image" => "https://tse4.mm.bing.net/th/id/OIP._Kwnl-kk9S32TSRw21X0PAHaHa?r=0&rs=1&pid=ImgDetMain&o=7&rm=3"
        ],
        [
            "id" => 6,
            "name" => "Sneha Kulkarni",
            "role" => "UI/UX Learner",
            "company" => "Rudra EduTech Academy",
            "message" => "The practical sessions and interactive mentoring helped me secure my first web design internship. Thank you Rudra EduTech team!",
            "rating" => 5,
            "image" => "https://th.bing.com/th/id/OIP.pfQdrghei-ir2NWT6Tg0HwAAAA?&rs=1&pid=ImgDetMain&o=7&rm=3"
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Read authentic reviews and success stories from students and clients who partnered with Rudra EduTech.">
    <meta name="author" content="Rudra EduTech">
    <meta name="robots" content="index, follow">

    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">


    <style>
     
        .about-loader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity .6s ease, visibility .6s ease;
        }

        .about-loader.hide {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            object-fit: cover;
            animation: loaderPulse 1.4s infinite;
        }

        .loader-content h3 {
            margin: 15px 0 0;
            font-size: 20px;
        }

        .loader-content p {
            margin: 5px 0 0;
            opacity: .7;
        }

        @keyframes loaderPulse {
            0% { transform: scale(.9); opacity: .6; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(.9); opacity: .6; }
        }

     
        .testimonials-hero {
            position: relative;
            padding: 100px 20px 80px;
            text-align: center;
            background: linear-gradient(135deg, #f8fbff 0%, #f5f3ff 100%);
            overflow: hidden;
        }

        .testimonials-hero h1 {
            font-family: "Poppins", sans-serif;
            font-size: clamp(38px, 5vw, 60px);
            font-weight: 800;
            color: #111827;
            margin-top: 15px;
            letter-spacing: -1.5px;
        }

        .testimonials-hero h1 span {
            background: linear-gradient(90deg, #2563eb, #7c3aed, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .testimonials-hero p {
            max-width: 650px;
            margin: 15px auto 0;
            color: #64748b;
            font-size: 16px;
        }

        .testimonials-grid-section {
            padding: 80px 20px;
            background: #ffffff;
        }

        .testimonials-wrapper {
            max-width: 1180px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        @media (max-width: 768px) {
            .testimonials-wrapper {
                grid-template-columns: 1fr;
            }
        }

        .testimonial-card {
            position: relative;
            padding: 35px;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeUp 0.8s ease both;
        }

        .testimonial-card:hover {
            transform: translateY(-6px);
            border-color: #cbdcff;
            box-shadow: 0 20px 45px rgba(37, 99, 235, 0.1);
        }

        .testimonial-quote-icon {
            position: absolute;
            top: 25px;
            right: 30px;
            font-size: 36px;
            color: #e2e8f0;
            transition: color 0.3s ease;
        }

        .testimonial-card:hover .testimonial-quote-icon {
            color: rgba(37, 99, 235, 0.2);
        }

        .testimonial-stars {
            display: flex;
            gap: 4px;
            color: #f59e0b;
            font-size: 16px;
            margin-bottom: 18px;
        }

        .testimonial-message {
            color: #475569;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.2);
            overflow: hidden;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h3 {
            font-family: "Poppins", sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .author-info span {
            display: block;
            font-size: 12px;
            color: #2563eb;
            font-weight: 600;
            margin-top: 2px;
        }

        .author-info small {
            display: block;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 1px;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="about-loader" id="aboutLoader">
    <div class="loader-content">
        <img src="image/logo.png" alt="Rudra EduTech" class="loader-logo">
        <h3>Rudra EduTech</h3>
        <p>Learn • Create • Grow</p>
    </div>
</div>

<!-- =========================================================
     TOP BAR
========================================================= -->
<div class="topbar">
    <div class="container topbar-inner">
        <div class="top-left">
            <span>
                <i class="bi bi-telephone" aria-hidden="true"></i>
                <a href="tel:+91<?php echo $phone; ?>"><?php echo htmlspecialchars($phoneDisplay); ?></a>
            </span>
            <span>
                <i class="bi bi-envelope" aria-hidden="true"></i>
                <a href="mailto:<?php echo $email; ?>"><?php echo htmlspecialchars($email); ?></a>
            </span>
        </div>
        <div class="top-right">
            <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
            <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
            <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
            <a href="https://wa.me/<?php echo $whatsapp; ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
        </div>
    </div>
</div>

<!-- =========================================================
     HEADER / NAVIGATION
========================================================= -->
<header class="header">
    <div class="container nav-container">
        <a href="index.php" class="logo" aria-label="Rudra EduTech Home">
            <div class="logo-image">
                <img src="image/logo.png" alt="Rudra EduTech Logo" loading="eager">
            </div>
            <div class="logo-text">
                <span class="logo-rudra">Rudra <b class="logo-edutech">EduTech</b></span>
            </div>
        </a>

        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open navigation menu" aria-controls="navMenu" aria-expanded="false">
            <i class="bi bi-list" aria-hidden="true"></i>
        </button>

        <nav aria-label="Main Navigation">
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="<?php echo ($currentPage === 'index.php') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">About Us</a></li>
                <li><a href="course.php" class="<?php echo ($currentPage === 'course.php') ? 'active' : ''; ?>">Courses</a></li>
                <li><a href="services.php" class="<?php echo ($currentPage === 'services.php') ? 'active' : ''; ?>">Services</a></li>
                <li><a href="client.php" class="<?php echo ($currentPage === 'client.php') ? 'active' : ''; ?>">Clients</a></li>
                <li><a href="gallery.php" class="<?php echo ($currentPage === 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li>
                <li><a href="testimonials.php" class="<?php echo ($currentPage === 'testimonials.php') ? 'active' : ''; ?>">Testimonials</a></li>
                <li><a href="Blog.php">Blog</a></li>

                <li class="nav-auth-item" style="display: flex; align-items: center; gap: 6px;">
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php" class="nav-auth-btn logout-btn" title="Logout">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i><span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="nav-auth-btn login-btn" title="Login">
                            <i class="bi bi-person-lock" aria-hidden="true"></i><span>Login</span>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
   
    <section class="testimonials-hero">
        <div class="hero-content">
            <div class="hero-label" style="display: inline-flex; align-items: center; gap: 8px; padding: 7px 15px; border: 1px solid #dbeafe; border-radius: 50px; color: var(--primary); background: rgba(255,255,255,.75); font-size: 12px; font-weight: 800; text-transform: uppercase; margin-bottom: 10px;">
                <i class="bi bi-chat-quote-fill"></i> Testimonials
            </div>
            <h1>What our students & clients <br><span>say about us.</span></h1>
            <p>Discover real feedback, success stories, and experiences from the community we build and grow alongside.</p>
        </div>
    </section>

    <section class="testimonials-grid-section">
        <div class="testimonials-wrapper">
            <?php foreach ($testimonials as $index => $item): 
                $name = $item['name'] ?? 'Anonymous';
                $role = $item['role'] ?? 'Student / Client';
                $company = $item['company'] ?? 'Rudra EduTech Community';
                $message = $item['message'] ?? '';
                $rating = intval($item['rating'] ?? 5);
                $image = trim($item['image'] ?? '');
                $initials = strtoupper(substr($name, 0, 2));

                
                if (!empty($image)) {
                    if (strpos($image, 'http://') === 0 || strpos($image, 'https://') === 0) {
                        $imageSrc = $image;
                    } else {
                        $imageSrc = 'uploads/testimonials/' . $image;
                    }
                } else {
                    $imageSrc = '';
                }
            ?>
                <div class="testimonial-card" style="animation-delay: <?php echo ($index * 0.1); ?>s;">
                    <i class="bi bi-quote testimonial-quote-icon"></i>
                    
                    <div class="testimonial-stars">
                        <?php for ($i = 0; $i < $rating; $i++): ?>
                            <i class="bi bi-star-fill"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="testimonial-message">
                        "<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>"
                    </p>

                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <?php if (!empty($imageSrc)): ?>
                                <img src="<?php echo htmlspecialchars($imageSrc, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php else: ?>
                                <?php echo htmlspecialchars($initials, ENT_QUOTES, 'UTF-8'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="author-info">
                            <h3><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <span><?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?></span>
                            <small><?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- =========================================================
     FOOTER
========================================================= -->
<footer>
    <div class="footer-main">
        <div class="container footer-grid">
            <div class="footer-column">
                <a href="index.php" class="footer-logo" aria-label="Rudra EduTech Home">
                    <img src="image/logo.png" alt="Rudra EduTech Logo" loading="lazy">
                    <span>Rudra <b>EduTech</b></span>
                </a>
                <p>Education, technology and digital solutions for students, professionals and businesses.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                    <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin" aria-hidden="true"></i></a>
                    <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                    <a href="https://wa.me/<?php echo $whatsapp; ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="course.php">Courses</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    
                </ul>
            </div>
            <div class="footer-column">
                <h3>Our Services</h3>
                <ul>
                    <li><a href="services.php">Web Development</a></li>
                    <li><a href="services.php">Web Design</a></li>
                    <li><a href="services.php">Web Hosting</a></li>
                    <li><a href="services.php">Digital Solutions</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <div class="footer-contact">
                    <p><i class="bi bi-geo-alt" aria-hidden="true"></i><span>mumbai, India</span></p>
                    <p><i class="bi bi-telephone" aria-hidden="true"></i><a href="tel:+91<?php echo $phone; ?>"><?php echo htmlspecialchars($phoneDisplay); ?></a></p>
                    <p><i class="bi bi-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $email; ?>"><?php echo htmlspecialchars($email); ?></a></p>
                    <p><i class="bi bi-whatsapp" aria-hidden="true"></i><a href="https://wa.me/<?php echo $whatsapp; ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($whatsappDisplay); ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; <?php echo date("Y"); ?> Rudra EduTech. All Rights Reserved.</p>
            <p>Designed &amp; Developed by Rudra EduTech</p>
        </div>
    </div>
</footer>

<!-- =====================================================
     BACK TO TOP BUTTON
====================================================== -->
<button type="button" class="back-top" id="backTop" aria-label="Back to Top">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- =========================================================
     JAVASCRIPT LOGIC
========================================================= -->
<script>
"use strict";


window.addEventListener("load", function () {
    const loader = document.getElementById("aboutLoader");
    setTimeout(function () {
        if (loader) {
            loader.classList.add("hide");
        }
    }, 500);
});

document.addEventListener("DOMContentLoaded", function() {
    /* MOBILE NAVIGATION */
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");
    const navLinks = document.querySelectorAll(".nav-menu a");

    function toggleMenu() {
        if (!navMenu || !menuToggle) return;
        const isOpen = navMenu.classList.toggle("active");
        menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
        const icon = menuToggle.querySelector("i");
        if (icon) {
            icon.classList.toggle("bi-list", !isOpen);
            icon.classList.toggle("bi-x-lg", isOpen);
        }
    }

    if (menuToggle) menuToggle.addEventListener("click", toggleMenu);

    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            if (navMenu) navMenu.classList.remove("active");
            if (menuToggle) menuToggle.setAttribute("aria-expanded", "false");
            const icon = menuToggle ? menuToggle.querySelector("i") : null;
            if (icon) {
                icon.classList.add("bi-list");
                icon.classList.remove("bi-x-lg");
            }
        });
    });

    /* BACK TO TOP & SCROLL */
    const backTop = document.getElementById("backTop");
    window.addEventListener("scroll", function() {
        if (!backTop) return;
        backTop.classList.toggle("show", window.scrollY > 500);
    });

    if (backTop) {
        backTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    /* ESC KEY CLOSE MENU */
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && navMenu && navMenu.classList.contains("active")) {
            navMenu.classList.remove("active");
            if (menuToggle) {
                menuToggle.setAttribute("aria-expanded", "false");
                const icon = menuToggle.querySelector("i");
                if (icon) {
                    icon.classList.remove("bi-x-lg");
                    icon.classList.add("bi-list");
                }
            }
        }
    });
});
</script>

</body>
</html>