<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle   = "Blog | Rudra EduTech";
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

$dbConnected = false;

if (!$conn->connect_error) {
    $conn->set_charset("utf8mb4");
    $dbConnected = true;
}

$isLoggedIn =
    isset($_SESSION['user_id']) &&
    isset($_SESSION['logged_in']) &&
    $_SESSION['logged_in'] === true;

/* =========================================================
   CONTACT DETAILS
========================================================= */

$phone        = "7738699924";
$phoneDisplay = "+91 7738699924";

$email = "vishalkumar167248@gmail.com";

$whatsapp        = "917738699924";
$whatsappDisplay = "+91 7738699924";

/* =========================================================
   SOCIAL LINKS
========================================================= */

$facebook  = "#";
$instagram = "#";
$linkedin  = "#";
$youtube   = "#";


$blogs = [];

if ($dbConnected) {
    $tableCheck = $conn->query("SHOW TABLES LIKE 'blogs'");

    if ($tableCheck && $tableCheck->num_rows > 0) {
        $query = "
            SELECT
                id,
                title,
                category,
                excerpt,
                content,
                image,
                author,
                created_at
            FROM blogs
            ORDER BY id DESC
        ";

        $result = $conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $blogs[] = $row;
            }
            $result->free();
        }
    }
    $conn->close();
}


if (empty($blogs)) {
    $blogs = [
        [
            "id" => 1,
            "title" => "The Future of Web Development in 2026: Trends & Technologies",
            "category" => "Web Development",
            "excerpt" => "Explore the latest technologies, frameworks, responsive interfaces and development trends shaping modern websites.",
            "content" => "Web development in 2026 is evolving rapidly. Modern websites are no longer limited to simple pages and static information. Developers are now focusing on performance, accessibility, artificial intelligence, advanced CSS, interactive interfaces and scalable backend architectures.\n\nResponsive design has become a fundamental requirement for every modern website. Users expect websites to load quickly and work perfectly across smartphones, tablets and desktop computers.\n\nAt Rudra EduTech, our training approach focuses on practical development. Students learn how to build complete websites, work with databases, create responsive layouts and understand real-world development workflows.",
            "image" => "https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Rudra EduTech Team",
            "created_at" => "2026-08-15"
        ],
        [
            "id" => 2,
            "title" => "Why Practical Computer Science Training Matters for Students",
            "category" => "Education",
            "excerpt" => "Discover how practical projects and real-world development experience help students become career-ready professionals.",
            "content" => "Traditional education often focuses heavily on theory. While theoretical knowledge is important, students also need practical experience to understand how technology works in real-world environments.\n\nPractical learning allows students to create websites, applications and software solutions while solving actual development problems. Students can learn version control, debugging, databases, deployment and project management through hands-on practice.\n\nRudra EduTech focuses on practical learning so students can develop confidence and build a strong technical foundation for their careers.",
            "image" => "https://images.pexels.com/photos/5905709/pexels-photo-5905709.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Vishal Kumar",
            "created_at" => "2026-08-20"
        ],
        [
            "id" => 3,
            "title" => "Scaling Small Businesses with Automated Digital Solutions",
            "category" => "Digital Solutions",
            "excerpt" => "Learn how websites, automation, hosting and digital tools can help small businesses improve their online presence.",
            "content" => "Small businesses can compete effectively in today's digital environment by adopting the right technologies.\n\nA professional website, reliable hosting, optimized user experience and digital automation can significantly improve customer engagement. Businesses can also use customized dashboards, CRM systems and online forms to simplify their daily operations.\n\nRudra EduTech creates digital solutions designed around business requirements. The goal is to provide scalable technology that can grow along with the business.",
            "image" => "https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Tech Advisory",
            "created_at" => "2026-08-28"
        ],
        [
            "id" => 4,
            "title" => "How a Professional Website Builds Brand Trust",
            "category" => "Web Design",
            "excerpt" => "A modern website can become one of the strongest trust-building tools for your business.",
            "content" => "A website is often the first interaction a potential customer has with a business. A clean design, fast performance and clear information can create a strong first impression.\n\nProfessional web design combines typography, colors, spacing, animations and usability to create an experience that feels trustworthy.\n\nBusinesses should focus not only on making their website visually attractive but also on making it easy for customers to find information and take action.",
            "image" => "https://images.pexels.com/photos/196644/pexels-photo-196644.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Rudra Design Team",
            "created_at" => "2026-08-30"
        ],
        [
            "id" => 5,
            "title" => "PHP & MySQL: Building Dynamic Websites",
            "category" => "Programming",
            "excerpt" => "Understand how PHP and MySQL work together to create powerful dynamic websites and web applications.",
            "content" => "PHP and MySQL remain useful technologies for developing dynamic websites. PHP handles server-side processing while MySQL stores structured application data.\n\nTogether they can be used to build login systems, admin dashboards, blogs, contact systems, course management systems and many other applications.\n\nLearning PHP with MySQL also gives students a strong understanding of backend development and database concepts.",
            "image" => "https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Development Team",
            "created_at" => "2026-09-01"
        ],
        [
            "id" => 6,
            "title" => "The Importance of Responsive Web Design",
            "category" => "Technology",
            "excerpt" => "Learn why responsive design is essential for creating websites that work smoothly on every screen.",
            "content" => "People access websites using many different devices. A website that looks perfect on a desktop but breaks on mobile can result in poor user experience.\n\nResponsive web design uses flexible layouts, images, grids and media queries to adapt a website to different screen sizes.\n\nModern websites should be designed with mobile users in mind while maintaining an excellent desktop experience.",
            "image" => "https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=1200",
            "author" => "Rudra EduTech",
            "created_at" => "2026-09-03"
        ]
    ];
}


