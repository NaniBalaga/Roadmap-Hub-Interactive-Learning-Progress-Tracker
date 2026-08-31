<?php
// Include your existing Auth Logic
session_start();
date_default_timezone_set('Asia/Kolkata');

$servername = "localhost";
$username = "u937292695_nanibalaga";
$password = "Nani@0779";
$dbname = "u937292695_nanibalaga";



// Show popup if not logged in
if (!isset($_SESSION['register_number'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSA ROADMAP | CONNECTSRMAP</title>
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
            <p class="subtitle">Please login to access your DSA ROODMAP PAGE</p>
            
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


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Auth Check
if (!isset($_SESSION['register_number']) && isset($_COOKIE['user_register_number'])) {
    $_SESSION['register_number'] = $_COOKIE['user_register_number'];
}
if (!isset($_SESSION['register_number'])) { header("Location: login.php"); exit(); }

$register_number = $_SESSION['register_number'];


// Generate fake active student count (10 to 120)
$active_students = rand(10, 50);


// =========================================================================
// 1. FETCH USER PROGRESS
// =========================================================================
$completed_topics = [];
$prog_sql = "SELECT topic_slug FROM user_dsa_progress WHERE register_number = '$register_number'";
$prog_res = $conn->query($prog_sql);
while($row = $prog_res->fetch_assoc()) {
    $completed_topics[] = $row['topic_slug'];
}

// =========================================================================
// 2. ROADMAP DATA
// =========================================================================
$roadmap = [
    "Phase 1: Foundations" => [
        "Variables, If-else conditions, Loops",
        "Functions",
        "Recursions (Basics)",
        "Time & Space Complexity",
        "Array & Strings basics"
    ],
    "Phase 2: Arrays" => [
        "Memory representation & Indexing",
        "1D & 2D Arrays",
        "Traversal, Insertion & Deletion",
        "Update operations",
        "Time complexity of array operations",
        "Difference: array vs vector/list",
        "Prefix sum",
        "Subarray vs subsequence",
        "Frequency array",
        "Two pointers, Sliding window (basic)",
        "Problem: Reverse array",
        "Problem: Find max/min element",
        "Problem: Count frequency",
        "Problem: Rotate array",
        "Problem: Move zeros",
        "Problem: Leaders in array",
        "Problem: Equilibrium index",
        "Problem: Max sum subarray (basic)"
    ],
    "Phase 2: Strings" => [
        "String representation",
        "Immutable vs mutable strings",
        "Character arrays",
        "ASCII & Unicode",
        "String operations",
        "Substrings vs subsequences",
        "Frequency counting",
        "Palindrome & Anagram Concepts",
        "Two pointers in strings, Sliding window",
        "Problem: Reverse string",
        "Problem: Palindrome check",
        "Problem: Anagram check",
        "Problem: Remove duplicates",
        "Problem: Count vowels/consonants",
        "Problem: Longest substring without repeating chars",
        "Problem: String rotation"
    ],
    "Linked Lists" => [
        "Node structure",
        "Singly, Doubly, & Circular linked lists",
        "Traversal",
        "Insertion: Beginning, End, Position",
        "Deletion: Beginning, End, Position",
        "Length of linked list",
        "Reverse linked list (Concept)",
        "Fast & slow pointer concept",
        "Problem: Reverse linked list",
        "Problem: Find middle node",
        "Problem: Detect cycle",
        "Problem: Remove nth node from end",
        "Problem: Merge two linked lists",
        "Problem: Palindrome linked list"
    ],
    "Stacks" => [
        "Stack operations (push, pop, peek)",
        "Implementation using array",
        "Implementation using linked list",
        "Recursion & call stack",
        "Problem: Valid parentheses",
        "Problem: Min stack",
        "Problem: Reverse stack",
        "Problem: Stack using queue"
    ],
    "Queues" => [
        "Queue operations (enqueue, dequeue)",
        "Implementation using array",
        "Implementation using linked list",
        "Circular queue",
        "Deque (double-ended queue)",
        "Priority queue (basic concept)",
        "Queue using stack",
        "Problem: Implement queue using stack",
        "Problem: Circular queue problems",
        "Problem: First non-repeating character"
    ],
    "Searching" => [
        "Linear search",
        "Binary search",
        "Binary search on answer",
        "Lower bound / upper bound",
        "Search in rotated sorted array",
        "Problem: First/last occurrence",
        "Problem: Peak element",
        "Problem: Square root using binary search",
        "Problem: Aggressive cows (basic idea)"
    ],
    "Sorting" => [
        "Bubble sort",
        "Selection sort",
        "Insertion sort",
        "Merge sort",
        "Quick sort",
        "Heap sort",
        "Counting sort",
        "Stability in sorting",
        "Problem: Sort colors",
        "Problem: Kth largest element",
        "Problem: Inversion count",
        "Problem: Merge intervals"
    ],
    "Recursion & Backtracking" => [
        "Recursion basics",
        "Base case & recursive case",
        "Recursion tree",
        "Divide & conquer",
        "Backtracking concept",
        "Problem: Factorial",
        "Problem: Fibonacci",
        "Problem: Power function",
        "Problem: Subsets",
        "Problem: Permutations",
        "Problem: N-Queens",
        "Problem: Rat in a maze"
    ],
    "Hashing" => [
        "HashMap & HashSet",
        "Frequency map",
        "Prefix sum + hashing",
        "Collision (basic idea)",
        "Problem: Two sum",
        "Problem: Subarray sum equals K",
        "Problem: Longest consecutive sequence",
        "Problem: Majority element"
    ],
    "Trees" => [
        "Binary tree & Node structure",
        "Tree traversals: Inorder, Preorder, Postorder",
        "Level order (BFS)",
        "Height, Depth, Diameter of tree",
        "Lowest Common Ancestor (LCA)",
        "Binary Search Tree (BST)",
        "Problem: Max depth of tree",
        "Problem: Balanced tree",
        "Problem: Diameter of tree",
        "Problem: Validate BST",
        "Problem: Kth smallest in BST"
    ],
    "Heaps" => [
        "Complete Binary Tree",
        "Min Heap vs Max Heap",
        "Heap properties & Array representation",
        "Parent / left / right index formula",
        "Heap operations: Insert, delete, peek",
        "Heapify (up & down)",
        "Build heap from array",
        "Time complexity of heap operations",
        "Priority Queue concept",
        "Heap vs BST",
        "Kth problems using heap",
        "Using heap with greedy logic",
        "Two heaps concept",
        "Heap in real-time problems (streams)",
        "Problem: Implement Min Heap, Max Heap",
        "Problem: Insert element into heap",
        "Problem: Delete root from heap",
        "Problem: Convert array into heap (heapify)",
        "Problem: Find minimum / maximum element",
        "Problem: Check if array is a valid heap",
        "Problem: Sort an array using heap (Heap Sort)",
        "Problem: Kth largest/smallest element in array",
        "Problem: Top K frequent elements",
        "Problem: Merge K sorted arrays",
        "Problem: Merge K sorted linked lists",
        "Problem: Find median from data stream",
        "Problem: Sliding window median",
        "Problem: Connect ropes with minimum cost",
        "Problem: Minimum cost to connect sticks",
        "Problem: Task scheduler",
        "Problem: Meeting rooms"
    ],
    "Graphs" => [
        "Vertices and edges",
        "Directed vs undirected graph",
        "Weighted vs unweighted graph",
        "Degree of a node",
        "Path and cycle",
        "Connected Components",
        "Representations: Adjacency Matrix vs List",
        "BFS vs DFS (when to use which)",
        "Cycle detection in directed graph",
        "Topological sorting",
        "In-degree & out-degree",
        "Shortest path in unweighted graph",
        "Graph coloring (basic idea)",
        "Problem: Create adjacency list",
        "Problem: BFS traversal of graph",
        "Problem: DFS traversal of graph",
        "Problem: Count connected components",
        "Problem: Check if path exists between nodes",
        "Problem: Detect cycle in undirected graph",
        "Problem: Number of islands",
        "Problem: Flood fill",
        "Problem: Detect cycle in directed graph",
        "Problem: Topological sort (DFS approach)",
        "Problem: Topological sort (Kahn’s algo – BFS)",
        "Problem: Course schedule",
        "Problem: Shortest path in unweighted graph",
        "Problem: Rotten oranges",
        "Problem: Word ladder (basic version)",
        "Problem: Bipartite graph check",
        "Problem: Clone a graph"
    ],
    "Dynamic Programming & Patterns" => [
        "Memoization vs Tabulation",
        "Problem: Fibonacci DP",
        "Problem: 0/1 Knapsack",
        "Problem: Longest Increasing Subsequence (LIS)",
        "Problem: Longest Common Subsequence (LCS)",
        "Problem: DP on grids",
        "Problem: Matrix Chain Multiplication",
        "Problem: Sliding window (advanced)",
        "Problem: Two pointers (advanced)",
        "Problem: Greedy algorithms",
        "Problem: Divide & conquer",
        "Problem: Bit manipulation"
    ]
];

// Helper to create safe slugs
function makeSlug($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

// Calculate Progress
$total_topics = 0;
foreach($roadmap as $section) { $total_topics += count($section); }
$completed_count = count($completed_topics);
$percentage = ($total_topics > 0) ? round(($completed_count / $total_topics) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSA Roadmap | CONNECT SRMAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sky: {
                            400: '#38bdf8', // Sky Blue Light
                            500: '#0ea5e9', // Sky Blue Default
                            600: '#0284c7', // Sky Blue Dark
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Pure Black Background */
        body { font-family: 'Inter', sans-serif; background-color: #000000; color: #e2e8f0; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #1a1a1a; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #38bdf8; } /* Sky Blue Hover */

        /* Checkbox Customization */
        .custom-checkbox input:checked + div {
            background-color: #38bdf8; /* Sky Blue */
            border-color: #38bdf8;
        }
        .custom-checkbox input:checked + div svg {
            display: block;
        }

        /* --- ANIMATIONS --- */
        
        /* Pop Effect for Check */
        @keyframes pop {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        .animate-pop {
            animation: pop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Shake Effect for Uncheck */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            15% { transform: translateX(-6px); }
            30% { transform: translateX(5px); }
            45% { transform: translateX(-4px); }
            60% { transform: translateX(2px); }
            75% { transform: translateX(-1px); }
        }
        .animate-shake {
            animation: shake 0.4s ease-in-out;
            color: #ef4444 !important; /* Flash red slightly */
        }
        
        /* Fade In */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fadeIn { animation: fadeIn 0.2s ease-out forwards; }
    </style>
</head>
<body class="min-h-screen pb-12">

    <nav class="bg-black border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-tighter text-white">
                CONNECT <span class="text-sky-400">SRMAP</span>
            </h1>
            <div class="text-sm font-semibold text-gray-400">
                DSA Roadmap
            </div>
        </div>
    </nav>

    <header class="max-w-3xl mx-auto mt-8 px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
            Master Data Structures<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-600">
                & Algorithms
            </span>
        </h2>
        
        <p class="text-gray-400 text-sm max-w-md mx-auto mb-5">
            Track your progress from Foundations to Advanced DP. 
            Consistency is key.
        </p>
        
        

        <button id="openGuideBtn" class="mb-6 inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl border border-gray-700 hover:border-sky-500/50 transition-all group shadow-lg">
            <svg class="w-4 h-4 text-sky-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span class="text-sm font-semibold">Start Here: Language & Resources</span>
        </button>



        <div class="bg-gray-900 rounded-full h-4 w-full max-w-lg mx-auto relative overflow-hidden shadow-inner border border-gray-800">
            <div id="progressBar" class="bg-sky-500 h-full transition-all duration-500 ease-out flex items-center justify-end pr-2 text-[10px] font-bold text-black" 
                 style="width: <?php echo $percentage; ?>%;">
                <?php echo $percentage; ?>%
            </div>
        </div>
        
        <p class="mt-2 text-xs text-gray-500">
            <span id="completedCount"><?php echo $completed_count; ?></span> / <?php echo $total_topics; ?> Topics Completed
        </p>
        
        <br>
        
        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-900 border border-gray-800 rounded-full shadow-sm">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-wide">
                    <span class="text-sky-400 font-bold text-xs"><?php echo $active_students; ?></span> Students Online
                </p>
            </div>
    </header>

    <main class="max-w-4xl mx-auto mt-12 px-4 space-y-8">
        
        <?php foreach ($roadmap as $section_title => $topics): ?>
<div class="bg-gray-900/50 border border-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all hover:border-gray-700">
    <div class="bg-gray-900 px-4 py-3 border-b border-gray-800 flex justify-between items-center">
        <h3 class="text-lg font-bold text-white flex items-center gap-2">
            <span class="w-1.5 h-6 bg-sky-500 rounded-full"></span>
            <?php echo $section_title; ?>
        </h3>
        <span class="text-[10px] font-mono text-gray-500 bg-black px-2 py-0.5 rounded border border-gray-800">
            <?php echo count($topics); ?> Items
        </span>
    </div>

    <div class="p-2 grid gap-1 md:grid-cols-1">
        <?php foreach ($topics as $topic): 
            $slug = makeSlug($section_title . '-' . $topic);
            $isChecked = in_array($slug, $completed_topics);
        ?>
        <label class="custom-checkbox relative overflow-hidden flex items-center gap-3 p-2.5 rounded-lg bg-black/20 hover:bg-black/40 cursor-pointer transition-colors group border border-transparent hover:border-gray-800">
            
            <div class="relative z-10 flex-shrink-0">
                <input type="checkbox" 
                       class="peer sr-only topic-checkbox" 
                       data-slug="<?php echo $slug; ?>"
                       <?php echo $isChecked ? 'checked' : ''; ?>>
                
                <div class="w-4 h-4 border-2 border-gray-700 rounded bg-gray-900 transition-all peer-focus:ring-2 peer-focus:ring-sky-500/50 flex items-center justify-center">
                    <svg class="w-3 h-3 text-black hidden pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            
            <div class="flex-1 z-10">
                <span class="topic-text text-sm text-gray-300 font-medium group-hover:text-white transition-colors <?php echo $isChecked ? 'text-gray-500 line-through decoration-sky-500/50' : ''; ?>">
                    <?php echo $topic; ?>
                </span>
                
                <?php if(str_contains($topic, 'Problem:')): ?>
                    <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-sky-300 bg-sky-900/20 px-1.5 py-0.5 rounded border border-sky-900/50">
                        Practice
                    </span>
                <?php elseif(str_contains($topic, 'Sort') || str_contains($topic, 'Search')): ?>
                    <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-indigo-400 bg-indigo-900/20 px-1.5 py-0.5 rounded border border-indigo-900/50">
                        Algo
                    </span>
                <?php endif; ?>
            </div>
        </label>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>

    </main>

    <footer class="mt-20 py-8 text-center text-gray-700 border-t border-gray-900">
        <p>&copy; <?php echo date('Y'); ?> CONNECT SRMAP. Developed by Nani.</p>
    </footer>

    <div id="guideModal" class="fixed inset-0 z-[100] hidden bg-black animate-fadeIn overflow-y-auto">
        
        <button id="closeGuideBtn" class="fixed top-6 right-6 z-50 text-gray-400 hover:text-white bg-gray-900 hover:bg-red-900/50 border border-gray-800 hover:border-red-800 rounded-full p-3 transition-all">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="w-full min-h-screen p-6 md:p-12 flex flex-col items-center">
            
            <div class="max-w-4xl w-full space-y-12">
                <div class="text-center space-y-4 mt-10">
                    <h2 class="text-5xl md:text-6xl font-extrabold text-white">DSA <span class="text-sky-400">Kickstart</span></h2>
                    <p class="text-xl text-gray-400">Which language to choose & where to start learning?</p>
                </div>

                <div class="space-y-12">
                    
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="text-sky-400 text-3xl">01.</span> Language Selection
                        </h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-blue-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">🐍</span><h4 class="font-bold text-blue-400 text-lg">Python</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Beginner friendly.</li>
                                    <li><span class="text-red-400 font-bold">-</span> No memory control.</li>
                                    <li><strong class="text-white">Verdict:</strong> Good for Interviews.</li>
                                </ul>
                            </div>
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-sky-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">⚡</span><h4 class="font-bold text-sky-500 text-lg">C++</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Best for CP & Speed.</li>
                                    <li><span class="text-red-400 font-bold">-</span> Hard syntax.</li>
                                    <li><strong class="text-white">Verdict:</strong> High effort, high reward.</li>
                                </ul>
                            </div>
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-orange-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">☕</span><h4 class="font-bold text-orange-500 text-lg">Java</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Corporate Standard.</li>
                                    <li><span class="text-red-400 font-bold">-</span> Verbose syntax.</li>
                                    <li><strong class="text-white">Verdict:</strong> Safe career bet.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-red-400 text-3xl">02.</span> YouTube Channels
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">Python</span>
                                    <span class="text-white font-medium">Codebasics, Code with Harry</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">C++</span>
                                    <span class="text-white font-medium">Apna College, CodeHelp</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">Java</span>
                                    <span class="text-white font-medium">Kunal Kushwaha</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">General</span>
                                    <span class="text-white font-medium">Take U Forward (Striver)</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-green-400 text-3xl">03.</span> Vital Practice
                            </h3>
                            <div class="flex flex-col gap-4">
                                <a href="https://takeuforward.org/strivers-a2z-dsa-course/strivers-a2z-dsa-course-sheet-2/" target="_blank" class="group flex items-center justify-between p-5 bg-gray-900 border border-gray-800 hover:border-green-500 transition-all">
                                    <span class="text-gray-300 group-hover:text-white font-medium">🚀 Striver’s SDE Sheet</span>
                                    <span class="text-green-500">→</span>
                                </a>
                                <a href="https://learnyard.com/practice/dsa" target="_blank" class="group flex items-center justify-between p-5 bg-gray-900 border border-gray-800 hover:border-purple-500 transition-all">
                                    <span class="text-gray-300 group-hover:text-white font-medium">🧠 LearnYard DSA Practice</span>
                                    <span class="text-purple-500">→</span>
                                </a>
                                <a href="#" class="group flex items-center justify-between p-5 bg-gray-900 border border-gray-800 hover:border-sky-500 transition-all">
                                    <span class="text-gray-300 group-hover:text-white font-medium">📊 LeetCode Top 100</span>
                                    <span class="text-sky-500">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                <div class="pt-10 pb-20 text-center">
                    <button id="closeGuideBottomBtn" class="px-8 py-3 bg-white text-black font-bold hover:bg-gray-200 transition-colors">
                        Got it, Let's Code
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // --- MODAL LOGIC ---
            $('#openGuideBtn').on('click', function() {
                $('#guideModal').removeClass('hidden');
                $('body').addClass('overflow-hidden'); 
            });

            function closeModal() {
                $('#guideModal').addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }

            $('#closeGuideBtn, #closeGuideBottomBtn').on('click', closeModal);

            // --- CHECKBOX LOGIC (WITH SKY BLUE CELEBRATION) ---
            $('.topic-checkbox').on('change', function() {
                const checkbox = $(this);
                const isChecked = checkbox.is(':checked');
                const slug = checkbox.data('slug');
                const label = checkbox.closest('label');
                const labelText = label.find('.topic-text');
                const boxContainer = checkbox.next('div'); 

                // 1. ANIMATION & UI
                if (isChecked) {
                    // Celebration Styling
                    labelText.addClass('text-gray-500 line-through decoration-sky-500/50');
                    
                    // Pop Animation
                    boxContainer.addClass('animate-pop');
                    setTimeout(() => boxContainer.removeClass('animate-pop'), 300);

                    // --- CONFETTI EXPLOSION ---
                    const rect = checkbox[0].getBoundingClientRect();
                    const x = (rect.left + rect.width / 2) / window.innerWidth;
                    const y = (rect.top + rect.height / 2) / window.innerHeight;

                    confetti({
                        particleCount: 60,
                        spread: 60,
                        origin: { x: x, y: y },
                        colors: ['#38bdf8', '#ffffff', '#0ea5e9'], // Sky Blue, White
                        disableForReducedMotion: true,
                        gravity: 1.2,
                        scalar: 0.7,
                        ticks: 150
                    });

                } else {
                    // Uncelebration
                    labelText.removeClass('text-gray-500 line-through decoration-sky-500/50');
                    label.addClass('animate-shake');
                    setTimeout(() => label.removeClass('animate-shake'), 400);
                }

                // 2. AJAX REQUEST
                $.ajax({
                    url: 'update_dsa_progress.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        topic_slug: slug,
                        checked: isChecked
                    }),
                    success: function(response) {
                        const res = JSON.parse(response);
                        if(res.status === 'success') {
                            updateProgress();
                        } else {
                            console.error("Update failed", res);
                            checkbox.prop('checked', !isChecked);
                        }
                    },
                    error: function() {
                        alert("Network error. Could not save progress.");
                        checkbox.prop('checked', !isChecked);
                    }
                });
            });

            function updateProgress() {
                const total = <?php echo $total_topics; ?>;
                const checked = $('.topic-checkbox:checked').length;
                const percent = Math.round((checked / total) * 100);

                $('#progressBar').css('width', percent + '%').text(percent + '%');
                $('#completedCount').text(checked);
            }
        });
    </script>
</body>
</html>