<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

/* =========================================================
   DATABASE CONFIGURATION
========================================================= */

$db_host = getenv("DB_HOST") ?: "localhost";
$db_user = getenv("DB_USER") ?: "root";
$db_pass = getenv("DB_PASS");
$db_pass = ($db_pass === false) ? "" : $db_pass;
$db_name = getenv("DB_NAME") ?: "rudra_edutech";



$error = "";
$username = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";


    if ($username === "" || $password === "") {

        $error = "Please enter your username and password.";

    } else {

        /* -------------------------------------------------
           DATABASE CONNECTION
        ------------------------------------------------- */

        $conn = new mysqli(
            $db_host,
            $db_user,
            $db_pass,
            $db_name
        );

        if ($conn->connect_error) {

            $error = "Database connection failed. Please try again.";

        } else {

            $conn->set_charset("utf8mb4");

          
            $stmt = $conn->prepare(
                "SELECT id, username, password
                 FROM users
                 WHERE username = ?
                 LIMIT 1"
            );

            if (!$stmt) {

                $error = "Unable to process login request.";

            } else {

                $stmt->bind_param("s", $username);

                $stmt->execute();

                $result = $stmt->get_result();


                if ($result && $result->num_rows === 1) {

                    $user = $result->fetch_assoc();

                    /* -------------------------------------------------
                       VERIFY PASSWORD
                    ------------------------------------------------- */

                    if (
                        isset($user["password"]) &&
                        password_verify(
                            $password,
                            $user["password"]
                        )
                    ) {

                        /* ---------------------------------------------
                           SECURE SESSION
                        --------------------------------------------- */

                        session_regenerate_id(true);

                        $_SESSION["user_id"] = $user["id"];

                        $_SESSION["user_name"] = $user["username"];

                        $_SESSION["logged_in"] = true;

                        $_SESSION["login_time"] = time();

                        /* ---------------------------------------------
                           REDIRECT WITH WELCOME TOAST PARAMETER
                        --------------------------------------------- */

                        header("Location: index.php?login_status=success");

                        exit();

                    } else {

                        $error = "Invalid username or password.";

                    }

                } else {

                    $error = "Invalid username or password.";

                }

                $stmt->close();

            }

            $conn->close();

        }

    }

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
        name="theme-color"
        content="#2563eb"
    >

    <meta
        name="description"
        content="Rudra EduTech Admin Login"
    >

    <title>
        Admin Login | Rudra EduTech
    </title>

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
        rel="stylesheet"
        href="style.css?v=2.0"
    >

 

    <style>

       

        :root {

            --primary: #2563eb;

            --primary-dark: #1d4ed8;

            --secondary: #7c3aed;

            --dark: #0f172a;

            --text: #334155;

            --muted: #64748b;

            --border: #e2e8f0;

            --white: #ffffff;

            --danger: #dc2626;

        }

     

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {

            min-height: 100vh;

            font-family: "Inter", sans-serif;

            color: var(--text);

            overflow-x: hidden;

            background:
                radial-gradient(
                    circle at 10% 15%,
                    rgba(37, 99, 235, 0.13),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 85%,
                    rgba(124, 58, 237, 0.12),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #f8fbff 0%,
                    #eef5ff 50%,
                    #faf7ff 100%
                );

        }


        .login-page {

            min-height: 100vh;

            width: 100%;

            position: relative;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 35px 20px;

            overflow: hidden;

        }

     

        .login-page::before {

            content: "";

            position: absolute;

            inset: 0;

            background-image:
                linear-gradient(
                    rgba(37, 99, 235, 0.035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(37, 99, 235, 0.035) 1px,
                    transparent 1px
                );

            background-size: 45px 45px;

            pointer-events: none;

        }

     

        .shape {

            position: absolute;

            border-radius: 50%;

            pointer-events: none;

            animation:
                floating 10s ease-in-out infinite;

        }

        .shape-1 {

            width: 280px;

            height: 280px;

            top: -130px;

            left: -100px;

            background:
                radial-gradient(
                    circle,
                    rgba(37, 99, 235, 0.18),
                    rgba(37, 99, 235, 0)
                );

        }

        .shape-2 {

            width: 360px;

            height: 360px;

            right: -150px;

            bottom: -150px;

            background:
                radial-gradient(
                    circle,
                    rgba(124, 58, 237, 0.16),
                    rgba(124, 58, 237, 0)
                );

            animation-delay: 2s;

        }

        .shape-3 {

            width: 150px;

            height: 150px;

            top: 12%;

            right: 14%;

            background:
                radial-gradient(
                    circle,
                    rgba(14, 165, 233, 0.12),
                    rgba(14, 165, 233, 0)
                );

            animation-delay: 4s;

        }

        .shape-4 {

            width: 110px;

            height: 110px;

            bottom: 14%;

            left: 12%;

            background:
                radial-gradient(
                    circle,
                    rgba(99, 102, 241, 0.12),
                    rgba(99, 102, 241, 0)
                );

            animation-delay: 6s;

        }

        @keyframes floating {

            0%,
            100% {

                transform:
                    translate(0, 0)
                    rotate(0deg);

            }

            50% {

                transform:
                    translate(20px, -25px)
                    rotate(8deg);

            }

        }

       
        .login-container {

            width: 100%;

            max-width: 460px;

            position: relative;

            z-index: 5;

            animation:
                pageEnter 0.8s ease forwards;

        }

        @keyframes pageEnter {

            from {

                opacity: 0;

                transform:
                    translateY(35px)
                    scale(0.97);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

            }

        }

        

        .brand {

            text-align: center;

            margin-bottom: 22px;

        }

        .brand-logo {

            width: 74px;

            height: 74px;

            margin: 0 auto 13px;

            border-radius: 19px;

            overflow: hidden;

            background: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid rgba(255,255,255,0.9);

            box-shadow:
                0 15px 40px
                rgba(37,99,235,0.15);

        }

        .brand-logo img {

            width: 100%;

            height: 100%;

            object-fit: cover;

        }

        .brand-name {

            font-family: "Poppins", sans-serif;

            font-size: 24px;

            font-weight: 800;

            color: var(--dark);

            letter-spacing: -0.4px;

        }

        .brand-name span {

            color: var(--primary);

        }

        .brand-tagline {

            color: var(--muted);

            font-size: 12px;

            margin-top: 3px;

        }

       
        .login-card {

            width: 100%;

            position: relative;

            padding: 38px;

            border-radius: 24px;

            background:
                rgba(255,255,255,0.94);

            border: 1px solid
                rgba(255,255,255,0.9);

            box-shadow:
                0 30px 80px
                rgba(15,23,42,0.12),
                0 8px 25px
                rgba(37,99,235,0.06);

            backdrop-filter: blur(20px);

            -webkit-backdrop-filter: blur(20px);

            overflow: hidden;

        }

        .login-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    var(--primary),
                    var(--secondary)
                );

        }

  

        .login-header {

            text-align: center;

            margin-bottom: 28px;

        }

        .login-icon {

            width: 68px;

            height: 68px;

            margin: 0 auto 16px;

            border-radius: 18px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 29px;

            color: var(--primary);

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,0.12),
                    rgba(124,58,237,0.10)
                );

            box-shadow:
                inset 0 0 0 1px
                rgba(37,99,235,0.08);

            animation:
                iconAnimation 4s ease-in-out infinite;

        }

        @keyframes iconAnimation {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }

        }

        .login-header h1 {

            font-family: "Poppins", sans-serif;

            color: var(--dark);

            font-size: 27px;

            font-weight: 700;

            margin-bottom: 7px;

        }

        .login-header p {

            color: var(--muted);

            font-size: 13px;

            line-height: 1.6;

        }

       

        .error-box {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            padding: 13px 14px;

            margin-bottom: 20px;

            border-radius: 11px;

            color: #991b1b;

            background: #fef2f2;

            border: 1px solid #fecaca;

            font-size: 13px;

            line-height: 1.5;

            animation:
                errorAnimation 0.4s ease;

        }

        .error-box i {

            font-size: 16px;

            flex-shrink: 0;

            margin-top: 1px;

        }

        @keyframes errorAnimation {

            from {

                opacity: 0;

                transform: translateY(-8px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }

        

        .form-group {

            margin-bottom: 19px;

        }

        .form-group label {

            display: block;

            color: var(--dark);

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;

        }

        .input-box {

            position: relative;

            width: 100%;

            display: flex;

            align-items: center;

        }

        .input-box > .left-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;

            font-size: 18px;

            z-index: 5;

            pointer-events: none;

            transition: 0.25s ease;

        }

        .form-input {

            width: 100%;

            height: 52px;

            padding-left: 50px !important;

            padding-right: 50px;

            border-radius: 12px;

            border: 1px solid var(--border);

            outline: none;

            background: #f8fafc;

            color: var(--dark);

            font-family: "Inter", sans-serif;

            font-size: 14px;

            transition:
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background 0.25s ease;

        }

        .form-input::placeholder {

            color: #94a3b8;

        }

        .form-input:hover {

            background: #ffffff;

            border-color: #cbd5e1;

        }

        .form-input:focus {

            background: #ffffff;

            border-color: var(--primary);

            box-shadow:
                0 0 0 4px
                rgba(37,99,235,0.09);

        }

        .input-box:focus-within .left-icon {

            color: var(--primary);

        }

       

        .password-button {

            position: absolute;

            right: 12px;

            top: 50%;

            transform: translateY(-50%);

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            border-radius: 8px;

            background: transparent;

            color: #94a3b8;

            cursor: pointer;

            z-index: 5;

            transition: 0.25s ease;

        }

        .password-button:hover {

            color: var(--primary);

            background: #eff6ff;

        }

       

        .login-options {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: 4px;

            margin-bottom: 22px;

        }

        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            color: var(--muted);

            font-size: 12px;

            cursor: pointer;

            user-select: none;

        }

        .remember input {

            width: 16px;

            height: 16px;

            cursor: pointer;

            accent-color: var(--primary);

        }

        .secure {

            display: flex;

            align-items: center;

            gap: 5px;

            color: #64748b;

            font-size: 11px;

        }

        .secure i {

            color: #16a34a;

            font-size: 13px;

        }


        .login-button {

            position: relative;

            width: 100%;

            height: 54px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb 0%,
                    #1d4ed8 100%
                );

            color: #ffffff;

            font-family: "Poppins", sans-serif;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            overflow: hidden;

            box-shadow:
                0 10px 25px
                rgba(37,99,235,0.25);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;

        }

        .login-button::before {

            content: "";

            position: absolute;

            top: 0;

            left: -120%;

            width: 70%;

            height: 100%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,0.28),
                    transparent
                );

            transform: skewX(-20deg);

            transition:
                left 0.65s ease;

        }

        .login-button:hover {

            transform: translateY(-2px);

            box-shadow:
                0 15px 35px
                rgba(37,99,235,0.32);

        }

        .login-button:hover::before {

            left: 150%;

        }

        .login-button:active {

            transform: translateY(0);

        }

        .login-button .button-arrow {

            transition:
                transform 0.25s ease;

        }

        .login-button:hover .button-arrow {

            transform: translateX(4px);

        }

        .button-loader {

            display: none;

            width: 18px;

            height: 18px;

            border-radius: 50%;

            border:
                2px solid
                rgba(255,255,255,0.35);

            border-top-color:
                #ffffff;

            animation:
                spin 0.7s linear infinite;

        }

        .login-button.loading {

            pointer-events: none;

            opacity: 0.9;

        }

        .login-button.loading .button-text,

        .login-button.loading .button-arrow {

            display: none;

        }

        .login-button.loading .button-loader {

            display: block;

        }

        @keyframes spin {

            to {
                transform: rotate(360deg);
            }

        }


        .login-divider {

            display: flex;

            align-items: center;

            gap: 12px;

            margin: 23px 0 19px;

        }

        .login-divider::before,

        .login-divider::after {

            content: "";

            height: 1px;

            flex: 1;

            background: #edf1f5;

        }

        .login-divider span {

            color: #94a3b8;

            font-size: 10px;

            text-transform: uppercase;

            letter-spacing: 1px;

            white-space: nowrap;

        }


        .back-website {

            width: 100%;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            border: 1px solid var(--border);

            border-radius: 11px;

            background: #ffffff;

            color: var(--text);

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition:
                all 0.25s ease;

        }

        .back-website i {

            font-size: 15px;

            transition:
                transform 0.25s ease;

        }

        .back-website:hover {

            color: var(--primary);

            border-color:
                rgba(37,99,235,0.35);

            background: #f8fbff;

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px
                rgba(37,99,235,0.08);

        }

        .back-website:hover i {

            transform:
                translateX(-4px);

        }


        .card-footer {

            text-align: center;

            margin-top: 21px;

            padding-top: 18px;

            border-top: 1px solid #edf1f5;

        }

        .card-footer p {

            color: #94a3b8;

            font-size: 10px;

            line-height: 1.6;

        }

        .card-footer strong {

            color: #64748b;

            font-weight: 600;

        }

       
        .security-info {

            display: flex;

            justify-content: center;

            align-items: center;

            flex-wrap: wrap;

            gap: 16px;

            margin-top: 18px;

        }

        .security-item {

            display: flex;

            align-items: center;

            gap: 5px;

            color: #94a3b8;

            font-size: 10px;

        }

        .security-item i {

            font-size: 12px;

            color: #64748b;

        }

     
        @media (max-width: 600px) {

            .login-page {

                padding:
                    25px 15px;

            }

            .login-container {

                max-width: 430px;

            }

            .brand {

                margin-bottom: 18px;

            }

            .brand-logo {

                width: 64px;

                height: 64px;

                border-radius: 17px;

            }

            .brand-name {

                font-size: 21px;

            }

            .login-card {

                padding:
                    30px 22px;

                border-radius: 20px;

            }

            .login-icon {

                width: 62px;

                height: 62px;

                font-size: 26px;

            }

            .login-header h1 {

                font-size: 23px;

            }

            .login-header p {

                font-size: 12px;

            }

            .login-options {

                gap: 10px;

            }

        }

        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 380px) {

            .login-page {

                padding:
                    20px 12px;

            }

            .login-card {

                padding:
                    26px 17px;

            }

            .login-options {

                align-items: flex-start;

                flex-direction: column;

            }

            .security-info {

                gap: 9px;

            }

        }

        

        @media (prefers-reduced-motion: reduce) {

            * {

                animation-duration:
                    0.01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    0.01ms !important;

            }

        }

    </style>

