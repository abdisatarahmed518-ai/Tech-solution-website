<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: var(--bg-color);
        }
        .login-box {
            background: var(--second-bg-color);
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            margin-bottom: 1rem;
            font-size: 3.5rem;
            text-transform: super;
            letter-spacing: 1px;
            color: var(--main-color);
        }
        .login-box input {
            width: 100%;
            padding: 1rem 3.5rem 1rem 1rem;
            margin-bottom: 1rem;
            font-size: 1.8rem;
            background: var(--bg-color);
            border: none;
            border-radius: .5rem;
            color: var(--text-color);
        }
        .login-box button {
            background: var(--main-color);
            color: var(--second-bg-color);
            padding: 1rem 2rem;
            border: none;
            font-size: 1.8rem;
            border-radius: .5rem;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }

        .error-msg {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            font-size: 1.8rem;
            padding: 1rem;
            border-radius: .5rem;
            border: 1px solid rgba(255, 71, 87, 0.2);
            margin-bottom: 2rem;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .input-container {
            position: relative;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            right: 1.5rem;
            top: 35%;
            transform: translateY(-35%);
            color: var(--text-color);
            opacity: 0.6;
            font-size: 1.6rem;
            z-index: 10;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .input-icon:hover {
            opacity: 1;
            color: var(--main-color);
        }

        /* Responsive Design */
        @media (max-width: 450px) {
            .login-box {
                width: 90%;
                padding: 1.5rem;
            }

            .login-box h2 {
                font-size: 2.8rem;
            }

            .login-box input {
                font-size: 2rem;
                padding: 0.8rem 3rem 0.8rem 0.8rem;
            }

            .login-box button {
                font-size: 2rem;
                padding: 0.8rem 1.5rem;
            }

            .input-icon,
            .toggle-password {
                right: 1rem;
                font-size: 2rem;
            }

            .error-msg {
                font-size: 2rem;
                padding: 0.8rem;
            }
        }


        .password-container {
            position: relative;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 1.5rem;
            top: 35%;
            transform: translateY(-35%);
            cursor: pointer;
            color: var(--text-color);
            opacity: 0.6;
            font-size: 1.6rem;
            z-index: 10;
        }

        .toggle-password:hover {
            opacity: 1;
            color: var(--main-color);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if (isset($_GET['error'])) { echo '<p class="error-msg">' . htmlspecialchars($_GET['error']) . '</p>'; } ?>
        <form action="login_action.php" method="POST">
            <div class="input-container">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user input-icon"></i>
            </div>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fa-solid fa-eye toggle-password" id="eyeIcon"></i>
            </div>
            <button type="submit">Login</button>
        </form>

        <script>
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            eyeIcon.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
            // Toggle icon
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });

            // Remove error parameter from URL without reloading
            if (window.history.replaceState && window.location.search.includes('error=')) {
                const url = new URL(window.location.href);
                url.searchParams.delete('error');
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }
        </script>
    </div>
</body>
</html>
