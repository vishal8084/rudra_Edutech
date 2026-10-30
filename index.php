<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Rudra EduTech | Education & Digital Solutions";

/*
=========================================================
DATABASE CONNECTION
=========================================================
*/

$db_host = getenv("DB_HOST") ?: "localhost";
$db_user = getenv("DB_USER") ?: "root";
$db_pass = getenv("DB_PASS");
$db_pass = ($db_pass === false) ? "" : $db_pass;
$db_name = getenv("DB_NAME") ?: "rudra_edutech";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (!$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}



$currentPage = basename($_SERVER['PHP_SELF']);


$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

if (isset($_GET['login_status']) && $_GET['login_status'] === 'success' && $isLoggedIn) {
    $adminName = $_SESSION['user_name'] ?? 'Admin';
    $_SESSION['welcome_msg'] = "Welcome back, " . htmlspecialchars($adminName) . "! Logged in successfully.";
} elseif (isset($_GET['logout_status']) && $_GET['logout_status'] === 'success' && !isset($_SESSION['welcome_msg'])) {
    $_SESSION['welcome_msg'] = "You have been logged out successfully.";
}

/*
=========================================================
CONTACT DETAILS
=========================================================
*/

$phone = "7738699924";
$phoneDisplay = "+91 7738699924";

$email = "vishalkumar167248@gmail.com";

$whatsapp = "917738699924";
$whatsappDisplay = "+91 7738699924";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="Rudra EduTech provides quality education, web development, web design, web hosting and professional digital solutions.">

    <meta name="keywords"
          content="Rudra EduTech, education, web development, web design, web hosting, digital solutions, computer courses">

    <meta name="author"
          content="Rudra EduTech">

    <meta name="robots"
          content="index, follow">

    <title>
        <?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>
    </title>


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

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




<div class="topbar">

    <div class="container topbar-inner">

        <div class="top-left">

            <span>

                <i class="bi bi-telephone"
                   aria-hidden="true"></i>

                <a href="tel:+91<?php echo $phone; ?>">

                    <?php echo htmlspecialchars($phoneDisplay); ?>

                </a>

            </span>

            <span>

                <i class="bi bi-envelope"
                   aria-hidden="true"></i>

                <a href="mailto:<?php echo $email; ?>">

                    <?php echo htmlspecialchars($email); ?>

                </a>

            </span>

        </div>


        <!-- SOCIAL LINKS -->

        <div class="top-right">

            <a href="#"
               aria-label="Facebook"
               target="_blank"
               rel="noopener noreferrer">

                <i class="bi bi-facebook"
                   aria-hidden="true"></i>

            </a>

            <a href="#"
               aria-label="Instagram"
               target="_blank"
               rel="noopener noreferrer">

                <i class="bi bi-instagram"
                   aria-hidden="true"></i>

            </a>

            <a href="#"
               aria-label="YouTube"
               target="_blank"
               rel="noopener noreferrer">

                <i class="bi bi-youtube"
                   aria-hidden="true"></i>

            </a>

            <a href="https://wa.me/<?php echo $whatsapp; ?>"
               aria-label="WhatsApp"
               target="_blank"
               rel="noopener noreferrer">

                <i class="bi bi-whatsapp"
                   aria-hidden="true"></i>

            </a>

        </div>

    </div>

</div>





