<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Clients | Rudra EduTech";
$currentPage = basename($_SERVER['PHP_SELF']);

/* =========================================================
   DATABASE CONNECTION
========================================================= */

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



$phone        = "7738699924";
$phoneDisplay = "+91 7738699924";
$email        = "vishalkumar167248@gmail.com";
$whatsapp     = "917738699924";
$whatsappDisplay = "+91 7738699924";

$whatsappMessage =
    "Hello Rudra EduTech, I would like to know more about your services.";

$whatsappLink =
    "https://wa.me/" .
    $whatsapp .
    "?text=" .
    rawurlencode($whatsappMessage);



$clients = [

    [
        "id" => "technova",
        "name" => "TechNova Solutions",
        "category" => "Technology",
        "location" => "Delhi, India",
        "year" => "2025",
        "initials" => "TS",
        "featured" => true,
        "description" => "A modern technology company that partnered with Rudra EduTech for a professional digital presence and scalable web solutions.",
        "services" => [
            "Website Design",
            "Web Development",
            "SEO Optimization"
        ]
    ],

    [
        "id" => "edusphere",
        "name" => "EduSphere Institute",
        "category" => "Education",
        "location" => "Noida, India",
        "year" => "2025",
        "initials" => "EI",
        "featured" => true,
        "description" => "An education institute looking for a modern website and digital platform to connect students with quality learning resources.",
        "services" => [
            "Website Design",
            "Web Application",
            "Digital Solutions"
        ]
    ],

    [
        "id" => "primebiz",
        "name" => "PrimeBiz Consulting",
        "category" => "Business",
        "location" => "Gurugram, India",
        "year" => "2024",
        "initials" => "PC",
        "featured" => false,
        "description" => "A professional consulting business that needed a trustworthy and conversion-focused online identity.",
        "services" => [
            "Website Design",
            "SEO Optimization",
            "Website Maintenance"
        ]
    ],

    [
        "id" => "creativecraft",
        "name" => "CreativeCraft Studio",
        "category" => "Creative",
        "location" => "Mumbai, India",
        "year" => "2024",
        "initials" => "CS",
        "featured" => true,
        "description" => "A creative studio that wanted a visually engaging website reflecting its creativity, services and brand identity.",
        "services" => [
            "Website Design",
            "Web Development",
            "Digital Marketing"
        ]
    ],

    [
        "id" => "healthplus",
        "name" => "HealthPlus Care",
        "category" => "Healthcare",
        "location" => "Jaipur, India",
        "year" => "2024",
        "initials" => "HC",
        "featured" => false,
        "description" => "A healthcare organization supported with a clean, accessible and mobile-friendly digital platform.",
        "services" => [
            "Website Development",
            "Web Hosting",
            "Website Maintenance"
        ]
    ],

    [
        "id" => "urbanedge",
        "name" => "UrbanEdge Interiors",
        "category" => "Interior & Design",
        "location" => "Lucknow, India",
        "year" => "2025",
        "initials" => "UI",
        "featured" => false,
        "description" => "An interior design brand that needed a premium digital portfolio to showcase its projects and attract new customers.",
        "services" => [
            "Website Design",
            "SEO Optimization",
            "Digital Marketing"
        ]
    ],

    [
        "id" => "learnpoint",
        "name" => "LearnPoint Academy",
        "category" => "Education",
        "location" => "Delhi, India",
        "year" => "2023",
        "initials" => "LA",
        "featured" => false,
        "description" => "An academy that partnered with Rudra EduTech to improve its online learning presence and student engagement.",
        "services" => [
            "Web Application",
            "Website Design",
            "Digital Solutions"
        ]
    ],

    [
        "id" => "marketbridge",
        "name" => "MarketBridge",
        "category" => "Marketing",
        "location" => "Pune, India",
        "year" => "2025",
        "initials" => "MB",
        "featured" => true,
        "description" => "A marketing-focused business requiring a fast, responsive and SEO-friendly website.",
        "services" => [
            "Website Development",
            "SEO Optimization",
            "Digital Marketing"
        ]
    ],

    [
        "id" => "fincore",
        "name" => "FinCore Advisors",
        "category" => "Finance",
        "location" => "Bengaluru, India",
        "year" => "2024",
        "initials" => "FA",
        "featured" => false,
        "description" => "A financial advisory company that required a professional online presence built around trust and clarity.",
        "services" => [
            "Website Design",
            "Web Development",
            "Website Maintenance"
        ]
    ],

    [
        "id" => "stylenest",
        "name" => "StyleNest Boutique",
        "category" => "Fashion",
        "location" => "Chandigarh, India",
        "year" => "2025",
        "initials" => "SB",
        "featured" => false,
        "description" => "A fashion boutique with a modern digital showcase designed to improve brand visibility and customer engagement.",
        "services" => [
            "Website Design",
            "Digital Marketing",
            "SEO Optimization"
        ]
    ],

    [
        "id" => "buildright",
        "name" => "BuildRight Projects",
        "category" => "Construction",
        "location" => "Ahmedabad, India",
        "year" => "2023",
        "initials" => "BP",
        "featured" => false,
        "description" => "A construction company that wanted a strong online portfolio to showcase projects and business capabilities.",
        "services" => [
            "Website Development",
            "Website Hosting",
            "SEO Optimization"
        ]
    ],

    [
        "id" => "nextstep",
        "name" => "NextStep Skills",
        "category" => "Training",
        "location" => "Patna, India",
        "year" => "2025",
        "initials" => "NS",
        "featured" => true,
        "description" => "A professional training organization supported with a modern digital platform for learners and businesses.",
        "services" => [
            "Website Design",
            "Web Application",
            "Digital Solutions"
        ]
    ]

];




