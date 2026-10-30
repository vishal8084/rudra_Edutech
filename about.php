<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "About Us | Rudra EduTech";
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

$phone        = "7738699924";
$phoneDisplay = "+91 7738699924";
$email        = "vishalkumar167248@gmail.com";
$whatsapp     = "917738699924";
$whatsappDisplay = "+91 7738699924";

$whatsappMessage =
    "Hello Rudra EduTech, I would like to know more about your services.";

$whatsappLink =
    "https://wa.me/" . $whatsapp . "?text=" . rawurlencode($whatsappMessage);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Learn more about Rudra EduTech, our mission, vision, approach and commitment to quality education, practical learning and career growth[cite: 8]."
    >

    <meta
        name="keywords"
        content="Rudra EduTech, About Rudra EduTech, Education, Web Development, Web Design, Computer Courses, Digital Solutions[cite: 8]"
    >

    <meta
        name="theme-color"
        content="#2563eb"
    >

    <title><?php echo htmlspecialchars($pageTitle); ?></title>


    <!-- =====================================================
         GOOGLE FONTS
    ====================================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


   

    <link
        rel="icon"
        type="image/jpeg"
        href="image/logo.jpeg"
    >

    <!-- WEBSITE CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">




    <style>



        html {
            scroll-behavior: smooth;
        }



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




        .about-page-hero {

            min-height: 520px;

            display: flex;
            align-items: center;

            position: relative;

            overflow: hidden;

            padding: 100px 20px;

            background:

                radial-gradient(
                    circle at 10% 20%,
                    rgba(37, 99, 235, .12),
                    transparent 35%
                ),

                radial-gradient(
                    circle at 90% 80%,
                    rgba(124, 58, 237, .12),
                    transparent 35%
                );
        }


        .about-page-hero::before {

            content: "";

            position: absolute;

            width: 420px;
            height: 420px;

            border-radius: 50%;

            border: 1px solid rgba(37, 99, 235, .12);

            top: -180px;
            right: -120px;

            animation:
                rotateCircle 18s linear infinite;
        }


        .about-page-hero::after {

            content: "";

            position: absolute;

            width: 280px;
            height: 280px;

            border-radius: 50%;

            border: 1px solid rgba(124, 58, 237, .12);

            bottom: -130px;
            left: -100px;

            animation:
                rotateCircleReverse 15s linear infinite;
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


        .about-hero-content {

            max-width: 900px;

            margin: auto;

            text-align: center;

            position: relative;

            z-index: 2;
        }


        .about-hero-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 9px 18px;

            border-radius: 50px;

            background: rgba(37, 99, 235, .09);

            color: var(--primary);

            font-weight: 700;

            font-size: 13px;

            letter-spacing: 1.5px;

            margin-bottom: 20px;

            animation:
                fadeDown .8s ease forwards;
        }


        .about-hero-content h1 {

            font-family: "Poppins", sans-serif;

            font-size:
                clamp(38px, 6vw, 70px);

            line-height: 1.08;

            margin:
                0 auto 22px;

            font-weight: 800;

            animation:
                fadeUp .9s ease .1s both;
        }


        .about-hero-content h1 span {

            display: block;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;
        }


        .about-hero-content p {

            max-width: 800px;

            margin: auto;

            font-size: 16px;

            line-height: 1.8;

            color: var(--text);

            animation:
                fadeUp .9s ease .2s both;
        }


        /* =========================================================
           ANIMATIONS
        ========================================================= */

        @keyframes fadeUp {

            from {

                opacity: 0;

                transform:
                    translateY(35px);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0);
            }

        }


        @keyframes fadeDown {

            from {

                opacity: 0;

                transform:
                    translateY(-25px);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0);
            }

        }


        .reveal {

            opacity: 0;

            transform:
                translateY(45px);

            transition:

                opacity .8s ease,

                transform .8s ease;
        }


        .reveal.active {

            opacity: 1;

            transform:
                translateY(0);
        }



        .about-details {

            padding:
                100px 20px;
        }


        .about-details-grid {

            max-width: 1180px;

            margin: auto;

            display: grid;

            grid-template-columns:
                .9fr 1.1fr;

            gap: 70px;

            align-items: center;
        }


        /* =========================================================
           ABOUT 
        ========================================================= */

        .about-visual {

            min-height: 450px;

            border-radius: 28px;

            position: relative;

            overflow: hidden;

            background:

                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            box-shadow:
                0 25px 70px rgba(15, 23, 42, .15);

            display: flex;

            align-items: center;

            justify-content: center;

            transition:
                transform .25s ease;
        }


        .about-visual::before {

            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            border:
                1px solid rgba(255,255,255,.2);

            animation:
                rotateCircle 20s linear infinite;
        }


        .about-visual::after {

            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            border:
                1px solid rgba(255,255,255,.2);

            animation:
                rotateCircleReverse 15s linear infinite;
        }


        .about-visual-inner {

            text-align: center;

            color: #fff;

            position: relative;

            z-index: 2;
        }


        .about-visual-inner i {

            width: 100px;
            height: 100px;

            border-radius: 50%;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255,255,255,.14);

            font-size: 48px;

            margin-bottom: 25px;

            animation:
                floatingIcon 3s ease-in-out infinite;
        }


        .about-visual-inner h3 {

            font-family: "Poppins", sans-serif;

            font-size: 32px;

            margin:
                0 0 10px;
        }


        .about-visual-inner p {

            margin: 0;

            font-size: 17px;

            opacity: .85;
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


        /* =========================================================
           CONTENT
        ========================================================= */

        .about-details-content .section-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 15px;

            border: 1px solid #dbeafe;

            border-radius: 999px;

            color: var(--primary);

            background: rgba(239, 246, 255, .9);

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .4px;

            margin-bottom: 15px;
        }


        .about-details-content h2 {

            font-family: "Poppins", sans-serif;

            font-size:
                clamp(32px, 4vw, 48px);

            line-height: 1.2;

            margin:
                0 0 25px;

            font-weight: 800;

            color: var(--dark);
        }


        .about-details-content > p {

            font-size: 15px;

            line-height: 1.85;

            margin-bottom: 18px;

            color: var(--text);
        }


        /* =========================================================
           ABOUT LIST
        ========================================================= */

        .about-feature-list {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 14px;

            margin-top: 30px;
        }


        .about-feature-item {

            padding:
                15px 16px;

            border-radius: 12px;

            background:
                var(--primary-light);

            display: flex;

            align-items: center;

            gap: 11px;

            font-size: 13px;

            font-weight: 700;

            color: var(--dark);

            transition:

                transform .3s ease,

                box-shadow .3s ease,

                background .3s ease;
        }


        .about-feature-item:hover {

            transform:
                translateY(-5px);

            background:
                #dbeafe;

            box-shadow:
                0 10px 25px
                rgba(0,0,0,.08);
        }


        .about-feature-item i {

            color:
                var(--primary);

            font-size: 18px;
        }


  

        .purpose-section {

            padding:
                100px 20px;

            background: #f8fbff;
        }


        .about-section-heading {

            text-align: center;

            max-width: 800px;

            margin:
                0 auto 55px;
        }


        .about-section-heading .section-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 15px;

            border: 1px solid #dbeafe;

            border-radius: 999px;

            color: var(--primary);

            background: rgba(239, 246, 255, .9);

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .4px;

            margin-bottom: 12px;
        }


        .about-section-heading h2 {

            font-family: "Poppins", sans-serif;

            font-size:
                clamp(32px, 4vw, 48px);

            margin:
                0 0 15px;

            font-weight: 800;

            color: var(--dark);
        }


        .about-section-heading p {

            font-size: 15px;

            line-height: 1.7;

            color: var(--text);
        }



        .purpose-grid {

            max-width: 1180px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;
        }


        .purpose-card {

            padding:
                38px 30px;

            border-radius: 22px;

            background: #fff;

            border:
                1px solid var(--border);

            box-shadow:
                0 15px 40px
                rgba(15, 23, 42, .06);

            text-align: center;

            transition:

                transform .4s ease,

                box-shadow .4s ease;

            position: relative;

            overflow: hidden;
        }


        .purpose-card::before {

            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            border-radius: 50%;

            background:
                rgba(37,99,235,.05);

            top: -55px;
            right: -55px;

            transition:
                transform .4s ease;
        }


        .purpose-card:hover {

            transform:
                translateY(-12px);

            box-shadow:
                0 25px 60px
                rgba(15, 23, 42, .12);
        }


        .purpose-card:hover::before {

            transform:
                scale(2);
        }


        .purpose-icon {

            width: 85px;
            height: 85px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            margin:
                0 auto 22px;

            background:
                var(--primary-light);

            color:
                var(--primary);

            font-size: 34px;

            position: relative;

            z-index: 2;

            transition:
                transform .4s ease;
        }


        .purpose-card:hover
        .purpose-icon {

            transform:
                rotateY(180deg);
        }


        .purpose-card h3 {

            font-family: "Poppins", sans-serif;

            font-size: 22px;

            margin:
                0 0 15px;

            font-weight: 700;

            color: var(--dark);

            position: relative;

            z-index: 2;
        }


        .purpose-card p {

            line-height: 1.75;

            color: var(--text);

            font-size: 14px;

            margin: 0;

            position: relative;

            z-index: 2;
        }


      

        .why-section {

            padding:
                100px 20px;

            background: #ffffff;
        }


        .why-grid {

            max-width: 1180px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 22px;
        }


        .why-card {

            padding:
                35px 25px;

            border-radius: 20px;

            border:
                1px solid var(--border);

            background: #fff;

            box-shadow: 0 8px 25px rgba(15, 23, 42, .05);

            transition:

                transform .35s ease,

                box-shadow .35s ease;

            text-align: center;

            position: relative;
        }


        .why-card:hover {

            transform:
                translateY(-10px);

            box-shadow:
                0 20px 45px
                rgba(15, 23, 42, .1);
        }


        .why-icon {

            width: 75px;
            height: 75px;

            border-radius: 18px;

            margin:
                0 auto 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                var(--primary-light);

            color:
                var(--primary);

            font-size: 31px;

            transition:
                all .35s ease;
        }


        .why-card:hover
        .why-icon {

            border-radius: 50%;

            transform:
                scale(1.08);
        }


        .why-card h3 {

            font-family: "Poppins", sans-serif;

            margin:
                0 0 13px;

            font-size: 19px;

            font-weight: 700;

            color: var(--dark);
        }


        .why-card p {

            margin: 0;

            line-height: 1.7;

            color: var(--text);

            font-size: 13.5px;
        }



        .about-cta {

            padding:
                100px 20px;

            position: relative;

            overflow: hidden;

            background:

                linear-gradient(
                    135deg,
                    #111827,
                    #1e293b
                );

            color: #fff;
        }


        .about-cta::before {

            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            top: -180px;

            left: -100px;

            background:
                rgba(37, 99, 235, .18);
        }


        .about-cta::after {

            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            right: -100px;

            bottom: -180px;

            background:
                rgba(124, 58, 237, .18);
        }


        .about-cta-content {

            max-width: 800px;

            margin: auto;

            text-align: center;

            position: relative;

            z-index: 2;
        }


        .about-cta-content .section-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 15px;

            border: 1px solid rgba(255,255,255,.3);

            border-radius: 999px;

            color: #fff;

            background: rgba(255,255,255,.08);

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .4px;

            margin-bottom: 12px;
        }


        .about-cta-content h2 {

            font-family: "Poppins", sans-serif;

            font-size:
                clamp(30px, 4vw, 46px);

            line-height: 1.2;

            margin:
                15px 0;

            font-weight: 800;

            color: #fff;
        }


        .about-cta-content p {

            font-size: 15px;

            line-height: 1.7;

            color: #cbd5e1;

            margin-bottom: 30px;
        }


        .about-cta-actions {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            flex-wrap: wrap;
        }


        .about-cta-contact {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 48px;

            padding:
                0 21px;

            border-radius: 12px;

            color: #fff;

            border:
                1px solid
                rgba(255,255,255,.35);

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;

            transition:
                all .35s cubic-bezier(.4, 0, .2, 1);

            background:
                rgba(255,255,255,.08);
        }


        .about-cta-contact:hover {

            color: #fff;

            background:
                rgba(255,255,255,.18);

            transform:
                translateY(-3px);
        }


        /* =========================================================
           BACK TO TOP
        ========================================================= */

        .about-top-btn {

            position: fixed;

            right: 22px;
            bottom: 22px;

            width: 46px;
            height: 46px;

            border: 0;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );

            color: #fff;

            font-size: 18px;

            cursor: pointer;

            z-index: 999;

            opacity: 0;

            visibility: hidden;

            transform:
                translateY(15px);

            transition:
                all .35s cubic-bezier(.4, 0, .2, 1);

            box-shadow:
                0 12px 30px
                rgba(37, 99, 235, .25);
        }


        .about-top-btn.show {

            opacity: 1;

            visibility: visible;

            transform:
                translateY(0);
        }


        .about-top-btn:hover {

            transform:
                translateY(-4px);
        }


        /* =========================================================
           RESPONSIVE STYLES
        ========================================================= */

        @media (max-width: 1150px) {

            .why-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 900px) {

            .about-details-grid {

                grid-template-columns: 1fr;

                gap: 45px;
            }


            .purpose-grid {

                grid-template-columns: 1fr;
            }


            .about-visual {

                min-height: 380px;
            }

        }


        @media (max-width: 700px) {

            .about-page-hero {

                min-height: 470px;

                padding:
                    80px 18px;
            }


            .about-hero-content p {

                font-size: 15px;

                line-height: 1.7;
            }


            .about-details,
            .purpose-section,
            .why-section,
            .about-cta {

                padding:
                    70px 18px;
            }


            .about-feature-list {

                grid-template-columns: 1fr;
            }


            .why-grid {

                grid-template-columns: 1fr;
            }


            .about-visual {

                min-height: 330px;

                border-radius: 20px;
            }


            .about-visual-inner h3 {

                font-size: 27px;
            }


            .about-visual::before {

                width: 260px;
                height: 260px;
            }


            .about-visual::after {

                width: 190px;
                height: 190px;
            }


            .purpose-card {

                padding:
                    30px 22px;
            }


            .about-top-btn {

                right: 15px;

                bottom: 15px;
            }


            .about-cta-actions {

                flex-direction: column;

                width: 100%;
            }


            .about-cta-actions .btn,
            .about-cta-contact {

                width: 100%;

                justify-content: center;
            }

        }


        @media (max-width: 480px) {

            .about-hero-label {

                font-size: 11px;

                letter-spacing: 1px;
            }


            .about-hero-content h1 {

                font-size: 36px;
            }


            .about-details-content h2 {

                font-size: 31px;
            }


            .about-section-heading h2 {

                font-size: 31px;
            }


            .about-cta-content h2 {

                font-size: 32px;
            }

        }


        

        @media (prefers-reduced-motion: reduce) {

            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {

                animation-duration: .01ms ;

                animation-iteration-count: 1 ;

                transition-duration: .01ms ;
            }

        }

    </style>