<header class="header">

    <div class="container nav-container">

        <a href="index.php"
           class="logo"
           aria-label="Rudra EduTech Home">

            <div class="logo-image">

                <img src="image/logo.png"
                     alt="Rudra EduTech Logo"
                     loading="eager">

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

        <button
            type="button"
            class="menu-toggle"
            id="menuToggle"
            aria-label="Open navigation menu"
            aria-controls="navMenu"
            aria-expanded="false">

            <i class="bi bi-list"
               aria-hidden="true"></i>

        </button>


        <nav aria-label="Main Navigation">

            <ul class="nav-menu"
                id="navMenu">

                <li>

                    <a href="index.php"
                       class="<?php echo ($currentPage === 'index.php') ? 'active' : ''; ?>">

                        Home

                    </a>

                </li>

                <li>

                    <a href="about.php"
                       class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">

                        About Us

                    </a>

                </li>

                <li>

                    <a href="course.php"
                       class="<?php echo ($currentPage === 'course.php') ? 'active' : ''; ?>">

                        Courses

                    </a>

                </li>

                <li>

                    <a href="services.php"
                       class="<?php echo ($currentPage === 'services.php') ? 'active' : ''; ?>">

                        Services

                    </a>

                </li>

                <li>

                    <a href="client.php"
                       class="<?php echo ($currentPage === 'client.php') ? 'active' : ''; ?>">

                        Clients

                    </a>

                </li>

                <li>

                    <?php if ($isLoggedIn): ?>
                            <a href="manage_gallery.php"
                               class="<?php echo ($currentPage === 'manage_gallery.php') ? 'active' : ''; ?>">

                            Gallery

                        </a>
                    <?php else: ?>
                        <a href="gallery.php">

                            Gallery

                        </a>
                    <?php endif; ?>

                </li>

                <li>

                    <a href="testimonials.php">

                        Testimonials

                    </a>

                </li>

                <li>

                     <a href="Blog.php"
                        class="<?php echo ($currentPage === 'Blog.php') ? 'active' : ''; ?>">
                        

                        Blog

                    </a>

                </li>

                <li>

                    <a href="contact.php"
                       class="nav-button">

                        Contact

                        <i class="bi bi-arrow-up-right"
                           aria-hidden="true"></i>

                    </a>

                </li>

                <!-- LOGIN / LOGOUT BUTTON -->
                <li class="nav-auth-item">

                    <?php if ($isLoggedIn): ?>

                        <a href="logout.php"
                           class="nav-auth-btn logout-btn"
                           title="Logout">

                            <i class="bi bi-box-arrow-right"
                               aria-hidden="true"></i>

                            <span>Logout</span>

                        </a>

                    <?php else: ?>

                        <a href="login.php"
                           class="nav-auth-btn login-btn"
                           title="Login">

                            <i class="bi bi-person-lock"
                               aria-hidden="true"></i>

                            <span>Login</span>

                        </a>

                    <?php endif; ?>

                </li>

            </ul>

        </nav>

    </div>

</header>


<main>

<!-- =========================================================
     HERO SECTION
========================================================= -->

<section class="hero"
         id="home"
         aria-label="Rudra EduTech introduction">

    <div class="container hero-grid">

        <div class="hero-content">

            <div class="hero-badge">

                <i class="bi bi-stars"
                   aria-hidden="true"></i>

                Welcome to Rudra EduTech

            </div>

            <h1>

                Learn.

                <span>

                    Create.

                </span>

                Grow.

            </h1>

            <p>

                Empowering students, professionals and
                businesses with quality education,
                modern technology and professional
                digital solutions.

            </p>

            <div class="hero-buttons">

                <a href="course.php"
                   class="btn btn-primary">

                    Explore Courses

                    <i class="bi bi-arrow-right"
                       aria-hidden="true"></i>

                </a>

                <a href="services.php"
                   class="btn btn-secondary">

                    Our Services

                    <i class="bi bi-arrow-right"
                       aria-hidden="true"></i>

                </a>

            </div>

            <div class="hero-points">

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Practical Learning

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Modern Technology

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Professional Support

                </div>

            </div>

        </div>

        <div class="hero-card">

            <div class="hero-slider"
                 id="heroSlider">

                <!-- SLIDE 1 -->

                <div class="slide active">

                    <img src="image/slide1.jpg"
                         alt="Education and Technology"
                         loading="eager">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-mortarboard-fill"
                               aria-hidden="true"></i>

                        </span>

                        <h2>

                            Learn

                            <small>

                                Build Your Future

                            </small>

                        </h2>

                        <p>

                            Learn practical skills with
                            modern technology.

                        </p>

                    </div>

                </div>

                <!-- SLIDE 2 -->

                <div class="slide">

                    <img src="image/slide2.jpg"
                         alt="Web Development"
                         loading="lazy">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-code-slash"
                               aria-hidden="true"></i>

                        </span>

                        <h2>

                            Create

                            <small>

                                Build Amazing Websites

                            </small>

                        </h2>

                        <p>

                            Turn your ideas into professional
                            digital solutions.

                        </p>

                    </div>

                </div>

                <!-- SLIDE 3 -->

                <div class="slide">

                    <img src="image/slide3.jpg"
                         alt="Digital Technology"
                         loading="lazy">

                    <div class="slide-overlay"></div>

                    <div class="slide-content">

                        <span>

                            <i class="bi bi-cpu-fill"
                               aria-hidden="true"></i>

                        </span>

                        <h2>

                            Grow

                            <small>

                                Grow With Technology

                            </small>

                        </h2>

                        <p>

                            Improve your skills and
                            achieve your goals.

                        </p>

                    </div>

                </div>

                <!-- PREVIOUS -->

                <button
                    type="button"
                    class="slider-arrow slider-prev"
                    id="sliderPrev"
                    aria-label="Previous slide">

                    <i class="bi bi-chevron-left"
                       aria-hidden="true"></i>

                </button>

                <!-- NEXT -->

                <button
                    type="button"
                    class="slider-arrow slider-next"
                    id="sliderNext"
                    aria-label="Next slide">

                    <i class="bi bi-chevron-right"
                       aria-hidden="true"></i>

                </button>

                <div class="slider-dots"
                     role="tablist"
                     aria-label="Hero slides">

                    <button
                        type="button"
                        class="dot active"
                        data-slide="0"
                        aria-label="Go to slide 1"
                        aria-selected="true">
                    </button>

                    <button
                        type="button"
                        class="dot"
                        data-slide="1"
                        aria-label="Go to slide 2"
                        aria-selected="false">
                    </button>

                    <button
                        type="button"
                        class="dot"
                        data-slide="2"
                        aria-label="Go to slide 3"
                        aria-selected="false">
                    </button>

                </div>

            </div>

            <!--  CARD 1 -->

            <div class="floating-card floating-one">

                <i class="bi bi-code-slash"
                   aria-hidden="true"></i>

                <div>

                    <strong>

                        Web Development

                    </strong>

                    <small>

                        Professional Skills

                    </small>

                </div>

            </div>

            <!--  CARD 2 -->

            <div class="floating-card floating-two">

                <i class="bi bi-palette"
                   aria-hidden="true"></i>

                <div>

                    <strong>

                        Web Design

                    </strong>

                    <small>

                        Creative Solutions

                    </small>

                </div>

            </div>

        </div>

    </div>

