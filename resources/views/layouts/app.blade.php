<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi To-Do List')</title>
    <link rel="icon" href="https://cache.lahelu.com/image-PyPPl44p5-85802" type="image/x-icon">

    <style>
        /* :root adalah variabel untuk Light Mode (Default) */
        :root {
            --bg-body: #f4f7f6;
            --bg-sidebar: #2c3e50;
            --text-sidebar: #ecf0f1;
            --text-sidebar-hover: #34495e;
            --bg-logout-button: #e74c3c;
            --bg-logout-button-hover: #c0392b;
            --bg-content-card: #ffffff;
            --text-color: #333;
            --text-color-light: #555;
        }

        /* Ini adalah variabel untuk Dark Mode */
        body.dark-mode {
            --bg-body: #1a202c;
            --bg-sidebar: #2d3748;
            --text-sidebar: #e2e8f0;
            --text-sidebar-hover: #4a5568;
            --bg-logout-button: #e53e3e;
            --bg-logout-button-hover: #c53030;
            --bg-content-card: #2d3748;
            --text-color: #e2e8f0;
            --text-color-light: #a0aec0;
        }

        /* --- STYLING GLOBAL --- */
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: var(--bg-body);
            /* Gunakan variabel */
            color: var(--text-color);
            /* Gunakan variabel */
            transition: background-color 0.2s, color 0.2s;
            /* Animasi halus */
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- STYLING SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--bg-sidebar);
            /* Gunakan variabel */
            color: var(--text-sidebar);
            /* Gunakan variabel */
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            transition: background-color 0.2s;
        }

        .sidebar .logo {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav li a {
            color: var(--text-sidebar);
            /* Gunakan variabel */
            text-decoration: none;
            display: block;
            padding: 0.85rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
        }

        .sidebar nav li a:hover {
            background-color: var(--text-sidebar-hover);
            /* Gunakan variabel */
        }

        .sidebar .user-profile {
            margin-top: auto;
            border-top: 1px solid var(--text-sidebar-hover);
            /* Gunakan variabel */
            padding-top: 1rem;
        }

        .sidebar .user-profile span {
            display: block;
            text-align: start;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .sidebar .logout-form button {
            width: 100%;
            background: var(--bg-logout-button);
            /* Gunakan variabel */
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .sidebar .logout-form button:hover {
            background: var(--bg-logout-button-hover);
            /* Gunakan variabel */
        }

        /* Tombol Toggle Mode */
        #theme-toggle {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--text-sidebar);
            background: transparent;
            color: var(--text-sidebar);
            cursor: pointer;
            border-radius: 4px;
        }

        body.dark-mode #theme-toggle {
            background: var(--text-sidebar-hover);
        }

        /* --- STYLING KONTEN UTAMA --- */
        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .main-content .content-card {
            background-color: var(--bg-content-card);
            /* Gunakan variabel */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            transition: background-color 0.2s;
        }
    </style>
</head>

<body>
    <div class="app-container">

        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="logo">To-Do List</div>

            @auth
                <nav>
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @if (Auth::user()->role == 'admin')
                            <li><a href="{{ route('admin.users.index') }}">Kelola User</a></li>
                            <li><a href="{{ route('admin.lists.index') }}">Semua List</a></li>
                        @else
                            <li><a href="#">List Saya</a></li>
                        @endif
                    </ul>
                </nav>
                <div class="user-profile">
                    <span>Hallo <b>{{ Auth::user()->name }}</b></span>
                    <button id="theme-toggle">Ganti Mode</button>

                    <form class="logout-form" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            @endauth

            @guest
                <nav>
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </nav>
            @endguest
        </aside>

        <main class="main-content">
            <div class="content-card">
                @yield('content')
            </div>
        </main>
    </div>
    <script>
        (function() {
            // 1. Definisikan elemen
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;
            const currentTheme = localStorage.getItem('theme');

            // 2. Cek tema yang tersimpan saat halaman dimuat
            if (currentTheme === 'dark') {
                body.classList.add('dark-mode');
                themeToggle.textContent = 'Mode Terang'; // Ubah teks tombol
            } else {
                themeToggle.textContent = 'Mode Gelap'; // Teks tombol default
            }

            // 3. Tambahkan event listener untuk tombol
            themeToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');

                // 4. Simpan pilihan ke localStorage
                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    themeToggle.textContent = 'Mode Terang';
                } else {
                    localStorage.setItem('theme', 'light');
                    themeToggle.textContent = 'Mode Gelap';
                }
            });
        })();
    </script>
</body>

</html>