</head>


<body id="top">


<!-- =========================================================
     PAGE LOADER
========================================================= -->

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

                    <a href="gallery.php"
                       class="<?php echo ($currentPage === 'gallery.php') ? 'active' : ''; ?>">

                        Gallery

                    </a>

                </li>

                <li>

                    <a href="testimonials.php">

                        Testimonials

                    </a>

                </li>

                <li>

                    <a href="Blog.php">

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
                <li class="nav-auth-item" style="display: flex; align-items: center; gap: 6px;">

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


 

    <section class="about-page-hero">

        <div class="container">

            <div class="about-hero-content">


                <div class="about-hero-label">

                    <i class="bi bi-building"></i>

                    ABOUT RUDRA EDUTECH

                </div>


                <h1>

                    Empowering Students

                    <span>
                        For A Better Future
                    </span>

                </h1>


                <p>

                    Rudra Edutech is committed to providing quality
                    education, practical skills and career-focused
                    learning opportunities for students[cite: 8].

                </p>

            </div>

        </div>

    </section>




    <section class="about-details">

        <div class="about-details-grid reveal">


            <!-- LEFT -->

            <div class="about-visual">

                <div class="about-visual-inner">

                    <i class="bi bi-mortarboard-fill"></i>

                    <h3>
                        Rudra EduTech
                    </h3>

                    <p>
                        Learn • Grow • Succeed
                    </p>

                </div>

            </div>


            <!-- RIGHT -->

            <div class="about-details-content">


                <span class="section-label">
                    WHO WE ARE
                </span>


                <h2>

                    Building Skills,
                    Creating Opportunities

                </h2>


                <p>

                    At Rudra Edutech, we believe that education
                    should not be limited to textbooks. Our goal
                    is to provide students with knowledge,
                    practical skills and confidence that can help
                    them succeed in their academic and
                    professional journey[cite: 8].

                </p>


                <p>

                    We focus on creating a learning environment
                    where students can understand concepts,
                    develop practical abilities and prepare
                    themselves for future opportunities[cite: 8].

                </p>


                <!-- FEATURES -->

                <div class="about-feature-list">


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Quality Education

                    </div>


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Practical Learning

                    </div>


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Experienced Guidance

                    </div>


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Career Focused Training

                    </div>


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Student Support

                    </div>


                    <div class="about-feature-item">

                        <i class="bi bi-check-circle-fill"></i>

                        Modern Learning

                    </div>


                </div>

            </div>

        </div>

    </section>




    <section class="purpose-section light-section">

        <div class="container">


            <div class="about-section-heading reveal">

                <span class="section-label">
                    OUR PURPOSE
                </span>


                <h2>
                    Mission & Vision
                </h2>


                <p>

                    Our focus is to help students learn better,
                    build confidence and prepare for their future[cite: 8].

                </p>

            </div>


            <div class="purpose-grid">


                <!-- MISSION -->

                <div class="purpose-card reveal">

                    <div class="purpose-icon">

                        <i class="bi bi-bullseye"></i>

                    </div>


                    <h3>
                        Our Mission
                    </h3>


                    <p>

                        To provide accessible, practical and
                        quality-focused education that helps
                        students develop useful skills and achieve
                        their goals[cite: 8].

                    </p>

                </div>


                <!-- VISION -->

                <div class="purpose-card reveal">

                    <div class="purpose-icon">

                        <i class="bi bi-eye"></i>

                    </div>


                    <h3>
                        Our Vision
                    </h3>


                    <p>

                        To become a trusted education and training
                        platform that empowers students with
                        knowledge, skills and confidence[cite: 8].

                    </p>

                </div>


                <!-- APPROACH -->

                <div class="purpose-card reveal">

                    <div class="purpose-icon">

                        <i class="bi bi-lightbulb"></i>

                    </div>


                    <h3>
                        Our Approach
                    </h3>


                    <p>

                        We combine learning with practical
                        understanding so that students can apply
                        their knowledge in real-world situations[cite: 8].

                    </p>

                </div>


            </div>

        </div>

    </section>


    <!-- =====================================================
         WHY CHOOSE US
    ====================================================== -->

    <section class="why-section">

        <div class="container">


            <div class="about-section-heading reveal">

                <span class="section-label">
                    WHY RUDRA EDUTECH
                </span>


                <h2>
                    Why Choose Us?
                </h2>

            </div>


            <div class="why-grid">


                <!-- 1 -->

                <div class="why-card reveal">

                    <div class="why-icon">

                        <i class="bi bi-person-check"></i>

                    </div>


                    <h3>
                        Student Focused
                    </h3>


                    <p>

                        Our learning approach keeps students'
                        needs and growth at the center[cite: 8].

                    </p>

                </div>


                <!-- 2 -->

                <div class="why-card reveal">

                    <div class="why-icon">

                        <i class="bi bi-laptop"></i>

                    </div>


                    <h3>
                        Practical Skills
                    </h3>


                    <p>

                        Students get opportunities to understand
                        concepts through practical learning[cite: 8].

                    </p>

                </div>


                <!-- 3 -->

                <div class="why-card reveal">

                    <div class="why-icon">

                        <i class="bi bi-person-video3"></i>

                    </div>


                    <h3>
                        Expert Guidance
                    </h3>


                    <p>

                        Proper guidance helps students move forward
                        with clarity and confidence[cite: 8].

                    </p>

                </div>


                <!-- 4 -->

                <div class="why-card reveal">

                    <div class="why-icon">

                        <i class="bi bi-rocket-takeoff"></i>

                    </div>


                    <h3>
                        Career Growth
                    </h3>


                    <p>

                        We aim to prepare students for future
                        academic and career opportunities[cite: 8].

                    </p>

                </div>


            </div>

        </div>

    </section>




    <section class="about-cta">

        <div class="container">

            <div class="about-cta-content reveal">


                <span class="section-label">
                    START YOUR JOURNEY
                </span>


                <h2>
                    Ready To Learn & Grow?
                </h2>


                <p>

                    Explore our courses and services and take
                    the next step toward your goals[cite: 8].

                </p>


                <div class="about-cta-actions">


                    <a href="contact.php"
                       class="btn btn-primary">

                        Contact Us

                        <i class="bi bi-arrow-right"></i>

                    </a>


                    <!-- PHONE -->

                    <a href="tel:+91<?php echo $phone; ?>"
                       class="about-cta-contact">

                        <i class="bi bi-telephone-fill"></i>

                        <?php echo htmlspecialchars($phoneDisplay); ?>

                    </a>


                    <!-- WHATSAPP -->

                    <a href="<?php echo htmlspecialchars($whatsappLink); ?>"
                       class="about-cta-contact"
                       target="_blank"
                       rel="noopener noreferrer">

                        <i class="bi bi-whatsapp"></i>

                        WhatsApp Us

                    </a>

                </div>

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

            <!-- FOOTER COLUMN 1 -->

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

                    <a href="<?php echo htmlspecialchars($whatsappLink); ?>"
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

                        <a href="gallery.php">

                            Gallery

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

                    <!-- ADDRESS -->

                    <p>

                        <i class="bi bi-geo-alt"
                           aria-hidden="true"></i>

                        <span>
                        mumbai, India
                    </span>

                    </p>

                    <!-- PHONE -->

                    <p>

                        <i class="bi bi-telephone"
                           aria-hidden="true"></i>

                        <a href="tel:+91<?php echo $phone; ?>">

                            <?php echo htmlspecialchars($phoneDisplay); ?>

                        </a>

                    </p>

                    <!-- EMAIL -->

                    <p>

                        <i class="bi bi-envelope"
                           aria-hidden="true"></i>

                        <a href="mailto:<?php echo $email; ?>">

                            <?php echo htmlspecialchars($email); ?>

                        </a>

                    </p>

                    <!-- WHATSAPP -->

                    <p>

                        <i class="bi bi-whatsapp"
                           aria-hidden="true"></i>

                        <a href="<?php echo htmlspecialchars($whatsappLink); ?>"
                           target="_blank"
                           rel="noopener noreferrer">

                            WhatsApp Us

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- FOOTER BOTTOM -->

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
     BACK TO TOP
