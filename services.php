<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Services | Rudra EduTech";
$currentPage = basename($_SERVER['PHP_SELF']);



$db_host = getenv("DB_HOST") ?: "localhost";
$db_user = getenv("DB_USER") ?: "root";
$db_pass = getenv("DB_PASS");
$db_pass = ($db_pass === false) ? "" : $db_pass;
$db_name = getenv("DB_NAME") ?: "rudra_edutech";

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

$whatsappMessage =
    "Hello Rudra EduTech, I would like to know more about your services.";

$whatsappLink =
    "https://wa.me/" . $whatsapp . "?text=" . rawurlencode($whatsappMessage);




$services = [

    "website-design" => [
        "number" => "01",
        "title" => "Website Design",
        "short" => "Modern, responsive & conversion-focused websites.",
        "icon" => "bi-window",
        "image" => "assets/images/services/website-design.jpg",

        "intro" =>
        "We design modern, professional and responsive websites that help your business create a powerful online presence.",

        "description" => [
            "Your website is often the first interaction customers have with your business. We create clean, attractive and professional designs that communicate your brand clearly.",

            "Our websites are carefully structured with responsive layouts, intuitive navigation, modern typography and engaging visual elements.",

            "Every design is optimized for desktop, tablet and mobile devices so your visitors get a smooth experience on every screen."
        ],

        "features" => [
            "Responsive Web Design",
            "Modern UI / UX",
            "Mobile Friendly",
            "Fast Loading",
            "SEO Friendly",
            "Professional Layout"
        ]
    ],


    "web-application" => [
        "number" => "02",
        "title" => "Web Application",
        "short" => "Powerful PHP-based applications for growing businesses.",
        "icon" => "bi-code-slash",
        "image" => "assets/images/services/web-application.jpg",

        "intro" =>
        "We develop powerful, secure and scalable web applications designed around your business requirements.",

        "description" => [
            "Our web application development services help businesses automate processes, manage information and improve productivity.",

            "We build custom solutions using modern frontend technologies, PHP, MySQL and reliable backend architectures.",

            "From admin dashboards to business management systems, we create applications that are practical, secure and easy to use."
        ],

        "features" => [
            "Custom Web Applications",
            "PHP Development",
            "MySQL Database",
            "Admin Dashboards",
            "Business Automation",
            "API Integration"
        ]
    ],


    "web-hosting" => [
        "number" => "03",
        "title" => "Web Hosting",
        "short" => "Secure, reliable and performance-focused hosting.",
        "icon" => "bi-hdd-network",
        "image" => "assets/images/services/web-hosting.jpg",

        "intro" =>
        "Reliable hosting keeps your website fast, secure and available whenever your customers need it.",

        "description" => [
            "We provide dependable web hosting solutions designed for business websites, portfolios, applications and professional online platforms.",

            "Our hosting approach focuses on performance, security, reliability and website availability.",

            "We also help with website migration, SSL setup, backups and basic technical support so your website remains operational."
        ],

        "features" => [
            "Reliable Hosting",
            "SSL Support",
            "Website Backup",
            "Fast Servers",
            "Security Support",
            "Technical Assistance"
        ]
    ],


    "digital-marketing" => [
        "number" => "04",
        "title" => "Digital Marketing",
        "short" => "Reach the right audience and grow your online presence.",
        "icon" => "bi-megaphone",
        "image" => "assets/images/services/digital-marketing.jpg",

        "intro" =>
        "We help businesses build their digital presence and connect with the right audience through effective online strategies.",

        "description" => [
            "A strong digital presence requires more than just a website. Our digital marketing solutions are designed to improve visibility and engagement.",

            "We focus on practical strategies that help businesses reach potential customers through relevant digital channels.",

            "Our approach combines content, social media, search visibility and campaign planning according to your business goals."
        ],

        "features" => [
            "Social Media Strategy",
            "Content Marketing",
            "Online Campaigns",
            "Brand Promotion",
            "Audience Research",
            "Digital Strategy"
        ]
    ],


    "seo-optimization" => [
        "number" => "05",
        "title" => "SEO & Optimization",
        "short" => "Improve discoverability, speed and search performance.",
        "icon" => "bi-graph-up-arrow",
        "image" => "assets/images/services/seo.jpg",

        "intro" =>
        "We optimize websites for better search visibility, performance, usability and overall online experience.",

        "description" => [
            "Search engine optimization helps your website become easier to discover by people who are looking for your products or services.",

            "We analyze website structure, content, technical performance and important on-page elements.",

            "Along with SEO, we also focus on page speed, mobile usability and technical improvements that contribute to a better user experience."
        ],

        "features" => [
            "On-Page SEO",
            "Technical SEO",
            "Keyword Research",
            "Page Speed",
            "Mobile Optimization",
            "Website Analysis"
        ]
    ],


    "website-maintenance" => [
        "number" => "06",
        "title" => "Website Maintenance",
        "short" => "Keep your website updated, secure and running smoothly.",
        "icon" => "bi-shield-check",
        "image" => "assets/images/services/maintenance.jpg",

        "intro" =>
        "Regular maintenance keeps your website secure, updated, functional and ready for your customers.",

        "description" => [
            "Websites require continuous updates to remain secure, compatible and effective.",

            "Our maintenance service can include content updates, bug fixing, security checks, performance improvements and technical assistance.",

            "We help businesses keep their websites healthy so they can focus on their core operations."
        ],

        "features" => [
            "Content Updates",
            "Bug Fixing",
            "Security Checks",
            "Performance Optimization",
            "Backup Assistance",
            "Technical Support"
        ]
    ],


    "custom-digital-solutions" => [
        "number" => "07",
        "title" => "Custom Digital Solutions",
        "short" => "Technology solutions designed around your business.",
        "icon" => "bi-stars",
        "image" => "assets/images/services/custom-solutions.jpg",

        "intro" =>
        "Every business is different. We create customized digital solutions according to your specific goals and requirements.",

        "description" => [
            "Sometimes standard software or ready-made solutions are not enough. Our custom development approach allows us to create technology specifically for your business.",

            "We understand your requirements, plan the solution and develop practical digital systems that can improve your workflow.",

            "From custom dashboards and automation systems to specialized websites and applications, we help turn your ideas into working digital solutions."
        ],

        "features" => [
            "Custom Development",
            "Business Automation",
            "Custom Dashboards",
            "Database Solutions",
            "API Integration",
            "Digital Consulting"
        ]
    ]

];


