<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PKL Management System</title>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <style>
        :root {
            --accent-primary: #3b82f6;
            --accent-secondary: #6366f1;
            --accent-success: #10b981;
            --accent-warning: #f59e0b;
            --accent-danger: #ef4444;
            --bg-primary: #0f0f23;
            --bg-secondary: #1a1a2e;
            --bg-card: rgba(26, 26, 46, 0.8);
            --bg-input: rgba(255, 255, 255, 0.1);
            --text-primary: #ffffff;
            --text-secondary: #a0a0c0;
            --text-muted: #6b7280;
            --border-light: rgba(255, 255, 255, 0.1);
            --border-medium: rgba(255, 255, 255, 0.2);
            --border-dark: rgba(255, 255, 255, 0.3);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: var(--text-primary);
            overflow: hidden;
            position: relative;
        }

        /* Stars Background */
        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .star {
            position: absolute;
            background-color: white;
            border-radius: 50%;
            animation: twinkle var(--duration, 3s) infinite var(--delay, 0s);
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.2;
                transform: scale(0.8);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        /* Nebula Effect */
        .nebula {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            animation: nebulaFloat 20s ease-in-out infinite;
            z-index: 2;
        }

        @keyframes nebulaFloat {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(-10px, -10px) scale(1.02);
            }
            50% {
                transform: translate(5px, 5px) scale(0.98);
            }
            75% {
                transform: translate(10px, -5px) scale(1.01);
            }
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 0 0 1px rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border: 1px solid var(--border-light);
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        }

        .login-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transition: left 0.5s ease;
        }

        .login-card:hover::after {
            left: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-icon {
            font-size: 3.5rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .login-title {
            font-size: 1.875rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1.25rem;
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid var(--border-medium);
            border-radius: var(--radius-lg);
            background: var(--bg-input);
            color: var(--text-primary);
            font-size: 1rem;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 
                0 0 0 3px rgba(59, 130, 246, 0.1),
                0 0 20px rgba(59, 130, 246, 0.2);
        }

        .form-input::placeholder {
            color: var(--text-secondary);
        }

        .remember-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-checkbox {
            width: 1.125rem;
            height: 1.125rem;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-medium);
            background: var(--bg-input);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .remember-checkbox:checked {
            background: var(--accent-primary);
            border-color: var(--accent-primary);
        }

        .remember-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 0.75rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .remember-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: left 0.5s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 10px 20px rgba(59, 130, 246, 0.3),
                0 0 30px rgba(59, 130, 246, 0.2);
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:active {
            transform: translateY(0);
        }

        .error-message {
            color: var(--accent-danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 3;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: floatParticle 20s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Stars Background -->
    <div class="stars" id="stars"></div>
    
    <!-- Nebula Effect -->
    <div class="nebula"></div>
    
    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="ph ph-sign-in"></i>
                </div>
                <h1 class="login-title">Masuk ke Sistem</h1>
                <p class="login-subtitle">Silakan masuk untuk mengelola tugas PKL Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="ph ph-envelope"></i>
                        Alamat Email
                    </label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="ph ph-at"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="form-input" placeholder="masukkan@email.anda" required>
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="ph ph-warning-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="ph ph-lock"></i>
                        Kata Sandi
                    </label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="ph ph-key"></i>
                        </div>
                        <input type="password" id="password" name="password" 
                               class="form-input" placeholder="Masukkan kata sandi" required>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="ph ph-warning-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="remember-group">
                    <input type="checkbox" name="remember" id="remember" class="remember-checkbox">
                    <label for="remember" class="remember-label">Ingatkan Saya</label>
                </div>

                <button type="submit" class="login-button">
                    <i class="ph ph-sign-in"></i>
                    Masuk ke Akun
                </button>
            </form>
        </div>
    </div>

    <script>
        // Create stars
        const starsContainer = document.getElementById('stars');
        const starCount = 150;

        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            
            // Random properties
            const size = Math.random() * 2 + 1;
            const left = Math.random() * 100;
            const top = Math.random() * 100;
            const duration = Math.random() * 4 + 2;
            const delay = Math.random() * 5;
            
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.left = `${left}%`;
            star.style.top = `${top}%`;
            star.style.setProperty('--duration', `${duration}s`);
            star.style.setProperty('--delay', `-${delay}s`);
            
            starsContainer.appendChild(star);
        }

        // Create floating particles
        const particlesContainer = document.getElementById('particles');
        const particleCount = 20;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random properties
            const size = Math.random() * 3 + 1;
            const left = Math.random() * 100;
            const duration = Math.random() * 10 + 10;
            const delay = Math.random() * 20;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${left}%`;
            particle.style.animationDuration = `${duration}s`;
            particle.style.animationDelay = `-${delay}s`;
            
            particlesContainer.appendChild(particle);
        }

        // Add focus effects to form inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>