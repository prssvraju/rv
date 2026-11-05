<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If already logged in, redirect to dashboard
if (isset($_SESSION['vr_admin_logged_in']) && $_SESSION['vr_admin_logged_in'] === true) {
    header('Location: admin_grievances.php');
    exit;
}

$error = '';
$logoutMsg = isset($_GET['logout']) ? 'You have been safely signed out.' : '';

// Valid credentials list
$validUsers = [
    'admin' => 'admin',
    'rohini' => 'rohini2026',
    'prssvraju' => 'admin123'
];

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } elseif (isset($validUsers[$username]) && $validUsers[$username] === $password) {
        // Successful login
        $_SESSION['vr_admin_logged_in'] = true;
        $_SESSION['vr_admin_user'] = $username;
        $_SESSION['vr_admin_login_time'] = date('Y-m-d H:i:s');
        header('Location: admin_grievances.php');
        exit;
    } else {
        $error = 'Invalid credentials. Please verify your username and password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In - Vegesna Rohini Office Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Telugu:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Inter", sans-serif; }
    </style>
</head>
<body class="bg-[#f5f5f7] text-[#1d1d1f] min-h-screen flex flex-col justify-between antialiased selection:bg-[#0071e3] selection:text-white">

    <!-- Top Minimal Navigation -->
    <header class="py-4 px-6 border-b border-[#e5e5ea] bg-white/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="index.php" class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-full bg-[#1d1d1f] flex items-center justify-center font-bold text-white text-xs">VR</span>
                <div>
                    <span class="text-sm font-semibold text-[#1d1d1f]">Vegesna Rohini</span>
                    <span class="text-[10px] text-[#86868b] block -mt-0.5">Bhimavaram Municipal Leadership</span>
                </div>
            </a>
            <a href="index.php" class="text-xs font-medium text-[#0071e3] hover:underline flex items-center gap-1">
                ← Return to Website
            </a>
        </div>
    </header>

    <!-- Main Sign In Stage -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 my-8">
        <div class="w-full max-w-md">
            
            <!-- Apple-Style Card -->
            <div class="apple-card p-8 sm:p-10 shadow-xl bg-white">
                
                <!-- Logo & Heading -->
                <div class="text-center mb-8">
                    <div class="w-14 h-14 rounded-2xl bg-[#1d1d1f] text-white flex items-center justify-center font-bold text-lg mx-auto shadow-md mb-4">
                        VR
                    </div>
                    <h1 class="text-2xl font-semibold tracking-tight text-[#1d1d1f]">Admin Sign In</h1>
                    <p class="text-xs text-[#86868b] mt-1.5">
                        Praja Vani Citizen Grievance Management Portal
                    </p>
                </div>

                <!-- Alert Messages -->
                <?php if (!empty($error)): ?>
                    <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-center gap-2">
                        <span>⚠️</span>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($logoutMsg)): ?>
                    <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                        <span>✓</span>
                        <span><?= htmlspecialchars($logoutMsg) ?></span>
                    </div>
                <?php endif; ?>

                <!-- Sign In Form -->
                <form method="POST" action="admin_login.php" class="space-y-4">
                    <div>
                        <label for="username" class="block text-xs font-semibold text-[#1d1d1f] mb-1.5">Username</label>
                        <input type="text" id="username" name="username" required autocomplete="username" 
                               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                               class="w-full apple-input px-3.5 py-2.5 text-xs text-[#1d1d1f] placeholder-[#86868b]" 
                               placeholder="e.g. admin">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-semibold text-[#1d1d1f]">Password</label>
                            <button type="button" onclick="togglePasswordVisibility()" class="text-[11px] text-[#0071e3] hover:underline" id="togglePwText">Show</button>
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                               class="w-full apple-input px-3.5 py-2.5 text-xs text-[#1d1d1f] placeholder-[#86868b]" 
                               placeholder="Enter your password">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="apple-btn-primary w-full py-3 text-xs tracking-wide font-medium shadow-sm hover:shadow transition">
                            Sign In to Dashboard
                        </button>
                    </div>
                </form>



            </div>

            <!-- Footer note -->
            <p class="text-center text-[11px] text-[#86868b] mt-6">
                &copy; <?= date('Y') ?> Vegesna Rohini Office • Bhimavaram Municipality
            </p>

        </div>
    </main>

    <!-- Page Footer -->
    <footer class="py-4 text-center text-[11px] text-[#86868b] border-t border-[#e5e5ea] bg-white">
        Bhimavaram Municipal Corporation Area, West Godavari District, Andhra Pradesh
    </footer>

    <script>
        function togglePasswordVisibility() {
            const pw = document.getElementById('password');
            const toggle = document.getElementById('togglePwText');
            if (pw.type === 'password') {
                pw.type = 'text';
                toggle.textContent = 'Hide';
            } else {
                pw.type = 'password';
                toggle.textContent = 'Show';
            }
        }
    </script>
</body>
</html>