========================================================= -->

<button class="about-top-btn"
        id="aboutTopBtn"
        onclick="scrollToTop()"
        aria-label="Back to top"
        type="button">

    <i class="bi bi-arrow-up"></i>

</button>


<!-- =========================================================
     JAVASCRIPT
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


/* =========================================================
   MOBILE MENU TOGGLE
========================================================= */

const menuToggle =
    document.getElementById("menuToggle");

const navMenu =
    document.getElementById("navMenu");


if (menuToggle && navMenu) {
    menuToggle.addEventListener(
        "click",
        function () {

            const isOpen = navMenu.classList.toggle("active");

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

            const icon = menuToggle.querySelector("i");
            if (icon) {
                icon.classList.toggle("bi-list", !isOpen);
                icon.classList.toggle("bi-x-lg", isOpen);
            }

        }
    );
}


/* =========================================================
   CLOSE MOBILE MENU AFTER CLICK
========================================================= */

document
    .querySelectorAll(".nav-menu a")
    .forEach(function (link) {

        link.addEventListener(
            "click",
            function () {

                if (!navMenu || !menuToggle) return;

                navMenu.classList.remove("active");

                menuToggle.setAttribute(
                    "aria-expanded",
                    "false"
                );

                menuToggle.setAttribute(
                    "aria-label",
                    "Open navigation menu"
                );

                const icon = menuToggle.querySelector("i");
                if (icon) {
                    icon.classList.remove("bi-x-lg");
                    icon.classList.add("bi-list");
                }

            }
        );

    });