</section>




<!--
     ABOUT SECTION
 -->

<section class="section"
         id="about">

    <div class="container about-grid">

        <div class="about-image">

            <div class="about-image-inner">

                <i class="bi bi-mortarboard-fill"
                   aria-hidden="true"></i>

                <h3>

                    Rudra EduTech

                </h3>

                <p>

                    Learn • Create • Grow

                </p>

            </div>

        </div>

        <div class="about-content">

            <div class="section-label">

                About Us

            </div>

            <h2>

                We Help You Learn,
                Create & Grow

            </h2>

            <p>

                Rudra EduTech is focused on providing
                quality education, technology training
                and professional digital solutions.

            </p>

            <p>

                We believe in practical learning and
                modern technology so that students,
                professionals and businesses can achieve
                their goals.

            </p>

            <div class="about-list">

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Quality Education

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Practical Skills

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Modern Technology

                </div>

                <div>

                    <i class="bi bi-check-circle-fill"
                       aria-hidden="true"></i>

                    Professional Services

                </div>

            </div>

            <a href="contact.php"
               class="btn btn-primary">

                Get In Touch

                <i class="bi bi-arrow-right"
                   aria-hidden="true"></i>

            </a>

        </div>

    </div>

</section>




<!-- =========================================================
     COURSES SECTION
========================================================= -->

<section class="section light-section"
         id="courses">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Our Courses

            </div>

            <h2>

                Learn Skills That Matter

            </h2>

            <p>

                Develop practical skills and build
                confidence for your career.

            </p>

        </div>

        <div class="cards-grid">

           

            <article class="course-card">

                <div class="card-image">

                    <img src="image/course-web.jpg"
                         alt="Web Development Course"
                         loading="lazy">

                    <div class="card-image-icon">

                        <i class="bi bi-code-slash"
                           aria-hidden="true"></i>

                    </div>

                </div>

                <div class="card-body">

                    <div class="card-icon blue">

                        <i class="bi bi-code-slash"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Web Development

                    </h3>

                    <p>

                        Learn HTML, CSS, JavaScript, PHP,
                        databases and modern web development.

                    </p>

                    <a href="course.php">

                        Learn More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>


            <article class="course-card">

                <div class="card-image">

                    <img src="image/course-design.jpg"
                         alt="Web Designing Course"
                         loading="lazy">

                    <div class="card-image-icon">

                        <i class="bi bi-palette"
                           aria-hidden="true"></i>

                    </div>

                </div>

                <div class="card-body">

                    <div class="card-icon purple">

                        <i class="bi bi-palette"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Web Designing

                    </h3>

                    <p>

                        Learn modern UI design, responsive
                        layouts and professional website design.

                    </p>

                    <a href="course.php">

                        Learn More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>


            <article class="course-card">

                <div class="card-image">

                    <img src="image/course-computer.jpg"
                         alt="Computer Course"
                         loading="lazy">

                    <div class="card-image-icon">

                        <i class="bi bi-pc-display"
                           aria-hidden="true"></i>

                    </div>

                </div>

                <div class="card-body">

                    <div class="card-icon green">

                        <i class="bi bi-pc-display"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Computer Courses

                    </h3>

                    <p>

                        Develop essential computer and
                        digital skills for your career.

                    </p>

                    <a href="course.php">

                        Learn More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>

         

            <article class="course-card">

                <div class="card-image">

                    <img src="image/course-skills.jpg"
                         alt="Professional Skills Course"
                         loading="lazy">

                    <div class="card-image-icon">

                        <i class="bi bi-file-earmark-text"
                           aria-hidden="true"></i>

                    </div>

                </div>

                <div class="card-body">

                    <div class="card-icon orange">

                        <i class="bi bi-file-earmark-text"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Professional Skills

                    </h3>

                    <p>

                        Improve your digital knowledge and
                        professional skills.

                    </p>

                    <a href="course.php">

                        Learn More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>

        </div>

    </div>