$activeService = "website-design";

if (isset($_GET["service"]) && isset($services[$_GET["service"]])) {
    $activeService = $_GET["service"];
}

$currentService = $services[$activeService];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Rudra EduTech provides professional website design, web application, hosting, digital marketing, SEO and custom digital solutions[cite: 8].">

    <meta
        name="keywords"
        content="Rudra EduTech, Website Design, Web Application, Web Hosting, Digital Marketing, SEO, Website Maintenance[cite: 8]">

    <meta name="theme-color" content="#2563eb">

    <title>
        <?= htmlspecialchars($pageTitle); ?>
    </title>


    <!-- =====================================================
         GOOGLE FONT
    ====================================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    <!-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <link
        rel="icon"
        type="image/jpeg"
        href="image/logo.png"
    >

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



.scroll-progress {

    position: fixed;

    top: 0;
    left: 0;

    height: 3px;

    width: 0;

    z-index: 99999;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #7c3aed,
            #06b6d4
        );
}



.services-hero {

    position: relative;

    overflow: hidden;

    padding:
        100px 20px 90px;

    text-align: center;

    background:
        linear-gradient(
            135deg,
            #f8fbff 0%,
            #f5f3ff 50%,
            #f8fbff 100%
        );
}


.services-hero::before {

    content: "";

    position: absolute;

    width: 420px;

    height: 420px;

    top: -250px;

    right: -130px;

    border-radius: 50%;

    background:
        rgba(124,58,237,.10);
}


.services-hero::after {

    content: "";

    position: absolute;

    width: 320px;

    height: 320px;

    bottom: -220px;

    left: -80px;

    border-radius: 50%;

    background:
        rgba(37,99,235,.10);
}


.hero-content {

    position: relative;

    z-index: 2;

    max-width: 850px;

    margin: auto;
}


.hero-label {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding:
        7px 15px;

    border:
        1px solid #dbeafe;

    border-radius: 50px;

    color: var(--primary);

    background:
        rgba(255,255,255,.75);

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;

    animation:
        fadeDown .7s ease both;
}


.hero-label i {

    font-size: 14px;
}


