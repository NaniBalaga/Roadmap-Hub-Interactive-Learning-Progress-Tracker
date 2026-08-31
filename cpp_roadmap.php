<?php
// Include Auth Logic
session_start();
date_default_timezone_set('Asia/Kolkata');

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Auth Check
if (!isset($_SESSION['register_number']) && isset($_COOKIE['user_register_number'])) {
    $_SESSION['register_number'] = $_COOKIE['user_register_number'];
}
if (!isset($_SESSION['register_number'])) { header("Location: login.php"); exit(); }

$register_number = $_SESSION['register_number'];

// Random active students count
$active_students = rand(25, 90);

// =========================================================================
// 1. FETCH USER PROGRESS (CPP TABLE)
// =========================================================================
$completed_topics = [];
$prog_sql = "SELECT topic_slug FROM user_cpp_progress WHERE register_number = '$register_number'";
$prog_res = $conn->query($prog_sql);
while($row = $prog_res->fetch_assoc()) {
    $completed_topics[] = $row['topic_slug'];
}

// =========================================================================
// 2. C++ PROGRAMMING LANGUAGE ROADMAP (SYNTAX & CODING FOCUSED)
// =========================================================================
$roadmap = [
    "Phase 1: Basic Syntax & Input/Output" => [
        "Structure of C++ Program (main function)",
        "Comments (Single line // vs Multi-line /* */)",
        "Variables & Data Types (int, float, char, bool, double)",
        "Input: cin >> (Extraction Operator)",
        "Output: cout << (Insertion Operator)",
        "New Line: endl vs \\n (Escape Sequences)",
        "Type Casting: (int)x vs static_cast<int>(x)",
        "Math Library: pow, sqrt, abs, ceil, floor",
        "Hands-on: Calculator using switch-case",
        "Hands-on: Check Odd/Even Number"
    ],
    "Phase 2: Control Structures (Logic)" => [
        "If-Else Statements",
        "Nested If-Else",
        "Ternary Operator (condition ? true : false)",
        "Switch Case (break, default)",
        "Loops: For Loop (Syntax & Flow)",
        "Loops: While Loop",
        "Loops: Do-While Loop",
        "Break & Continue Statements",
        "Hands-on: Print Multiplication Table",
        "Hands-on: Reverse a Number using While Loop",
        "Hands-on: Check Prime Number"
    ],
    "Phase 3: Arrays & Strings" => [
        "Array Declaration & Initialization",
        "Accessing Elements (Index based)",
        "Multidimensional Arrays (2D Matrix)",
        "C-Style Strings (char array)",
        "C++ String Class (std::string header)",
        "String Functions: length(), append(), substr()",
        "String Input: getline(cin, str)",
        "Hands-on: Find Max Element in Array",
        "Hands-on: Matrix Addition",
        "Hands-on: Check Palindrome String"
    ],
    "Phase 4: Functions" => [
        "Function Declaration vs Definition",
        "Return Types & Parameters",
        "Pass by Value",
        "Pass by Reference (& syntax)",
        "Default Arguments",
        "Function Overloading (Same name, diff params)",
        "Recursion (Function calling itself)",
        "Hands-on: Swap function (Pass by Reference)",
        "Hands-on: Factorial using Recursion"
    ],
    "Phase 5: Pointers (Language Syntax)" => [
        "Pointer Declaration (*ptr)",
        "Address-of Operator (&)",
        "Dereferencing Operator (*)",
        "Null Pointer (nullptr)",
        "Pointer Arithmetic (ptr++, ptr--)",
        "Dynamic Memory: new keyword",
        "Dynamic Memory: delete keyword",
        "Hands-on: Dynamic Array allocation",
        "Hands-on: Sum of array using pointers"
    ],
    "Phase 6: OOPs - Classes & Objects" => [
        "Class Syntax (class Keyword)",
        "Access Specifiers: public, private",
        "Creating Objects (Static vs Dynamic)",
        "Member Functions (Inside vs Outside class)",
        "Constructors (Default, Parameterized)",
        "Destructors (~Syntax)",
        "The 'this' Pointer",
        "Static Members (static keyword)",
        "Hands-on: Student Class with Roll No & Name",
        "Hands-on: Rectangle Class with Area method"
    ],
    "Phase 7: OOPs - Inheritance & Polymorphism" => [
        "Inheritance Syntax (class B : public A)",
        "Single Inheritance",
        "Multilevel Inheritance",
        "Function Overriding (Same signature)",
        "Virtual Functions (virtual keyword)",
        "Pure Virtual Functions (= 0 syntax)",
        "Friend Functions (friend keyword)",
        "Hands-on: Animal Class -> Dog Class (Inheritance)",
        "Hands-on: Shape Class -> Circle/Square (Polymorphism)"
    ],
    "Phase 8: STL (Standard Template Library)" => [
        "Vectors: push_back(), size(), pop_back()",
        "Iterators: begin(), end()",
        "Sort Function: sort(v.begin(), v.end())",
        "Maps: map<key, value> syntax",
        "Pairs: pair<int, int> syntax",
        "Hands-on: Sorting an Array using STL",
        "Hands-on: Frequency Count using Map"
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
    <title>C++ OOPs Roadmap | CONNECT SRMAP</title>
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
                        blue: {
                            500: '#3b82f6',
                            600: '#2563eb',
                        },
                        cyan: {
                            400: '#22d3ee',
                            500: '#06b6d4',
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
        ::-webkit-scrollbar-thumb:hover { background: #3b82f6; } 

        /* Checkbox Customization */
        .custom-checkbox input:checked + div {
            background-color: #3b82f6; /* Blue */
            border-color: #3b82f6;
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
                CONNECT <span class="text-blue-500">SRMAP</span>
            </h1>
            <div class="text-sm font-semibold text-gray-400">
                C++ OOPs Roadmap
            </div>
        </div>
    </nav>

    <header class="max-w-3xl mx-auto mt-8 px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
            Master Object Oriented<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-600">
                Programming with C++
            </span>
        </h2>
        
        <p class="text-gray-400 text-sm max-w-md mx-auto mb-5">
            From Classes and Objects to Advanced STL and Memory Management. The core of Placement Interviews.
        </p>

        <button id="openGuideBtn" class="mb-6 inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl border border-gray-700 hover:border-blue-500/50 transition-all group shadow-lg">
             
            <span class="text-sm font-semibold">Quick Guide: OOPs Cheat Sheet</span>
        </button>

        <div class="bg-gray-900 rounded-full h-4 w-full max-w-lg mx-auto relative overflow-hidden shadow-inner border border-gray-800">
            <div id="progressBar" class="bg-blue-500 h-full transition-all duration-500 ease-out flex items-center justify-end pr-2 text-[10px] font-bold text-white" 
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
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                </span>
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-wide">
                    <span class="text-blue-400 font-bold text-xs"><?php echo $active_students; ?></span> C++ Coders
                </p>
            </div>
    </header>

    <main class="max-w-4xl mx-auto mt-12 px-4 space-y-8">
        
        <?php foreach ($roadmap as $section_title => $topics): ?>
        <div class="bg-gray-900/50 border border-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all hover:border-gray-700">
            <div class="bg-gray-900 px-4 py-3 border-b border-gray-800 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
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
                        
                        <div class="w-4 h-4 border-2 border-gray-700 rounded bg-gray-900 transition-all peer-focus:ring-2 peer-focus:ring-blue-500/50 flex items-center justify-center">
                            <svg class="w-3 h-3 text-white hidden pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1 z-10">
                        <span class="topic-text text-sm text-gray-300 font-medium group-hover:text-white transition-colors <?php echo $isChecked ? 'text-gray-500 line-through decoration-blue-500/50' : ''; ?>">
                            <?php echo $topic; ?>
                        </span>
                        
                        <?php if(str_contains($topic, 'Virtual') || str_contains($topic, 'Polymorphism')): ?>
                            <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-cyan-300 bg-cyan-900/20 px-1.5 py-0.5 rounded border border-cyan-900/50">
                                Core
                            </span>
                        <?php elseif(str_contains($topic, 'Pointer') || str_contains($topic, 'Memory')): ?>
                            <span class="ml-1.5 inline-block text-[9px] uppercase font-bold text-red-300 bg-red-900/20 px-1.5 py-0.5 rounded border border-red-900/50">
                                Hard
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
                    <h2 class="text-5xl md:text-6xl font-extrabold text-white">OOPs <span class="text-blue-500">Mastery</span></h2>
                    <p class="text-xl text-gray-400">Resources & Best Practices</p>
                </div>

                <div class="space-y-12">
                    
                    <div class="grid md:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-blue-400 text-3xl">01.</span> YouTube Channels
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-blue-500/50 transition-colors">
                                    <span class="text-gray-400">The Cherno</span>
                                    <span class="text-white font-medium">Deep C++ Knowledge</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-blue-500/50 transition-colors">
                                    <span class="text-gray-400">Abdul Bari</span>
                                    <span class="text-white font-medium">Algorithms & C++</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-900 border border-gray-800 hover:border-blue-500/50 transition-colors">
                                    <span class="text-gray-400">CodeBeauty</span>
                                    <span class="text-white font-medium">OOPs Concepts</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                                <span class="text-cyan-400 text-3xl">02.</span> Interview Hotspots
                            </h3>
                            <div class="flex flex-col gap-4">
                                <div class="p-4 bg-gray-900 border border-gray-800">
                                    <h4 class="text-white font-bold mb-1">V-Table & V-Ptr</h4>
                                    <p class="text-xs text-gray-400">How runtime polymorphism works internally.</p>
                                </div>
                                <div class="p-4 bg-gray-900 border border-gray-800">
                                    <h4 class="text-white font-bold mb-1">Diamond Problem</h4>
                                    <p class="text-xs text-gray-400">Virtual Inheritance to solve ambiguity.</p>
                                </div>
                                 <div class="p-4 bg-gray-900 border border-gray-800">
                                    <h4 class="text-white font-bold mb-1">Smart Pointers</h4>
                                    <p class="text-xs text-gray-400">Unique vs Shared pointers (C++11).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                <div class="pt-10 pb-20 text-center">
                    <button id="closeGuideBottomBtn" class="px-8 py-3 bg-white text-black font-bold hover:bg-gray-200 transition-colors">
                        Start Coding
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

            // --- CHECKBOX LOGIC (WITH BLUE/CYAN CELEBRATION) ---
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
                    labelText.addClass('text-gray-500 line-through decoration-blue-500/50');
                    
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
                        colors: ['#3b82f6', '#22d3ee', '#ffffff'], // Blue, Cyan, White
                        disableForReducedMotion: true,
                        gravity: 1.2,
                        scalar: 0.7,
                        ticks: 150
                    });

                } else {
                    // Uncelebration
                    labelText.removeClass('text-gray-500 line-through decoration-blue-500/50');
                    label.addClass('animate-shake');
                    setTimeout(() => label.removeClass('animate-shake'), 400);
                }

                // 2. AJAX REQUEST
                $.ajax({
                    url: 'update_cpp_progress.php',
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
