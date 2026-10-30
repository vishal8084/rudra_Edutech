<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Gallery | Rudra EduTech";
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



$galleryItems = [];
if (isset($conn) && !$conn->connect_error) {
    $galleryQuery = "SELECT id, title, category, description, image FROM gallery ORDER BY id DESC";
    $galleryResult = $conn->query($galleryQuery);
    if ($galleryResult) {
        while ($row = $galleryResult->fetch_assoc()) {
            $galleryItems[] = $row;
        }
        $galleryResult->free();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore the Rudra EduTech gallery featuring events, classes, projects, and digital solutions[cite: 10].">
    <meta name="author" content="Rudra EduTech[cite: 10]">
    <meta name="robots" content="index, follow[cite: 10]">

    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

            transition:
                opacity .6s ease,
                visibility .6s ease;
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

            0% {
                transform: scale(.9);
                opacity: .6;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(.9);
                opacity: .6;
            }

        }

        body.lightbox-open {
            overflow: hidden;
        }


        .gallery-masonry-grid {
            column-count: 4;
            column-gap: 20px;
            width: 100%;
        }

        @media (max-width: 1100px) {
            .gallery-masonry-grid { column-count: 3; }
        }
        @media (max-width: 768px) {
            .gallery-masonry-grid { column-count: 2; }
        }
        @media (max-width: 480px) {
            .gallery-masonry-grid { column-count: 1; }
        }

        .gallery-card {
            position: relative;
            display: inline-block;
            vertical-align: top;
            width: 100%;
            margin-bottom: 20px;
            overflow: hidden;
            break-inside: avoid;
            -webkit-column-break-inside: avoid;
            border-radius: 14px;
            background: #ffffff;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.85);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s ease, filter 0.4s ease, opacity 0.4s ease;
        }

        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.12);
        }

        .gallery-card img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
            background: #f1f5f9;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-card:hover img {
            transform: scale(1.03);
        }

       
        .gallery-masonry-grid:hover .gallery-card:not(:hover) {
            filter: blur(1.5px);
            opacity: 0.7;
        }

        .gallery-overlay-box {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            padding: 18px;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.88), rgba(15, 23, 42, 0.02) 70%);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .gallery-card:hover .gallery-overlay-box {
            opacity: 1;
        }

        .gallery-badge {
            display: inline-block;
            padding: 4px 10px;
            margin-bottom: 6px;
            border-radius: 20px;
            background: var(--primary, #2563eb);
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .gallery-overlay-title {
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
        }

        .gallery-fullscreen-icon {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary, #2563eb);
            font-size: 14px;
        }

        /* MODERN LIGHTBOX */
        .lightbox-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(2, 6, 23, 0.94);
            backdrop-filter: blur(10px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .lightbox-overlay.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .lightbox-container {
            position: relative;
            width: min(950px, 95vw);
            max-height: 92vh;
            overflow: hidden;
            border-radius: 16px;
            background: #0f172a;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
            transform: scale(0.92) translateY(15px);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .lightbox-overlay.active .lightbox-container {
            transform: scale(1) translateY(0);
        }

        .lightbox-media-box {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-height: 62vh;
            background: #020617;
            overflow: hidden;
        }

        .lightbox-media-box img {
            max-width: 100%;
            max-height: 62vh;
            object-fit: contain;
        }

        .lightbox-close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.8);
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .lightbox-close-btn:hover {
            background: #dc2626;
        }

        .lightbox-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.7);
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .lightbox-arrow:hover {
            background: var(--primary, #2563eb);
        }
        .lightbox-prev { left: 15px; }
        .lightbox-next { right: 15px; }

        .lightbox-content-box {
            padding: 20px 24px;
            background: #1e293b;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .lightbox-content-box span {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(37, 99, 235, 0.2);
            color: #93c5fd;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .lightbox-content-box h3 {
            margin: 0 0 6px;
            font-size: 20px;
            font-weight: 700;
        }

        .lightbox-content-box p {
            margin: 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.6;
        }

        .lightbox-loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #ffffff;
            font-size: 26px;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>

<body>


<div class="about-loader"
     id="aboutLoader">

    <div class="loader-content">

        <img src="image/logo.png"
             alt="Rudra EduTech"
             class="loader-logo">

        <h3>
            Rudra EduTech
        </h3>

        <p>
            Learn • Create • Grow
        </p>

    </div>

</div>

<?php if (isset($_SESSION['welcome_msg'])): ?>
    <div class="admin-welcome-toast" id="welcomeToast" role="alert">
        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
        <span><?php echo htmlspecialchars($_SESSION['welcome_msg']); ?></span>
        <button type="button" onclick="closeWelcomeToast()" aria-label="Close notification">&times;</button>
    </div>
    <?php unset($_SESSION['welcome_msg']); ?>
<?php endif; ?>


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
                <li><a href="testimonials.php">Testimonials</a></li>
                <li><a href="Blog.php">Blog</a></li>

                <li class="nav-auth-item" style="display: flex; align-items: center; gap: 6px;">
                    <?php if ($isLoggedIn): ?>
                        <a href="manage_gallery.php" class="nav-auth-btn" style="background: var(--primary); color: #fff;" title="Manage Gallery">
                            <i class="bi bi-images" aria-hidden="true"></i><span>Manage</span>
                        </a>
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
    <!-- PAGE HERO SECTION -->
    <section class="hero" style="padding: 50px 0; min-height: auto;">
        <div class="container text-center">
            <h1>Our <span>Gallery</span></h1>
            <p>Explore high-resolution captures, project moments, and milestones from Rudra EduTech.</p>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="section light-section" style="padding-top: 10px;">
        <div class="container">
            <?php if (!empty($galleryItems)): ?>
                <div class="gallery-masonry-grid" id="galleryGrid">
                    <?php foreach ($galleryItems as $index => $item): 
                        $imgName = trim($item['image'] ?? '');
                        $imgPath = 'uploads/gallery/' . rawurlencode($imgName);
                        $title = !empty($item['title']) ? $item['title'] : 'Rudra EduTech Gallery';
                        $category = !empty($item['category']) ? $item['category'] : 'Gallery';
                        $description = !empty($item['description']) ? $item['description'] : 'No description available.';
                    ?>
                        <article class="gallery-card"
                            data-index="<?php echo $index; ?>"
                            data-image="<?php echo htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8'); ?>"
                            data-title="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                            data-category="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>"
                            data-description="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>"
                            tabindex="0" role="button" aria-label="Open <?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
                            
                            <img src="<?php echo htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8'); ?>"
                                 alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                                 loading="<?php echo $index < 4 ? 'eager' : 'lazy'; ?>"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=Image+Unavailable';">

                            <div class="gallery-overlay-box">
                                <div style="width:100%;">
                                    <span class="gallery-badge"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></span>
                                    <div class="gallery-overlay-title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></div>
                                </div>
                                <span class="gallery-fullscreen-icon"><i class="bi bi-arrows-fullscreen"></i></span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 2px dashed #cbd5e1;">
                    <i class="bi bi-images" style="font-size: 48px; color: var(--muted);" aria-hidden="true"></i>
                    <h3 style="margin-top: 15px; color: var(--dark);">No Gallery Images Yet</h3>
                    <p style="color: var(--muted); font-size: 14px;">Images added by the admin will automatically show up here.</p>
                    <?php if ($isLoggedIn): ?>
                        <a href="manage_gallery.php" class="btn btn-primary" style="margin-top: 15px;">Add Gallery Images</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<div class="lightbox-overlay" id="lightbox" aria-hidden="true">
    <div class="lightbox-container" role="dialog" aria-modal="true">
        <button type="button" class="lightbox-close-btn" id="lightboxClose" aria-label="Close Lightbox"><i class="bi bi-x-lg"></i></button>
        
        <div class="lightbox-media-box">
            <div class="lightbox-loading-spinner" id="lightboxLoading"><i class="bi bi-arrow-repeat"></i></div>
            <button type="button" class="lightbox-arrow lightbox-prev" id="lightboxPrev" aria-label="Previous Image"><i class="bi bi-chevron-left"></i></button>
            <img src="" alt="" id="lightboxImage">
            <button type="button" class="lightbox-arrow lightbox-next" id="lightboxNext" aria-label="Next Image"><i class="bi bi-chevron-right"></i></button>
        </div>

        <div class="lightbox-content-box">
            <span id="lightboxCategory">Gallery</span>
            <h3 id="lightboxTitle">Title</h3>
            <p id="lightboxDescription">Description</p>
        </div>
    </div>
</div>


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
     BACK TO TOP
====================================================== -->

<button
    type="button"
    class="back-top"
    id="backTop"
    aria-label="Back to Top"
>

    <i class="bi bi-arrow-up"></i>

</button>

<!-- =========================================================
     JAVASCRIPT LOGIC
========================================================= -->
<script>
"use strict";


window.addEventListener("load", function () {

    const loader =
        document.getElementById("aboutLoader");

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

    /* LIGHTBOX FUNCTIONALITY */
    const galleryItems = Array.from(document.querySelectorAll(".gallery-card"));
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightboxImage");
    const lightboxTitle = document.getElementById("lightboxTitle");
    const lightboxCategory = document.getElementById("lightboxCategory");
    const lightboxDescription = document.getElementById("lightboxDescription");
    const lightboxClose = document.getElementById("lightboxClose");
    const lightboxPrev = document.getElementById("lightboxPrev");
    const lightboxNext = document.getElementById("lightboxNext");
    const lightboxLoading = document.getElementById("lightboxLoading");

    let currentIndex = 0;

    function openLightbox(index) {
        if (!galleryItems.length) return;
        currentIndex = index;
        const item = galleryItems[currentIndex];

        const imageSrc = item.getAttribute("data-image") || "";
        const title = item.getAttribute("data-title") || "";
        const category = item.getAttribute("data-category") || "";
        const description = item.getAttribute("data-description") || "";

        if (lightboxLoading) lightboxLoading.style.display = "block";
        lightboxImage.src = "";
        lightboxTitle.textContent = title;
        lightboxCategory.textContent = category;
        lightboxDescription.textContent = description;

        lightboxImage.onload = () => { if (lightboxLoading) lightboxLoading.style.display = "none"; };
        lightboxImage.onerror = () => {
            if (lightboxLoading) lightboxLoading.style.display = "none";
            lightboxImage.src = "https://via.placeholder.com/800x600?text=Image+Unavailable";
        };

        lightboxImage.src = imageSrc;
        lightbox.classList.add("active");
        document.body.classList.add("lightbox-open");
    }

    function closeLightbox() {
        lightbox.classList.remove("active");
        document.body.classList.remove("lightbox-open");
        lightboxImage.src = "";
    }

    function nextImage() {
        if (!galleryItems.length) return;
        currentIndex = (currentIndex + 1) % galleryItems.length;
        openLightbox(currentIndex);
    }

    function prevImage() {
        if (!galleryItems.length) return;
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        openLightbox(currentIndex);
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener("click", () => openLightbox(index));
        item.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                openLightbox(index);
            }
        });
    });

    if (lightboxClose) lightboxClose.addEventListener("click", closeLightbox);
    if (lightboxNext) lightboxNext.addEventListener("click", (e) => { e.stopPropagation(); nextImage(); });
    if (lightboxPrev) lightboxPrev.addEventListener("click", (e) => { e.stopPropagation(); prevImage(); });

    if (lightbox) {
        lightbox.addEventListener("click", (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }

  
    document.addEventListener("keydown", (e) => {
        if (!lightbox.classList.contains("active")) return;
        if (e.key === "Escape") closeLightbox();
        if (e.key === "ArrowRight") nextImage();
        if (e.key === "ArrowLeft") prevImage();
    });


    let touchStartX = 0;
    let touchEndX = 0;

    if (lightbox) {
        lightbox.addEventListener("touchstart", (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].screenX;
            let distance = touchEndX - touchStartX;
            if (Math.abs(distance) > 40) {
                if (distance < 0) nextImage();
                else prevImage();
            }
        }, { passive: true });
    }
});
</script>

</body>
</html>