</section>




<!-- =========================================================
     SERVICES SECTION
========================================================= -->

<section class="section"
         id="services">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Our Services

            </div>

            <h2>

                Professional Digital Services

            </h2>

            <p>

                We provide modern, affordable and
                professional digital solutions for
                individuals and businesses.

            </p>

        </div>

        <div class="services-grid">


            <article class="service-card">

                <div class="service-image">

                    <img src="image/service-development.jpg"
                         alt="Web Development Service"
                         loading="lazy">

                </div>

                <div class="service-body">

                    <div class="service-icon">

                        <i class="bi bi-lightning-charge"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Web Development

                    </h3>

                    <p>

                        We produce visually attractive,
                        innovative and professional websites
                        designed according to your business
                        requirements and brand identity.

                    </p>

                    <div class="service-links">

                        <a href="services.php">

                            Learn More

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                        <a href="services.php">

                            Get Service

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                    </div>

                </div>

            </article>

            

            <article class="service-card">

                <div class="service-image">

                    <img src="image/service-design.jpg"
                         alt="Web Design Service"
                         loading="lazy">

                </div>

                <div class="service-body">

                    <div class="service-icon">

                        <i class="bi bi-award"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Web Design

                    </h3>

                    <p>

                        Our web designers create modern,
                        responsive and user-friendly layouts
                        based on your website's look, feel,
                        functionality and business requirements.

                    </p>

                    <div class="service-links">

                        <a href="services.php">

                            Learn More

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                        <a href="services.php">

                            Get Service

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                    </div>

                </div>

            </article>

           
            <article class="service-card">

                <div class="service-image">

                    <img src="image/service-hosting.jpg"
                         alt="Web Hosting Service"
                         loading="lazy">

                </div>

                <div class="service-body">

                    <div class="service-icon">

                        <i class="bi bi-gem"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Web Hosting

                    </h3>

                    <p>

                        Reliable web hosting services designed
                        for different business requirements.
                        We provide affordable and practical
                        hosting solutions for your website.

                    </p>

                    <div class="service-links">

                        <a href="services.php">

                            Learn More

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                        <a href="services.php">

                            Get Service

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                    </div>

                </div>

            </article>

           

            <article class="service-card">

                <div class="service-image">

                    <img src="image/service-digital.jpg"
                         alt="Digital Solutions Service"
                         loading="lazy">

                </div>

                <div class="service-body">

                    <div class="service-icon">

                        <i class="bi bi-globe2"
                           aria-hidden="true"></i>

                    </div>

                    <h3>

                        Digital Solutions

                    </h3>

                    <p>

                        Reliable digital solutions to help
                        your business establish a strong
                        online presence with modern and
                        professional technology.

                    </p>

                    <div class="service-links">

                        <a href="services.php">

                            Learn More

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                        <a href="services.php">

                            Get Service

                            <i class="bi bi-arrow-right"
                               aria-hidden="true"></i>

                        </a>

                    </div>

                </div>

            </article>

        </div>

    </div>

</section>




<!-- =========================================================
     WHY CHOOSE US
========================================================= -->