/* =========================================================
   SCROLL REVEAL ANIMATION
========================================================= */

const revealElements =
    document.querySelectorAll(".reveal");


function revealOnScroll() {

    const windowHeight =
        window.innerHeight;


    revealElements.forEach(
        function (element) {

            const elementTop =
                element
                .getBoundingClientRect()
                .top;


            if (
                elementTop <
                windowHeight - 80
            ) {

                element.classList.add(
                    "active"
                );

            }

        }
    );

}


window.addEventListener(
    "scroll",
    revealOnScroll,
    {
        passive: true
    }
);


revealOnScroll();


/* =========================================================
   BACK TO TOP
========================================================= */

const topButton =
    document.getElementById(
        "aboutTopBtn"
    );


window.addEventListener(
    "scroll",
    function () {

        if (!topButton) {
            return;
        }


        if (window.scrollY > 400) {

            topButton.classList.add(
                "show"
            );

        } else {

            topButton.classList.remove(
                "show"
            );

        }

    },
    {
        passive: true
    }
);


function scrollToTop() {

    window.scrollTo({

        top: 0,

        behavior: "smooth"

    });

}



document
    .querySelectorAll(
        ".purpose-card, .why-card"
    )
    .forEach(
        function (card, index) {

            card.style.transitionDelay =
                (index * 0.08) + "s";

        }
    );