</head>

<body>



<div class="login-page">



    <div class="shape shape-1"></div>

    <div class="shape shape-2"></div>

    <div class="shape shape-3"></div>

    <div class="shape shape-4"></div>


    <main class="login-container">



        <div class="brand">

            <div class="brand-logo">

                <img
                    src="image/logo.png"
                    alt="Rudra EduTech"
                    onerror="
                        this.style.display='none';
                        this.parentElement.innerHTML=
                        '<i class=\'bi bi-mortarboard-fill\' style=\'font-size:32px;color:#2563eb;\'></i>';
                    "
                >

            </div>

            <div class="brand-name">

                Rudra <span>EduTech</span>

            </div>

            <div class="brand-tagline">

                Education & Digital Solutions

            </div>

        </div>


        <section class="login-card">

            

            <div class="login-header">

                <div class="login-icon">

                    <i class="bi bi-shield-lock-fill"></i>

                </div>

                <h1>
                    Admin Login
                </h1>

                <p>
                    Welcome back! Sign in to access<br>
                    your administration panel.
                </p>

            </div>

          

            <?php if ($error !== ""): ?>

                <div
                    class="error-box"
                    role="alert"
                >

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>
                        <?php
                        echo htmlspecialchars(
                            $error,
                            ENT_QUOTES,
                            "UTF-8"
                        );
                        ?>
                    </span>

                </div>

            <?php endif; ?>


            <form
                id="loginForm"
                action="login.php"
                method="POST"
                autocomplete="on"
            >

                <!-- =================================================
                     USERNAME
                ================================================== -->

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <div class="input-box">

                        <i
                            class="bi bi-person left-icon"
                        ></i>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-input"
                            placeholder="Enter your username"
                            value="<?php
                                echo htmlspecialchars(
                                    $username,
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                            ?>"
                            maxlength="100"
                            autocomplete="username"
                            required
                        >

                    </div>

                </div>

                <!-- =================================================
                     PASSWORD
                ================================================== -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-box">

                        <i
                            class="bi bi-lock left-icon"
                        ></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-button"
                            id="passwordButton"
                            aria-label="Show password"
                        >

                            <i
                                class="bi bi-eye"
                                id="passwordIcon"
                            ></i>

                        </button>

                    </div>

                </div>

                <!-- =================================================
                     LOGIN OPTIONS
                ================================================== -->

                <div class="login-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>

                    <div class="secure">

                        <i
                            class="bi bi-shield-check"
                        ></i>

                        Secure Login

                    </div>

                </div>

                <!-- =================================================
                     LOGIN BUTTON
                ================================================== -->

                <button
                    type="submit"
                    class="login-button"
                    id="loginButton"
                >

                    <span class="button-text">
                        Sign In 
                    </span>

                    <i
                        class="bi bi-arrow-right button-arrow"
                    ></i>

                    <span
                        class="button-loader"
                    ></span>

                </button>

            </form>

    

            <div class="login-divider">

                <span>
                    Rudra EduTech
                </span>

            </div>

            <!-- =================================================
                 BACK TO WEBSITE
            ================================================== -->

            <a
                href="index.php"
                class="back-website"
            >

                <i class="bi bi-arrow-left"></i>

                <span>
                    Back to Website
                </span>

            </a>

            <!-- =================================================
                 CARD FOOTER
            ================================================== -->

            <div class="card-footer">

                <p>

                    Protected administration area of

                    <strong>
                        Rudra EduTech
                    </strong>

                </p>

            </div>

        </section>

        <!-- =================================================
             SECURITY INFORMATION
        ================================================== -->

        <div class="security-info">

            <div class="security-item">

                <i class="bi bi-lock-fill"></i>

                Secure Access

            </div>

            <div class="security-item">

                <i class="bi bi-database-lock"></i>

                Protected Data

            </div>

            <div class="security-item">

                <i class="bi bi-shield-fill-check"></i>

                Admin Only

            </div>

        </div>

    </main>

</div>

<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {

        /* =================================================
           PASSWORD SHOW / HIDE
        ================================================== */

        const password =
            document.getElementById("password");

        const passwordButton =
            document.getElementById("passwordButton");

        const passwordIcon =
            document.getElementById("passwordIcon");

        if (
            password &&
            passwordButton &&
            passwordIcon
        ) {

            passwordButton.addEventListener(
                "click",
                function () {

                    if (
                        password.type ===
                        "password"
                    ) {

                        password.type =
                            "text";

                        passwordIcon.classList.remove(
                            "bi-eye"
                        );

                        passwordIcon.classList.add(
                            "bi-eye-slash"
                        );

                        passwordButton.setAttribute(
                            "aria-label",
                            "Hide password"
                        );

                    } else {

                        password.type =
                            "password";

                        passwordIcon.classList.remove(
                            "bi-eye-slash"
                        );

                        passwordIcon.classList.add(
                            "bi-eye"
                        );

                        passwordButton.setAttribute(
                            "aria-label",
                            "Show password"
                        );

                    }

                }
            );

        }

        /* =================================================
           LOGIN LOADING
        ================================================== */

        const loginForm =
            document.getElementById("loginForm");

        const loginButton =
            document.getElementById("loginButton");

        if (
            loginForm &&
            loginButton
        ) {

            loginForm.addEventListener(
                "submit",
                function (event) {

                    if (
                        !loginForm.checkValidity()
                    ) {

                        return;

                    }

                    loginButton.classList.add(
                        "loading"
                    );

                }
            );

        }


        const username =
            document.getElementById("username");

        if (
            username &&
            username.value.trim() === ""
        ) {

            setTimeout(
                function () {

                    username.focus();

                },
                500
            );

        }

        /* =================================================
           REMEMBER USERNAME
        ================================================== */

        const remember =
            document.getElementById("remember");

        if (
            remember &&
            username
        ) {

            const savedUsername =
                localStorage.getItem(
                    "rudra_admin_username"
                );

            if (savedUsername) {

                username.value =
                    savedUsername;

                remember.checked =
                    true;

            }

            loginForm.addEventListener(
                "submit",
                function () {

                    if (
                        remember.checked
                    ) {

                        localStorage.setItem(
                            "rudra_admin_username",
                            username.value.trim()
                        );

                    } else {

                        localStorage.removeItem(
                            "rudra_admin_username"
                        );

                    }

                }
            );

        }

    }
);

</script>

</body>

</html>