<section class="section light-section">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Why Choose Us

            </div>

            <h2>

                Why Rudra EduTech?

            </h2>

        </div>

        <div class="features-grid">

         

            <article class="feature-card">

                <div class="feature-number">

                    01

                </div>

                <div class="feature-image">

                    <i class="bi bi-award"
                       aria-hidden="true"></i>

                </div>

                <i class="bi bi-award feature-icon"
                   aria-hidden="true"></i>

                <h3>

                    Quality

                </h3>

                <p>

                    We focus on quality education and
                    professional digital solutions.

                </p>

            </article>

           

            <article class="feature-card">

                <div class="feature-number">

                    02

                </div>

                <div class="feature-image">

                    <i class="bi bi-lightbulb"
                       aria-hidden="true"></i>

                </div>

                <i class="bi bi-lightbulb feature-icon"
                   aria-hidden="true"></i>

                <h3>

                    Practical Learning

                </h3>

                <p>

                    Learn useful skills through
                    practical knowledge and projects.

                </p>

            </article>

           

            <article class="feature-card">

                <div class="feature-number">

                    03

                </div>

                <div class="feature-image">

                    <i class="bi bi-cpu"
                       aria-hidden="true"></i>

                </div>

                <i class="bi bi-cpu feature-icon"
                   aria-hidden="true"></i>

                <h3>

                    Modern Technology

                </h3>

                <p>

                    We use modern technologies to
                    create better solutions.

                </p>

            </article>


            <article class="feature-card">

                <div class="feature-number">

                    04

                </div>

                <div class="feature-image">

                    <i class="bi bi-headset"
                       aria-hidden="true"></i>

                </div>

                <i class="bi bi-headset feature-icon"
                   aria-hidden="true"></i>

                <h3>

                    Support

                </h3>

                <p>

                    Get reliable support whenever
                    you need assistance.

                </p>

            </article>

        </div>

    </div>

</section>




<!-- =========================================================
     CLIENTS SECTION
========================================================= -->

<section class="section"
         id="clients">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Our Clients

            </div>

            <h2>

                Trusted By Our Clients

            </h2>

            <p>

                We work with individuals, students and
                businesses to create better solutions.

            </p>

        </div>

        <div class="clients-grid">

            <?php for ($i = 1; $i <= 6; $i++): ?>

                <div class="client-box">

                    <div class="client-image">

                        <i class="bi bi-building"
                           aria-hidden="true"></i>

                    </div>

                    Client

                    <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>

                </div>

            <?php endfor; ?>

        </div>

    </div>

</section>






<section class="section light-section"
         id="gallery">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Gallery

            </div>

            <h2>

                Our Gallery

            </h2>

            <p>

                Some moments and activities from
                Rudra EduTech.

            </p>

            <!-- UPLOAD / MANAGE BUTTON FOR LOGGED-IN ADMIN -->
            <?php if ($isLoggedIn): ?>
                <div>
                    <a href="manage_gallery.php" class="btn btn-primary">
                        <i class="bi bi-cloud-arrow-up-fill" aria-hidden="true"></i> Upload Images
                    </a>
                </div>
            <?php endif; ?>

        </div>

        <div class="gallery-grid">

            <?php
            // Fetch gallery records from Database
            if (isset($conn) && !$conn->connect_error) {
                $galleryQuery = "SELECT * FROM gallery ORDER BY id DESC";
                $galleryResult = $conn->query($galleryQuery);
            } else {
                $galleryResult = false;
            }

            if ($galleryResult && $galleryResult->num_rows > 0):
                while ($item = $galleryResult->fetch_assoc()):
            ?>
                <div class="gallery-item">

                    <img
                        src="uploads/gallery/<?php echo htmlspecialchars($item['image']); ?>"
                        alt="<?php echo htmlspecialchars($item['title']); ?>"
                        loading="lazy"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Image+Not+Found';">

                    <div class="gallery-overlay">

                        <i class="bi bi-zoom-in" aria-hidden="true"></i>

                        <span>
                            <?php echo htmlspecialchars($item['title']); ?>
                        </span>

                        <small>
                            <?php echo htmlspecialchars($item['category']); ?>
                        </small>

                    </div>

                </div>
            <?php 
                endwhile;
            else:
            ?>
               
                <div>
                    <i class="bi bi-images" aria-hidden="true"></i>
                    <p>No gallery images uploaded yet.</p>
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>




<!-- =========================================================
     TESTIMONIALS SECTION
========================================================= -->