.hero-title {

    margin-top: 20px;

    font-family: "Poppins", sans-serif;

    font-size:
        clamp(36px, 5vw, 72px);

    line-height: 1.1;

    letter-spacing: -1.5px;

    color: #111827;

    font-weight: 800;

    animation:
        fadeUp .8s .1s ease both;
}


.hero-title span {

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #7c3aed,
            #06b6d4
        );

    -webkit-background-clip: text;

    background-clip: text;

    color: transparent;
}


.hero-text {

    max-width: 700px;

    margin:
        20px auto 0;

    color: #64748b;

    font-size: clamp(14px, 1.5vw, 16px);

    animation:
        fadeUp .8s .2s ease both;
}




.services-area {

    padding:
        90px 20px;

    background:
        #ffffff;
}


.services-wrapper {

    max-width: 1180px;

    margin: auto;

    display: grid;

    grid-template-columns:
        350px minmax(0, 1fr);

    gap: 40px;

    align-items: start;
}



.service-sidebar {

    position: sticky;

    top: 105px;

    padding:
        22px;

    border:
        1px solid #e2e8f0;

    border-radius: 22px;

    background:
        #ffffff;

    box-shadow:
        0 8px 25px rgba(15, 23, 42, 0.06);

    animation:
        fadeLeft .8s ease both;
}


.sidebar-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding:
        0 3px 17px;

    border-bottom:
        1px solid #e5e7eb;

    margin-bottom: 5px;
}


.sidebar-title {

    font-family: "Poppins", sans-serif;

    color: #172033;

    font-size: 20px;

    font-weight: 800;
}


.solution-count {

    padding:
        6px 11px;

    border-radius: 50px;

    color: var(--primary);

    background:
        #eff6ff;

    font-size: 11px;

    font-weight: 800;
}


.service-list {

    display: flex;

    flex-direction: column;

    gap: 7px;
}


.service-item {

    position: relative;

    width: 100%;

    display: flex;

    align-items: center;

    gap: 13px;

    padding:
        12px 10px;

    border:
        1px solid transparent;

    border-radius: 17px;

    background:
        transparent;

    text-align: left;

    cursor: pointer;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.service-item:hover {

    transform:
        translateX(4px);

    background:
        #f8fafc;
}


.service-item.active {

    border:
        2px solid #c7d8ff;

    background:
        linear-gradient(
            135deg,
            #f3f7ff,
            #f7f2ff
        );

    box-shadow:
        0 8px 25px rgba(37,99,235,.08);
}


.service-item.active::before {

    content: "";

    position: absolute;

    left: -2px;

    top: 9px;

    bottom: 9px;

    width: 4px;

    border-radius: 20px;

    background:
        linear-gradient(
            180deg,
            #2563eb,
            #7c3aed
        );
}


.service-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background:
        #eff6ff;

    color:
        #2563eb;

    font-size: 20px;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.service-item.active .service-icon {

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #6845e8
        );

    box-shadow:
        0 8px 20px rgba(37,99,235,.20);

    transform:
        scale(1.05);
}


.service-item:hover .service-icon {

    transform:
        translateY(-2px);
}


.service-text {

    min-width: 0;

    flex: 1;
}


.service-name {

    color: #263247;

    font-size: 14px;

    font-weight: 800;

    line-height: 1.3;
}


.service-item.active .service-name {

    color: #2563eb;
}


.service-desc {

    margin-top: 3px;

    color: #8090a7;

    font-size: 11px;

    line-height: 1.4;

    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}


.service-arrow {

    color: #94a3b8;

    font-size: 15px;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.service-item:hover .service-arrow,

.service-item.active .service-arrow {

    color: var(--primary);

    transform:
        translateX(3px);
}



.service-detail {

    min-width: 0;
    width: 100%;

    animation:
        fadeRight .8s ease both;
}


.detail-card {

    position: relative;

    overflow: hidden;

    border:
        1px solid #e2e8f0;

    border-radius: 25px;

    background:
        #ffffff;

    box-shadow:
        0 20px 60px rgba(15, 23, 42, 0.08);

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.detail-card:hover {

    box-shadow:
        0 30px 75px rgba(15,23,42,.11);
}



.detail-image {

    position: relative;

    min-height: 340px;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #eaf2ff,
            #f3efff
        );
}


.detail-image img {

    width: 100%;

    height: 340px;

    object-fit: cover;

    transition:
        transform .8s ease;
}


.detail-card:hover .detail-image img {

    transform:
        scale(1.04);
}


.detail-image::after {

    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            180deg,
            transparent 45%,
            rgba(15,23,42,.45)
        );

    pointer-events: none;
}


