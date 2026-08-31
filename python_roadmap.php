<?php
// Include your existing Auth Logic
session_start();
date_default_timezone_set('Asia/Kolkata');

$servername = "localhost";
$username = "u937292695_nanibalaga";
$password = "Nani@0779";
$dbname = "u937292695_nanibalaga";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Auth Check
if (!isset($_SESSION['register_number']) && isset($_COOKIE['user_register_number'])) {
    $_SESSION['register_number'] = $_COOKIE['user_register_number'];
}
if (!isset($_SESSION['register_number'])) { header("Location: login.php"); exit(); }

$register_number = $_SESSION['register_number'];

// Generate fake active student count (10 to 120)
$active_students = rand(15, 65);

// =========================================================================
// 1. FETCH USER PROGRESS (PYTHON TABLE)
// =========================================================================
$completed_topics = [];
$prog_sql = "SELECT topic_slug FROM user_python_progress WHERE register_number = '$register_number'";
$prog_res = $conn->query($prog_sql);
while($row = $prog_res->fetch_assoc()) {
    $completed_topics[] = $row['topic_slug'];
}

// =========================================================================
// 2. PYTHON ROADMAP DATA (BALANCED CORE + RICH LIBRARIES)
// =========================================================================
$roadmap = [
    "Phase 1: Python Core Foundations" => [
        "Introduction: Features & Execution Modes",
        "Variables & Dynamic Typing",
        "Data Types: int, float, bool, str, None",
        "Type Casting (Implicit vs Explicit)",
        "Input/Output: print(f-strings), input()",
        "Operators: Arithmetic, Logical, Comparison",
        "Operators: Bitwise, Membership, Identity",
        "Code Practice: Simple Calculator",
        "Code Practice: Swapping Variables"
    ],
    "Phase 2: Control Flow Logic" => [
        "Conditional: if, elif, else",
        "Loops: while loop (entry controlled)",
        "Loops: for loop (range function)",
        "Loop Control: break, continue, pass",
        "Nested Loops (Pattern Printing)",
        "Code Practice: Fibonacci Series",
        "Code Practice: Prime Number Check",
        "Code Practice: Star Patterns"
    ],
    "Phase 3: Data Structures (The Big 4)" => [
        "Lists: append, pop, sort, slicing ",
        "Tuples: Immutability & Packing",
        "Sets: Union, Intersection, Unique items",
        "Dictionaries: Key-Value pairs, get() method",
        "List Comprehensions (Pythonic way)",
        "Dictionary Comprehensions",
        "Code Practice: Remove Duplicates from List",
        "Code Practice: Frequency Count (Dict)",
        "Code Practice: Matrix Addition (Nested Lists)"
    ],
    "Phase 4: Strings & Regex" => [
        "String Slicing [::-1] (Reverse)",
        "String Methods: split, join, strip, replace",
        "String Formatting: f-strings vs format()",
        "Regex: re.match vs re.search",
        "Regex: Patterns (\d, \w, \s)",
        "Code Practice: Palindrome Check",
        "Code Practice: Extract Email from text (Regex)"
    ],
    "Phase 5: Functions & Modules" => [
        "Function Def & Return Statement",
        "Arguments: Positional, Keyword, Default",
        "Args & Kwargs (*args, **kwargs)",
        "Lambda Functions (Anonymous)",
        "Map, Filter, Reduce",
        "Recursion Basics",
        "Modules: Import math, random, time",
        "Code Practice: Factorial (Recursion)",
        "Code Practice: Custom Module Creation"
    ],
    "Phase 6: OOPs (Object Oriented Programming)" => [
        "Class & Object Syntax",
        "The __init__ Constructor",
        "Self Parameter",
        "Inheritance (Single & Multiple)",
        "Polymorphism (Method Overriding)",
        "Encapsulation (Private __vars)",
        "Abstraction (Abstract Base Class)",
        "Code Practice: Bank Account Class",
        "Code Practice: Library Management System"
    ],
    "Phase 7: File & Exception Handling" => [
        "File Modes: Read (r), Write (w), Append (a)",
        "Context Manager (with open...)",
        "CSV File Handling (csv module)",
        "Try, Except, Finally Blocks",
        "Raising Custom Exceptions",
        "Code Practice: Log File analyzer"
    ],
    // =========================================================
    // IMPORTANT LIBRARIES SECTION (EXPANDED)
    // =========================================================
    "Phase 8: Essential Built-in Libraries" => [
        "OS Module: File paths, Directory operations",
        "Sys Module: Command line args, System path",
        "DateTime: Date manipulation, Timedelta",
        "Random: seed, choice, shuffle",
        "JSON: Parsing API responses (load/dump)",
        "Math: ceil, floor, factorial, gcd",
        "Collections: Counter, DefaultDict, NamedTuple"
    ],
    "Phase 9: Data Science Libraries (NumPy & Pandas)" => [
        "NumPy: Arrays vs Lists (Performance)",
        "NumPy: Shape, Reshape, Slicing",
        "NumPy: Broadcasting & Math Operations",
        "Pandas: Series vs DataFrame",
        "Pandas: Reading CSV/Excel (read_csv)",
        "Pandas: Head, Tail, Info, Describe",
        "Pandas: Filtering & Sorting Data",
        "Pandas: Handling Missing Values (fillna)",
        "Matplotlib: Simple Line & Bar Plots"
    ],
    "Phase 10: Web Scraping & Automation" => [
        "Requests Lib: GET, POST, Status Codes",
        "BeautifulSoup4: HTML Parsing, find(), find_all()",
        "Selenium: Browser Automation (Basic Idea)",
        "Project: IMDB Top Movies Scraper",
        "Project: Amazon Price Tracker"
    ],
    "Phase 11: Web Frameworks (Overview)" => [
        "Flask: Routing & Templates (Jinja2)",
        "Django: MVT Architecture Concept",
        "FastAPI: Modern Async APIs (Intro)",
        "Project: Simple To-Do List API (Flask)"
    ],
    "Phase 12: GUI & Database" => [
        "Tkinter: Windows, Labels, Buttons",
        "SQLite3: Connecting Database",
        "SQL: Execute, Commit, FetchAll",
        "Project: GUI Contact Book with Database"
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
    <title>Python Roadmap | CONNECT SRMAP</title>
    <link rel="icon" href="../logo.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
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
        ::-webkit-scrollbar-thumb:hover { background: #38bdf8; } 

        /* Checkbox Customization */
        .custom-checkbox input:checked + div {
            background-color: #38bdf8; 
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
                Python Mastery
            </div>
        </div>
    </nav>

    <header class="max-w-3xl mx-auto mt-8 px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
            The Ultimate<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-600">
                Python Roadmap
            </span>
        </h2>
        
        <p class="text-gray-400 text-sm max-w-md mx-auto mb-5">
            Zero to Hero in Python. Master the syntax, OOPs, and build real projects for your placements.
        </p>
        
        <button id="openGuideBtn" class="mb-6 inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl border border-gray-700 hover:border-sky-500/50 transition-all group shadow-lg">
            <svg class="w-4 h-4 text-sky-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <span class="text-sm font-semibold">Start Here: Tools & Tips</span>
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
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                </span>
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-wide">
                    <span class="text-sky-400 font-bold text-xs"><?php echo $active_students; ?></span> Python Learners
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
                        
                        <?php if(str_contains($topic, 'Code Practice') || str_contains($topic, 'Project')): ?>
                            <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-sky-300 bg-sky-900/20 px-1.5 py-0.5 rounded border border-sky-900/50">
                                Build
                            </span>
                        <?php elseif(str_contains($topic, 'Deep Dive') || str_contains($topic, 'Advanced')): ?>
                            <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-yellow-400 bg-yellow-900/20 px-1.5 py-0.5 rounded border border-yellow-900/50">
                                Pro
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
                    <h2 class="text-5xl md:text-6xl font-extrabold text-white">Python <span class="text-sky-400">Kickstart</span></h2>
                    <p class="text-xl text-gray-400">Tools, Resources & Environment Setup</p>
                </div>

                <div class="space-y-12">
                    
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="text-sky-400 text-3xl">01.</span> Editors & IDEs
                        </h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-blue-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">💻</span><h4 class="font-bold text-blue-400 text-lg">VS Code</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Lightweight & Fast.</li>
                                    <li><span class="text-green-400 font-bold">+</span> Great Extensions.</li>
                                    <li><strong class="text-white">Verdict:</strong> Best for Web Dev/Scripts.</li>
                                </ul>
                            </div>
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-yellow-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">🐍</span><h4 class="font-bold text-yellow-500 text-lg">PyCharm</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Powerful Debugger.</li>
                                    <li><span class="text-red-400 font-bold">-</span> Heavy on RAM.</li>
                                    <li><strong class="text-white">Verdict:</strong> Best for pure Python.</li>
                                </ul>
                            </div>
                            <div class="bg-gray-900 p-6 rounded-none border-l-2 border-gray-800 hover:border-orange-500 transition-all">
                                <div class="flex items-center gap-2 mb-3"><span class="text-2xl">📓</span><h4 class="font-bold text-orange-500 text-lg">Jupyter</h4></div>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li><span class="text-green-400 font-bold">+</span> Interactive Cells.</li>
                                    <li><span class="text-green-400 font-bold">+</span> Data Visualization.</li>
                                    <li><strong class="text-white">Verdict:</strong> Best for DS/ML.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-red-400 text-3xl">02.</span> Learning Resources
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">YouTube (Hindi)</span>
                                    <span class="text-white font-medium">CodeWithHarry</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">YouTube (English)</span>
                                    <span class="text-white font-medium">Corey Schafer / Mosh</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-red-500/50 transition-colors">
                                    <span class="text-gray-400">Documentation</span>
                                    <span class="text-white font-medium">Docs.python.org</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-green-400 text-3xl">03.</span> Practice Sites
                            </h3>
                            <div class="flex flex-col gap-4">
                                <a href="https://www.hackerrank.com/domains/python" target="_blank" class="group flex items-center justify-between p-5 bg-gray-900 border border-gray-800 hover:border-green-500 transition-all">
                                    <span class="text-gray-300 group-hover:text-white font-medium">🟢 HackerRank (Gold Badge)</span>
                                    <span class="text-green-500">→</span>
                                </a>
                                <a href="https://leetcode.com/problemset/all/?topicSlugs=python" target="_blank" class="group flex items-center justify-between p-5 bg-gray-900 border border-gray-800 hover:border-orange-500 transition-all">
                                    <span class="text-gray-300 group-hover:text-white font-medium">🟠 LeetCode (Python)</span>
                                    <span class="text-orange-500">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                <div class="pt-10 pb-20 text-center">
                    <button id="closeGuideBottomBtn" class="px-8 py-3 bg-white text-black font-bold hover:bg-gray-200 transition-colors">
                        Ready? print("Let's Go")
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
                        colors: ['#38bdf8', '#ffffff', '#fbbf24'], // Sky Blue, White, Amber
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

                // 2. AJAX REQUEST (UPDATED TO PYTHON ENDPOINT)
                $.ajax({
                    url: 'update_python_progress.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        topic_slug: slug,
                        checked: isChecked
                    }),
                    success: function(response) {
                        try {
                            const res = JSON.parse(response);
                            if(res.status === 'success') {
                                updateProgress();
                            } else {
                                console.error("Update failed", res);
                                checkbox.prop('checked', !isChecked);
                            }
                        } catch(e) {
                            console.error("JSON Error", e);
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