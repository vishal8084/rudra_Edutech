<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =========================================================
   DATABASE CONFIGURATION
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

$message = "";
$error   = "";

$whatsappNum     = "917738699924";
$whatsappDisplay = "+91 77386 99924";
$phoneDisplay    = "+91 7738699924";
$phoneNum        = "7738699924";
$emailAddress    = "vishalkumar167248@gmail.com";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {

    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $phone   = trim($_POST["phone"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $msg     = trim($_POST["message"] ?? "");

    if ($name !== "" && filter_var($email, FILTER_VALIDATE_EMAIL) && $msg !== "") {

        if ($conn && !$conn->connect_error) {
            $createTable = $conn->query("
                CREATE TABLE IF NOT EXISTS contact_messages (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    phone VARCHAR(20),
                    subject VARCHAR(150),
                    message TEXT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");

            if ($createTable) {

                $stmt = $conn->prepare("
                    INSERT INTO contact_messages
                    (name, email, phone, subject, message)
                    VALUES (?, ?, ?, ?, ?)
                ");

                if ($stmt) {
                    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $msg);
                    $stmt->execute();
                    $stmt->close();
                }

            }
        }

        // WhatsApp message structure
        $waMessage  = "*New Enquiry - Rudra EduTech*" . "\n\n";
        $waMessage .= "*Name:* " . $name . "\n";
        $waMessage .= "*Email:* " . $email . "\n";
        $waMessage .= "*Phone:* " . ($phone !== "" ? $phone : "Not provided") . "\n";
        $waMessage .= "*Subject:* " . ($subject !== "" ? $subject : "General Enquiry") . "\n";
        $waMessage .= "*Message:* " . $msg;

        // WhatsApp redirect
        $encodedText = urlencode($waMessage);
        $waUrl = "https://api.whatsapp.com/send?phone=" . $whatsappNum . "&text=" . $encodedText;

        header("Location: " . $waUrl);
        exit;

    } elseif ($name === "" || $email === "" || $msg === "") {
        $error = "Please fill in all required fields.";
    } else {
        $error = "Please enter a valid email address.";
    }
}


$pageTitle   = "Contact Us | Rudra EduTech";
$currentPage = basename($_SERVER["PHP_SELF"]);

$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Rudra EduTech for education, web development, web design, hosting and digital solutions.">
    <meta name="theme-color" content="#2563eb">

    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- =====================================================
         ICONS + FONTS
    ====================================================== -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
          rel="stylesheet">

   
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
            font-family: "Poppins", sans-serif;
            color: #0f172a;
        }

        .loader-content p {
            margin: 5px 0 0;
            opacity: .7;
            font-size: 14px;
            color: #334155;
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

        :root {
            --cp-primary: #2563eb;
            --cp-primary-dark: #1d4ed8;
            --cp-primary-light: #60a5fa;
            --cp-secondary: #7c3aed;
            --cp-cyan: #06b6d4;

            --cp-dark: #0f172a;
            --cp-dark-2: #172554;
            --cp-text: #334155;
            --cp-muted: #64748b;

            --cp-white: #ffffff;
            --cp-bg: #f8fafc;
            --cp-bg-2: #f1f5f9;
            --cp-border: #e2e8f0;

            --cp-success: #16a34a;
            --cp-danger: #dc2626;

            --cp-radius-sm: 12px;
            --cp-radius-md: 20px;
            --cp-radius-lg: 30px;

            --cp-shadow-sm: 0 10px 30px rgba(15, 23, 42, .06);
            --cp-shadow-md: 0 20px 55px rgba(15, 23, 42, .10);
            --cp-shadow-lg: 0 30px 80px rgba(15, 23, 42, .15);

            --cp-transition: .35s cubic-bezier(.2, .8, .2, 1);
        }

        .contact-page,
        .contact-page * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body.contact-body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: var(--cp-bg);
            color: var(--cp-text);
            font-family: "Inter", sans-serif;
            overflow-x: hidden;
        }

        .contact-page {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow: hidden;
        }

        .contact-page a {
            text-decoration: none;
        }


        .cp-bg-shape {
            position: absolute;
            pointer-events: none;
            border-radius: 50%;
            filter: blur(1px);
            opacity: .55;
            z-index: 0;
        }

        .cp-shape-one {
            width: 360px;
            height: 360px;
            top: 70px;
            left: -190px;
            background: radial-gradient(circle, rgba(37,99,235,.16), transparent 68%);
        }

        .cp-shape-two {
            width: 430px;
            height: 430px;
            top: 500px;
            right: -220px;
            background: radial-gradient(circle, rgba(124,58,237,.13), transparent 68%);
        }

        .cp-shape-three {
            width: 260px;
            height: 260px;
            bottom: 100px;
            left: 20%;
            background: radial-gradient(circle, rgba(6,182,212,.10), transparent 70%);
        }

        .contact-hero {
            position: relative;
            isolation: isolate;
            min-height: 410px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 95px 20px 125px;
            text-align: center;
            color: #fff;
            overflow: hidden;

            background:
                radial-gradient(circle at 12% 30%, rgba(96,165,250,.20), transparent 28%),
                radial-gradient(circle at 88% 70%, rgba(124,58,237,.22), transparent 30%),
                linear-gradient(135deg, #020617 0%, #0f172a 48%, #172554 100%);
        }

        .contact-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 45px 45px;
            mask-image: linear-gradient(to bottom, black, transparent);
            -webkit-mask-image: linear-gradient(to bottom, black, transparent);
        }

        .hero-orb {
            position: absolute;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 50%;
            pointer-events: none;
            animation: cpFloat 8s ease-in-out infinite;
        }

        .hero-orb.one {
            width: 120px;
            height: 120px;
            left: 7%;
            top: 22%;
        }

        .hero-orb.two {
            width: 210px;
            height: 210px;
            right: 7%;
            bottom: 4%;
            animation-delay: -3s;
        }

        .hero-content {
            width: min(900px, 100%);
            position: relative;
            z-index: 2;
            animation: cpHeroIn .9s ease both;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 999px;
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            color: #bfdbfe;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .hero-badge i {
            color: #60a5fa;
            animation: cpPulse 1.8s infinite;
        }

        .contact-hero h1 {
            margin: 0 auto 18px;
            font-family: "Poppins", sans-serif;
            font-size: clamp(38px, 6vw, 66px);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -1.8px;
            max-width: 900px;
        }

        .contact-hero h1 span {
            background: linear-gradient(90deg, #fff, #bfdbfe, #c4b5fd);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .contact-hero p {
            max-width: 700px;
            margin: 0 auto;
            color: #cbd5e1;
            font-size: clamp(14px, 2vw, 17px);
            line-height: 1.8;
        }

        .hero-scroll {
            position: absolute;
            left: 50%;
            bottom: 28px;
            transform: translateX(-50%);
            color: rgba(255,255,255,.60);
            font-size: 11px;
            letter-spacing: .14em;
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
        }

        .hero-scroll i {
            animation: cpBounce 1.6s infinite;
            font-size: 18px;
        }

        .contact-container {
            position: relative;
            z-index: 5;
            width: min(1240px, calc(100% - 40px));
            margin: -35px auto 90px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: .88fr 1.35fr;
            background: rgba(255,255,255,.96);
            border: 1px solid rgba(226,232,240,.95);
            border-radius: var(--cp-radius-lg);
            box-shadow: var(--cp-shadow-lg);
            overflow: hidden;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            animation: cpCardIn .8s .15s ease both;
        }

        .contact-info-side {
            position: relative;
            isolation: isolate;
            padding: 55px 45px 45px;
            min-height: 650px;
            color: #fff;
            overflow: hidden;

            background:
                radial-gradient(circle at 90% 8%, rgba(96,165,250,.22), transparent 27%),
                radial-gradient(circle at 10% 90%, rgba(124,58,237,.18), transparent 30%),
                linear-gradient(145deg, #1d4ed8 0%, #1e40af 48%, #172554 100%);
        }

        .contact-info-side::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -145px;
            top: -100px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50%;
            z-index: -1;
        }

        .contact-info-side::after {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            left: -110px;
            bottom: -80px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 50%;
            z-index: -1;
        }

        .info-top {
            position: relative;
            z-index: 2;
        }

        .info-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            margin-bottom: 18px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 999px;
            background: rgba(255,255,255,.08);
            color: #dbeafe;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .09em;
        }

        .contact-info-side h2 {
            margin: 0 0 15px;
            color: #fff;
            font-family: "Poppins", sans-serif;
            font-size: clamp(26px, 3vw, 34px);
            line-height: 1.18;
            font-weight: 800;
        }

        .contact-info-side .intro {
            margin: 0 0 38px;
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.8;
        }

        .info-list {
            display: grid;
            gap: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 17px;
            background: rgba(255,255,255,.07);
            transition: transform var(--cp-transition),
                        background var(--cp-transition),
                        border-color var(--cp-transition);
        }

        .info-item:hover {
            transform: translateX(7px);
            background: rgba(255,255,255,.12);
            border-color: rgba(255,255,255,.20);
        }

        .info-icon {
            flex: 0 0 48px;
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: rgba(255,255,255,.13);
            color: #fff;
            font-size: 20px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.06);
        }

        .info-content {
            min-width: 0;
        }

        .info-content span {
            display: block;
            margin-bottom: 4px;
            color: #93c5fd;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .info-content a,
        .info-content p {
            display: block;
            margin: 0;
            color: #fff;
            font-size: 14px;
            line-height: 1.45;
            font-weight: 600;
            word-break: break-word;
        }

        .info-content a:hover {
            color: #bfdbfe;
        }

        .info-bottom {
            position: relative;
            z-index: 2;
            margin-top: 42px;
            padding-top: 28px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .follow-title {
            margin-bottom: 13px;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .contact-info-side .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .contact-info-side .social-links a {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 13px;
            color: #fff;
            background: rgba(255,255,255,.08);
            font-size: 17px;
            transition: transform var(--cp-transition),
                        background var(--cp-transition);
        }

        .contact-info-side .social-links a:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,.17);
        }

        /* =====================================================
           FORM 
        ====================================================== */
        .contact-form-side {
            padding: 55px 52px;
            background: #fff;
        }

        .form-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .form-heading h2 {
            margin: 0 0 8px;
            color: var(--cp-dark);
            font-family: "Poppins", sans-serif;
            font-size: clamp(25px, 3vw, 32px);
            line-height: 1.2;
            font-weight: 800;
        }

        .form-heading p {
            margin: 0;
            color: var(--cp-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .form-heading-icon {
            flex: 0 0 52px;
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            color: var(--cp-primary);
            background: #eff6ff;
            border: 1px solid #dbeafe;
            font-size: 21px;
        }

        /* =====================================================
           ALERTS
        ====================================================== */
        .cp-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            margin-bottom: 23px;
            border-radius: 14px;
            font-size: 13px;
            line-height: 1.55;
            animation: cpAlertIn .5s ease both;
        }

        .cp-alert i {
            flex: 0 0 auto;
            margin-top: 2px;
            font-size: 17px;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        /* =====================================================
           FORM FIELDS
        ====================================================== */
        .contact-form {
            width: 100%;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
            color: #334155;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .01em;
        }

        .required {
            color: #ef4444;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            transition: color var(--cp-transition);
        }

        .input-wrap textarea + .input-icon {
            top: 18px;
            transform: none;
        }

        .form-group input,
        .form-group textarea {
            display: block;
            width: 100%;
            border: 1px solid var(--cp-border);
            border-radius: 14px;
            outline: none;
            background: #f8fafc;
            color: var(--cp-dark);
            font-size: 14px;
            transition:
                border-color var(--cp-transition),
                box-shadow var(--cp-transition),
                background var(--cp-transition),
                transform var(--cp-transition);
        }

        .form-group input {
            height: 52px;
            padding: 0 16px 0 45px;
        }

        .form-group textarea {
            min-height: 145px;
            resize: vertical;
            padding: 15px 16px 15px 45px;
            line-height: 1.65;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
        }

        .form-group input:hover,
        .form-group textarea:hover {
            border-color: #cbd5e1;
            background: #fff;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--cp-primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37,99,235,.10);
        }

        .form-group input:focus ~ .input-icon,
        .form-group textarea:focus + .input-icon {
            color: var(--cp-primary);
        }

        .form-note {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: -3px 0 22px;
            color: #64748b;
            font-size: 11px;
        }

        .form-note i {
            color: var(--cp-primary);
        }

        /* =====================================================
           SUBMIT BUTTON
        ====================================================== */
        .btn-submit {
            position: relative;
            isolation: isolate;
            width: 100%;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            overflow: hidden;
            border: 0;
            border-radius: 15px;
            cursor: pointer;

            background: linear-gradient(135deg, var(--cp-primary), var(--cp-secondary));
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            box-shadow: 0 13px 30px rgba(37,99,235,.22);
            transition: transform var(--cp-transition), box-shadow var(--cp-transition);
        }

        .btn-submit::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.22), transparent);
            transform: translateX(-120%);
            transition: transform .7s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 38px rgba(37,99,235,.28);
        }

        .btn-submit:hover::before {
            transform: translateX(120%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            font-size: 16px;
            transition: transform var(--cp-transition);
        }

        .btn-submit:hover i {
            transform: translateX(4px) rotate(-8deg);
        }

        .btn-submit.loading {
            pointer-events: none;
            opacity: .85;
        }

        .btn-submit.loading i {
            animation: cpSpin .8s linear infinite;
        }

        /* =====================================================
           QUICK ACTIONS
        ====================================================== */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .quick-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 45px;
            padding: 10px 12px;
            border: 1px solid var(--cp-border);
            border-radius: 12px;
            color: #475569;
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            transition: transform var(--cp-transition),
                        border-color var(--cp-transition),
                        color var(--cp-transition),
                        background var(--cp-transition);
        }

        .quick-action:hover {
            transform: translateY(-3px);
            color: var(--cp-primary);
            border-color: #bfdbfe;
            background: #eff6ff;
        }

        .quick-action i {
            font-size: 16px;
        }

       
        .contact-trust {
            width: min(1240px, calc(100% - 40px));
            margin: -40px auto 85px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            position: relative;
            z-index: 3;
        }

        .trust-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 20px;
            border: 1px solid var(--cp-border);
            border-radius: 18px;
            background: rgba(255,255,255,.82);
            box-shadow: var(--cp-shadow-sm);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: transform var(--cp-transition),
                        box-shadow var(--cp-transition);
        }

        .trust-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--cp-shadow-md);
        }

        .trust-icon {
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #eff6ff;
            color: var(--cp-primary);
            font-size: 19px;
        }

        .trust-card strong {
            display: block;
            margin-bottom: 3px;
            color: var(--cp-dark);
            font-size: 13px;
        }

        .trust-card span {
            display: block;
            color: var(--cp-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        /* =====================================================
           ANIMATIONS 
        ====================================================== */
        .contact-info-side h2,
        .form-heading h2 {
            animation: cpTextUp .8s .25s cubic-bezier(.2,.8,.2,1) both;
        }

        .contact-info-side .intro,
        .form-heading p {
            animation: cpTextUp .8s .38s cubic-bezier(.2,.8,.2,1) both;
        }

        .info-kicker,
        .hero-badge {
            animation: cpBadgeIn .75s .1s cubic-bezier(.2,.8,.2,1) both;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes cpTextUp {
            from { opacity: 0; transform: translateY(18px); filter: blur(4px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        @keyframes cpBadgeIn {
            from { opacity: 0; transform: translateY(-12px) scale(.94); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes cpHeroIn {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cpCardIn {
            from { opacity: 0; transform: translateY(35px) scale(.985); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes cpAlertIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes cpFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-16px) rotate(3deg); }
        }

        @keyframes cpPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .45; transform: scale(.85); }
        }

        @keyframes cpBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(6px); }
        }

        @keyframes cpSpin {
            to { transform: rotate(360deg); }
        }

        /* =====================================================
           RESPONSIVE MEDIA QUERIES
        ====================================================== */
        @media (max-width: 1050px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
            .contact-info-side {
                min-height: auto;
            }
            .info-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .info-bottom {
                margin-top: 32px;
            }
            .contact-trust {
                margin-top: -45px;
            }
        }

        @media (max-width: 760px) {
            .contact-hero {
                min-height: 390px;
                padding: 90px 18px 105px;
            }
            .contact-container {
                width: min(100% - 24px, 620px);
                margin: -25px auto 65px;
            }
            .contact-grid {
                border-radius: 22px;
            }
            .contact-info-side,
            .contact-form-side {
                padding: 34px 24px;
            }
            .info-list {
                grid-template-columns: 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .form-heading {
                gap: 12px;
            }
            .form-heading-icon {
                flex-basis: 45px;
                width: 45px;
                height: 45px;
            }
            .contact-trust {
                width: min(100% - 24px, 620px);
                margin: -25px auto 65px;
                grid-template-columns: 1fr;
            }
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .contact-hero {
                min-height: 360px;
                padding: 80px 15px 95px;
            }
            .contact-container {
                width: calc(100% - 20px);
            }
            .contact-info-side,
            .contact-form-side {
                padding: 30px 18px;
            }
            .info-item {
                padding: 13px;
            }
            .info-icon {
                flex-basis: 43px;
                width: 43px;
                height: 43px;
            }
            .form-group input {
                height: 50px;
            }
            .hero-scroll {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body class="contact-body">


<div class="about-loader" id="aboutLoader">
    <div class="loader-content">
        <img src="image/logo.png" alt="Rudra EduTech" class="loader-logo">
        <h3>Rudra EduTech</h3>
        <p>Learn • Create • Grow</p>
    </div>
</div>

<div class="contact-page">

    <div class="cp-bg-shape cp-shape-one"></div>
    <div class="cp-bg-shape cp-shape-two"></div>
    <div class="cp-bg-shape cp-shape-three"></div>

    <!-- =========================================================
         TOP BAR
    ========================================================= -->
    <div class="topbar">
        <div class="container topbar-inner">
            <div class="top-left">
                <span>
                    <i class="bi bi-telephone" aria-hidden="true"></i>
                    <a href="tel:+91<?php echo $phoneNum; ?>">
                        <?php echo htmlspecialchars($phoneDisplay); ?>
                    </a>
                </span>
                <span>
                    <i class="bi bi-envelope" aria-hidden="true"></i>
                    <a href="mailto:<?php echo htmlspecialchars($emailAddress); ?>">
                        <?php echo htmlspecialchars($emailAddress); ?>
                    </a>
                </span>
            </div>

            <div class="top-right">
                <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                <a href="https://wa.me/<?php echo $whatsappNum; ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp" aria-hidden="true"></i>
                </a>
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
                    <span class="logo-rudra">
                        Rudra <b class="logo-edutech">EduTech</b>
                    </span>
                </div>
            </a>

            <button type="button"
                    class="menu-toggle"
                    id="menuToggle"
                    aria-label="Open navigation menu"
                    aria-controls="navMenu"
                    aria-expanded="false">
                <i class="bi bi-list" aria-hidden="true"></i>
            </button>

            <nav aria-label="Main Navigation">
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="<?php echo ($currentPage === 'index.php') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="about.php" class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">About Us</a></li>
                    <li><a href="course.php" class="<?php echo ($currentPage === 'course.php') ? 'active' : ''; ?>">Courses</a></li>
                    <li><a href="services.php" class="<?php echo ($currentPage === 'services.php') ? 'active' : ''; ?>">Services</a></li>
                    <li><a href="client.php" class="<?php echo ($currentPage === 'client.php') ? 'active' : ''; ?>">Clients</a></li>
                    <li>
                        <?php if ($isLoggedIn): ?>
                            <a href="manage_gallery.php" class="<?php echo ($currentPage === 'manage_gallery.php') ? 'active' : ''; ?>">Gallery</a>
                        <?php else: ?>
                            <a href="gallery.php" class="<?php echo ($currentPage === 'gallery.php') ? 'active' : ''; ?>">Gallery</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="testimonials.php" class="<?php echo ($currentPage === 'testimonials.php') ? 'active' : ''; ?>">Testimonials</a></li>
                    <li><a href="Blog.php" class="<?php echo ($currentPage === 'Blog.php') ? 'active' : ''; ?>">Blog</a></li>
                    <li>
                        <a href="contact.php" class="nav-button <?php echo ($currentPage === 'contact.php') ? 'active' : ''; ?>">
                            Contact <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-auth-item">
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

        <!-- =================================================
             HERO
        ================================================== -->
        <section class="contact-hero">

            <div class="hero-orb one"></div>
            <div class="hero-orb two"></div>

            <div class="hero-content">
                <div class="hero-badge">
                    <i class="bi bi-stars" aria-hidden="true"></i>
                    We're Here to Help
                </div>

                <h1>
                    Let's <span>Connect &amp; Grow</span> Together
                </h1>

                <p>
                    Have questions about our courses, services, websites or
                    digital solutions? Send us a message and our team will
                    get back to you as soon as possible.
                </p>
            </div>

            <div class="hero-scroll">
                Contact Us
                <i class="bi bi-chevron-down" aria-hidden="true"></i>
            </div>

        </section>

        <section class="contact-container" id="contact">

            <div class="contact-grid">

              
                <div class="contact-info-side">

                    <div class="info-top">

                        <div class="info-kicker">
                            <i class="bi bi-chat-dots-fill" aria-hidden="true"></i>
                            Get in touch
                        </div>

                        <h2>Let's Talk With Us</h2>

                        <p class="intro">
                            Whether you need professional training, a modern
                            website, hosting or a complete digital solution,
                            our team is ready to help you.
                        </p>

                        <div class="info-list">

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                                </div>
                                <div class="info-content">
                                    <span>Location</span>
                                    <p>Mumbai, Maharashtra, India</p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                                </div>
                                <div class="info-content">
                                    <span>Phone Number</span>
                                    <a href="tel:+91<?php echo $phoneNum; ?>">
                                        <?php echo htmlspecialchars($phoneDisplay); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                                </div>
                                <div class="info-content">
                                    <span>Email Address</span>
                                    <a href="mailto:<?php echo htmlspecialchars($emailAddress); ?>">
                                        <?php echo htmlspecialchars($emailAddress); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-whatsapp" aria-hidden="true"></i>
                                </div>
                                <div class="info-content">
                                    <span>WhatsApp Support</span>
                                    <a href="https://wa.me/<?php echo $whatsappNum; ?>"
                                       target="_blank"
                                       rel="noopener noreferrer">
                                        Chat with us instantly
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="info-bottom">
                        <div class="follow-title">Follow Us</div>

                        <div class="social-links">
                            <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                            <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                            <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                            <a href="https://wa.me/<?php echo $whatsappNum; ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                </div>

          
                <div class="contact-form-side">

                    <div class="form-heading">
                        <div>
                            <h2>Send Us a Message</h2>
                            <p>
                                Fill out the form below. Fields marked with
                                <strong>*</strong> are required.
                            </p>
                        </div>
                        <div class="form-heading-icon">
                            <i class="bi bi-send" aria-hidden="true"></i>
                        </div>
                    </div>

                    <?php if (!empty($message)): ?>
                        <div class="cp-alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                            <div><?php echo htmlspecialchars($message); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="cp-alert alert-error" role="alert">
                            <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                            <div><?php echo htmlspecialchars($error); ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="contact.php"
                          method="POST"
                          class="contact-form"
                          id="contactForm">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">
                                    Full Name <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           maxlength="100"
                                           autocomplete="name"
                                           placeholder="Enter your full name"
                                           required>
                                    <i class="bi bi-person input-icon" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    Email Address <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           maxlength="100"
                                           autocomplete="email"
                                           placeholder="example@domain.com"
                                           required>
                                    <i class="bi bi-envelope input-icon" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">
                                    Phone Number  <span class="required">*</span>
                                </label>
                                <div class="input-wrap">
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           maxlength="20"
                                           autocomplete="tel"
                                           placeholder="+91 XXXXX XXXXX">
                                    <i class="bi bi-telephone input-icon" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <div class="input-wrap">
                                    <input type="text"
                                           id="subject"
                                           name="subject"
                                           maxlength="150"
                                           placeholder="How can we help?">
                                    <i class="bi bi-chat-left-text input-icon" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">
                                Your Message <span class="required">*</span>
                            </label>
                            <div class="input-wrap">
                                <textarea id="message"
                                          name="message"
                                          maxlength="2000"
                                          placeholder="Write your message here..."
                                          required></textarea>
                                <i class="bi bi-pencil-square input-icon" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="form-note">
                            <i class="bi bi-shield-check" aria-hidden="true"></i>
                            Your information is used only to respond to your enquiry.
                        </div>

                        <button type="submit"
                                name="send_message"
                                class="btn-submit"
                                id="submitBtn">
                            <i class="bi bi-send-fill" aria-hidden="true"></i>
                            <span>Send Message Now</span>
                        </button>

                        <div class="quick-actions">
                            <a class="quick-action" href="tel:+91<?php echo $phoneNum; ?>">
                                <i class="bi bi-telephone-fill" aria-hidden="true"></i> Call Us
                            </a>
                            <a class="quick-action" href="https://wa.me/<?php echo $whatsappNum; ?>" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </section>

        <section class="contact-trust">

            <div class="trust-card reveal">
                <div class="trust-icon">
                    <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                </div>
                <div>
                    <strong>Quick Response</strong>
                    <span>We aim to respond to enquiries promptly.</span>
                </div>
            </div>

            <div class="trust-card reveal">
                <div class="trust-icon">
                    <i class="bi bi-headset" aria-hidden="true"></i>
                </div>
                <div>
                    <strong>Friendly Support</strong>
                    <span>Get practical guidance from our team.</span>
                </div>
            </div>

            <div class="trust-card reveal">
                <div class="trust-icon">
                    <i class="bi bi-stars" aria-hidden="true"></i>
                </div>
                <div>
                    <strong>Professional Solutions</strong>
                    <span>Education and digital solutions under one roof.</span>
                </div>
            </div>

        </section>

    </main>


    <footer>

        <div class="footer-main">
            <div class="container footer-grid">

                <!-- FOOTER COLUMN 1 -->
                <div class="footer-column">
                    <a href="index.php" class="footer-logo" aria-label="Rudra EduTech Home">
                        <img src="image/logo.png" alt="Rudra EduTech Logo" loading="lazy">
                        <span>
                            Rudra <b>EduTech</b>
                        </span>
                    </a>
                    <p>
                        Education, technology and digital solutions for students, professionals and businesses.
                    </p>

                    <!-- SOCIAL LINKS -->
                    <div class="social-links">
                        <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                        <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin" aria-hidden="true"></i></a>
                        <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                        <a href="https://wa.me/<?php echo $whatsappNum; ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- FOOTER COLUMN 2 -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="course.php">Courses</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <!-- FOOTER COLUMN 3 -->
                <div class="footer-column">
                    <h3>Our Services</h3>
                    <ul>
                        <li><a href="services.php">Web Development</a></li>
                        <li><a href="services.php">Web Design</a></li>
                        <li><a href="services.php">Web Hosting</a></li>
                        <li><a href="services.php">Digital Solutions</a></li>
                    </ul>
                </div>

                <!-- FOOTER COLUMN 4 -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="footer-contact">
                        <p>
                            <i class="bi bi-geo-alt" aria-hidden="true"></i>
                            <span>Mumbai, India</span>
                        </p>
                        <p>
                            <i class="bi bi-telephone" aria-hidden="true"></i>
                            <a href="tel:+91<?php echo $phoneNum; ?>"><?php echo htmlspecialchars($phoneDisplay); ?></a>
                        </p>
                        <p>
                            <i class="bi bi-envelope" aria-hidden="true"></i>
                            <a href="mailto:<?php echo $emailAddress; ?>"><?php echo htmlspecialchars($emailAddress); ?></a>
                        </p>
                        <p>
                            <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            <a href="https://wa.me/<?php echo $whatsappNum; ?>" target="_blank" rel="noopener noreferrer">
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
                    &copy; <?php echo date("Y"); ?> Rudra EduTech. All Rights Reserved.
                </p>
                <p>
                    Designed &amp; Developed by Rudra EduTech
                </p>
            </div>
        </div>

    </footer>

</div>

<!-- =========================================================
     JAVASCRIPT
========================================================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {

   
    window.addEventListener("load", function () {
        const loader = document.getElementById("aboutLoader");
        setTimeout(function () {
            if (loader) {
                loader.classList.add("hide");
            }
        }, 500);
    });

    /* =====================================================
       MOBILE MENU
    ====================================================== */
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");

    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", function () {
            const isOpen = navMenu.classList.toggle("active");

            menuToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
            menuToggle.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");

            const icon = menuToggle.querySelector("i");
            if (icon) {
                icon.classList.toggle("bi-list", !isOpen);
                icon.classList.toggle("bi-x-lg", isOpen);
            }
        });

        navMenu.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
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
    }

    const form = document.getElementById("contactForm");
    const submitBtn = document.getElementById("submitBtn");

    if (form && submitBtn) {
        form.addEventListener("submit", function (event) {
            if (!form.checkValidity()) {
                return;
            }

            submitBtn.classList.add("loading");

            const icon = submitBtn.querySelector("i");
            const text = submitBtn.querySelector("span");

            if (icon) {
                icon.className = "bi bi-arrow-repeat";
            }

            if (text) {
                text.textContent = "Sending Message...";
            }
        });
    }

    const revealItems = document.querySelectorAll(".reveal");

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        obs.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );

        revealItems.forEach(function (item) {
            observer.observe(item);
        });
    } else {
        revealItems.forEach(function (item) {
            item.classList.add("show");
        });
    }

   
    const alertBox = document.querySelector(".cp-alert");

    if (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = "opacity .4s ease, transform .4s ease";
            alertBox.style.opacity = "0";
            alertBox.style.transform = "translateY(-8px)";

            setTimeout(function () {
                alertBox.remove();
            }, 450);

        }, 7000);
    }

});
</script>

</body>
</html>