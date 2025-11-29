<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi To-Do List PKL')</title>
    <link rel="icon" href="https://cache.lahelu.com/image-PyPPl44p5-85802" type="image/x-icon">
    <link href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" rel="stylesheet">

    <style>
        /* ===== VARIABLES & THEME ===== */
        :root {
            /* Light Theme */
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-content: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f1f5f9;
            --bg-input: #ffffff;

            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;

            --accent-primary: #3b82f6;
            --accent-secondary: #6366f1;
            --accent-success: #10b981;
            --accent-warning: #f59e0b;
            --accent-danger: #ef4444;

            --border-light: #e2e8f0;
            --border-medium: #cbd5e1;

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);

            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;

            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark-mode {
            /* Modern Dark Theme - Blue & Black Palette */
            --bg-body: #0a0f1c;
            --bg-sidebar: #111827;
            --bg-content: #111827;
            --bg-card: #1f2937;
            --bg-hover: #374151;
            --bg-input: #374151;

            --text-primary: #f3f4f6;
            --text-secondary: #d1d5db;
            --text-muted: #9ca3af;

            --accent-primary: #3b82f6;
            --accent-secondary: #60a5fa;
            --accent-success: #10b981;
            --accent-warning: #f59e0b;
            --accent-danger: #ef4444;

            --border-light: #374151;
            --border-medium: #4b5563;

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.4);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -1px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.4);
        }

        /* ===== BASE STYLING ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-body);
            color: var(--text-primary);
            line-height: 1.6;
            transition: var(--transition-slow);
            overflow-x: hidden;
        }

        /* ===== LAYOUT ===== */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 280px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-light);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            transition: var(--transition-slow);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            overflow-y: auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-primary);
            margin-bottom: 2rem;
            padding: 0.5rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .logo:hover {
            transform: translateX(4px);
        }

        .logo i {
            font-size: 1.75rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links li {
            margin-bottom: 0.25rem;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--accent-primary);
            transform: scaleY(0);
            transition: var(--transition);
        }

        .nav-links a:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
            transform: translateX(4px);
        }

        .nav-links a:hover::before {
            transform: scaleY(1);
        }

        .nav-links a.active {
            background: var(--bg-hover);
            color: var(--accent-primary);
        }

        .nav-links a.active::before {
            transform: scaleY(1);
        }

        .nav-links i {
            font-size: 1.25rem;
            width: 20px;
            text-align: center;
        }

        /* User Section */
        .user-section {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-light);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: var(--radius-md);
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .user-profile:hover {
            background: var(--bg-hover);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.125rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .action-buttons>* {
            width: 100%;
        }

        .btn {
            padding: 0.75rem 1rem;
            border: none;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            width: 100%;
        }

        .btn-primary {
            background: var(--accent-primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-secondary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-medium);
            color: var(--text-secondary);
        }

        .btn-outline:hover {
            background: var(--bg-hover);
            border-color: var(--accent-primary);
            color: var(--accent-primary);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--accent-danger);
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            padding: 2rem;
            background: var(--bg-content);
            transition: var(--transition-slow);
            position: relative;
            margin-left: 280px;
            min-height: 100vh;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .content-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            transition: var(--transition);
            border: 1px solid var(--border-light);
        }

        .content-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-menu-btn {
                display: block !important;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: var(--accent-primary);
                color: white;
                border: none;
                border-radius: var(--radius-md);
                padding: 0.75rem;
                cursor: pointer;
                box-shadow: var(--shadow-lg);
                font-size: 1.25rem;
                line-height: 1;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
                padding-top: 5rem;
            }

            .content-card {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .content-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .action-buttons {
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .sidebar {
                width: 100%;
                max-width: 300px;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .text-gradient {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark-mode .glass-effect {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--accent-primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            padding: 0.75rem;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            font-size: 1.25rem;
            line-height: 1;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>

<body>
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Buka menu">
        <i class="ph ph-list"></i>
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-container">
        {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <i class="ph ph-check-square"></i>
                <span>To-Do List</span>
            </div>

            @auth
                <nav class="nav-section">
                    <div class="nav-title">Navigation</div>
                    <ul class="nav-links">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="ph ph-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        {{-- Tampilkan "Kelola User" HANYA jika admin --}}
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                    <i class="ph ph-users"></i>
                                    <span>Kelola User</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('lists.index') }}"
                                class="{{ request()->routeIs('lists.*') ? 'active' : '' }}">
                                <i class="ph ph-list-checks"></i>
                                <span>Semua List</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="user-section">
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button class="btn btn-outline" id="theme-toggle" aria-label="Ganti mode tema">
                            <i class="ph" id="theme-icon"></i>
                            <span id="theme-text">Mode Gelap</span>
                        </button>

                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="ph ph-sign-out"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <nav class="nav-section">
                    <ul class="nav-links">
                        <li>
                            <a href="{{ route('login') }}">
                                <i class="ph ph-sign-in"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endguest
        </aside>

        {{-- Konten Utama --}}
        <main class="main-content">

            <div class="content-wrapper" style="width: 100%; max-width: 1400px; margin-left: auto; margin-right: auto;">

                <div class="content-header">
                    <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                    <div class="header-actions">
                        @yield('header-actions')
                    </div>
                </div>

                <div class="content-card">
                    @yield('content')
                </div>

            </div>
        </main>
    </div>

    <script>
        // Theme Toggle Functionality
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const themeText = document.getElementById('theme-text');
        const body = document.body;
        const currentTheme = localStorage.getItem('theme');

        // Initialize theme
        function initTheme() {
            if (!themeToggle) return;

            if (currentTheme === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.className = 'ph ph-sun';
                themeText.textContent = 'Mode Terang';
            } else {
                body.classList.remove('dark-mode');
                themeIcon.className = 'ph ph-moon';
                themeText.textContent = 'Mode Gelap';
            }
        }

        // Toggle theme
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');

                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    themeIcon.className = 'ph ph-sun';
                    themeText.textContent = 'Mode Terang';
                } else {
                    localStorage.setItem('theme', 'light');
                    themeIcon.className = 'ph ph-moon';
                    themeText.textContent = 'Mode Gelap';
                }
            });
        }

        // Mobile Menu Functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleMobileMenu() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');

            // Update aria label untuk aksesibilitas
            const isOpen = sidebar.classList.contains('active');
            mobileMenuBtn.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
            mobileMenuBtn.innerHTML = isOpen ? '<i class="ph ph-x"></i>' : '<i class="ph ph-list"></i>';
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            sidebarOverlay.addEventListener('click', toggleMobileMenu);
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            initTheme();

            // Auto-hide mobile menu when clicking on links
            const navLinks = document.querySelectorAll('.nav-links a');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                        toggleMobileMenu();
                    }
                });
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                // Reset icon menu
                mobileMenuBtn.innerHTML = '<i class="ph ph-list"></i>';
                mobileMenuBtn.setAttribute('aria-label', 'Buka menu');
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