if (window.innerWidth > 900) {

    const visual =
        document.querySelector(
            ".about-visual"
        );


    if (visual) {

        document.addEventListener(
            "mousemove",
            function (event) {

                const x =
                    (
                        window.innerWidth / 2 -
                        event.clientX
                    ) / 60;


                const y =
                    (
                        window.innerHeight / 2 -
                        event.clientY
                    ) / 60;


                visual.style.transform =
                    "perspective(1000px) " +
                    "rotateY(" +
                    x +
                    "deg) " +
                    "rotateX(" +
                    -y +
                    "deg)";

            }
        );


        document.addEventListener(
            "mouseleave",
            function () {

                visual.style.transform =
                    "perspective(1000px) " +
                    "rotateY(0deg) " +
                    "rotateX(0deg)";

            }
        );

    }

}



document.addEventListener(
    "keydown",
    function (event) {

        if (event.key === "Escape") {

            if (navMenu && navMenu.classList.contains("active")) {
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

        }

    }
);



document.addEventListener(
    "click",
    function (event) {

        if (
            navMenu &&
            menuToggle &&
            navMenu.classList.contains("active") &&
            !navMenu.contains(event.target) &&
            !menuToggle.contains(event.target)
        ) {

            navMenu.classList.remove("active");
            menuToggle.setAttribute("aria-expanded", "false");
            const icon = menuToggle.querySelector("i");
            if (icon) {
                icon.classList.remove("bi-x-lg");
                icon.classList.add("bi-list");
            }

        }

    }
);

</script>


</body>

</html>