<section class="section"
         id="testimonials">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Testimonials

            </div>

            <h2>

                What People Say

            </h2>

        </div>

        <div class="cards-grid">

          

            <article class="testimonial-card">

                <div class="testimonial-image">

                    <i class="bi bi-person-fill"
                       aria-hidden="true"></i>

                </div>

                <div class="stars"
                     aria-label="5 out of 5 stars">

                    ★★★★★

                </div>

                <p>

                    "Very good learning experience and
                    professional support."

                </p>

                <div class="testimonial-user">

                    <div class="user-icon">

                        <i class="bi bi-person"
                           aria-hidden="true"></i>

                    </div>

                    <div>

                        <strong>

                            Student Name

                        </strong>

                        <small>

                            Student

                        </small>

                    </div>

                </div>

            </article>

           

            <article class="testimonial-card">

                <div class="testimonial-image">

                    <i class="bi bi-person-fill"
                       aria-hidden="true"></i>

                </div>

                <div class="stars"
                     aria-label="5 out of 5 stars">

                    ★★★★★

                </div>

                <p>

                    "Excellent web development and
                    digital service."

                </p>

                <div class="testimonial-user">

                    <div class="user-icon">

                        <i class="bi bi-person"
                           aria-hidden="true"></i>

                    </div>

                    <div>

                        <strong>

                            Client Name

                        </strong>

                        <small>

                            Client

                        </small>

                    </div>

                </div>

            </article>

           

            <article class="testimonial-card">

                <div class="testimonial-image">

                    <i class="bi bi-person-fill"
                       aria-hidden="true"></i>

                </div>

                <div class="stars"
                     aria-label="5 out of 5 stars">

                    ★★★★★

                </div>

                <p>

                    "Excellent web development and
                    digital service."

                </p>

                <div class="testimonial-user">

                    <div class="user-icon">

                        <i class="bi bi-person"
                           aria-hidden="true"></i>

                    </div>

                    <div>

                        <strong>

                            Client Name

                        </strong>

                        <small>

                            Client

                        </small>

                    </div>

                </div>

            </article>

           

            <article class="testimonial-card">

                <div class="testimonial-image">

                    <i class="bi bi-person-fill"
                       aria-hidden="true"></i>

                </div>

                <div class="stars"
                     aria-label="5 out of 5 stars">

                    ★★★★★

                </div>

                <p>

                    "Professional, helpful and reliable
                    service."

                </p>

                <div class="testimonial-user">

                    <div class="user-icon">

                        <i class="bi bi-person"
                           aria-hidden="true"></i>

                    </div>

                    <div>

                        <strong>

                            Customer Name

                        </strong>

                        <small>

                            Customer

                        </small>

                    </div>

                </div>

            </article>

        </div>

    </div>

</section>




<!-- =========================================================
     BLOG SECTION
========================================================= -->

<section class="section light-section"
         id="blog">

    <div class="container">

        <div class="section-heading">

            <div class="section-label">

                Blog

            </div>

            <h2>

                Latest Articles & Updates

            </h2>

        </div>

        <div class="cards-grid">

            <!-- BLOG 1 -->

            <article class="blog-card">

                <div class="blog-image">

                    <i class="bi bi-code-slash"
                       aria-hidden="true"></i>

                </div>

                <div class="blog-content">

                    <span>

                        Web Development

                    </span>

                    <h3>

                        Why Learn Web Development?

                    </h3>

                    <p>

                        Discover why web development is
                        an important modern career skill.

                    </p>

                    <a href="#">

                        Read More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>

            <!-- BLOG 2 -->

            <article class="blog-card">

                <div class="blog-image">

                    <i class="bi bi-palette"
                       aria-hidden="true"></i>

                </div>

                <div class="blog-content">

                    <span>

                        Web Design

                    </span>

                    <h3>

                        Importance of Modern Web Design

                    </h3>

                    <p>

                        Learn why responsive and modern
                        website design matters.

                    </p>

                    <a href="#">

                        Read More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>

            <!-- BLOG 3 -->

            <article class="blog-card">

                <div class="blog-image">

                    <i class="bi bi-globe"
                       aria-hidden="true"></i>

                </div>

                <div class="blog-content">

                    <span>

                        Digital

                    </span>

                    <h3>

                        Grow Your Online Presence

                    </h3>

                    <p>

                        Build a strong online presence
                        for your business.

                    </p>

                    <a href="#">

                        Read More

                        <i class="bi bi-arrow-right"
                           aria-hidden="true"></i>

                    </a>

                </div>

            </article>

        </div>

    </div>

</section>