.detail-number {

    position: absolute;

    z-index: 2;

    top: 20px;

    right: 20px;

    width: 58px;

    height: 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid rgba(255,255,255,.35);

    border-radius: 50%;

    color: #ffffff;

    background:
        rgba(15,23,42,.48);

    backdrop-filter:
        blur(12px);

    font-family: "Poppins", sans-serif;

    font-size: 17px;

    font-weight: 800;
}


.image-caption {

    position: absolute;

    z-index: 3;

    left: 28px;

    bottom: 25px;

    color: #ffffff;
}


.image-caption small {

    display: block;

    margin-bottom: 2px;

    opacity: .78;

    font-size: 10px;

    letter-spacing: 1.5px;

    text-transform: uppercase;
}


.image-caption strong {

    font-family: "Poppins", sans-serif;

    font-size: 25px;

    font-weight: 800;
}


.detail-content {

    padding:
        35px 38px 40px;
}


.detail-heading-row {

    display: flex;

    align-items: flex-start;

    gap: 18px;
}


.detail-main-icon {

    width: 60px;

    height: 60px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #ffffff;

    border-radius: 17px;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );

    font-size: 24px;

    box-shadow:
        0 15px 30px rgba(37,99,235,.18);
}


.detail-title {

    font-family: "Poppins", sans-serif;

    color: #111827;

    font-size:
        clamp(24px, 3vw, 39px);

    line-height: 1.2;

    font-weight: 800;
}


.detail-subtitle {

    margin-top: 5px;

    color: var(--primary);

    font-size: 13px;

    font-weight: 700;
}


.detail-intro {

    margin-top: 25px;

    padding:
        17px 18px;

    border-left:
        3px solid var(--primary);

    border-radius:
        0 12px 12px 0;

    background:
        #f8fafc;

    color: #475569;

    font-size: 14px;

    font-weight: 600;

    line-height: 1.75;
}


.detail-description {

    margin-top: 24px;
}


.detail-description p {

    margin-bottom: 16px;

    color: #64748b;

    font-size: 14px;

    line-height: 1.85;
}



.features-heading {

    margin-top: 28px;

    margin-bottom: 15px;

    color: #172033;

    font-family: "Poppins", sans-serif;

    font-size: 18px;

    font-weight: 800;
}


.features-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0,1fr));

    gap: 10px;
}


.feature-box {

    display: flex;

    align-items: center;

    gap: 9px;

    padding:
        12px 13px;

    border:
        1px solid #e8edf3;

    border-radius: 12px;

    background:
        #f8fafc;

    color: #475569;

    font-size: 12px;

    font-weight: 700;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.feature-box i {

    color: var(--primary);

    font-size: 15px;
}


.feature-box:hover {

    transform:
        translateY(-3px);

    border-color:
        #cbdcff;

    background:
        #ffffff;

    box-shadow:
        0 10px 25px rgba(15,23,42,.06);
}



.service-cta {

    position: relative;

    overflow: hidden;

    margin-top: 28px;

    padding:
        25px 26px;

    border-radius: 18px;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );
}


.service-cta::before {

    content: "";

    position: absolute;

    width: 180px;

    height: 180px;

    right: -70px;

    top: -90px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.10);
}


.service-cta h3 {

    position: relative;

    z-index: 2;

    font-family: "Poppins", sans-serif;

    font-size: 19px;
}


.service-cta p {

    position: relative;

    z-index: 2;

    margin-top: 4px;

    font-size: 12px;

    opacity: .85;
}


.cta-link {

    position: relative;

    z-index: 2;

    display: inline-flex;

    align-items: center;

    gap: 8px;

    margin-top: 13px;

    padding:
        9px 16px;

    border-radius: 50px;

    color: #172033;

    background:
        #ffffff;

    font-size: 12px;

    font-weight: 800;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.cta-link:hover {

    transform:
        translateY(-3px);

    box-shadow:
        0 10px 25px rgba(0,0,0,.15);
}



.process-section {

    position: relative;

    padding:
        100px 20px 110px;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #f8fafc 0%,
            #f5f7ff 50%,
            #f8fafc 100%
        );
}


