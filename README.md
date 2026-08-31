# 🧭 Roadmap Hub

A personal learning roadmap dashboard built with PHP, MySQL, JavaScript, Tailwind CSS, jQuery, and simple progress tracking.

The project brings multiple programming and CS roadmaps into one place and lets students mark topics as completed while their progress is saved per account.

## ✨ What This Project Includes

- 📊 Central roadmap dashboard
- 🧩 DSA learning roadmap
- 🐍 Python learning roadmap
- 🗄️ DBMS learning roadmap
- 💻 C++ learning roadmap
- ✅ Per-topic completion tracking
- 📈 Progress percentage calculation
- 👤 Student-specific progress using register number
- 🔐 Session-based login protection
- 🍪 Optional login persistence through a user register-number cookie
- 🎉 Completion animation/confetti feedback
- 📱 Responsive dark UI
- ⚡ AJAX progress updates without a full page refresh

## 🗂️ Project Structure

```text
roadmap-hub/
│
├── dashboard.php
│
├── dsa_roadmap.php
├── python_roadmap.php
├── dbms_roadmap.php
├── cpp_roadmap.php
│
├── update_dsa_progress.php
├── update_python_progress.php
├── update_dbms_progress.php
├── update_cpp_progress.php
│
├── roadmap.sql
└── README.md
```

## 🧠 Roadmaps

### DSA

The DSA roadmap is structured into foundations, arrays, strings and further data-structure and interview-oriented topics. Progress is stored in `user_dsa_progress`.

### Python

The Python roadmap covers:

- Core Python foundations
- Control flow
- Lists, tuples, sets and dictionaries
- Strings and regular expressions
- Functions and modules
- OOP
- File and exception handling
- Built-in libraries
- NumPy, Pandas and Matplotlib
- Web scraping and automation
- Flask, Django and FastAPI overview
- Tkinter and SQLite

Progress is stored in `user_python_progress`.

### DBMS

The DBMS roadmap is high-yield and interview focused. It covers:

- DBMS architecture and basics
- ER model and keys
- DDL, DML, DCL and TCL
- Constraints and operators
- Joins
- Aggregation and grouping
- Window functions
- Subqueries and views
- Normalization
- Transactions and concurrency
- Indexing
- SQL interview queries

Progress is stored in `user_dbms_progress`.

### C++

The C++ roadmap is syntax and coding focused. It covers:

- Basic syntax and input/output
- Control structures
- Arrays and strings
- Functions
- Pointers
- OOP classes and objects
- Inheritance and polymorphism
- STL

Progress is stored in `user_cpp_progress`.

## ⚙️ How Progress Tracking Works

Each roadmap uses a simple progress table containing:

```text
register_number
 topic_slug
 created_at
```

When a student checks a topic, the corresponding `update_*_progress.php` endpoint inserts the topic for that student.

When the topic is unchecked, the endpoint removes it.

The roadmap page then loads the student's completed topic slugs and calculates the percentage from the number of completed topics.

The frontend sends progress changes with AJAX, so the checkbox can update without reloading the entire page.

## 🔐 Login / Authentication Integration

The current PHP files expect a logged-in student session containing:

```php
$_SESSION['register_number']
```

Some pages also use:

```php
$_SESSION['name']
```

The project redirects unauthenticated users to a login page such as:

```text
login.php
```

If you integrate this project into another website, change the login redirect and session logic to match your authentication system.

## 🗄️ Database Setup

The roadmap pages require an existing student table with at least:

```text
students
├── register_number
└── name
```

The project also needs these progress tables:

```text
user_dsa_progress
user_python_progress
user_dbms_progress
user_cpp_progress
```

Use the included `roadmap.sql` file to create the progress tables.

### Import with phpMyAdmin

1. Create or select the database used by your application.
2. Open **Import**.
3. Select `roadmap.sql`.
4. Execute the SQL.
5. Confirm that the four progress tables were created.

## 🔌 Database Connection

Before using the files, replace the hard-coded database configuration with your own secure configuration.

Example:

```php
$servername = "localhost";
$username = "YOUR_DATABASE_USER";
$password = "YOUR_DATABASE_PASSWORD";
$dbname = "YOUR_DATABASE_NAME";
```

A better production approach is to store database credentials outside the public source files.

## 🚨 Security Before GitHub

Do **not** push real database credentials to a public repository.

The original project files contain database connection values directly inside PHP files. Remove or replace those values before publishing.

Never commit:

```text
.env
config.php
secrets.php
db_credentials.php
production_database.sql
```

Also never upload real student data.

## 🧩 Adding a New Roadmap

To add another subject:

1. Create a new roadmap PHP page.
2. Define the topics as PHP arrays grouped by phases.
3. Create a progress table such as:

```sql
user_java_progress
```

4. Create an update endpoint:

```text
update_java_progress.php
```

5. Read the user's completed topic slugs.
6. Calculate total and completed topics.
7. Add the roadmap card to `dashboard.php`.

Use a unique progress table for each subject to keep the implementation simple.

## 🧪 Local Setup

Place the project inside your PHP server directory.

For XAMPP, for example:

```text
htdocs/roadmap-hub/
```

Start:

- Apache
- MySQL

Then open your local URL, for example:

```text
http://localhost/roadmap-hub/dashboard.php
```

Make sure your login system is available at the path expected by the roadmap pages.

## 🌐 Frontend Libraries

The UI uses CDN-hosted libraries including:

- Tailwind CSS
- jQuery
- Font Awesome
- Google Fonts
- canvas-confetti

An internet connection is required when those assets are loaded from their CDNs.

## 📌 Important Integration Note

`dashboard.php` reads progress counts from the four subject-specific progress tables and uses configured roadmap totals to calculate percentages.

If you change the roadmap topic lists, update the corresponding total-topic values in `dashboard.php` so the dashboard percentages stay accurate.

## 🚀 GitHub Push

From the project folder:

```bash
git init
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
git add .
git commit -m "Add roadmap learning hub"
git push -u origin main
```

If the GitHub repository already contains an initial commit:

```bash
git pull --rebase origin main
git push -u origin main
```

## 📝 Suggested Repository Topics

```text
php
mysql
learning-roadmap
student-dashboard
dsa
python
dbms
cpp
javascript
tailwindcss
jquery
progress-tracker
```

## 📄 License

MIT License

## 👨‍💻 Author

**NaniBalaga**

A lightweight roadmap system for structured technical learning and progress tracking.