function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function formatBlogDate($date) {
    if (empty($date)) {
        return "Recent";
    }
    $timestamp = strtotime($date);
    if (!$timestamp) {
        return "Recent";
    }
    return date("M d, Y", $timestamp);
}


$categories = [];
foreach ($blogs as $blog) {
    $category = trim($blog['category'] ?? '');
    if ($category !== '' && !in_array($category, $categories, true)) {
        $categories[] = $category;
    }
}
sort($categories);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Read the latest technology, education, web development and digital solution articles from Rudra EduTech[cite: 10, 11].">
    <meta name="author" content="Rudra EduTech">
    <meta name="robots" content="index, follow">
    <title><?php echo e($pageTitle); ?></title>

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

   
    <style>
        :root {
            --blog-primary: #2563eb;
            --blog-primary-dark: #1d4ed8;
            --blog-secondary: #7c3aed;
            --blog-cyan: #06b6d4;
            --blog-dark: #0f172a;
            --blog-heading: #111827;
            --blog-text: #475569;
            --blog-muted: #64748b;
            --blog-border: #e2e8f0;
            --blog-light: #f8fafc;
            --blog-white: #ffffff;
            --blog-radius: 24px;
            --blog-shadow: 0 15px 45px rgba(15, 23, 42, .07);
            --blog-shadow-hover: 0 30px 70px rgba(37, 99, 235, .15);
        }

        .blog-page {
            overflow-x: hidden;
        }

       
        .about-loader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity .6s ease, visibility .6s ease;
        }

        .about-loader.hide {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
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
            font-family: "Poppins", sans-serif;
            color: var(--blog-heading);
            font-weight: 700;
        }

        .loader-content p {
            margin: 5px 0 0;
            opacity: .7;
            color: var(--blog-muted);
            font-size: 13px;
        }

        @keyframes loaderPulse {
            0% { transform: scale(.9); opacity: .6; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(.9); opacity: .6; }
        }

        .blog-hero {
            position: relative;
            min-height: 430px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px 90px;
            overflow: hidden;
            background: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, .10), transparent 30%), radial-gradient(circle at 90% 20%, rgba(124, 58, 237, .10), transparent 30%), linear-gradient(135deg, #f8fbff, #f7f5ff);
        }

        .blog-hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 1px solid #dbeafe;
            border-radius: 50px;
            color: var(--blog-primary);
            background: rgba(255,255,255,.8);
            box-shadow: 0 10px 25px rgba(37,99,235,.07);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            backdrop-filter: blur(10px);
        }

        .blog-hero h1 {
            margin: 20px 0 0;
            font-family: "Poppins", sans-serif;
            font-size: clamp(40px, 6vw, 68px);
            line-height: 1.08;
            letter-spacing: -2.5px;
            font-weight: 800;
            color: var(--blog-heading);
        }

        .blog-hero h1 span {
            background: linear-gradient(90deg, #2563eb, #7c3aed, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% auto;
            animation: gradientMove 5s linear infinite;
        }

        @keyframes gradientMove {
            to { background-position: 200% center; }
        }

        .blog-hero p {
            max-width: 700px;
            margin: 20px auto 0;
            color: var(--blog-muted);
            font-size: 16px;
            line-height: 1.8;
        }

        .blog-grid-section {
            padding: 90px 20px 110px;
            background: #ffffff;
        }

        .blog-container {
            width: min(1200px, 100%);
            margin: auto;
        }

        .blog-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 45px;
            padding: 16px;
            background: #ffffff;
            border: 1px solid var(--blog-border);
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .blog-search {
            position: relative;
            flex: 1;
            max-width: 380px;
        }

        .blog-search i {
            position: absolute;
            left: 17px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--blog-muted);
            font-size: 16px;
        }

        .blog-search input {
            width: 100%;
            height: 48px;
            padding: 0 18px 0 45px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            color: var(--blog-dark);
            background: #f8fafc;
            transition: .3s ease;
        }

        .blog-search input:focus {
            border-color: #93c5fd;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37,99,235,.08);
        }

        .category-filters {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .category-btn {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            padding: 9px 14px;
            border-radius: 10px;
            font-family: "Inter", sans-serif;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: color .3s ease, background .3s ease, border-color .3s ease, transform .3s ease;
        }

        .category-btn:hover {
            transform: translateY(-2px);
            border-color: #bfdbfe;
            color: var(--blog-primary);
        }

        .category-btn.active {
            color: #ffffff;
            background: linear-gradient(135deg, var(--blog-primary), var(--blog-secondary));
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(37,99,235,.18);
        }

        .blog-wrapper {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 30px;
        }

        .blog-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid var(--blog-border);
            border-radius: var(--blog-radius);
            box-shadow: var(--blog-shadow);
            opacity: 0;
            transform: translateY(35px) scale(.98);
            transition: transform .55s cubic-bezier(.2,.8,.2,1), box-shadow .4s ease, border-color .4s ease, opacity .55s ease;
        }

        .blog-card.reveal {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .blog-card:hover {
            transform: translateY(-10px) scale(1.01);
            border-color: #bfdbfe;
            box-shadow: var(--blog-shadow-hover);
        }

        .blog-img-box {
            position: relative;
            height: 235px;
            overflow: hidden;
            background: linear-gradient(135deg, #eff6ff, #f5f3ff);
        }

        .blog-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .8s cubic-bezier(.2,.8,.2,1);
        }

        .blog-card:hover .blog-img-box img {
            transform: scale(1.09);
        }

        .blog-category-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            z-index: 3;
            padding: 7px 12px;
            border-radius: 50px;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37,99,235,.95), rgba(124,58,237,.95));
            backdrop-filter: blur(10px);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
            box-shadow: 0 8px 20px rgba(37,99,235,.18);
        }

        .blog-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 25px;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 13px;
            color: var(--blog-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .blog-meta i {
            color: var(--blog-primary);
            font-size: 13px;
        }

        .blog-title {
            margin: 0 0 13px;
            font-family: "Poppins", sans-serif;
            color: var(--blog-heading);
            font-size: 19px;
            line-height: 1.45;
            font-weight: 700;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-excerpt {
            margin: 0 0 22px;
            color: var(--blog-text);
            font-size: 13.5px;
            line-height: 1.75;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 0;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .blog-author i {
            color: var(--blog-primary);
            font-size: 14px;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            flex-shrink: 0;
            padding: 8px 0;
            border: 0;
            outline: none;
            color: var(--blog-primary);
            background: transparent;
            font-family: "Inter", sans-serif;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: gap .3s ease, color .3s ease;
        }

        .blog-empty {
            display: none;
            padding: 70px 20px;
            text-align: center;
            border: 1px dashed #cbd5e1;
            border-radius: 20px;
            background: #f8fafc;
        }

        .blog-empty.show {
            display: block;
        }

        .blog-modal {
            position: fixed;
            inset: 0;
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15,23,42,.72);
            backdrop-filter: blur(10px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity .35s ease, visibility .35s ease;
        }

        .blog-modal.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .blog-modal-container {
            position: relative;
            width: min(850px, 100%);
            max-height: 92vh;
            overflow-y: auto;
            border-radius: 26px;
            background: #ffffff;
            box-shadow: 0 40px 100px rgba(0,0,0,.3);
            transform: translateY(40px) scale(.94);
            transition: transform .45s cubic-bezier(.2,.8,.2,1);
        }

        .blog-modal.active .blog-modal-container {
            transform: translateY(0) scale(1);
        }

        .blog-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 20;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 50%;
            color: #ffffff;
            background: rgba(15,23,42,.65);
            cursor: pointer;
            transition: background .3s ease, transform .3s ease;
        }

        .blog-modal-img-wrap {
            position: relative;
            height: 350px;
            overflow: hidden;
        }

        .blog-modal-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .blog-modal-body {
            padding: 38px;
        }

        .blog-modal-title {
            margin: 15px 0;
            font-family: "Poppins", sans-serif;
            color: var(--blog-heading);
            font-size: clamp(24px, 4vw, 34px);
            font-weight: 800;
        }

        .blog-modal-text {
            color: #334155;
            font-size: 15px;
            line-height: 1.95;
            white-space: pre-line;
        }

        .modal-navigation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 35px;
            padding-top: 22px;
            border-top: 1px solid #e2e8f0;
        }

        .modal-nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 15px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            color: var(--blog-primary);
            background: #f8fbff;
            font-weight: 800;
            cursor: pointer;
        }

        .back-top {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 9999;
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 14px;
            color: #ffffff;
            background: linear-gradient(135deg, var(--blog-primary), var(--blog-secondary));
            box-shadow: 0 12px 30px rgba(37,99,235,.25);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: .3s ease;
        }

        .back-top.show {
            opacity: 1;
            visibility: visible;
        }

        .blog-card.filtered-out {
            display: none;
        }

        
        footer {
            background-color: #0f172a;
            color: #94a3b8;
            font-family: "Inter", sans-serif;
            font-size: 17px;
            line-height: 1.5;
        }

        .footer-main {
            padding: 60px 0 35px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 35px;
        }

        .footer-column h3 {
            color: #ffffff;
            font-family: "Poppins", sans-serif;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 30px;
            height: 2px;
            background: var(--blog-primary);
            border-radius: 2px;
        }

        .footer-column p {
            margin-bottom: 20px;
            color: #94a3b8;
        }

        .footer-logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .footer-logo img {
            width: 55px;
            height: 55px;
            border-radius: 10%;
            object-fit: cover;
        }

        .footer-logo span {
            color: #ffffff;
        }

        .footer-logo b {
            color: var(--blog-primary);
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
            display: inline-block;
        }

        .footer-column ul li a:hover {
            color: #ffffff;
            padding-left: 6px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .social-links a:hover {
            background: var(--blog-primary);
            transform: translateY(-3px);
        }

        .footer-contact p {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .footer-contact p i {
            color: var(--blog-primary);
            font-size: 16px;
            margin-top: 3px;
        }

        .footer-contact a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-contact a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            padding: 20px 0;
            background: #090d16;
        }

        .footer-bottom-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 13px;
            color: #64748b;
        }

        .footer-bottom-inner p {
            margin: 0;
        }

        @media (max-width: 1024px) {
            .blog-wrapper { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
        }

        @media (max-width: 700px) {
            .blog-wrapper { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-bottom-inner { flex-direction: column; text-align: center; }
        }
    </style>
</head>

<body class="blog-page">


<div class="about-loader" id="aboutLoader">
    <div class="loader-content">
        <img src="image/logo.png" alt="Rudra EduTech" class="loader-logo">
        <h3>Rudra EduTech</h3>
        <p>Learn • Create • Grow</p>
    </div>
</div>

<!-- TOP BAR -->
<div class="topbar">
    <div class="container topbar-inner">
        <div class="top-left">
            <span><i class="bi bi-telephone"></i> <a href="tel:+91<?php echo e($phone); ?>"><?php echo e($phoneDisplay); ?></a></span>
            <span><i class="bi bi-envelope"></i> <a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></span>
        </div>
        <div class="top-right">
            <a href="<?php echo e($facebook); ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
            <a href="<?php echo e($instagram); ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
            <a href="<?php echo e($youtube); ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
            <a href="https://wa.me/<?php echo e($whatsapp); ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"></i></a>
        </div>
    </div>
</div>

<!-- HEADER -->
<header class="header">
    <div class="container nav-container">
        <a href="index.php" class="logo">
            <div class="logo-image"><img src="image/logo.png" alt="Logo" loading="eager"></div>
            <div class="logo-text"><span class="logo-rudra">Rudra <b class="logo-edutech">EduTech</b></span></div>
        </a>
        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Toggle Menu"><i class="bi bi-list"></i></button>
        <nav>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="<?php echo ($currentPage === 'index.php') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php" class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">About Us</a></li>
                <li><a href="course.php" class="<?php echo ($currentPage === 'course.php') ? 'active' : ''; ?>">Courses</a></li>
                <li><a href="services.php" class="<?php echo ($currentPage === 'services.php') ? 'active' : ''; ?>">Services</a></li>
                <li><a href="client.php" class="<?php echo ($currentPage === 'client.php') ? 'active' : ''; ?>">Clients</a></li>
                <li><a href="gallery.php" class="<?php echo ($currentPage === 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li>
                <li><a href="testimonials.php" class="<?php echo ($currentPage === 'testimonials.php') ? 'active' : ''; ?>">Testimonials</a></li>
                <li><a href="blog.php" class="<?php echo ($currentPage === 'Blog.php') ? 'active' : ''; ?>">Blog</a></li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php" class="nav-auth-btn logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="nav-auth-btn login-btn"><i class="bi bi-person-lock"></i> Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="blog-hero">
        <div class="blog-hero-content">
            <div class="hero-label"><i class="bi bi-journal-richtext"></i> Our Insights & Articles</div>
            <h1>Latest news, tutorials & <br><span>tech updates.</span></h1>
            <p>Explore articles written by our experts covering software development, digital transformation, education and student success.</p>
        </div>
    </section>

    <section class="blog-grid-section">
        <div class="blog-container">
            <div class="blog-toolbar">
                <div class="blog-search">
                    <i class="bi bi-search"></i>
                    <input type="search" id="blogSearch" placeholder="Search articles..." autocomplete="off">
                </div>
                <div class="category-filters">
                    <button type="button" class="category-btn active" data-category="all">All</button>
                    <?php foreach ($categories as $category): ?>
                        <button type="button" class="category-btn" data-category="<?php echo e($category); ?>"><?php echo e($category); ?></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="blog-wrapper" id="blogWrapper">
                <?php foreach ($blogs as $index => $post): 
                    $title = trim($post['title'] ?? 'Untitled Post');
                    $category = trim($post['category'] ?? 'Technology');
                    $excerpt = trim($post['excerpt'] ?? '');
                    $image = trim($post['image'] ?? 'https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg');
                    $author = trim($post['author'] ?? 'Rudra EduTech');
                    $date = formatBlogDate($post['created_at'] ?? '');
                ?>
                    <article class="blog-card" data-category="<?php echo e($category); ?>" data-title="<?php echo e(strtolower($title)); ?>" data-index="<?php echo e($index); ?>">
                        <div class="blog-img-box">
                            <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" loading="lazy" onerror="this.onerror=null; this.src='https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg';">
                            <span class="blog-category-badge"><?php echo e($category); ?></span>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta"><i class="bi bi-calendar3"></i> <span><?php echo e($date); ?></span></div>
                            <h3 class="blog-title"><?php echo e($title); ?></h3>
                            <p class="blog-excerpt"><?php echo e($excerpt); ?></p>
                            <div class="blog-footer">
                                <div class="blog-author"><i class="bi bi-person-circle"></i> <span><?php echo e($author); ?></span></div>
                                <button type="button" class="read-more-btn" data-index="<?php echo e($index); ?>">Read More <i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="blog-empty" id="blogEmpty">
                <div class="blog-empty-icon"><i class="bi bi-search"></i></div>
                <h3>No articles found</h3>
                <p>Try another keyword or select a different category.</p>
            </div>
        </div>
    </section>
</main>

<div class="blog-modal" id="blogModal" aria-hidden="true">
    <div class="blog-modal-container">
        <button type="button" class="blog-modal-close" id="blogModalClose" aria-label="Close article"><i class="bi bi-x-lg"></i></button>
        <div class="blog-modal-img-wrap"><img src="" alt="Blog Image" class="blog-modal-img" id="modalImage"></div>
        <div class="blog-modal-body">
            <span class="blog-modal-category" id="modalCategory">Category</span>
            <h2 class="blog-modal-title" id="modalTitle">Blog Title</h2>
            <div class="blog-modal-meta">
                <span><i class="bi bi-calendar3"></i> <strong id="modalDate">Date</strong></span>
                <span><i class="bi bi-person-circle"></i> <strong id="modalAuthor">Author</strong></span>
            </div>
            <div class="blog-modal-text" id="modalContent">Blog content...</div>
            <div class="modal-navigation">
                <button type="button" class="modal-nav-btn" id="modalPrev"><i class="bi bi-arrow-left"></i> Previous</button>
                <button type="button" class="modal-nav-btn" id="modalNext">Next <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="footer-main">
        <div class="container footer-grid">
            <div class="footer-column">
                <a href="index.php" class="footer-logo">
                    <img src="image/logo.png" alt="Rudra EduTech Logo" loading="lazy">
                    <span>Rudra <b>EduTech</b></span>
                </a>
                <p>Education, technology and digital solutions for students, professionals and businesses.</p>
                <div class="social-links">
                    <a href="<?php echo e($facebook); ?>" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                    <a href="<?php echo e($instagram); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                    <a href="<?php echo e($linkedin); ?>" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                    <a href="<?php echo e($youtube); ?>" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
                    <a href="https://wa.me/<?php echo e($whatsapp); ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"></i></a>
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
                    <p><i class="bi bi-geo-alt"></i><span>Mumbai, India</span></p>
                    <p><i class="bi bi-telephone"></i><a href="tel:+91<?php echo e($phone); ?>"><?php echo e($phoneDisplay); ?></a></p>
                    <p><i class="bi bi-envelope"></i><a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></p>
                    <p><i class="bi bi-whatsapp"></i><a href="https://wa.me/<?php echo e($whatsapp); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($whatsappDisplay); ?></a></p>
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

<button type="button" class="back-top" id="backTop" aria-label="Back to Top"><i class="bi bi-arrow-up"></i></button>

<script>
"use strict";

const blogData = <?php echo json_encode(array_values($blogs), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;


window.addEventListener("load", function () {
    const loader = document.getElementById("aboutLoader");
    setTimeout(function () {
        if (loader) {
            loader.classList.add("hide");
        }
    }, 500);
});

setTimeout(function () {
    const loader = document.getElementById("aboutLoader");
    if (loader) {
        loader.classList.add("hide");
    }
}, 1500);

document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");

    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    }

    const cards = document.querySelectorAll(".blog-card");
    cards.forEach((card, index) => {
        card.classList.add("reveal");
    });

    const searchInput = document.getElementById("blogSearch");
    const categoryButtons = document.querySelectorAll(".category-btn");
    const emptyState = document.getElementById("blogEmpty");
    let activeCategory = "all";

    function filterBlogs() {
        const searchValue = searchInput ? searchInput.value.trim().toLowerCase() : "";
        let visibleCount = 0;

        cards.forEach(card => {
            const title = (card.dataset.title || "").toLowerCase();
            const category = (card.dataset.category || "").toLowerCase();
            const categoryMatch = activeCategory === "all" || category === activeCategory.toLowerCase();
            const searchMatch = searchValue === "" || title.includes(searchValue);
            
            if (categoryMatch && searchMatch) {
                card.classList.remove("filtered-out");
                visibleCount++;
            } else {
                card.classList.add("filtered-out");
            }
        });

        if (emptyState) {
            emptyState.classList.toggle("show", visibleCount === 0);
        }
    }

    if (searchInput) {
        searchInput.addEventListener("input", filterBlogs);
    }

    categoryButtons.forEach(button => {
        button.addEventListener("click", function () {
            categoryButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            activeCategory = this.dataset.category || "all";
            filterBlogs();
        });
    });

    const blogModal = document.getElementById("blogModal");
    const modalClose = document.getElementById("blogModalClose");
    const modalImage = document.getElementById("modalImage");
    const modalCategory = document.getElementById("modalCategory");
    const modalTitle = document.getElementById("modalTitle");
    const modalDate = document.getElementById("modalDate");
    const modalAuthor = document.getElementById("modalAuthor");
    const modalContent = document.getElementById("modalContent");
    const modalPrev = document.getElementById("modalPrev");
    const modalNext = document.getElementById("modalNext");
    let currentBlogIndex = 0;

    function openBlogModal(index) {
        if (!blogData.length || !blogModal) return;
        currentBlogIndex = Math.max(0, Math.min(index, blogData.length - 1));
        const blog = blogData[currentBlogIndex];

        if (modalImage) modalImage.src = blog.image || "";
        if (modalCategory) modalCategory.textContent = blog.category || "Technology";
        if (modalTitle) modalTitle.textContent = blog.title || "";
        if (modalDate) modalDate.textContent = blog.created_at || "Recent";
        if (modalAuthor) modalAuthor.textContent = blog.author || "Rudra EduTech";
        if (modalContent) modalContent.textContent = blog.content || blog.excerpt || "";

        if (modalPrev) modalPrev.disabled = currentBlogIndex <= 0;
        if (modalNext) modalNext.disabled = currentBlogIndex >= blogData.length - 1;

        blogModal.classList.add("active");
        blogModal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    }

    function closeBlogModal() {
        if (!blogModal) return;
        blogModal.classList.remove("active");
        blogModal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    document.querySelectorAll(".read-more-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            openBlogModal(Number(this.dataset.index));
        });
    });

    if (modalClose) modalClose.addEventListener("click", closeBlogModal);
    if (blogModal) blogModal.addEventListener("click", (e) => { if (e.target === blogModal) closeBlogModal(); });
    if (modalPrev) modalPrev.addEventListener("click", () => openBlogModal(currentBlogIndex - 1));
    if (modalNext) modalNext.addEventListener("click", () => openBlogModal(currentBlogIndex + 1));

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeBlogModal();
    });

    const backTop = document.getElementById("backTop");
    window.addEventListener("scroll", () => {
        if (backTop) backTop.classList.toggle("show", window.scrollY > 400);
    });
    if (backTop) {
        backTop.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));
    }
});
</script>

</body>
</html>