<section class="cta">

    <div class="container">

        <div class="cta-content">

            <div class="section-label">

                Let's Work Together

            </div>

            <h2>

                Ready to Learn or
                Build Something Amazing?

            </h2>

            <p>

                Contact Rudra EduTech today and
                let's discuss your requirements.

            </p>

            <a href="contact.php"
               class="btn btn-white">

                Contact Us

                <i class="bi bi-arrow-right"
                   aria-hidden="true"></i>

            </a>

        </div>

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

                <a href="index.php"
                   class="footer-logo"
                   aria-label="Rudra EduTech Home">

                    <img src="image/logo.png"
                         alt="Rudra EduTech Logo"
                         loading="lazy">

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

                <!-- SOCIAL LINKS -->

                <div class="social-links">

                    <a href="#"
                       aria-label="Facebook"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-facebook"
                           aria-hidden="true"></i>

                    </a>

                    <a href="#"
                       aria-label="Instagram"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-instagram"
                           aria-hidden="true"></i>

                    </a>

                    <a href="#"
                       aria-label="LinkedIn"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-linkedin"
                           aria-hidden="true"></i>

                    </a>

                    <a href="#"
                       aria-label="YouTube"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-youtube"
                           aria-hidden="true"></i>

                    </a>

                    <a href="https://wa.me/<?php echo $whatsapp; ?>"
                       aria-label="WhatsApp"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-whatsapp"
                           aria-hidden="true"></i>

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

                    Our Services

                </h3>

                <ul>

                    <li>

                        <a href="services.php">

                            Web Development

                        </a>

                    </li>

                    <li>

                        <a href="services.php">

                            Web Design

                        </a>

                    </li>

                    <li>

                        <a href="services.php">

                            Web Hosting

                        </a>

                    </li>

                    <li>

                        <a href="services.php">

                            Digital Solutions

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

                        <i class="bi bi-geo-alt"
                           aria-hidden="true"></i>

                        <span>
                        mumbai, India
                    </span>

                    </p>

                    
                    <p>

                        <i class="bi bi-telephone"
                           aria-hidden="true"></i>

                        <a href="tel:+91<?php echo $phone; ?>">

                            <?php echo htmlspecialchars($phoneDisplay); ?>

                        </a>

                    </p>

               

                    <p>

                        <i class="bi bi-envelope"
                           aria-hidden="true"></i>

                        <a href="mailto:<?php echo $email; ?>">

                            <?php echo htmlspecialchars($email); ?>

                        </a>

                    </p>

                   

                    <p>

                        <i class="bi bi-whatsapp"
                           aria-hidden="true"></i>

                        <a href="https://wa.me/<?php echo $whatsapp; ?>"
                           target="_blank"
                           rel="noopener noreferrer">

                            <?php echo htmlspecialchars($whatsappDisplay); ?>

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="footer-bottom">

        <div class="container footer-bottom-inner">

            <p>

                &copy;

                <?php echo date("Y"); ?>

                Rudra EduTech.

                All Rights Reserved.

            </p>

            <p>

                Designed &amp; Developed by
                Rudra EduTech

            </p>

        </div>

    </div>

</footer>




<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

"use strict";




const menuToggle =
    document.getElementById("menuToggle");


const navMenu =
    document.getElementById("navMenu");


const heroSlider =
    document.getElementById("heroSlider");


const slides =
    document.querySelectorAll(".slide");


const dots =
    document.querySelectorAll(".dot");


const sliderPrev =
    document.getElementById("sliderPrev");


const sliderNext =
    document.getElementById("sliderNext");


const navLinks =
    document.querySelectorAll(".nav-menu a");




