<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Courses | Rudra EduTech";
$metaDescription = "Explore practical and career-focused courses at Rudra EduTech. Learn web development, web designing, computer skills and professional skills.";

$currentPage = basename($_SERVER['PHP_SELF']);

$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

if (isset($_GET['login_status']) && $_GET['login_status'] === 'success' && $isLoggedIn) {
    $adminName = $_SESSION['user_name'] ?? 'Admin';
    $_SESSION['welcome_msg'] = "Welcome back, " . htmlspecialchars($adminName) . "! Logged in successfully.";
} elseif (isset($_GET['logout_status']) && $_GET['logout_status'] === 'success' && !isset($_SESSION['welcome_msg'])) {
    $_SESSION['welcome_msg'] = "You have been logged out successfully.";
}

$phone        = "7738699924";
$phoneDisplay = "+91 7738699924";
$email        = "vishalkumar167248@gmail.com";
$whatsapp     = "917738699924";

$whatsappMessage = "Hello Rudra EduTech, I would like to know more about your courses.";
$whatsappLink   = "https://wa.me/" . $whatsapp . "?text=" . rawurlencode($whatsappMessage);

function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        "UTF-8"
    );
}

$courses = [
    "web-development" => [
        "title" => "Web Development",
        "short_title" => "Web Development",
        "icon" => "bi-code-slash",
        "icon_color" => "blue",
        "image" => "image/course-web.jpg",
        "description" =>
            "Learn how to create modern, responsive and professional websites using HTML, CSS, JavaScript, PHP and databases.",
        "duration" => "3 - 6 Months",
        "level" => "Beginner to Advanced",
        "mode" => "Practical Training",
        "modules" => [
            "HTML & HTML5",
            "CSS & Responsive Design",
            "JavaScript",
            "Bootstrap",
            "PHP",
            "MySQL Database",
            "Forms & Validation",
            "Dynamic Website Development",
            "Website Deployment",
            "Real World Projects"
        ]
    ],

    "web-designing" => [
        "title" => "Web Designing",
        "short_title" => "Web Designing",
        "icon" => "bi-palette",
        "icon_color" => "purple",
        "image" => "image/course-design.jpg",
        "description" =>
            "Learn modern website design, responsive layouts, user interface design and creative techniques to build attractive websites.",
        "duration" => "2 - 4 Months",
        "level" => "Beginner to Advanced",
        "mode" => "Practical Training",
        "modules" => [
            "Design Fundamentals",
            "HTML & CSS",
            "Responsive Web Design",
            "Bootstrap",
            "UI Design",
            "Website Layouts",
            "Typography",
            "Colors & Visual Design",
            "Mobile Friendly Design",
            "Professional Website Projects"
        ]
    ],

    "computer-courses" => [
        "title" => "Computer Courses",
        "short_title" => "Computer Courses",
        "icon" => "bi-pc-display",
        "icon_color" => "green",
        "image" => "image/course-computer.jpg",
        "description" =>
            "Build essential computer and digital skills required for education, office work, business and professional careers.",
        "duration" => "2 - 6 Months",
        "level" => "Beginner",
        "mode" => "Practical Training",
        "modules" => [
            "Computer Fundamentals",
            "Windows Basics",
            "MS Word",
            "MS Excel",
            "MS PowerPoint",
            "Internet & Email",
            "File & Folder Management",
            "Typing Skills",
            "Digital Skills",
            "Basic Office Work"
        ]
    ],

    "professional-skills" => [
        "title" => "Professional Skills",
        "short_title" => "Professional Skills",
        "icon" => "bi-file-earmark-text",
        "icon_color" => "orange",
        "image" => "image/course-skills.jpg",
        "description" =>
            "Improve your digital knowledge, communication, workplace skills and professional abilities to become career ready.",
        "duration" => "1 - 3 Months",
        "level" => "Beginner to Intermediate",
        "mode" => "Practical Training",
        "modules" => [
            "Communication Skills",
            "Professional Behaviour",
            "Resume Preparation",
            "Interview Preparation",
            "Digital Communication",
            "Email Writing",
            "Presentation Skills",
            "Time Management",
            "Basic Workplace Skills",
            "Career Development"
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="<?php echo e($metaDescription); ?>">

    <title><?php echo e($pageTitle); ?></title>

    <!-- =================================================
         BOOTSTRAP ICONS
    ================================================== -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

<style>

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    overflow-x: hidden;
}

.course-loader {
    position: fixed;
    inset: 0;
    background: #fff;
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity .6s ease, visibility .6s ease;
}

.course-loader.hide {
    opacity: 0;
    visibility: hidden;
}

.course-loader-content {
    text-align: center;
}

.course-loader-logo {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    object-fit: cover;
    animation: courseLoaderPulse 1.4s infinite;
}

.course-loader-content h3 {
    margin: 15px 0 0;
    font-size: 20px;
}

.course-loader-content p {
    margin: 5px 0 0;
    opacity: .7;
}

@keyframes courseLoaderPulse {
    0%,
    100% {
        transform: scale(.9);
        opacity: .6;
    }
    50% {
        transform: scale(1);
        opacity: 1;
    }
}

.hero {
    min-height: 520px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 100px 20px;
    background:
        radial-gradient(
            circle at 10% 20%,
            rgba(0, 123, 255, .12),
            transparent 35%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(111, 66, 193, .12),
            transparent 35%
        );
}

.hero::before {
    content: "";
    position: absolute;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    border: 1px solid rgba(0, 123, 255, .12);
    top: -180px;
    right: -120px;
    animation: rotateCircle 18s linear infinite;
}

.hero::after {
    content: "";
    position: absolute;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    border: 1px solid rgba(111, 66, 193, .12);
    bottom: -130px;
    left: -100px;
    animation: rotateCircleReverse 15s linear infinite;
}

@keyframes rotateCircle {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes rotateCircleReverse {
    from {
        transform: rotate(360deg);
    }
    to {
        transform: rotate(0deg);
    }
}

.hero-grid {
    position: relative;
    z-index: 2;
}

.hero-content {
    animation: fadeUp .9s ease .1s both;
}

.hero-badge {
    animation: fadeDown .8s ease forwards;
}

.hero-content h1 {
    animation: fadeUp .9s ease .1s both;
}

.hero-content p {
    animation: fadeUp .9s ease .2s both;
}

.hero-buttons,
.hero-points {
    animation: fadeUp .9s ease .3s both;
}

.hero-card {
    animation: heroCardIn 1s ease .2s both;
}

@keyframes heroCardIn {
    from {
        opacity: 0;
        transform:
            translateX(45px)
            scale(.96);
    }
    to {
        opacity: 1;
        transform:
            translateX(0)
            scale(1);
    }
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(35px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translateY(-25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.reveal {
    opacity: 0;
    transform: translateY(45px);
    transition:
        opacity .8s ease,
        transform .8s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

/* =========================================================
   COURSE SLIDER
========================================================= */

.hero-slider {
    position: relative;
    overflow: hidden;
}

.slide {
    overflow: hidden;
}

.slide img {
    transition: transform 1s ease;
}

.slide.active img {
    transform: scale(1.05);
}

.slide-content {
    animation: slideContentIn .8s ease both;
}

.slide:not(.active) .slide-content {
    animation: none;
}

@keyframes slideContentIn {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.slider-arrow {
    transition:
        transform .3s ease,
        background .3s ease,
        box-shadow .3s ease;
}

.slider-arrow:hover {
    transform:
        translateY(-50%)
        scale(1.08);
    box-shadow:
        0 10px 25px rgba(0,0,0,.18);
}

.dot {
    transition:
        transform .3s ease,
        opacity .3s ease;
}

.dot:hover {
    transform: scale(1.3);
}

.section-heading {
    animation: fadeUp .8s ease both;
}

.course-card {
    position: relative;
    overflow: hidden;
    transition:
        transform .4s ease,
        box-shadow .4s ease,
        border-color .4s ease;
}

.course-card:hover {
    transform: translateY(-12px);
    box-shadow:
        0 25px 60px rgba(0,0,0,.12);
}

.course-card::before {
    content: "";
    position: absolute;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: rgba(13,110,253,.05);
    top: -70px;
    right: -70px;
    transition: transform .5s ease;
    pointer-events: none;
}

.course-card:hover::before {
    transform: scale(2);
}

.card-image {
    overflow: hidden;
}

.card-image img {
    transition: transform .6s ease;
}

.course-card:hover .card-image img {
    transform: scale(1.08);
}

.card-image-icon {
    transition:
        transform .4s ease,
        box-shadow .4s ease;
}

.course-card:hover .card-image-icon {
    transform:
        rotateY(180deg)
        scale(1.06);
}

.card-icon {
    transition: transform .4s ease;
}

.course-card:hover .card-icon {
    transform:
        translateY(-4px)
        rotateY(180deg);
}

.course-card .card-body > a {
    transition:
        color .3s ease,
        gap .3s ease,
        transform .3s ease;
}

.course-card .card-body > a:hover {
    transform: translateX(3px);
}

.course-info {
    margin: 22px 0 24px;
    padding: 16px 0;
    border-top:
        1px solid var(--border);
    border-bottom:
        1px solid var(--border);
}

.course-info > div {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 9px 0;
    color: var(--text);
    font-size: 14px;
    line-height: 1.5;
    transition: transform .3s ease;
}

.course-info > div:hover {
    transform: translateX(5px);
}

.course-info i {
    color: var(--primary);
    font-size: 16px;
    min-width: 18px;
}

.course-detail {
    position: relative;
    overflow: hidden;
    background: #fff;
}

.course-detail:nth-of-type(even) {
    background: var(--light);
}

.course-detail::before {
    content: "";
    position: absolute;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    border:
        1px solid rgba(13,110,253,.07);
    top: -220px;
    right: -170px;
    animation:
        rotateCircle 22s linear infinite;
    pointer-events: none;
}

.course-detail::after {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    border:
        1px solid rgba(111,66,193,.07);
    bottom: -150px;
    left: -120px;
    animation:
        rotateCircleReverse 18s linear infinite;
    pointer-events: none;
}

.course-detail > .container {
    position: relative;
    z-index: 2;
}

.course-detail .about-grid {
    animation: fadeUp .8s ease both;
}

.course-detail .about-image {
    transition:
        transform .45s ease,
        box-shadow .45s ease;
    border-radius: 28px;
    overflow: hidden;
}

.course-detail .about-image:hover {
    transform: translateY(-8px);
    box-shadow:
        0 25px 70px rgba(0,0,0,.16);
}

.course-detail .about-image-inner {
    overflow: hidden;
}

.course-detail .about-image-inner img {
    transition: transform .7s ease;
}

.course-detail .about-image:hover img {
    transform: scale(1.06);
}

.course-detail .about-image-inner > i {
    animation:
        floatingIcon 3s ease-in-out infinite;
}

@keyframes floatingIcon {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-12px);
    }
}

.course-detail .about-content h2 {
    font-family: "Poppins", sans-serif;
}

.course-detail .about-content {
    animation:
        fadeUp .9s ease .1s both;
}

.course-detail .about-list {
    margin-bottom: 28px;
}

.course-detail .about-list > div {
    color: var(--text);
    transition:
        transform .3s ease;
}

.course-detail .about-list > div:hover {
    transform: translateX(6px);
}

.course-detail .about-list i {
    color: var(--success);
}

.course-detail .about-content .btn {
    margin-top: 4px;
}

.course-modules-heading {
    margin-top: 75px;
    margin-bottom: 34px;
}

.feature-card {
    position: relative;
    overflow: hidden;
    transition:
        transform .4s ease,
        box-shadow .4s ease,
        border-color .4s ease;
}

.feature-card::before {
    content: "";
    position: absolute;
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background:
        rgba(13,110,253,.05);
    top: -65px;
    right: -65px;
    transition:
        transform .45s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow:
        0 22px 50px rgba(0,0,0,.11);
}

.feature-card:hover::before {
    transform: scale(2);
}

.feature-number {
    transition:
        transform .4s ease;
}

.feature-card:hover .feature-number {
    transform: translateX(5px);
}

.feature-image {
    transition:
        transform .4s ease,
        border-radius .4s ease;
}

.feature-card:hover .feature-image {
    transform:
        scale(1.08)
        rotate(2deg);
    border-radius: 50%;
}

.feature-icon {
    transition:
        transform .4s ease;
}

.feature-card:hover .feature-icon {
    transform:
        scale(1.15)
        rotateY(180deg);
}

.section.light-section .feature-card {
    background: #fff;
}

.cta {
    position: relative;
    overflow: hidden;
}

.cta::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    border:
        1px solid rgba(255,255,255,.12);
    border-radius: 50%;
    top: -250px;
    right: -120px;
    animation:
        rotateCircle 20s linear infinite;
}

.cta::after {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    border:
        1px solid rgba(255,255,255,.12);
    border-radius: 50%;
    bottom: -200px;
    left: -100px;
}

.cta-content {
    position: relative;
    z-index: 2;
    animation:
        fadeUp .9s ease both;
}

.cta .section-label {
    color: #fff;
    border-color:
        rgba(255,255,255,.3);
}

.contact-item {
    transition:
        transform .35s ease,
        box-shadow .35s ease;
}

.contact-item:hover {
    transform: translateX(7px);
}

.contact-icon {
    transition:
        transform .35s ease;
}

.contact-item:hover .contact-icon {
    transform:
        rotateY(180deg)
        scale(1.06);
}

.contact-form-box {
    transition:
        transform .4s ease,
        box-shadow .4s ease;
}

.contact-form-box:hover {
    transform: translateY(-5px);
    box-shadow:
        0 25px 60px rgba(0,0,0,.10);
}

.form-group input,
.form-group textarea,
.form-group select {
    transition:
        border-color .3s ease,
        box-shadow .3s ease,
        transform .3s ease;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color:
        var(--primary);
    box-shadow:
        0 0 0 3px
        rgba(37,99,235,.10);
    transform:
        translateY(-1px);
}

.form-group select {
    width: 100%;
    border:
        1px solid var(--border);
    border-radius: 10px;
    padding: 13px 15px;
    background: var(--white);
    color: var(--text);
    font: inherit;
    outline: none;
}

.btn {
    transition:
        transform .3s ease,
        box-shadow .3s ease,
        background .3s ease;
}

.btn:hover {
    transform: translateY(-4px);
    box-shadow:
        0 12px 28px rgba(0,0,0,.15);
}

/* =========================================================
   FOOTER
========================================================= */

.social-links a {
    transition:
        transform .3s ease,
        background .3s ease;
}

.social-links a:hover {
    transform:
        translateY(-5px)
        rotate(4deg);
}

/* =========================================================
   CONTACT LINKS
========================================================= */

.topbar a[href^="tel:"],
.topbar a[href^="mailto:"],
.footer-contact a[href^="tel:"],
.footer-contact a[href^="mailto:"],
.footer-contact a[href*="wa.me"] {
    color: inherit;
    text-decoration: none;
    transition:
        color .3s ease,
        opacity .3s ease;
}

.topbar a[href^="tel:"]:hover,
.topbar a[href^="mailto:"]:hover,
.footer-contact a[href^="tel:"]:hover,
.footer-contact a[href^="mailto:"]:hover,
.footer-contact a[href*="wa.me"]:hover {
    opacity: .8;
}

.cards-grid .course-card:nth-child(1),
.features-grid .feature-card:nth-child(1) {
    transition-delay: .04s;
}

.cards-grid .course-card:nth-child(2),
.features-grid .feature-card:nth-child(2) {
    transition-delay: .08s;
}

.cards-grid .course-card:nth-child(3),
.features-grid .feature-card:nth-child(3) {
    transition-delay: .12s;
}

.cards-grid .course-card:nth-child(4),
.features-grid .feature-card:nth-child(4) {
    transition-delay: .16s;
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 900px) {
    .hero {
        padding: 80px 20px;
    }

    .course-detail .about-grid {
        gap: 45px;
    }

    .course-detail .about-image {
        border-radius: 22px;
    }
}

@media (max-width: 700px) {
    .hero {
        min-height: 470px;
        padding: 75px 18px;
    }

    .hero::before {
        width: 280px;
        height: 280px;
        right: -150px;
        top: -110px;
    }

    .hero::after {
        width: 200px;
        height: 200px;
        left: -100px;
        bottom: -100px;
    }

    .course-modules-heading {
        margin-top: 55px;
        margin-bottom: 28px;
    }

    .course-info {
        margin: 18px 0 22px;
    }

    .course-info > div {
        font-size: 13px;
    }

    .course-card:hover,
    .feature-card:hover {
        transform:
            translateY(-6px);
    }
}

@media (max-width: 480px) {
    .hero {
        padding: 65px 15px;
    }

    .hero-content h1 {
        font-size: 36px;
    }

    .course-detail::before {
        width: 260px;
        height: 260px;
    }

    .course-detail::after {
        width: 180px;
        height: 180px;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: .01ms;
        animation-iteration-count: 1 ;
        scroll-behavior: auto;
        transition-duration: .01ms;
    }
}

</style>

</head>

<body>

<?php if (isset($_SESSION['welcome_msg'])): ?>
    <div class="admin-welcome-toast" id="welcomeToast" role="alert">
        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
        <span><?php echo htmlspecialchars($_SESSION['welcome_msg']); ?></span>
        <button type="button" onclick="closeWelcomeToast()" aria-label="Close notification">&times;</button>
    </div>
    <?php unset($_SESSION['welcome_msg']); ?>
<?php endif; ?>

<div class="course-loader"
     id="courseLoader">

    <div class="course-loader-content">

        <img src="image/logo.png"
             alt="Rudra EduTech"
             class="course-loader-logo">

        <h3>
            Rudra EduTech
        </h3>

        <p>
            Learn • Create • Grow
        </p>

    </div>

</div>

<!-- =====================================================
     TOP BAR
===================================================== -->

<div class="topbar">

    <div class="container topbar-inner">

        <div class="top-left">

            <span>

                <i class="bi bi-telephone"></i>

                <a href="tel:+917738699924">
                    +91 7738699924
                </a>

            </span>


            <span>

                <i class="bi bi-envelope"></i>

                <a href="mailto:vishalkumar167248@gmail.com">
                    vishalkumar167248@gmail.com
                </a>

            </span>

        </div>


        <div class="top-right">

            <a href="#"
               aria-label="Facebook">

                <i class="bi bi-facebook"></i>

            </a>


            <a href="#"
               aria-label="Instagram">

                <i class="bi bi-instagram"></i>

            </a>


            <a href="#"
               aria-label="YouTube">

                <i class="bi bi-youtube"></i>

            </a>


            <a href="<?php echo e($whatsappLink); ?>"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="Chat with Rudra EduTech on WhatsApp">

                <i class="bi bi-whatsapp"></i>

            </a>

        </div>

    </div>

</div>

<!-- =====================================================
     HEADER / NAVBAR
===================================================== -->

<header class="header">

    <div class="container nav-container">

        <!-- LOGO -->
        <a href="index.php"
           class="logo">

            <div class="logo-image">

                <img src="image/logo.png"
                     alt="Rudra EduTech Logo">

            </div>

            <div class="logo-text">

                <span class="logo-rudra">

                    Rudra

                    <b class="logo-edutech">
                        EduTech
                    </b>

                </span>

            </div>

        </a>

        <!-- MOBILE MENU -->
        <button class="menu-toggle"
                id="menuToggle"
                aria-label="Open navigation menu"
                aria-controls="navMenu"
                aria-expanded="false">

            <i class="bi bi-list" aria-hidden="true"></i>

        </button>

        <!-- NAVIGATION -->
        <nav aria-label="Main Navigation">

            <ul class="nav-menu"
                id="navMenu">

                <li>
                    <a href="index.php" class="<?php echo ($currentPage === 'index.php') ? 'active' : ''; ?>">
                        Home
                    </a>
                </li>

                <li>
                    <a href="about.php" class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">
                        About Us
                    </a>
                </li>

                <li>
                    <a href="course.php" class="<?php echo ($currentPage === 'course.php') ? 'active' : ''; ?>">
                        Courses
                    </a>
                </li>

                <li>
                    <a href="services.php" class="<?php echo ($currentPage === 'services.php') ? 'active' : ''; ?>">
                        Services
                    </a>
                </li>

                <li>
                    <a href="client.php" class="<?php echo ($currentPage === 'client.php') ? 'active' : ''; ?>">
                        Clients
                    </a>
                </li>

                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="manage_gallery.php" class="<?php echo ($currentPage === 'manage_gallery.php') ? 'active' : ''; ?>">
                            Gallery
                        </a>
                    <?php else: ?>
                        <a href="gallery.php" class="<?php echo ($currentPage === 'gallery.php') ? 'active' : ''; ?>">
                            Gallery
                        </a>
                    <?php endif; ?>
                </li>

                <li>
                    <a href="testimonials.php" class="<?php echo ($currentPage === 'testimonials.php') ? 'active' : ''; ?>">
                        Testimonials
                    </a>
                </li>

                <li>
                    <a href="Blog.php" class="<?php echo ($currentPage === 'Blog.php') ? 'active' : ''; ?>">
                        Blog
                    </a>
                </li>

                <li>
                    <a href="contact.php" class="nav-button <?php echo ($currentPage === 'contact.php') ? 'active' : ''; ?>">
                        Contact
                        <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                    </a>
                </li>

                <!-- LOGIN / LOGOUT BUTTON -->
                <li class="nav-auth-item">
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php"
                           class="nav-auth-btn logout-btn"
                           title="Logout">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                            <span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="login.php"
                           class="nav-auth-btn login-btn"
                           title="Login">
                            <i class="bi bi-person-lock" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>
                    <?php endif; ?>
                </li>

            </ul>

        </nav>

    </div>

</header>

<main>

<!-- =====================================================
     COURSES HERO
===================================================== -->

<section class="hero">

    <div class="container hero-grid">

        <div class="hero-content">

            <div class="hero-badge">

                <i class="bi bi-mortarboard-fill"></i>

                Rudra EduTech Courses

            </div>

            <h1>

                Learn.

                <span>
                    Create.
                </span>

                Grow.

            </h1>

            <p>

                Develop practical skills with career-focused
                courses designed for students, professionals
                and aspiring creators.

            </p>

            <div class="hero-buttons">

                <a href="#all-courses"
                   class="btn btn-primary">

                    Explore Courses

                    <i class="bi bi-arrow-down"></i>

                </a>

            </div>

            <div class="hero-points">

                <div>

                    <i class="bi bi-check-circle-fill"></i>

                    Practical Learning

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"></i>

                    Career Focused

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"></i>

                    Professional Support

                </div>

            </div>

        </div>

        <div class="hero-card">

            <div class="hero-slider">

                <div class="slide active">

                    <img src="image/course-web.jpg"
                         alt="Web Development Course">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-code-slash"></i>

                        </span>

                        <h2>

                            Web Development

                            <small>
                                Build Professional Websites
                            </small>

                        </h2>

                        <p>

                            Learn modern web technologies
                            through practical projects.

                        </p>

                    </div>

                </div>

                <div class="slide">

                    <img src="image/course-design.jpg"
                         alt="Web Designing Course">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-palette"></i>

                        </span>

                        <h2>

                            Web Designing

                            <small>
                                Create Beautiful Websites
                            </small>

                        </h2>

                        <p>

                            Learn modern UI and responsive
                            website design.

                        </p>

                    </div>

                </div>

                <div class="slide">

                    <img src="image/course-computer.jpg"
                         alt="Computer Courses">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-pc-display"></i>

                        </span>

                        <h2>

                            Computer Skills

                            <small>
                                Build Your Digital Skills
                            </small>

                        </h2>

                        <p>

                            Learn essential computer and
                            office skills.

                        </p>

                    </div>

                </div>

                <button class="slider-arrow slider-prev"
                        onclick="changeSlide(-1)"
                        aria-label="Previous Slide">

                    <i class="bi bi-chevron-left"></i>

                </button>

                <button class="slider-arrow slider-next"
                        onclick="changeSlide(1)"
                        aria-label="Next Slide">

                    <i class="bi bi-chevron-right"></i>

                </button>

                <div class="slider-dots">

                    <button class="dot active"
                            onclick="goToSlide(0)"
                            aria-label="Slide 1">
                    </button>

                    <button class="dot"
                            onclick="goToSlide(1)"
                            aria-label="Slide 2">
                    </button>

                    <button class="dot"
                            onclick="goToSlide(2)"
                            aria-label="Slide 3">
                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
     COURSE INTRODUCTION
===================================================== -->

<section class="section light-section"
         id="all-courses">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">
                Our Courses
            </div>

            <h2>
                Learn Skills That Matter
            </h2>

            <p>

                Choose a practical course and develop
                the skills you need for your education,
                career or business.

            </p>

        </div>

        <!-- =================================================
             COURSE CARDS
        ================================================== -->

        <div class="cards-grid">

            <?php foreach ($courses as $slug => $course): ?>

                <div class="course-card"
                     id="<?php echo e($slug); ?>">

                    <!-- COURSE IMAGE -->
                    <div class="card-image">

                        <img src="<?php echo e($course["image"]); ?>"
                             alt="<?php echo e($course["title"]); ?>">

                        <div class="card-image-icon">

                            <i class="bi <?php echo e($course["icon"]); ?>"></i>

                        </div>

                    </div>

                    <!-- COURSE BODY -->
                    <div class="card-body">

                        <div class="card-icon <?php echo e($course["icon_color"]); ?>">

                            <i class="bi <?php echo e($course["icon"]); ?>"></i>

                        </div>

                        <h3>

                            <?php echo e($course["title"]); ?>

                        </h3>

                        <p>

                            <?php echo e($course["description"]); ?>

                        </p>

                        <!-- COURSE INFO -->
                        <div class="course-info">

                            <div>

                                <i class="bi bi-clock"></i>

                                <span>

                                    <?php echo e($course["duration"]); ?>

                                </span>

                            </div>

                            <div>

                                <i class="bi bi-bar-chart"></i>

                                <span>

                                    <?php echo e($course["level"]); ?>

                                </span>

                            </div>

                            <div>

                                <i class="bi bi-laptop"></i>

                                <span>

                                    <?php echo e($course["mode"]); ?>

                                </span>

                            </div>

                        </div>

                        <a href="#course-<?php echo e($slug); ?>">

                            View Course Details

                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- =====================================================
     COURSES
===================================================== -->

<?php foreach ($courses as $slug => $course): ?>

<section class="section course-detail"
         id="course-<?php echo e($slug); ?>">

    <div class="container">

        <div class="about-grid">

            <!-- IMAGE -->
            <div class="about-image">

                <div class="about-image-inner">

                    <img src="<?php echo e($course["image"]); ?>"
                         alt="<?php echo e($course["title"]); ?>">

                    <i class="bi <?php echo e($course["icon"]); ?>"></i>

                    <h3>

                        <?php echo e($course["title"]); ?>

                    </h3>

                    <p>

                        Practical • Professional • Career Focused

                    </p>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="about-content">

                <div class="section-label">

                    <?php echo e($course["short_title"]); ?>

                </div>

                <h2>

                    Master <?php echo e($course["title"]); ?>

                </h2>

                <p>

                    <?php echo e($course["description"]); ?>

                </p>

                <!-- COURSE DETAILS -->
                <div class="about-list">

                    <div>

                        <i class="bi bi-check-circle-fill"></i>

                        Duration:

                        <?php echo e($course["duration"]); ?>

                    </div>

                    <div>

                        <i class="bi bi-check-circle-fill"></i>

                        Level:

                        <?php echo e($course["level"]); ?>

                    </div>

                    <div>

                        <i class="bi bi-check-circle-fill"></i>

                        Training:

                        <?php echo e($course["mode"]); ?>

                    </div>

                    <div>

                        <i class="bi bi-check-circle-fill"></i>

                        Practical Project Based Learning

                    </div>

                </div>

            </div>

        </div>

        <div class="section-heading course-modules-heading">

            <div class="section-label">

                Course Modules

            </div>

            <h2>

                What You Will Learn

            </h2>

        </div>

        <div class="features-grid">

            <?php foreach ($course["modules"] as $index => $module): ?>

                <div class="feature-card">

                    <div class="feature-number">

                        <?php echo str_pad(
                            $index + 1,
                            2,
                            "0",
                            STR_PAD_LEFT
                        ); ?>

                    </div>

                    <div class="feature-image">

                        <i class="bi <?php echo e($course["icon"]); ?>"></i>

                    </div>

                    <i class="bi bi-check-circle feature-icon"></i>

                    <h3>

                        <?php echo e($module); ?>

                    </h3>

                    <p>

                        Practical learning with
                        step-by-step guidance.

                    </p>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<?php endforeach; ?>

<!-- =====================================================
     WHY CHOOSE OUR COURSES
===================================================== -->

<section class="section light-section">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Why Choose Our Courses

            </div>

            <h2>

                Learn With Confidence

            </h2>

            <p>

                Our courses are designed to focus on
                practical knowledge and useful skills.

            </p>

        </div>

        <div class="features-grid">

            <!-- FEATURE 1 -->
            <div class="feature-card">

                <div class="feature-number">
                    01
                </div>

                <div class="feature-image">

                    <i class="bi bi-laptop"></i>

                </div>

                <i class="bi bi-laptop feature-icon"></i>

                <h3>

                    Practical Training

                </h3>

                <p>

                    Learn by working on practical
                    exercises and real projects.

                </p>

            </div>

            <!-- FEATURE 2 -->
            <div class="feature-card">

                <div class="feature-number">
                    02
                </div>

                <div class="feature-image">

                    <i class="bi bi-lightbulb"></i>

                </div>

                <i class="bi bi-lightbulb feature-icon"></i>

                <h3>

                    Easy Learning

                </h3>

                <p>

                    Understand concepts through
                    simple and structured learning.

                </p>

            </div>

            <!-- FEATURE 3 -->
            <div class="feature-card">

                <div class="feature-number">
                    03
                </div>

                <div class="feature-image">

                    <i class="bi bi-briefcase"></i>

                </div>

                <i class="bi bi-briefcase feature-icon"></i>

                <h3>

                    Career Focused

                </h3>

                <p>

                    Develop skills that can help you
                    grow professionally.

                </p>

            </div>

            <!-- FEATURE 4 -->
            <div class="feature-card">

                <div class="feature-number">
                    04
                </div>

                <div class="feature-image">

                    <i class="bi bi-headset"></i>

                </div>

                <i class="bi bi-headset feature-icon"></i>

                <h3>

                    Professional Support

                </h3>

                <p>

                    Get guidance and support while
                    learning new skills.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="cta">

    <div class="container">

        <div class="cta-content">

            <div class="section-label">

                Start Learning Today

            </div>

            <h2>

                Ready to Build Your Skills?

            </h2>

            <p>

                Choose the right course and start
                your learning journey with Rudra EduTech.

            </p>

        </div>

    </div>

</section>

</main>

<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    <div class="footer-main">

        <div class="container footer-grid">

            <!-- FOOTER COLUMN 1 -->
            <div class="footer-column">

                <a href="index.php"
                   class="footer-logo">

                    <img src="image/logo.png"
                         alt="Rudra EduTech Logo">

                    <span>

                        Rudra

                        <b>
                            EduTech
                        </b>

                    </span>

                </a>

                <p>

                    Education, technology and digital
                    solutions for students,
                    professionals and businesses.

                </p>

                <div class="social-links">

                    <a href="#"
                       aria-label="Facebook">

                        <i class="bi bi-facebook"></i>

                    </a>

                    <a href="#"
                       aria-label="Instagram">

                        <i class="bi bi-instagram"></i>

                    </a>

                    <a href="#"
                       aria-label="LinkedIn">

                        <i class="bi bi-linkedin"></i>

                    </a>

                    <a href="#"
                       aria-label="YouTube">

                        <i class="bi bi-youtube"></i>

                    </a>

                    <a href="<?php echo e($whatsappLink); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Chat with Rudra EduTech on WhatsApp">

                        <i class="bi bi-whatsapp"></i>

                    </a>

                </div>

            </div>

            <!-- FOOTER COLUMN 2 -->
            <div class="footer-column">

                <h3>
                    Quick Links
                </h3>

                <ul>

                    <li>

                        <a href="index.php">
                            Home
                        </a>

                    </li>

                    <li>

                        <a href="about.php">
                            About Us
                        </a>

                    </li>

                    <li>

                        <a href="course.php">
                            Courses
                        </a>

                    </li>

                    <li>

                        <a href="services.php">
                            Services
                        </a>

                    </li>

                    <li>

                        <a href="contact.php">
                            Contact
                        </a>

                    </li>

                </ul>

            </div>

            <!-- FOOTER COLUMN 3 -->
            <div class="footer-column">

                <h3>
                    Our Courses
                </h3>

                <ul>

                    <li>

                        <a href="#web-development">
                            Web Development
                        </a>

                    </li>

                    <li>

                        <a href="#web-designing">
                            Web Designing
                        </a>

                    </li>

                    <li>

                        <a href="#computer-courses">
                            Computer Courses
                        </a>

                    </li>

                    <li>

                        <a href="#professional-skills">
                            Professional Skills
                        </a>

                    </li>

                </ul>

            </div>

            <!-- FOOTER COLUMN 4 -->
            <div class="footer-column">

                <h3>
                    Contact Us
                </h3>

                <div class="footer-contact">

                   <p>
                    <i class="bi bi-geo-alt"></i>

                    <span>
                        mumbai, India
                    </span>
                    </p>

                    <p>

                        <i class="bi bi-telephone"></i>

                        <a href="tel:+917738699924">

                            +91 7738699924

                        </a>

                    </p>

                    <p>

                        <i class="bi bi-envelope"></i>

                        <a href="mailto:vishalkumar167248@gmail.com">

                            vishalkumar167248@gmail.com

                        </a>

                    </p>

                    <p>

                        <i class="bi bi-whatsapp"></i>

                        <a href="<?php echo e($whatsappLink); ?>"
                           target="_blank"
                           rel="noopener noreferrer">

                            WhatsApp Us

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- =================================================
         FOOTER BOTTOM
    ================================================== -->

    <div class="footer-bottom">

        <div class="container footer-bottom-inner">

            <p>

                © <?php echo date("Y"); ?>

                Rudra EduTech.

                All Rights Reserved.

            </p>

            <p>

                Designed & Developed by Rudra EduTech

            </p>

        </div>

    </div>

</footer>

<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>
"use strict";

const menuToggle = document.getElementById("menuToggle");
const navMenu    = document.getElementById("navMenu");

function closeWelcomeToast() {
    const toast = document.getElementById("welcomeToast");
    if (toast) {
        toast.classList.add("hide");
        setTimeout(function() {
            toast.remove();
            
            const url = new URL(window.location.href);
            if (url.searchParams.has('login_status') || url.searchParams.has('logout_status')) {
                url.searchParams.delete('login_status');
                url.searchParams.delete('logout_status');
                window.history.replaceState({}, document.title, url.pathname);
            }
        }, 500);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const toast = document.getElementById("welcomeToast");
    if (toast) {
        setTimeout(closeWelcomeToast, 4000);
    }
});

function toggleMenu() {
    if (!navMenu || !menuToggle) return;

    const isOpen = navMenu.classList.toggle("active");

    menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    menuToggle.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");

    const icon = menuToggle.querySelector("i");
    if (icon) {
        icon.classList.toggle("bi-list", !isOpen);
        icon.classList.toggle("bi-x-lg", isOpen);
    }
}

if (menuToggle) {
    menuToggle.addEventListener("click", toggleMenu);
}

document.querySelectorAll(".nav-menu a").forEach(function(link) {
    link.addEventListener("click", function() {
        if (!navMenu || !menuToggle) return;

        navMenu.classList.remove("active");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.setAttribute("aria-label", "Open navigation menu");

        const icon = menuToggle.querySelector("i");
        if (icon) {
            icon.classList.remove("bi-x-lg");
            icon.classList.add("bi-list");
        }
    });
});

/* =========================================
   HERO SLIDER
========================================= */

let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const dots   = document.querySelectorAll(".dot");

function showSlide(index) {
    if (!slides.length) return;

    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    slides.forEach(function(slide) {
        slide.classList.remove("active");
    });

    dots.forEach(function(dot) {
        dot.classList.remove("active");
    });

    slides[currentSlide].classList.add("active");

    if (dots[currentSlide]) {
        dots[currentSlide].classList.add("active");
    }
}

function changeSlide(direction) {
    showSlide(currentSlide + direction);
}

function goToSlide(index) {
    showSlide(index);
}

setInterval(function() {
    changeSlide(1);
}, 5000);

let touchStartX = 0;
let touchEndX = 0;

const heroSlider = document.querySelector(".hero-slider");

if (heroSlider) {
    heroSlider.addEventListener("touchstart", function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    heroSlider.addEventListener("touchend", function(e) {
        touchEndX = e.changedTouches[0].screenX;

        if (touchEndX < touchStartX - 50) {
            changeSlide(1);
        }
        if (touchEndX > touchStartX + 50) {
            changeSlide(-1);
        }
    });
}

document.querySelectorAll("img").forEach(function(img) {
    img.addEventListener("error", function() {
        this.style.display = "none";

        if (this.parentElement.classList.contains("card-image")) {
            this.parentElement.classList.add("image-fallback");
        }
    });
});

/* =========================================================
   SCROLL REVEAL & LOADER
========================================================= */

window.addEventListener("load", function () {
    const loader = document.getElementById("courseLoader");
    if (loader) {
        setTimeout(function () {
            loader.classList.add("hide");
        }, 500);
    }
});

const courseRevealElements = document.querySelectorAll(
    ".course-card, .course-detail .about-grid, .course-detail .feature-card, .cta-content"
);

courseRevealElements.forEach(function (element) {
    element.classList.add("reveal");
});

function courseRevealOnScroll() {
    const windowHeight = window.innerHeight;

    courseRevealElements.forEach(function (element) {
        const elementTop = element.getBoundingClientRect().top;

        if (elementTop < windowHeight - 80) {
            element.classList.add("active");
        }
    });
}

window.addEventListener("scroll", courseRevealOnScroll);
courseRevealOnScroll();

if (window.innerWidth > 900) {
    const visual = document.querySelector(".course-detail .about-image");

    if (visual) {
        document.addEventListener("mousemove", function (event) {
            const x = (window.innerWidth / 2 - event.clientX) / 80;
            const y = (window.innerHeight / 2 - event.clientY) / 80;

            visual.style.transform = "perspective(1000px) rotateY(" + x + "deg) rotateX(" + -y + "deg)";
        });

        document.addEventListener("mouseleave", function () {
            visual.style.transform = "perspective(1000px) rotateY(0deg) rotateX(0deg)";
        });
    }
}
</script>

</body>

</html>