.process-section::before {

    content: "";

    position: absolute;

    width: 500px;

    height: 500px;

    right: -250px;

    top: -250px;

    border-radius: 50%;

    background:
        rgba(37,99,235,.06);
}


.process-container {

    position: relative;

    z-index: 2;

    max-width: 1180px;

    margin: auto;
}


.section-label {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    color: var(--primary);

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 2px;

    text-transform: uppercase;
}


.section-label::before,

.section-label::after {

    content: "";

    width: 22px;

    height: 1px;

    background:
        #8db4ff;
}


.process-title {

    max-width: 700px;

    margin:
        18px auto 0;

    text-align: center;

    font-family: "Poppins", sans-serif;

    color: #111827;

    font-size:
        clamp(28px, 4vw, 49px);

    line-height: 1.15;

    letter-spacing: -1.3px;

    font-weight: 800;
}


.process-description {

    max-width: 650px;

    margin:
        18px auto 0;

    text-align: center;

    color: #64748b;

    font-size: 14px;
}


.process-grid {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 18px;

    margin-top: 60px;
}


.process-card {

    position: relative;

    min-height: 207px;

    padding:
        28px 25px;

    border:
        1px solid #dfe6ef;

    border-radius: 20px;

    background:
        #ffffff;

    overflow: hidden;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);

    animation:
        fadeUp .8s ease both;
}


.process-card:nth-child(2) {
    animation-delay: .1s;
}


.process-card:nth-child(3) {
    animation-delay: .2s;
}


.process-card:nth-child(4) {
    animation-delay: .3s;
}


.process-card:hover {

    transform:
        translateY(-8px);

    border-color:
        #c9d9ff;

    box-shadow:
        0 25px 50px rgba(15,23,42,.08);
}


.process-number {

    position: absolute;

    top: 15px;

    right: 16px;

    color: #e4eaf2;

    font-family: "Poppins", sans-serif;

    font-size: 34px;

    line-height: 1;

    font-weight: 800;
}


.process-icon {

    width: 53px;

    height: 53px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    color: var(--primary);

    background:
        #eff6ff;

    font-size: 20px;

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.process-card:hover .process-icon {

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );

    transform:
        rotate(-5deg)
        scale(1.05);
}


.process-card h3 {

    margin-top: 19px;

    color: #172033;

    font-family: "Poppins", sans-serif;

    font-size: 18px;

    font-weight: 800;
}


.process-card p {

    margin-top: 6px;

    color: #718198;

    font-size: 12px;

    line-height: 1.7;
}


/* =========================================================
   BACK TO TOP
========================================================= */

.back-top {

    position: fixed;

    right: 20px;

    bottom: 20px;

    z-index: 999;

    width: 44px;

    height: 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: none;

    border-radius: 50%;

    color: #ffffff;

    background:
        linear-gradient(
            135deg,
            #2563eb,
            #7c3aed
        );

    box-shadow:
        0 10px 25px rgba(37,99,235,.25);

    cursor: pointer;

    opacity: 0;

    visibility: hidden;

    transform:
        translateY(20px);

    transition:
        all .35s cubic-bezier(.4, 0, .2, 1);
}


.back-top.show {

    opacity: 1;

    visibility: visible;

    transform:
        translateY(0);
}


.back-top:hover {

    transform:
        translateY(-5px);
}




.detail-changing {

    animation:
        detailChange .45s ease both;
}


@keyframes detailChange {

    from {

        opacity: 0;

        transform:
            translateY(20px)
            scale(.985);
    }

    to {

        opacity: 1;

        transform:
            translateY(0)
            scale(1);
    }
}




@keyframes fadeUp {

    from {

        opacity: 0;

        transform:
            translateY(30px);
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
            translateY(-20px);
    }

    to {

        opacity: 1;

        transform:
            translateY(0);
    }
}


@keyframes fadeLeft {

    from {

        opacity: 0;

        transform:
            translateX(-30px);
    }

    to {

        opacity: 1;

        transform:
            translateX(0);
    }
}


@keyframes fadeRight {

    from {

        opacity: 0;

        transform:
            translateX(30px);
    }

    to {

        opacity: 1;

        transform:
            translateX(0);
    }
}




@media (max-width: 1200px) {
    .services-wrapper {
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 30px;
    }
}