function closeWelcomeToast() {
    const toast = document.getElementById("welcomeToast");
    if (toast) {
        toast.classList.add("hide");
        setTimeout(function() {
            toast.remove();
            
            // Clean up the URL parameters without reloading page
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


/* =========================================================
   MOBILE MENU
========================================================= */

function toggleMenu() {

    if (!navMenu || !menuToggle) {

        return;

    }


    const isOpen =
        navMenu.classList.toggle("active");


    menuToggle.setAttribute(
        "aria-expanded",
        isOpen ? "true" : "false"
    );


    menuToggle.setAttribute(
        "aria-label",
        isOpen
            ? "Close navigation menu"
            : "Open navigation menu"
    );


    const icon =
        menuToggle.querySelector("i");


    if (icon) {

        icon.classList.toggle(
            "bi-list",
            !isOpen
        );


        icon.classList.toggle(
            "bi-x-lg",
            isOpen
        );

    }

}


if (menuToggle) {

    menuToggle.addEventListener(
        "click",
        toggleMenu
    );

}


/* =========================================================
   CLOSE MOBILE MENU AFTER CLICK
========================================================= */

navLinks.forEach(function(link) {

    link.addEventListener(
        "click",
        function() {

            if (!navMenu || !menuToggle) {

                return;

            }


            navMenu.classList.remove("active");


            menuToggle.setAttribute(
                "aria-expanded",
                "false"
            );


            menuToggle.setAttribute(
                "aria-label",
                "Open navigation menu"
            );


            const icon =
                menuToggle.querySelector("i");


            if (icon) {

                icon.classList.remove(
                    "bi-x-lg"
                );


                icon.classList.add(
                    "bi-list"
                );

            }

        }
    );

});




document.addEventListener(
    "click",
    function(event) {

        if (!navMenu || !menuToggle) {

            return;

        }


        const clickedInsideMenu =
            navMenu.contains(event.target);


        const clickedToggle =
            menuToggle.contains(event.target);


        if (
            !clickedInsideMenu &&
            !clickedToggle
        ) {

            navMenu.classList.remove("active");


            menuToggle.setAttribute(
                "aria-expanded",
                "false"
            );


            menuToggle.setAttribute(
                "aria-label",
                "Open navigation menu"
            );


            const icon =
                menuToggle.querySelector("i");


            if (icon) {

                icon.classList.remove(
                    "bi-x-lg"
                );


                icon.classList.add(
                    "bi-list"
                );

            }

        }

    }
);



let currentSlide = 0;

let autoSlideInterval = null;

let touchStartX = 0;

let touchEndX = 0;




function showSlide(index) {

    if (!slides.length) {

        return;

    }


    if (index >= slides.length) {

        currentSlide = 0;

    }

    else if (index < 0) {

        currentSlide =
            slides.length - 1;

    }

    else {

        currentSlide = index;

    }


    slides.forEach(
        function(slide, slideIndex) {

            slide.classList.toggle(
                "active",
                slideIndex === currentSlide
            );

        }
    );


    dots.forEach(
        function(dot, dotIndex) {

            const isActive =
                dotIndex === currentSlide;


            dot.classList.toggle(
                "active",
                isActive
            );


            dot.setAttribute(
                "aria-selected",
                isActive ? "true" : "false"
            );

        }
    );

}



function changeSlide(direction) {

    showSlide(
        currentSlide + direction
    );

}




function goToSlide(index) {

    showSlide(index);

}



if (sliderPrev) {

    sliderPrev.addEventListener(
        "click",
        function() {

            changeSlide(-1);

            restartAutoSlide();

        }
    );

}



if (sliderNext) {

    sliderNext.addEventListener(
        "click",
        function() {

            changeSlide(1);

            restartAutoSlide();

        }
    );

}



dots.forEach(function(dot) {

    dot.addEventListener(
        "click",
        function() {

            const slideIndex =
                parseInt(
                    dot.getAttribute("data-slide"),
                    10
                );


            if (!Number.isNaN(slideIndex)) {

                goToSlide(slideIndex);

                restartAutoSlide();

            }

        }
    );

});



function startAutoSlide() {

    if (slides.length <= 1) {

        return;

    }


    autoSlideInterval =
        setInterval(
            function() {

                changeSlide(1);

            },
            5000
        );

}




function restartAutoSlide() {

    if (autoSlideInterval) {

        clearInterval(
            autoSlideInterval
        );

    }


    startAutoSlide();

}



if (heroSlider) {

    heroSlider.addEventListener(
        "mouseenter",
        function() {

            if (autoSlideInterval) {

                clearInterval(
                    autoSlideInterval
                );

            }

        }
    );


    heroSlider.addEventListener(
        "mouseleave",
        function() {

            startAutoSlide();

        }
    );

}



if (heroSlider) {

    heroSlider.addEventListener(
        "touchstart",
        function(event) {

            touchStartX =
                event.changedTouches[0].screenX;

        },
        {
            passive: true
        }
    );


    heroSlider.addEventListener(
        "touchend",
        function(event) {

            touchEndX =
                event.changedTouches[0].screenX;


            const swipeDistance =
                touchEndX - touchStartX;


            if (Math.abs(swipeDistance) < 50) {

                return;

            }


            if (swipeDistance < 0) {

                changeSlide(1);

            }

            else {

                changeSlide(-1);

            }


            restartAutoSlide();

        },
        {
            passive: true
        }
    );

}




document.addEventListener(
    "keydown",
    function(event) {

        if (
            event.key === "ArrowLeft" &&
            document.activeElement !==
            document.body
        ) {

            return;

        }


        if (event.key === "ArrowLeft") {

            changeSlide(-1);

            restartAutoSlide();

        }


        if (event.key === "ArrowRight") {

            changeSlide(1);

            restartAutoSlide();

        }

    }
);




const allImages =
    document.querySelectorAll("img");


allImages.forEach(function(img) {

    img.addEventListener(
        "error",
        function() {

            this.classList.add(
                "image-error"
            );


            this.setAttribute(
                "alt",
                "Image unavailable"
            );


            const parent =
                this.parentElement;


            if (!parent) {

                return;

            }


            if (
                parent.classList.contains(
                    "card-image"
                ) ||
                parent.classList.contains(
                    "service-image"
                ) ||
                parent.classList.contains(
                    "gallery-item"
                ) ||
                parent.classList.contains(
                    "logo-image"
                ) ||
                parent.classList.contains(
                    "footer-logo"
                )
            ) {

                parent.classList.add(
                    "image-fallback"
                );

            }

        }
    );

});



showSlide(0);

startAutoSlide();

</script>

</body>

</html>