$categories = ["All"];

foreach ($clients as $client) {

    if (!in_array($client["category"], $categories)) {

        $categories[] = $client["category"];

    }

}

$totalClients = count($clients);

$featuredClients = count(
    array_filter($clients, function ($client) {
        return $client["featured"];
    })
);


/* =========================================================
   ESCAPE FUNCTION
========================================================= */

function e($value)
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        "UTF-8"
    );
}

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
        content="Explore Rudra EduTech clients and discover the businesses, institutes and organizations we support with modern digital solutions."
    >

    <meta
        name="theme-color"
        content="#2563eb"
    >

    <title><?= e($pageTitle); ?></title>


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

        animation: loaderPulse 1s infinite;
    }

    .loader-content h3 {
      margin: 0;
    font-size: 22px;
    font-family: "Poppins", sans-serif;
    color: #0f172a;
    }

    .loader-content p {
        margin: 6px 0 0;

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



    .clients-hero {

        position: relative;

        padding:
            100px 20px 90px;

        overflow: hidden;

        background:
            radial-gradient(
                circle at 10% 20%,
                rgba(37, 99, 235, .12),
                transparent 30%
            ),
            radial-gradient(
                circle at 90% 20%,
                rgba(124, 58, 237, .13),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #f8fbff,
                #f5f3ff
            );
    }

    .hero-decoration {

        position: absolute;

        border-radius: 50%;

        filter:
            blur(1px);

        pointer-events:
            none;
    }

    .hero-decoration.one {

        width: 280px;
        height: 280px;

        left: -120px;
        top: 30px;

        background:
            rgba(37, 99, 235, .08);
    }

    .hero-decoration.two {

        width: 330px;
        height: 330px;

        right: -150px;
        bottom: -120px;

        background:
            rgba(124, 58, 237, .08);
    }

    .hero-inner {

        position: relative;

        z-index: 2;

        width: min(850px, 100%);

        margin: auto;

        text-align: center;
    }

    .hero-label,
    .section-label {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 8px 15px;

        border:
            1px solid #dbeafe;

        border-radius: 999px;

        color:
            var(--primary);

        background:
            rgba(239, 246, 255, .9);

        font-size: 13px;

        font-weight: 700;

        letter-spacing: .4px;
    }

    .hero-label i,
    .section-label i {

        font-size: 15px;
    }

    .hero-title {

        margin-top: 22px;

        font-family: "Poppins", sans-serif;

        font-size:
            clamp(42px, 6vw, 72px);

        line-height: 1.08;

        font-weight: 800;

        letter-spacing: -2px;

        color:
            var(--dark);
    }

    .hero-title span {

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        -webkit-background-clip:
            text;

        -webkit-text-fill-color:
            transparent;
    }

    .hero-text {

        max-width: 720px;

        margin: 24px auto 0;

        color:
            var(--text);

        font-size: 16px;
    }


    .stats-wrapper {

        width: min(1100px, calc(100% - 40px));

        margin:
            -42px auto 0;

        position: relative;

        z-index: 5;
    }

    .stats-card {

        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        background:
            var(--white);

        border:
            1px solid var(--border);

        border-radius:
            22px;

        box-shadow:
            0 20px 60px rgba(15, 23, 42, .08);

        overflow:
            hidden;
    }

    .stat-item {

        position: relative;

        padding: 28px 20px;

        text-align: center;
    }

    .stat-item:not(:last-child)::after {

        content: "";

        position: absolute;

        right: 0;

        top: 25%;

        height: 50%;

        width: 1px;

        background:
            var(--border);
    }

    .stat-number {

        display: block;

        font-family:
            "Poppins", sans-serif;

        font-size: 32px;

        font-weight: 800;

        color:
            var(--dark);
    }

    .stat-number span {

        color:
            var(--primary);
    }

    .stat-label {

        display: block;

        margin-top: 2px;

        color:
            var(--muted);

        font-size: 13px;

        font-weight: 600;
    }


    /* =========================================================
       CLIENT SECTION
    ========================================================= */

    .clients-section {

        padding:
            95px 20px 110px;

        background:
            var(--white);
    }

    .section-heading {

        width: min(760px, 100%);

        margin:
            0 auto 45px;

        text-align:
            center;
    }

    .section-heading h2 {

        margin-top: 17px;

        font-family:
            "Poppins", sans-serif;

        font-size:
            clamp(32px, 4vw, 48px);

        line-height: 1.2;

        font-weight: 800;

        letter-spacing:
            -1px;

        color:
            var(--dark);
    }

    .section-heading h2 span {

        color:
            var(--primary);
    }

    .section-heading p {

        margin-top: 15px;

        color:
            var(--text);

        font-size: 15px;
    }


    /* =========================================================
       FILTER
    ========================================================= */

    .filter-wrap {

        width: min(1180px, 100%);

        margin:
            0 auto 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-wrap: wrap;

        gap: 10px;
    }

    .filter-btn {

        position: relative;

        border:
            1px solid var(--border);

        background:
            var(--white);

        color:
            var(--text);

        padding:
            10px 17px;

        border-radius:
            999px;

        font-size:
            13px;

        font-weight:
            700;

        cursor:
            pointer;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .filter-btn:hover {

        color:
            var(--primary);

        border-color:
            #bfdbfe;

        transform:
            translateY(-2px);
    }

    .filter-btn.active {

        color:
            var(--white);

        border-color:
            transparent;

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        box-shadow:
            0 10px 25px rgba(37, 99, 235, .16);
    }


    /* =========================================================
       CLIENT GRID
    ========================================================= */

    .clients-grid {

        width: min(1180px, 100%);

        margin:
            auto;

        display:
            grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap:
            25px;
    }


    /* =========================================================
       CLIENT CARD
    ========================================================= */

    .client-card {

        position: relative;

        background:
            var(--white);

        border:
            1px solid var(--border);

        border-radius:
            22px;

        overflow:
            hidden;

        box-shadow:
            0 8px 25px rgba(15, 23, 42, .06);

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);

        animation:
            fadeUp .65s both;
    }

    .client-card:hover {

        transform:
            translateY(-8px);

        border-color:
            #cbd5e1;

        box-shadow:
            0 20px 60px rgba(15, 23, 42, .08);
    }

    .client-card.hidden {

        display:
            none;
    }



    .client-card::before {

        content: "";

        position: absolute;

        width: 130px;
        height: 300px;

        top: -100px;
        left: -180px;

        transform:
            rotate(25deg);

        background:
            linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.65),
                transparent
            );

        transition:
            .7s;

        pointer-events:
            none;

        z-index:
            2;
    }

    .client-card:hover::before {

        left:
            110%;
    }


    

    .client-top {

        position: relative;

        padding:
            27px 25px 24px;

        background:
            linear-gradient(
                135deg,
                #f8fbff,
                #f7f5ff
            );

        border-bottom:
            1px solid var(--border);
    }

    .featured-badge {

        position: absolute;

        top: 18px;
        right: 18px;

        display:
            inline-flex;

        align-items:
            center;

        gap:
            5px;

        padding:
            6px 10px;

        border-radius:
            999px;

        background:
            #fff7ed;

        color:
            #ea580c;

        border:
            1px solid #fed7aa;

        font-size:
            10px;

        font-weight:
            800;

        text-transform:
            uppercase;

        letter-spacing:
            .5px;
    }


    /* CLIENT LOGO */

    .client-logo {

        width:
            68px;

        height:
            68px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border-radius:
            18px;

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        color:
            var(--white);

        font-family:
            "Poppins", sans-serif;

        font-size:
            20px;

        font-weight:
            800;

        box-shadow:
            0 12px 30px rgba(37, 99, 235, .18);

        margin-bottom:
            20px;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .client-card:hover .client-logo {

        transform:
            rotate(-4deg) scale(1.06);
    }

    .client-name {

        font-family:
            "Poppins", sans-serif;

        font-size:
            20px;

        line-height:
            1.35;

        font-weight:
            700;

        color:
            var(--dark);
    }

    .client-category {

        display:
            inline-flex;

        align-items:
            center;

        gap:
            6px;

        margin-top:
            8px;

        color:
            var(--primary);

        font-size:
            12px;

        font-weight:
            700;
    }


    /* CARD BODY */

    .client-body {

        padding:
            24px 25px 25px;
    }

    .client-description {

        min-height:
            82px;

        color:
            var(--text);

        font-size:
            13.5px;

        line-height:
            1.75;
    }

    .client-meta {

        display:
            flex;

        flex-wrap:
            wrap;

        gap:
            9px;

        margin-top:
            18px;
    }

    .meta-item {

        display:
            inline-flex;

        align-items:
            center;

        gap:
            6px;

        padding:
            7px 10px;

        border-radius:
            9px;

        background:
            var(--light);

        color:
            var(--muted);

        font-size:
            11px;

        font-weight:
            600;
    }

    .meta-item i {

        color:
            var(--primary);

        font-size:
            12px;
    }




    .service-tags {

        display:
            flex;

        flex-wrap:
            wrap;

        gap:
            7px;

        margin-top:
            19px;
    }

    .service-tag {

        padding:
            5px 9px;

        border-radius:
            7px;

        background:
            var(--primary-light);

        color:
            var(--primary);

        font-size:
            10px;

        font-weight:
            700;
    }


    

    .client-action {

        display:
            flex;

        align-items:
            center;

        justify-content:
            space-between;

        gap:
            10px;

        margin-top:
            22px;

        padding-top:
            19px;

        border-top:
            1px solid var(--border);
    }

    .view-client {

        display:
            inline-flex;

        align-items:
            center;

        gap:
            7px;

        color:
            var(--primary);

        font-size:
            13px;

        font-weight:
            700;

        cursor:
            pointer;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .view-client:hover {

        gap:
            11px;

        color:
            var(--secondary);
    }

    .view-client i {

        font-size:
            15px;
    }



    .empty-state {

        display:
            none;

        width:
            min(650px, 100%);

        margin:
            30px auto;

        padding:
            50px 25px;

        text-align:
            center;

        border:
            1px dashed var(--border);

        border-radius:
            20px;

        color:
            var(--muted);
    }

    .empty-state.show {
        display: block;
    }

    .empty-state i {

        display:
            block;

        margin-bottom:
            12px;

        font-size:
            38px;

        color:
            var(--primary);
    }


  

    .trust-section {

        position:
            relative;

        padding:
            100px 20px 110px;

        overflow:
            hidden;

        background:
            linear-gradient(
                135deg,
                #f8fbff,
                #f7f5ff
            );
    }

    .trust-grid {

        width:
            min(1180px, 100%);

        margin:
            50px auto 0;

        display:
            grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap:
            20px;
    }

    .trust-card {

        padding:
            30px 25px;

        text-align:
            center;

        background:
            var(--white);

        border:
            1px solid var(--border);

        border-radius:
            20px;

        box-shadow:
            0 8px 25px rgba(15, 23, 42, .06);

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .trust-card:hover {

        transform:
            translateY(-7px);

        box-shadow:
            0 20px 60px rgba(15, 23, 42, .08);
    }

    .trust-icon {

        width:
            60px;

        height:
            60px;

        margin:
            0 auto 19px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border-radius:
            16px;

        background:
            var(--primary-light);

        color:
            var(--primary);

        font-size:
            25px;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .trust-card:hover .trust-icon {

        color:
            var(--white);

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        transform:
            rotate(-5deg);
    }

    .trust-card h3 {

        font-family:
            "Poppins", sans-serif;

        font-size:
            17px;

        font-weight:
            700;

        color:
            var(--dark);
    }

    .trust-card p {

        margin-top:
            9px;

        color:
            var(--muted);

        font-size:
            13px;
    }


    .clients-cta {

        padding:
            90px 20px;

        background:
            var(--white);
    }

    .cta-box {

        position:
            relative;

        width:
            min(1180px, 100%);

        margin:
            auto;

        padding:
            55px;

        overflow:
            hidden;

        border-radius:
            28px;

        background:
            linear-gradient(
                135deg,
                #111827,
                #1e293b
            );

        box-shadow:
            0 25px 70px rgba(15, 23, 42, .18);

        text-align:
            center;
    }

    .cta-box::before {

        content:
            "";

        position:
            absolute;

        width:
            300px;

        height:
            300px;

        border-radius:
            50%;

        top:
            -180px;

        left:
            -100px;

        background:
            rgba(37, 99, 235, .18);
    }

    .cta-box::after {

        content:
            "";

        position:
            absolute;

        width:
            300px;

        height:
            300px;

        border-radius:
            50%;

        right:
            -100px;

        bottom:
            -180px;

        background:
            rgba(124, 58, 237, .18);
    }

    .cta-content {

        position:
            relative;

        z-index:
            2;
    }

    .cta-box h2 {

        font-family:
            "Poppins", sans-serif;

        color:
            var(--white);

        font-size:
            clamp(30px, 4vw, 46px);

        line-height:
            1.2;

        font-weight:
            800;
    }

    .cta-box p {

        max-width:
            650px;

        margin:
            15px auto 0;

        color:
            #cbd5e1;

        font-size:
            15px;
    }

    .cta-buttons {

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        flex-wrap:
            wrap;

        gap:
            12px;

        margin-top:
            27px;
    }

    .btn {

        display:
            inline-flex;

        align-items:
            center;

        justify-content:
            center;

        gap:
            8px;

        min-height:
            48px;

        padding:
            0 21px;

        border-radius:
            12px;

        font-size:
            13px;

        font-weight:
            700;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .btn-primary {

        color:
            var(--white);

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        box-shadow:
            0 12px 28px rgba(37, 99, 235, .25);
    }

    .btn-primary:hover {

        transform:
            translateY(-3px);

        box-shadow:
            0 18px 35px rgba(37, 99, 235, .35);
    }

    .btn-light {

        color:
            var(--dark);

        background:
            var(--white);
    }

    .btn-light:hover {

        transform:
            translateY(-3px);

        background:
            #f8fafc;
    }



    .back-top {

        position:
            fixed;

        right:
            22px;

        bottom:
            22px;

        width:
            46px;

        height:
            46px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border:
            0;

        border-radius:
            14px;

        color:
            var(--white);

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        box-shadow:
            0 12px 30px rgba(37, 99, 235, .25);

        cursor:
            pointer;

        opacity:
            0;

        visibility:
            hidden;

        transform:
            translateY(15px);

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);

        z-index:
            999;
    }

    .back-top.show {

        opacity:
            1;

        visibility:
            visible;

        transform:
            translateY(0);
    }

    .back-top:hover {

        transform:
            translateY(-4px);
    }


    .client-modal {

        position:
            fixed;

        inset:
            0;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        padding:
            20px;

        background:
            rgba(15, 23, 42, .68);

        backdrop-filter:
            blur(8px);

        opacity:
            0;

        visibility:
            hidden;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);

        z-index:
            10000;
    }

    .client-modal.show {

        opacity:
            1;

        visibility:
            visible;
    }

    .modal-box {

        position:
            relative;

        width:
            min(650px, 100%);

        max-height:
            90vh;

        overflow:
            auto;

        padding:
            38px;

        border-radius:
            25px;

        background:
            var(--white);

        box-shadow:
            0 30px 90px rgba(15, 23, 42, .25);

        transform:
            translateY(25px) scale(.97);

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .client-modal.show .modal-box {

        transform:
            translateY(0) scale(1);
    }

    .modal-close {

        position:
            absolute;

        top:
            17px;

        right:
            17px;

        width:
            40px;

        height:
            40px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border:
            1px solid var(--border);

        border-radius:
            11px;

        background:
            var(--white);

        color:
            var(--muted);

        font-size:
            19px;

        cursor:
            pointer;

        transition:
            all .35s cubic-bezier(.4, 0, .2, 1);
    }

    .modal-close:hover {

        color:
            var(--white);

        background:
            var(--primary);

        border-color:
            var(--primary);
    }

    .modal-logo {

        width:
            72px;

        height:
            72px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border-radius:
            18px;

        background:
            linear-gradient(
                135deg,
                var(--primary),
                var(--secondary)
            );

        color:
            var(--white);

        font-family:
            "Poppins", sans-serif;

        font-weight:
            800;

        font-size:
            21px;

        margin-bottom:
            20px;
    }

    .modal-title {

        padding-right:
            45px;

        font-family:
            "Poppins", sans-serif;

        font-size:
            28px;

        line-height:
            1.25;

        font-weight:
            800;

        color:
            var(--dark);
    }

    .modal-category {

        margin-top:
            7px;

        color:
            var(--primary);

        font-size:
            13px;

        font-weight:
            700;
    }

    .modal-description {

        margin-top:
            22px;

        padding-left:
            17px;

        border-left:
            3px solid var(--primary);

        color:
            var(--text);

        font-size:
            14px;
    }

    .modal-info {

        display:
            grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap:
            12px;

        margin-top:
            24px;
    }

    .modal-info-item {

        padding:
            15px;

        border:
            1px solid var(--border);

        border-radius:
            13px;

        background:
            var(--light);
    }

    .modal-info-item small {

        display:
            block;

        color:
            var(--muted);

        font-size:
            10px;

        font-weight:
            700;

        text-transform:
            uppercase;
    }

    .modal-info-item strong {

        display:
            block;

        margin-top:
            3px;

        color:
            var(--dark);

        font-size:
            13px;
    }

    .modal-services {

        margin-top:
            24px;
    }

    .modal-services h4 {

        margin-bottom:
            11px;

        font-family:
            "Poppins", sans-serif;

        font-size:
            15px;

        color:
            var(--dark);
    }


    /* =========================================================
       ANIMATIONS
    ========================================================= */

    @keyframes fadeUp {

        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reveal {

        opacity:
            0;

        transform:
            translateY(25px);

        transition:
            opacity .7s ease,
            transform .7s ease;
    }

    .reveal.visible {

        opacity:
            1;

        transform:
            translateY(0);
    }


    /* =========================================================
       RESPONSIVE — 1150px
    ========================================================= */

    @media (max-width: 1150px) {
        .clients-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .trust-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }
    }


    /* =========================================================
       RESPONSIVE — 950px
    ========================================================= */

    @media (max-width: 950px) {
        .stats-card {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .stat-item:nth-child(2)::after {
            display: none;
        }

        .stat-item:nth-child(-n+2) {
            border-bottom:
                1px solid var(--border);
        }
    }


    /* =========================================================
       RESPONSIVE — 650px
    ========================================================= */

    @media (max-width: 650px) {
        .clients-hero {
            padding:
                75px 18px 75px;
        }

        .stats-wrapper {
            width:
                calc(100% - 30px);
        }

        .stat-item {
            padding:
                22px 12px;
        }

        .stat-number {
            font-size:
                27px;
        }

        .clients-section {
            padding:
                75px 15px 85px;
        }

        .filter-wrap {
            justify-content:
                flex-start;

            overflow-x:
                auto;

            flex-wrap:
                nowrap;

            padding-bottom:
                5px;

            scrollbar-width:
                none;
        }

        .filter-wrap::-webkit-scrollbar {
            display: none;
        }

        .filter-btn {
            flex-shrink:
                0;
        }

        .clients-grid {
            grid-template-columns:
                1fr;

            gap:
                18px;
        }

        .trust-section {
            padding:
                75px 15px 85px;
        }

        .trust-grid {
            grid-template-columns:
                1fr;

            gap:
                15px;
        }

        .clients-cta {
            padding:
                70px 15px;
        }

        .cta-box {
            padding:
                40px 22px;
        }

        .modal-box {
            padding:
                30px 22px;
        }

        .modal-info {
            grid-template-columns:
                1fr;
        }
    }


    /* =========================================================
       RESPONSIVE — 400px
    ========================================================= */

    @media (max-width: 400px) {
        .stats-card {
            grid-template-columns:
                1fr;
        }

        .stat-item {
            border-bottom:
                1px solid var(--border);
        }

        .stat-item:last-child {
            border-bottom:
                0;
        }

        .stat-item::after {
            display:
                none !important;
        }

        .client-body,
        .client-top {
            padding-left:
                20px;

            padding-right:
                20px;
        }

        .cta-buttons {
            flex-direction:
                column;
        }

        .btn {
            width:
                100%;
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




<!-- =========================================================
     HEADER / NAVIGATION
========================================================= -->

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

<!-- =========================================================
     HERO
========================================================== -->

<section class="clients-hero">

    <div class="hero-decoration one"></div>
    <div class="hero-decoration two"></div>

    <div class="hero-inner">

        <div class="hero-label">

            <i class="bi bi-people"></i>

            Our Clients

        </div>

        <h1 class="hero-title">

            Trusted by businesses.

            <span>
                Built for growth.
            </span>

        </h1>

        <p class="hero-text">

            We work with businesses, educational institutions,
            professionals and organizations to create modern digital
            experiences that deliver real value.

        </p>

    </div>

</section>




<div class="stats-wrapper">

    <div class="stats-card">

        <div class="stat-item">

            <strong
                class="stat-number"
                data-count="<?= $totalClients; ?>"
            >

                0<span>+</span>

            </strong>

            <span class="stat-label">
                Clients
            </span>

        </div>


        <div class="stat-item">

            <strong
                class="stat-number"
                data-count="<?= $featuredClients; ?>"
            >

                0<span>+</span>

            </strong>

            <span class="stat-label">
                Featured Projects
            </span>

        </div>


        <div class="stat-item">

            <strong
                class="stat-number"
                data-count="15"
            >

                0<span>+</span>

            </strong>

            <span class="stat-label">
                Digital Solutions
            </span>

        </div>


        <div class="stat-item">

            <strong
                class="stat-number"
                data-count="100"
            >

                0<span>%</span>

            </strong>

            <span class="stat-label">
                Commitment
            </span>

        </div>

    </div>

</div>


<!-- =========================================================
     CLIENTS
========================================================== -->

<section class="clients-section">

    <div class="section-heading reveal">

        <div class="section-label">

            <i class="bi bi-grid-3x3-gap"></i>

            Our Client Portfolio

        </div>

        <h2>

            Businesses we help

            <span>
                move forward.
            </span>

        </h2>

        <p>

            Explore some of the businesses and organizations
            that have trusted Rudra EduTech for their digital
            transformation journey.

        </p>

    </div>


  

    <div class="filter-wrap">

        <?php foreach ($categories as $index => $category): ?>

            <button
                type="button"
                class="filter-btn <?= $index === 0 ? 'active' : ''; ?>"
                data-filter="<?= e($category); ?>"
            >

                <?php if ($category === "All"): ?>

                    <i class="bi bi-grid"></i>

                <?php else: ?>

                    <i class="bi bi-folder2-open"></i>

                <?php endif; ?>

                <?= e($category); ?>

            </button>

        <?php endforeach; ?>

    </div>



    <div
        class="clients-grid"
        id="clientsGrid"
    >

        <?php foreach ($clients as $index => $client): ?>

            <article
                class="client-card reveal"
                data-category="<?= e($client["category"]); ?>"
                style="animation-delay: <?= ($index % 3) * 0.08; ?>s;"
            >

                <div class="client-top">

                    <?php if ($client["featured"]): ?>

                        <div class="featured-badge">

                            <i class="bi bi-star-fill"></i>

                            Featured

                        </div>

                    <?php endif; ?>


                    <div class="client-logo">

                        <?= e($client["initials"]); ?>

                    </div>


                    <h3 class="client-name">

                        <?= e($client["name"]); ?>

                    </h3>


                    <div class="client-category">

                        <i class="bi bi-building"></i>

                        <?= e($client["category"]); ?>

                    </div>

                </div>


                <div class="client-body">

                    <p class="client-description">

                        <?= e($client["description"]); ?>

                    </p>


                    <div class="client-meta">

                        <span class="meta-item">

                            <i class="bi bi-geo-alt"></i>

                            <?= e($client["location"]); ?>

                        </span>


                        <span class="meta-item">

                            <i class="bi bi-calendar3"></i>

                            <?= e($client["year"]); ?>

                        </span>

                    </div>


                    <div class="service-tags">

                        <?php foreach ($client["services"] as $service): ?>

                            <span class="service-tag">

                                <?= e($service); ?>

                            </span>

                        <?php endforeach; ?>

                    </div>


                    <div class="client-action">

                        <span
                            class="view-client"
                            data-client="<?= e($client["id"]); ?>"
                        >

                            View Project

                            <i class="bi bi-arrow-right"></i>

                        </span>


                        <i
                            class="bi bi-arrow-up-right"
                            style="color:#94a3b8;"
                        ></i>

                    </div>

                </div>

            </article>

        <?php endforeach; ?>

    </div>


    <!-- EMPTY -->

    <div
        class="empty-state"
        id="emptyState"
    >

        <i class="bi bi-search"></i>

        <strong>
            No clients found
        </strong>

        <p>
            Try selecting another category.
        </p>

    </div>

</section>




<section class="trust-section">

    <div class="section-heading reveal">

        <div class="section-label">

            <i class="bi bi-shield-check"></i>

            Why Clients Choose Us

        </div>

        <h2>

            More than a service.

            <span>
                A long-term partner.
            </span>

        </h2>

        <p>

            Our approach combines technology, creativity and
            practical thinking to build solutions that actually
            support your goals.

        </p>

    </div>


    <div class="trust-grid">

        <div class="trust-card reveal">

            <div class="trust-icon">

                <i class="bi bi-award"></i>

            </div>

            <h3>
                Quality First
            </h3>

            <p>

                We focus on clean design, reliable development
                and professional-quality results.

            </p>

        </div>


        <div class="trust-card reveal">

            <div class="trust-icon">

                <i class="bi bi-lightning-charge"></i>

            </div>

            <h3>
                Modern Technology
            </h3>

            <p>

                We use modern tools and development practices
                to create fast and scalable digital solutions.

            </p>

        </div>


        <div class="trust-card reveal">

            <div class="trust-icon">

                <i class="bi bi-headset"></i>

            </div>

            <h3>
                Dedicated Support
            </h3>

            <p>

                We stay available to help maintain, improve
                and grow your digital presence.

            </p>

        </div>


        <div class="trust-card reveal">

            <div class="trust-icon">

                <i class="bi bi-graph-up-arrow"></i>

            </div>

            <h3>
                Growth Focused
            </h3>

            <p>

                Every solution is designed with usability,
                visibility and long-term growth in mind.

            </p>

        </div>

    </div>

</section>




<section class="clients-cta">

    <div class="cta-box">

        <div class="cta-content">

            <h2>

                Ready to become our next success story?

            </h2>

            <p>

                Let's build a professional digital solution
                that helps your business, institute or brand
                stand out and grow.

            </p>


            <div class="cta-buttons">

                <a
                    href="contact.php"
                    class="btn btn-primary"
                >

                    Start Your Project

                    <i class="bi bi-arrow-right"></i>

                </a>


                <a
                    href="services.php"
                    class="btn btn-light"
                >

                    Explore Our Services

                    <i class="bi bi-grid"></i>

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

                            <?php echo htmlspecialchars($whatsappDisplay); ?>

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
    type="button"
    class="back-top"
    id="backTop"
    aria-label="Back to Top"
>

    <i class="bi bi-arrow-up"></i>

</button>


<!-- =========================================================
     CLIENT MODAL
========================================================= -->

<div
    class="client-modal"
    id="clientModal"
    aria-hidden="true"
>

    <div class="modal-box">

        <button
            type="button"
            class="modal-close"
            id="modalClose"
            aria-label="Close"
        >

            <i class="bi bi-x-lg"></i>

        </button>


        <div
            class="modal-logo"
            id="modalLogo"
        >
            --
        </div>


        <h2
            class="modal-title"
            id="modalTitle"
        >
            Client Name
        </h2>


        <div
            class="modal-category"
            id="modalCategory"
        >
            Category
        </div>


        <p
            class="modal-description"
            id="modalDescription"
        >
            Description
        </p>


        <div class="modal-info">

            <div class="modal-info-item">

                <small>
                    Location
                </small>

                <strong id="modalLocation">
                    -
                </strong>

            </div>


            <div class="modal-info-item">

                <small>
                    Project Year
                </small>

                <strong id="modalYear">
                    -
                </strong>

            </div>

        </div>


        <div class="modal-services">

            <h4>
                Services Provided
            </h4>

            <div
                class="service-tags"
                id="modalServices"
            ></div>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

"use strict";


/* =========================================================
   PAGE LOADER SCRIPT (Matched with about.php / services.php)
========================================================= */

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
   CLIENT DATA
========================================================= */

const clients = <?= json_encode(
    $clients,
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE
); ?>;


/* =========================================================
   ELEMENTS
========================================================= */

const menuToggle =
    document.getElementById("menuToggle");

const navMenu =
    document.getElementById("navMenu");

const navLinks =
    document.querySelectorAll(".nav-menu a");

const backTop =
    document.getElementById("backTop");

const filterButtons =
    document.querySelectorAll(".filter-btn");

const clientCards =
    document.querySelectorAll(".client-card");

const emptyState =
    document.getElementById("emptyState");

const modal =
    document.getElementById("clientModal");

const modalClose =
    document.getElementById("modalClose");

const modalLogo =
    document.getElementById("modalLogo");

const modalTitle =
    document.getElementById("modalTitle");

const modalCategory =
    document.getElementById("modalCategory");

const modalDescription =
    document.getElementById("modalDescription");

const modalLocation =
    document.getElementById("modalLocation");

const modalYear =
    document.getElementById("modalYear");

const modalServices =
    document.getElementById("modalServices");


/* =========================================================
   MOBILE NAV
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


/* =========================================================
   SCROLL AND BACK TO TOP
========================================================= */

function handleScroll() {
    const scrollTop = window.scrollY;

    if (backTop) {
        backTop.classList.toggle(
            "show",
            scrollTop > 500
        );
    }
}

window.addEventListener(
    "scroll",
    handleScroll,
    { passive: true }
);

handleScroll();


if (backTop) {

    backTop.addEventListener("click", () => {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}



const revealElements =
    document.querySelectorAll(".reveal");


const revealObserver =
    new IntersectionObserver(
        entries => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    entry.target.classList.add(
                        "visible"
                    );

                    revealObserver.unobserve(
                        entry.target
                    );

                }

            });

        },
        {
            threshold: 0.12
        }
    );


revealElements.forEach(element => {

    revealObserver.observe(element);

});


const counterElements =
    document.querySelectorAll(".stat-number");

let countersStarted = false;


function startCounters() {

    if (countersStarted) {
        return;
    }

    countersStarted = true;


    counterElements.forEach(counter => {

        const target =
            Number(
                counter.dataset.count
            );

        const suffix =
            counter.querySelector("span");

        let current = 0;

        const duration = 1300;

        const startTime =
            performance.now();


        function updateCounter(time) {

            const progress =
                Math.min(
                    (time - startTime) / duration,
                    1
                );

            const eased =
                1 - Math.pow(
                    1 - progress,
                    3
                );

            current =
                Math.floor(
                    target * eased
                );

            if (suffix) {

                counter.innerHTML =
                    current +
                    suffix.outerHTML;

            } else {

                counter.textContent =
                    current;

            }


            if (progress < 1) {

                requestAnimationFrame(
                    updateCounter
                );

            }

        }


        requestAnimationFrame(
            updateCounter
        );

    });

}


const statsWrapper =
    document.querySelector(".stats-wrapper");


if (statsWrapper) {

    const counterObserver =
        new IntersectionObserver(
            entries => {

                if (
                    entries[0].isIntersecting
                ) {

                    startCounters();

                    counterObserver.disconnect();

                }

            },
            {
                threshold: .3
            }
        );

    counterObserver.observe(
        statsWrapper
    );

}




filterButtons.forEach(button => {

    button.addEventListener("click", () => {

        const selected =
            button.dataset.filter;


        filterButtons.forEach(btn => {

            btn.classList.remove("active");

        });

        button.classList.add("active");


        let visibleCount = 0;


        clientCards.forEach((card, index) => {

            const category =
                card.dataset.category;

            const shouldShow =
                selected === "All" ||
                category === selected;


            if (shouldShow) {

                card.classList.remove(
                    "hidden"
                );

                card.style.animation =
                    "none";

                void card.offsetWidth;

                card.style.animation =
                    `fadeUp .55s ${
                        (visibleCount % 3) * .07
                    }s both`;

                visibleCount++;

            } else {

                card.classList.add(
                    "hidden"
                );

            }

        });


        if (emptyState) {

            emptyState.classList.toggle(
                "show",
                visibleCount === 0
            );

        }

    });

});



function escapeHTML(value) {

    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");

}


function openClientModal(clientId) {

    const client =
        clients.find(
            item => item.id === clientId
        );


    if (!client) {
        return;
    }


    modalLogo.textContent =
        client.initials;

    modalTitle.textContent =
        client.name;

    modalCategory.textContent =
        client.category;

    modalDescription.textContent =
        client.description;

    modalLocation.textContent =
        client.location;

    modalYear.textContent =
        client.year;


    modalServices.innerHTML =
        client.services
            .map(service => {

                return `
                    <span class="service-tag">
                        ${escapeHTML(service)}
                    </span>
                `;

            })
            .join("");


    modal.classList.add("show");

    modal.setAttribute(
        "aria-hidden",
        "false"
    );

    document.body.style.overflow =
        "hidden";

}


function closeClientModal() {

    modal.classList.remove("show");

    modal.setAttribute(
        "aria-hidden",
        "true"
    );

    document.body.style.overflow =
        "";

}


/* =========================================================
   OPEN MODAL
========================================================= */

document.querySelectorAll(
    ".view-client"
).forEach(button => {

    button.addEventListener(
        "click",
        () => {

            openClientModal(
                button.dataset.client
            );

        }
    );

});



if (modalClose) {

    modalClose.addEventListener(
        "click",
        closeClientModal
    );

}


if (modal) {

    modal.addEventListener(
        "click",
        event => {

            if (
                event.target === modal
            ) {

                closeClientModal();

            }

        }
    );

}




document.addEventListener(
    "keydown",
    event => {

        if (event.key === "Escape") {

            closeClientModal();

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