@media (max-width: 1024px) {
    .services-wrapper {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .service-sidebar {
        position: static;
        width: 100%;
    }

    .process-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}


@media (max-width: 768px) {
    .services-hero {
        padding: 80px 16px 60px;
    }

    .services-area {
        padding: 50px 16px;
    }

    .detail-content {
        padding: 24px 20px;
    }

    .features-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .process-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .process-section {
        padding: 60px 16px;
    }

    .detail-heading-row {
        flex-direction: column;
        gap: 12px;
    }
}


@media (max-width: 480px) {
    .hero-title {
        font-size: 32px;
        letter-spacing: -1px;
    }

    .detail-image,
    .detail-image img {
        min-height: 220px;
        height: 220px;
    }

    .image-caption {
        left: 18px;
        bottom: 18px;
    }

    .image-caption strong {
        font-size: 20px;
    }

    .detail-number {
        width: 45px;
        height: 45px;
        font-size: 14px;
        top: 15px;
        right: 15px;
    }
}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {

        animation-duration:
            .01ms ;

        animation-iteration-count:
            1 ;

        scroll-behavior:
            auto;

        transition-duration:
            .01ms ;
    }
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


<!-- =========================================================
     TOP BAR
========================================================= -->

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



<div
    class="scroll-progress"
    id="scrollProgress">
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


<section class="services-hero">

    <div class="hero-content">

        <div class="hero-label">

            <i class="bi bi-stars"></i>

            Our Services

        </div>


        <h1 class="hero-title">

            Digital solutions that
            <span>move you forward.</span>

        </h1>


        <p class="hero-text">

            From modern websites and powerful web applications
            to hosting, marketing and custom digital solutions —
            we help you build, launch and grow with confidence.

        </p>

    </div>

</section>




<section
    class="services-area"
    id="services">


    <div class="services-wrapper">



        <aside class="service-sidebar">


            <div class="sidebar-top">

                <h2 class="sidebar-title">
                    Our Services
                </h2>

                <span class="solution-count">
                    7 solutions
                </span>

            </div>



            <div class="service-list">


                <?php foreach ($services as $slug => $service): ?>

                    <button
                        type="button"
                        class="service-item <?= $slug === $activeService ? 'active' : ''; ?>"
                        data-service="<?= htmlspecialchars($slug); ?>"
                        data-image="<?= htmlspecialchars($service['image']); ?>"
                        data-number="<?= htmlspecialchars($service['number']); ?>"
                        data-title="<?= htmlspecialchars($service['title']); ?>"
                        data-short="<?= htmlspecialchars($service['short']); ?>"
                        data-icon="<?= htmlspecialchars($service['icon']); ?>"
                    >

                        <div class="service-icon">

                            <i class="bi <?= htmlspecialchars($service['icon']); ?>"></i>

                        </div>


                        <div class="service-text">

                            <div class="service-name">

                                <?= htmlspecialchars($service['title']); ?>

                            </div>

                            <div class="service-desc">

                                <?= htmlspecialchars($service['short']); ?>

                            </div>

                        </div>


                        <div class="service-arrow">

                            <i class="bi bi-chevron-right"></i>

                        </div>

                    </button>

                <?php endforeach; ?>


            </div>

        </aside>



        <!-- =================================================
             SERVICE DETAIL
        ================================================== -->

        <div
            class="service-detail"
            id="serviceDetail">


            <div class="detail-card">


                <!-- IMAGE -->

                <div class="detail-image">

                    <img
                        id="serviceImage"
                        src="<?= htmlspecialchars($currentService['image']); ?>"
                        alt="<?= htmlspecialchars($currentService['title']); ?>"
                        onerror="serviceImageFallback(this, '<?= htmlspecialchars($currentService['title']); ?>');">


                    <div
                        class="detail-number"
                        id="serviceNumber">

                        <?= htmlspecialchars($currentService['number']); ?>

                    </div>


                    <div class="image-caption">

                        <small>
                            Rudra EduTech
                        </small>

                        <strong id="imageTitle">

                            <?= htmlspecialchars($currentService['title']); ?>

                        </strong>

                    </div>

                </div>



             

                <div class="detail-content">


                    <div class="detail-heading-row">


                        <div class="detail-main-icon">

                            <i
                                id="serviceMainIcon"
                                class="bi <?= htmlspecialchars($currentService['icon']); ?>">
                            </i>

                        </div>


                        <div>

                            <h2
                                class="detail-title"
                                id="serviceTitle">

                                <?= htmlspecialchars($currentService['title']); ?>

                            </h2>


                            <div
                                class="detail-subtitle"
                                id="serviceSubtitle">

                                <?= htmlspecialchars($currentService['short']); ?>

                            </div>

                        </div>

                    </div>



                  

                    <div
                        class="detail-intro"
                        id="serviceIntro">

                        <?= htmlspecialchars($currentService['intro']); ?>

                    </div>



                  

                    <div
                        class="detail-description"
                        id="serviceDescription">

                        <?php foreach ($currentService['description'] as $paragraph): ?>

                            <p>
                                <?= htmlspecialchars($paragraph); ?>
                            </p>

                        <?php endforeach; ?>

                    </div>



                    <!-- FEATURES -->

                    <h3 class="features-heading">
                        What We Provide
                    </h3>


                    <div
                        class="features-grid"
                        id="serviceFeatures">

                        <?php foreach ($currentService['features'] as $feature): ?>

                            <div class="feature-box">

                                <i class="bi bi-check-circle-fill"></i>

                                <span>
                                    <?= htmlspecialchars($feature); ?>
                                </span>

                            </div>

                        <?php endforeach; ?>

                    </div>




                    <div class="service-cta">

                        <h3>
                            Ready to start your project deploy?
                        </h3>

                        <p>
                            Let's turn your idea into a professional
                            digital experience.
                        </p>

                        <a
                            href="contact.php"
                            class="cta-link">

                            Get Started

                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     OUR PROCESS
====================================================== -->

<section
    class="process-section"
    id="process">


    <div class="process-container">


        <div class="section-label">

            Our Process

        </div>


        <h2 class="process-title">

            A simple process.
            A smarter outcome.

        </h2>


        <p class="process-description">

            We keep every project clear, collaborative and
            focused on results.

        </p>



        <div class="process-grid">


            <!-- STEP 01 -->

            <div class="process-card">

                <div class="process-number">
                    01
                </div>


                <div class="process-icon">

                    <i class="bi bi-chat-square-text"></i>

                </div>


                <h3>
                    Understand
                </h3>


                <p>
                    We learn about your business, audience,
                    requirements and goals.
                </p>

            </div>



            <!-- STEP 02 -->

            <div class="process-card">

                <div class="process-number">
                    02
                </div>


                <div class="process-icon">

                    <i class="bi bi-pencil-square"></i>

                </div>


                <h3>
                    Plan
                </h3>


                <p>
                    We structure the pages, features,
                    technology and delivery approach.
                </p>

            </div>



            <!-- STEP 03 -->

            <div class="process-card">

                <div class="process-number">
                    03
                </div>


                <div class="process-icon">

                    <i class="bi bi-code-square"></i>

                </div>


                <h3>
                    Build
                </h3>


                <p>
                    We design and develop the solution with
                    responsive, practical interfaces.
                </p>

            </div>



            <!-- STEP 04 -->

            <div class="process-card">

                <div class="process-number">
                    04
                </div>


                <div class="process-icon">

                    <i class="bi bi-rocket-takeoff"></i>

                </div>


                <h3>
                    Launch & Grow
                </h3>


                <p>
                    We help with optimization, maintenance
                    and improvements after launch.
                </p>

            </div>


        </div>

    </div>

</section>

</main>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <!-- FOOTER MAIN -->

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

                        <a href="https://wa.me/<?php echo $whatsapp; ?>"
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


<!-- =====================================================
     BACK TO TOP
====================================================== -->

<button
    class="back-top"
    id="backTop"
    aria-label="Back to top">

    <i class="bi bi-arrow-up"></i>

</button>



<script>



window.addEventListener("load", function () {

    const loader =
        document.getElementById("aboutLoader");

    setTimeout(function () {

        if (loader) {

            loader.classList.add("hide");

        }

    }, 500);

});



const services = <?= json_encode(
    $services,
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE
); ?>;



const serviceItems =
    document.querySelectorAll(".service-item");

const serviceDetail =
    document.getElementById("serviceDetail");

const serviceImage =
    document.getElementById("serviceImage");

const serviceNumber =
    document.getElementById("serviceNumber");

const imageTitle =
    document.getElementById("imageTitle");

const serviceMainIcon =
    document.getElementById("serviceMainIcon");

const serviceTitle =
    document.getElementById("serviceTitle");

const serviceSubtitle =
    document.getElementById("serviceSubtitle");

const serviceIntro =
    document.getElementById("serviceIntro");

const serviceDescription =
    document.getElementById("serviceDescription");

const serviceFeatures =
    document.getElementById("serviceFeatures");



function serviceImageFallback(image, title) {

    image.src =
        "https://placehold.co/1200x650/eef4ff/2563eb?text="
        + encodeURIComponent(title);

}




function updateService(slug, updateHash = true) {

    const service = services[slug];

    if (!service) {
        return;
    }



    serviceItems.forEach(item => {

        item.classList.remove("active");

        if (
            item.dataset.service === slug
        ) {

            item.classList.add("active");

        }

    });



    serviceDetail.classList.remove(
        "detail-changing"
    );

    void serviceDetail.offsetWidth;

    serviceDetail.classList.add(
        "detail-changing"
    );



    serviceImage.src =
        service.image;

    serviceImage.alt =
        service.title;


    serviceImage.onerror =
        function () {

            serviceImageFallback(
                this,
                service.title
            );

        };


    serviceNumber.textContent =
        service.number;

    imageTitle.textContent =
        service.title;

    serviceTitle.textContent =
        service.title;

    serviceSubtitle.textContent =
        service.short;

    serviceIntro.textContent =
        service.intro;




    serviceMainIcon.className =
        "bi " + service.icon;



    serviceDescription.innerHTML =
        service.description
            .map(text => {

                return `
                    <p>${escapeHtml(text)}</p>
                `;

            })
            .join("");




    serviceFeatures.innerHTML =
        service.features
            .map(feature => {

                return `
                    <div class="feature-box">

                        <i class="bi bi-check-circle-fill"></i>

                        <span>
                            ${escapeHtml(feature)}
                        </span>

                    </div>
                `;

            })
            .join("");



    if (updateHash) {

        history.replaceState(
            null,
            "",
            "#service-" + slug
        );

    }


  

    if (
        window.innerWidth < 1024
    ) {

        setTimeout(() => {

            serviceDetail.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });

        }, 100);

    }

}



