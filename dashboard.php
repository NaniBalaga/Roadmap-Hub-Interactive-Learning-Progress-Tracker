<?php
session_start();

// Database Configuration
$servername = "localhost";
$username = "u937292695_nanibalaga";
$password = "Nani@0779";
$dbname = "u937292695_nanibalaga";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Auth Check
if (!isset($_SESSION['register_number']) && isset($_COOKIE['user_register_number'])) {
    $_SESSION['register_number'] = $_COOKIE['user_register_number'];
}
if (!isset($_SESSION['register_number'])) { header("Location: login.php"); exit(); }

$reg_num = $_SESSION['register_number'];




// Show popup if not logged in
if (!isset($_SESSION['register_number'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROADMAP | CONNECTSRMAP</title>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #0f0f1a;
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.login-page {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: radial-gradient(circle at center, #1a1a2e 0%, #0f0f1a 100%);
    
    /* Scroll settings */
    overflow-y: auto;
    max-height: calc(100vh - 60px); /* adjust 60px if footer height changes */
}

.login-container {
    padding: 40px;
    border-radius: 20px;
    width: 100%;
    max-width: 450px;
    text-align: center;
    color: #fff;
}

.logo {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #00bfff, #0080ff);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: bold;
    color: white;
    box-shadow: 0 5px 15px rgba(0, 191, 255, 0.3);
}

h2 {
    margin-bottom: 15px;
    font-size: 28px;
    font-weight: 600;
    background: linear-gradient(to right, #00bfff, #00ffaa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.subtitle {
    margin-bottom: 25px;
    font-size: 15px;
    color: #b8c2cc;
    line-height: 1.5;
}

.input-group {
    margin-bottom: 20px;
    text-align: left;
    position: relative;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    color: #b8c2cc;
}

.input-field {
    width: 100%;
    padding: 14px 20px 14px 45px;
    border-radius: 10px;
    border: none;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 15px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.input-field:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(0, 191, 255, 0.5);
    box-shadow: 0 0 0 3px rgba(0, 191, 255, 0.1);
}

.input-field::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 40px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 18px;
}

.login-btn {
    width: 100%;
    padding: 14px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #00bfff, #0080ff);
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
}

.login-btn:hover {
    background: linear-gradient(135deg, #0080ff, #00bfff);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 191, 255, 0.4);
}

.footer-bar {
    background: rgba(20, 20, 36, 0.9);
    padding: 15px;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    color: #00bfff;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 100;
}

.footer-bar span {
    background: linear-gradient(to right, #00bfff, #00ffaa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Stylish popup message */
.message-popup {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 15px 25px;
    border-radius: 10px;
    background: rgba(30, 30, 46, 0.95);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    border-left: 4px solid;
    display: flex;
    align-items: center;
    z-index: 1000;
    opacity: 0;
    transition: all 0.3s ease;
    max-width: 90%;
    backdrop-filter: blur(10px);
}

.message-popup.show {
    opacity: 1;
    top: 30px;
}

.message-popup.success {
    border-left-color: #00ff88;
    color: #00ff88;
}

.message-popup.error {
    border-left-color: #ff4d4d;
    color: #ff4d4d;
}

.message-popup.info {
    border-left-color: #00bfff;
    color: #00bfff;
}

.message-icon {
    margin-right: 10px;
    font-size: 20px;
}

.auth-links {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-size: 14px;
}

.auth-links a {
    color: #00bfff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.auth-links a:hover {
    color: #00ffaa;
    text-decoration: underline;
}

.credentials-note {
    margin-top: 16px;
    padding: 10px 14px;
    font-size: 12.5px;
    color: #c9d1d9;
    background: rgba(255, 255, 255, 0.04);
    border-radius: 6px;
    line-height: 1.5;
    display: inline-block;
    max-width: 90%;
    word-wrap: break-word;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.pulse {
    animation: pulse 2s infinite;
}

@media (max-width: 480px) {
    .login-container {
        padding: 30px 20px;
    }

    h2 {
        font-size: 24px;
    }

    .logo {
        width: 70px;
        height: 70px;
        font-size: 28px;
    }

    .message-popup {
        width: 90%;
        padding: 12px 20px;
    }

    .auth-links {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
}

/* Custom Scrollbar for .login-page */
.login-page::-webkit-scrollbar {
    width: 8px;
}

.login-page::-webkit-scrollbar-thumb {
    background: #444;
    border-radius: 4px;
}

.login-page::-webkit-scrollbar-thumb:hover {
    background: #666;
}

.login-page::-webkit-scrollbar-track {
    background: transparent;
}

    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <div class="logo pulse">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Welcome to CONNECTSRMAP</h2>
            <p class="subtitle">Please login to access your ROODMAP'S PAGE</p>
            
            <div class="input-group">
                <label for="popupUsername">Register No or Email</label>
                <i class="fas fa-user input-icon" style="margin-top:5px;"></i>
                <input id="popupUsername" type="text" class="input-field" placeholder="Enter your register number or email">
            </div>
            
            <div class="input-group">
                <label for="popupPassword">Password</label>
                <i class="fas fa-key input-icon" style="margin-top:5px;"></i>
                <input id="popupPassword" type="password" class="input-field" placeholder="Enter your password">
            </div>
            
            <button class="login-btn" onclick="attemptLogin()">
                <i class="fas fa-sign-in-alt"></i> Login Now
            </button>
            
            <div class="auth-links">
                <a href="../forget_password.php"><i class="fas fa-key"></i> Forgot Password?</a>
                <a href="../register.php"><i class="fas fa-user-plus"></i> Don't have an account?</a>
            </div>
            
            <div class="credentials-note">
                 Please use your CONNECTSRMAP credentials to login
            </div>
        </div>
    </div>
    
    <div class="footer-bar">
        <span>#CONNECTSRMAP</span>
    </div>

    <!-- Message Popup (hidden by default) -->
    <div id="messagePopup" class="message-popup">
        <i id="messageIcon" class="message-icon"></i>
        <span id="messageText"></span>
    </div>

    <script>
    function showMessage(type, message) {
        const popup = document.getElementById('messagePopup');
        const icon = document.getElementById('messageIcon');
        const text = document.getElementById('messageText');
        
        // Set content and style based on type
        popup.className = 'message-popup ' + type;
        text.textContent = message;
        
        // Set icon based on type
        switch(type) {
            case 'success':
                icon.className = 'message-icon fas fa-check-circle';
                break;
            case 'error':
                icon.className = 'message-icon fas fa-times-circle';
                break;
            case 'info':
                icon.className = 'message-icon fas fa-info-circle';
                break;
        }
        
        // Show the popup
        popup.classList.add('show');
        
        // Hide after 3 seconds
        setTimeout(() => {
            popup.classList.remove('show');
        }, 3000);
    }

    function attemptLogin() {
      const username = document.getElementById("popupUsername").value.trim();
      const password = document.getElementById("popupPassword").value.trim();

      if (!username || !password) {
        showMessage('error', 'Both fields are required');
        return;
      }

      showMessage('info', 'Logging you in...');

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../current_login.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          try {
            const res = JSON.parse(xhr.responseText);
            if (res.success) {
              showMessage('success', res.message);
              setTimeout(() => {
                location.reload();
              }, 1000);
            } else {
              showMessage('error', res.message);
            }
          } catch {
            showMessage('error', 'Something went wrong. Please try again.');
          }
        }
      };
      xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
    }

    // Add event listener for Enter key
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            attemptLogin();
        }
    });
    </script>
</body>
</html>
<?php
exit(); // Stop the rest of the page if not logged in
}
// -------------------------------------------------------------------------
// 1. FETCH USER DETAILS
// -------------------------------------------------------------------------
$user_name = "Student"; 
$user_sql = "SELECT name FROM students WHERE register_number = '$reg_num' LIMIT 1";
$user_res = $conn->query($user_sql);
if ($user_res && $user_res->num_rows > 0) {
    $row = $user_res->fetch_assoc();
    $user_name = $row['name'];
} else {
    $user_name = $reg_num; 
}

// -------------------------------------------------------------------------
// 2. FETCH PROGRESS COUNTS
// -------------------------------------------------------------------------
function getProgress($conn, $table, $reg_num) {
    $sql = "SELECT COUNT(*) as count FROM $table WHERE register_number = '$reg_num'";
    $res = $conn->query($sql);
    if($res && $row = $res->fetch_assoc()) {
        return $row['count'];
    }
    return 0;
}

$dsa_done    = getProgress($conn, 'user_dsa_progress', $reg_num);
$python_done = getProgress($conn, 'user_python_progress', $reg_num);
$dbms_done   = getProgress($conn, 'user_dbms_progress', $reg_num);
$cpp_done    = getProgress($conn, 'user_cpp_progress', $reg_num);

// -------------------------------------------------------------------------
// 3. DEFINE TOTALS & CALCULATE
// -------------------------------------------------------------------------
$dsa_total    = 196; 
// $python_total = 86;
// $dbms_total   = 70;
// $cpp_total    = 75;

$dsa_pct    = ($dsa_total > 0) ? round(($dsa_done / $dsa_total) * 100) : 0;
$python_pct = ($python_total > 0) ? round(($python_done / $python_total) * 100) : 0;
$dbms_pct   = ($dbms_total > 0) ? round(($dbms_done / $dbms_total) * 100) : 0;
$cpp_pct    = ($cpp_total > 0) ? round(($cpp_done / $cpp_total) * 100) : 0;

$grand_total_done = $dsa_done + $python_done + $dbms_done + $cpp_done;
$grand_total_topics = $dsa_total + $python_total + $dbms_total + $cpp_total;
$overall_health = ($grand_total_topics > 0) ? round(($grand_total_done / $grand_total_topics) * 100) : 0;

// Determine Rank
$rank = "Novice";
$rank_color = "text-gray-400";
if($overall_health > 10) { $rank = "Apprentice"; $rank_color = "text-blue-400"; }
if($overall_health > 40) { $rank = "Developer"; $rank_color = "text-green-400"; }
if($overall_health > 70) { $rank = "Engineer"; $rank_color = "text-yellow-400"; }
if($overall_health > 90) { $rank = "Architect"; $rank_color = "text-purple-400"; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROADMAP'S | CONNECT SRMAP</title>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        dark: { 900: '#050505', 800: '#0a0a0a', 700: '#121212' }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #050505; color: #ffffff; }
        
        /* Smooth Entrance */
        .fade-in { animation: fadeIn 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

        /* Glass Cards */
        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            transition: all 0.2s ease-out;
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        /* Progress Bar Glows */
        .glow-sky { box-shadow: 0 0 12px rgba(14, 165, 233, 0.4); }
        .glow-yellow { box-shadow: 0 0 12px rgba(234, 179, 8, 0.4); }
        .glow-indigo { box-shadow: 0 0 12px rgba(99, 102, 241, 0.4); }
        .glow-blue { box-shadow: 0 0 12px rgba(37, 99, 235, 0.4); }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-dark-900 selection:bg-blue-500 selection:text-white">

<nav class="border-b border-white/5 bg-black/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-4 h-14 flex items-center justify-between">
        
        <!-- Logo + Title -->
        <div class="flex items-center gap-2">
            <img 
                src="../logo.jpg" 
                alt="CONNECT SRMAP Logo"
                class="w-7 h-7 rounded-full object-cover shadow-md"
            >
            <span class="font-bold text-lg tracking-tight">
                CONNECT SRMAP
            </span>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-4">
            <span class="text-xs font-mono text-gray-500 hidden sm:block">
                <?php echo $reg_num; ?>
            </span>
            <a href="../logout.php" class="text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                LOGOUT
            </a>
        </div>

    </div>
</nav>


    <main class="flex-grow max-w-5xl mx-auto px-4 py-8 w-full fade-in">
        
        <div class="flex flex-col sm:flex-row justify-between items-end gap-4 mb-8">
            <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-black mb-2 text-white">
    Welcome back, 
    <span class="bg-clip-text text-transparent bg-gradient-to-r from-sky-300 via-sky-400 to-sky-600">
        <?php echo htmlspecialchars($user_name); ?>
    </span>! 👋
</h1>

            <p class="text-gray-400 text-lg">One day, one concept, one step closer to success.</p>
        </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
            <div class="glass-card p-4 rounded-xl">
                <p class="text-[10px] font-bold text-gray-500 uppercase">Topics Done</p>
                <p class="text-2xl font-bold text-white mt-1"><?php echo $grand_total_done; ?></p>
            </div>
            <div class="glass-card p-4 rounded-xl">
                <p class="text-[10px] font-bold text-gray-500 uppercase">Completion</p>
                <p class="text-2xl font-bold text-white mt-1"><?php echo $overall_health; ?>%</p>
            </div>
            <div class="glass-card p-4 rounded-xl">
                <p class="text-[10px] font-bold text-gray-500 uppercase">Pending</p>
                <p class="text-2xl font-bold text-gray-400 mt-1"><?php echo $grand_total_topics - $grand_total_done; ?></p>
            </div>
            <div class="glass-card p-4 rounded-xl">
                <p class="text-[10px] font-bold text-gray-500 uppercase">Status</p>
                <div class="flex items-center gap-1.5 mt-2">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-sm font-bold text-green-400">Active</span>
                </div>
            </div>
        </div>

        <h2 class="text-sm font-bold text-sky-400 uppercase tracking-widest mb-4">Your Roadmap</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- CARD -->
    <a href="dsa_roadmap.php" class="glass-card p-5 rounded-xl group relative overflow-hidden">
        
        <div class="absolute -right-4 -top-4 text-sky-500/20">
            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7"/>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-white group-hover:text-sky-400">DSA</h3>
                <span class="text-xs font-mono text-gray-300"><?php echo $dsa_pct; ?>%</span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-1.5 overflow-hidden">
                <div class="bg-sky-500 h-1.5 rounded-full glow-sky transition-all duration-700"
                    style="width: <?php echo $dsa_pct; ?>%"></div>
            </div>

            <p class="text-xs text-gray-400 mt-3">Algorithms & Structures</p>
        </div>
    </a>

    <!-- Repeat same for all -->
    <a href="python_roadmap.php" class="glass-card p-5 rounded-xl group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 text-sky-500/20">
            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-white group-hover:text-sky-400">Python</h3>
                <span class="text-xs text-gray-300"><?php echo $python_pct; ?>%</span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-1.5">
                <div class="bg-sky-500 h-1.5 rounded-full glow-sky"
                    style="width: <?php echo $python_pct; ?>%"></div>
            </div>

            <p class="text-xs text-gray-400 mt-3">Core & Libraries</p>
        </div>
    </a>

    <a href="dbms_roadmap.php" class="glass-card p-5 rounded-xl group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 text-sky-500/20">
            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7"/>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-white group-hover:text-sky-400">DBMS</h3>
                <span class="text-xs text-gray-300"><?php echo $dbms_pct; ?>%</span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-1.5">
                <div class="bg-sky-500 h-1.5 rounded-full glow-sky"
                    style="width: <?php echo $dbms_pct; ?>%"></div>
            </div>

            <p class="text-xs text-gray-400 mt-3">SQL & Theory</p>
        </div>
    </a>

    <a href="cpp_roadmap.php" class="glass-card p-5 rounded-xl group relative overflow-hidden">
        <div class="absolute -right-4 -top-4 text-sky-500/20">
            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-white group-hover:text-sky-400">C++</h3>
                <span class="text-xs text-gray-300"><?php echo $cpp_pct; ?>%</span>
            </div>

            <div class="w-full bg-gray-700 rounded-full h-1.5">
                <div class="bg-sky-500 h-1.5 rounded-full glow-sky"
                    style="width: <?php echo $cpp_pct; ?>%"></div>
            </div>

            <p class="text-xs text-gray-400 mt-3">OOPs & Logic</p>
        </div>
    </a>

</div>

        <div class="mt-12 pt-10 border-t border-white/5">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-xl font-bold text-white mb-3">💡 The 1% Rule</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        You don't need to conquer the world in a day. Improving by just <span class="text-white font-bold">1% every day</span> leads to a 37x improvement over a year. 
                        The gap between where you are and where you want to be isn't talent—it's <span class="text-blue-400 font-medium">consistency</span>.
                    </p>
                    <div class="flex gap-2 text-xs font-mono text-gray-500">
                        <span class="bg-white/5 px-2 py-1 rounded">#Discipline</span>
                        <span class="bg-white/5 px-2 py-1 rounded">#Grind</span>
                        <span class="bg-white/5 px-2 py-1 rounded">#Focus</span>
                    </div>
                </div>
                <div class="glass-panel p-5  border-l-4 border-blue-500">
                    <p class="text-lg italic text-gray-300 font-serif">
                        "We are what we repeatedly do. Excellence, then, is not an act, but a habit."
                    </p>
                    <p class="text-right text-xs text-blue-400 font-bold mt-2 uppercase">— Aristotle</p>
                </div>
            </div>
        </div>

    </main>

    <footer class="border-t border-white/5 py-6 mt-auto bg-black">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <p class="text-gray-600 text-xs">&copy; <?php echo date('Y'); ?> CONNECT SRMAP</p>
            <div class="flex gap-4">
                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                <span class="h-2 w-2 rounded-full bg-purple-500"></span>
            </div>
        </div>
    </footer>

</body>
</html>