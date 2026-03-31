<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'ERP Bordir Admin' ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Admin Template Global CSS -->
    <style>
        :root {
            /* Global Glassmorphism Variables */
            --bg-color: #f0f4f8;
            --blob-1: rgba(143, 116, 255, 0.4);
            --blob-2: rgba(43, 210, 255, 0.4);
            
            --sidebar-width: 260px;
            --sidebar-bg: rgba(255, 255, 255, 0.45);
            --sidebar-border: rgba(255, 255, 255, 0.6);
            --sidebar-text: #2d3748;
            --sidebar-hover: rgba(255, 255, 255, 0.6);
            
            --header-bg: rgba(255, 255, 255, 0.45);
            --header-border: rgba(255, 255, 255, 0.6);
            --header-shadow: rgba(31, 38, 135, 0.05);
            
            --body-bg: transparent;
            --text-main: #334155;
            --accent-color: #5a67d8;

            /* These are used by child components like calculator */
            --glass-bg: rgba(255, 255, 255, 0.55);
            --glass-border: rgba(255, 255, 255, 0.8);
            --glass-shadow: rgba(31, 38, 135, 0.07);
            --text-muted: #718096;
            --input-bg: rgba(255, 255, 255, 0.7);
            --input-border: rgba(255, 255, 255, 1);
            --input-text: #2d3748;
            --accent: #5a67d8;
        }

        [data-theme="dark"] {
            --bg-color: #0f172a;
            --blob-1: rgba(139, 92, 246, 0.25);
            --blob-2: rgba(56, 189, 248, 0.25);

            --sidebar-bg: rgba(15, 23, 42, 0.5);
            --sidebar-border: rgba(255, 255, 255, 0.08);
            --sidebar-text: #f8fafc;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            
            --header-bg: rgba(15, 23, 42, 0.5);
            --header-border: rgba(255, 255, 255, 0.08);
            --header-shadow: rgba(0, 0, 0, 0.2);
            
            --body-bg: transparent;
            --text-main: #e2e8f0;
            --accent-color: #818cf8;

            /* Glass child variables */
            --glass-bg: rgba(15, 23, 42, 0.65);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: rgba(0, 0, 0, 0.25);
            --text-muted: #94a3b8;
            --input-bg: rgba(30, 41, 59, 0.6);
            --input-border: rgba(255, 255, 255, 0.1);
            --input-text: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            transition: background-color 0.3s ease, color 0.3s ease;
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Abstract Background Blobs */
        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            transition: all 0.5s ease;
        }

        .blob-1 {
            background: var(--blob-1);
            width: 400px;
            height: 400px;
            top: -100px;
            left: -50px;
        }

        .blob-2 {
            background: var(--blob-2);
            width: 500px;
            height: 500px;
            bottom: -150px;
            right: -100px;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        /* Sidebar Glassmorphism */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: var(--sidebar-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid var(--sidebar-border);
            color: var(--sidebar-text);
            min-height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        #sidebar.active {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.05);
            border-bottom: 1px solid var(--sidebar-border);
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1rem;
            display: block;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: 0.2s;
            border-left: 4px solid transparent;
        }

        #sidebar ul li a:hover {
            background: var(--sidebar-hover);
        }
        
        #sidebar ul li.active > a {
            background: rgba(255,255,255,0.1);
            border-left: 4px solid var(--accent-color);
            color: var(--accent-color);
            font-weight: 600;
        }

        /* Content Area */
        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .top-header {
            background: var(--header-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--header-border);
            box-shadow: 0 4px 30px var(--header-shadow);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .main-content {
            padding: 2rem;
            flex-grow: 1;
            position: relative;
            z-index: 1;
        }

        .main-footer {
            padding: 1rem 2rem;
            text-align: right;
            font-size: 0.85rem;
            color: var(--text-main);
            opacity: 0.7;
        }

        .theme-toggler-btn {
            background: var(--glass-bg);
            color: var(--text-main);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
        }
        .theme-toggler-btn:hover {
            transform: scale(1.05);
        }

        /* Dropdown glass */
        .dropdown-menu {
            background: var(--sidebar-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--sidebar-border);
            box-shadow: 0 4px 30px var(--header-shadow);
        }
        .dropdown-item {
            color: var(--text-main);
        }
        .dropdown-item:hover {
            background: var(--sidebar-hover);
            color: var(--text-main);
        }
        .dropdown-divider {
            border-top-color: var(--sidebar-border);
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
                position: fixed;
                height: 100vh;
            }
            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>

    <!-- Page Specific CSS loaded dynamically via Controller -->
    <?= isset($custom_css) ? $custom_css : '' ?>
</head>
<body>
    <!-- Global Abstract Blobs for Glassmorphism Context -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="wrapper">
        <!-- Sidebar Navigation -->
        <?php $this->load->view('layout/sidebar'); ?>

        <!-- Main Workspace -->
        <div id="content">
            <!-- Top Navbar/Header -->
            <?php $this->load->view('layout/header'); ?>

            <!-- Page Content Injection -->
            <div class="main-content">
                <?= isset($content) ? $content : '' ?>
            </div>

            <!-- Footer -->
            <?php $this->load->view('layout/footer'); ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin Template Global Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggler logic
            const sidebarBtn = document.getElementById('sidebarCollapse');
            if(sidebarBtn) {
                sidebarBtn.addEventListener('click', function() {
                    document.getElementById('sidebar').classList.toggle('active');
                });
            }

            // Global Dark Mode Theme Logic
            const themeBtn = document.getElementById('global-theme-trigger');
            const themeIcon = document.getElementById('global-theme-icon');
            
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                if(themeIcon) themeIcon.classList.replace('bi-moon', 'bi-sun');
            }

            if(themeBtn) {
                themeBtn.addEventListener('click', () => {
                    const currentTheme = document.documentElement.getAttribute('data-theme');
                    if (currentTheme === 'dark') {
                        document.documentElement.removeAttribute('data-theme');
                        localStorage.setItem('theme', 'light');
                        if(themeIcon) themeIcon.classList.replace('bi-sun', 'bi-moon');
                    } else {
                        document.documentElement.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                        if(themeIcon) themeIcon.classList.replace('bi-moon', 'bi-sun');
                    }
                });
            }
        });
    </script>

    <!-- Page Specific JS loaded dynamically via Controller -->
    <?= isset($custom_js) ? $custom_js : '' ?>
</body>
</html>