function escapeHtml(value) {

    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

}



serviceItems.forEach(item => {

    item.addEventListener(
        "click",
        function () {

            const slug =
                this.dataset.service;

            updateService(slug, true);

        }
    );

});



function loadHashService() {

    const hash =
        window.location.hash;

    if (
        hash.startsWith("#service-")
    ) {

        const slug =
            hash.replace(
                "#service-",
                ""
            );

        if (services[slug]) {

            updateService(
                slug,
                false
            );

        }

    }

}


window.addEventListener(
    "load",
    loadHashService
);


window.addEventListener(
    "hashchange",
    loadHashService
);

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


document
    .querySelectorAll(".nav-menu a")
    .forEach(link => {

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


const navbar =
    document.querySelector(".header");


window.addEventListener(
    "scroll",
    function () {

        if (!navbar) return;

        if (
            window.scrollY > 30
        ) {

            navbar.classList.add(
                "scrolled"
            );

        } else {

            navbar.classList.remove(
                "scrolled"
            );

        }

    }
);




const scrollProgress =
    document.getElementById(
        "scrollProgress"
    );


window.addEventListener(
    "scroll",
    function () {

        if (!scrollProgress) return;

        const scrollTop =
            window.scrollY;

        const height =
            document.documentElement
                .scrollHeight
            - window.innerHeight;


        const progress =
            height > 0

            ? (scrollTop / height) * 100

            : 0;


        scrollProgress.style.width =
            progress + "%";

    }
);


/* =========================================================
   BACK TO TOP
========================================================= */

const backTop =
    document.getElementById(
        "backTop"
    );


window.addEventListener(
    "scroll",
    function () {

        if (!backTop) return;

        if (
            window.scrollY > 500
        ) {

            backTop.classList.add(
                "show"
            );

        } else {

            backTop.classList.remove(
                "show"
            );

        }

    }
);


if (backTop) {
    backTop.addEventListener(
        "click",
        function () {

            window.scrollTo({

                top: 0,

                behavior: "smooth"

            });

        }
    );
}




document.addEventListener(
    "keydown",
    function (event) {

        if (
            event.key === "Escape"
        ) {

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

</script>


</body>
</html>