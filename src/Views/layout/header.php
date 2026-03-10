<!DOCTYPE html>
<html lang="<?php echo \App\Helpers\Language::getCurrent(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $currentLang = \App\Helpers\Language::getCurrent();
    $isEn = $currentLang === 'en';
    $metaDesc = $isEn ? ($settings['meta_description_en'] ?? $settings['meta_description'] ?? '') : ($settings['meta_description'] ?? '');
    ?>
    <title><?php echo $settings['site_title'] ?? 'Valentin Thuillier'; ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDesc); ?>">

    <!-- Open Graph -->
    <meta property="og:title"
        content="<?php echo htmlspecialchars($settings['site_title'] ?? 'Valentin Thuillier'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDesc); ?>">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <?php if (!empty($settings['favicon'])): ?>
        <link rel="icon" type="image/<?php echo pathinfo($settings['favicon'], PATHINFO_EXTENSION); ?>"
            href="/<?php echo $settings['favicon']; ?>">
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --accent: #facc15;
            --accent-glow: rgba(250, 204, 21, 0.12);
            --bg: #0c0a09;
            --text: #f5f5f4;
            --card-border: rgba(250, 204, 21, 0.1);
        }

        body.emergency-mode {
            --accent: #ef4444;
            --accent-glow: rgba(239, 68, 68, 0.2);
            --card-border: rgba(239, 68, 68, 0.3);
            animation: pulse-red 4s infinite;
        }

        @keyframes pulse-red {

            0%,
            100% {
                background-color: #0c0a09;
            }

            50% {
                background-color: #2a0a0a;
            }
        }

        /* Glitch Effect */
        .glitch-text {
            position: relative;
        }

        body.emergency-mode .glitch-text::before,
        body.emergency-mode .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0c0a09;
        }

        body.emergency-mode .glitch-text::before {
            left: 2px;
            text-shadow: -2px 0 #ff0000;
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim 5l infinite linear alternate-reverse;
        }

        body.emergency-mode .glitch-text::after {
            left: -2px;
            text-shadow: -2px 0 #00fff9;
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim2 5s infinite linear alternate-reverse;
        }

        @keyframes glitch-anim {
            0% {
                clip: rect(31px, 9999px, 94px, 0);
            }

            20% {
                clip: rect(62px, 9999px, 42px, 0);
            }

            40% {
                clip: rect(10px, 9999px, 51px, 0);
            }

            60% {
                clip: rect(82px, 9999px, 12px, 0);
            }

            80% {
                clip: rect(41px, 9999px, 75px, 0);
            }

            100% {
                clip: rect(54px, 9999px, 7px, 0);
            }
        }

        @keyframes glitch-anim2 {
            0% {
                clip: rect(65px, 9999px, 100px, 0);
            }

            20% {
                clip: rect(12px, 9999px, 20px, 0);
            }

            40% {
                clip: rect(43px, 9999px, 88px, 0);
            }

            60% {
                clip: rect(98px, 9999px, 40px, 0);
            }

            80% {
                clip: rect(10px, 9999px, 60px, 0);
            }

            100% {
                clip: rect(55px, 9999px, 80px, 0);
            }
        }

        /* CRT Flicker */
        body.emergency-mode::after {
            content: " ";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(18, 16, 16, 0.1);
            opacity: 0;
            z-index: 101;
            pointer-events: none;
            animation: flicker 0.15s infinite;
        }

        @keyframes flicker {
            0% {
                opacity: 0.27;
            }

            5% {
                opacity: 0.34;
            }

            10% {
                opacity: 0.23;
            }

            15% {
                opacity: 0.90;
            }

            20% {
                opacity: 0.18;
            }

            25% {
                opacity: 0.83;
            }

            30% {
                opacity: 0.65;
            }

            35% {
                opacity: 0.57;
            }

            40% {
                opacity: 0.26;
            }

            45% {
                opacity: 0.84;
            }

            50% {
                opacity: 0.96;
            }

            55% {
                opacity: 0.08;
            }

            60% {
                opacity: 0.20;
            }

            65% {
                opacity: 0.71;
            }

            70% {
                opacity: 0.53;
            }

            75% {
                opacity: 0.37;
            }

            80% {
                opacity: 0.71;
            }

            85% {
                opacity: 0.70;
            }

            90% {
                opacity: 0.70;
            }

            95% {
                opacity: 0.36;
            }

            100% {
                opacity: 0.24;
            }
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: background-color 0.5s ease;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .glass-nav {
            background: rgba(12, 10, 9, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            transition: border-color 0.5s ease;
        }

        .glass-card {
            background: rgba(28, 25, 23, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--card-border);
            transition: border-color 0.5s ease;
        }

        .yellow-glow {
            background: radial-gradient(circle at 50% -20%, var(--accent-glow), transparent 70%);
            transition: background 0.5s ease;
        }

        .pompier-red {
            color: #ef4444;
        }

        .pompier-bg-red {
            background-color: #ef4444;
        }

        .accent-yellow {
            color: #facc15;
        }

        .accent-bg-yellow {
            background-color: var(--accent);
            transition: background-color 0.5s ease;
        }

        .selection-yellow ::selection {
            background: var(--accent);
            color: #000;
        }

        /* Scanline effect for emergency mode */
        body.emergency-mode::before {
            content: " ";
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 255, 0, 0.06));
            z-index: 100;
            background-size: 100% 2px, 3px 100%;
            pointer-events: none;
            opacity: 0.3;
        }

        .emergency-btn {
            position: relative;
            overflow: hidden;
        }

        .emergency-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .emergency-btn:hover::after {
            left: 100%;
        }
    </style>

    <?php if (!empty($settings['analytics_script'])): ?>
        <?php echo $settings['analytics_script']; ?>
    <?php endif; ?>
</head>

<body class="selection:bg-yellow-400/30 selection:text-yellow-900 overflow-x-hidden">
    <div class="fixed inset-0 yellow-glow pointer-events-none z-0"></div>

    <!-- Big Warning Overlay (Hidden by default) -->
    <div id="emergency-overlay"
        class="fixed inset-0 z-[100] pointer-events-none flex items-center justify-center opacity-0 transition-opacity duration-1000">
        <div class="absolute inset-0 bg-red-900/10"></div>
        <div class="text-[20vw] font-black text-red-600/5 select-none uppercase tracking-tighter rotate-[-15deg]">DANGER
        </div>
        <div class="absolute bottom-10 right-10 text-red-600/20 font-mono text-xs space-y-1">
            <div>LOCAL_OVERRIDE: ENABLED</div>
            <div>STRIKE_PROTOCOL: ACTIVE</div>
            <div>STATUS: CRITICAL</div>
        </div>
    </div>
    <nav class="fixed w-full z-50 glass-nav">
        <!-- Emergency Alert Bar (Hidden by default) -->
        <div id="emergency-alert"
            class="bg-red-600 text-white text-[9px] font-black uppercase tracking-[0.4em] py-1 text-center hidden animate-pulse">
            CRITICAL SYSTEM OVERRIDE // INTERVENTION MODE ACTIVE
        </div>
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 accent-bg-yellow rounded-lg flex items-center justify-center font-black text-black transform group-hover:rotate-12 transition duration-500 shadow-lg shadow-yellow-400/20">
                        V</div>
                    <div>
                        <span
                            class="text-xl font-black tracking-tighter text-white block leading-none"><?php echo $settings['user_name'] ?? 'Portfolio'; ?></span>
                        <span id="system-status-tag"
                            class="text-[8px] font-bold tracking-[0.2em] text-yellow-400 uppercase">System: Ready</span>
                    </div>
                </a>
                <div class="hidden md:flex space-x-10">
                    <a href="/#about"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors"><?php echo \App\Helpers\Language::get('nav_strategy'); ?></a>
                    <a href="/#projects"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors"><?php echo \App\Helpers\Language::get('nav_interventions'); ?></a>
                    <a href="/blog"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors">Dev_Log</a>
                    <a href="/#contact"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors"><?php echo \App\Helpers\Language::get('nav_contact'); ?></a>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2 border-r border-stone-800 pr-6">
                        <a href="?lang=fr"
                            class="text-[10px] font-black uppercase tracking-widest <?php echo \App\Helpers\Language::getCurrent() === 'fr' ? 'text-yellow-400 font-black' : 'text-stone-600 hover:text-stone-400'; ?> transition">FR</a>
                        <span class="text-stone-800">/</span>
                        <a href="?lang=en"
                            class="text-[10px] font-black uppercase tracking-widest <?php echo \App\Helpers\Language::getCurrent() === 'en' ? 'text-yellow-400 font-black' : 'text-stone-600 hover:text-stone-400'; ?> transition">EN</a>
                    </div>
                    <a href="/login"
                        class="px-4 py-2 border border-stone-800 rounded-lg text-[10px] font-black uppercase tracking-widest text-stone-500 hover:border-yellow-400/50 hover:text-yellow-400 transition"><?php echo \App\Helpers\Language::get('nav_admin'); ?></a>

                    <!-- Emergency Button -->
                    <button id="panic-button"
                        class="emergency-btn group relative flex items-center justify-center w-10 h-10 border border-red-900/50 rounded-lg hover:border-red-500 transition-all duration-500 overflow-hidden"
                        title="TOGGLE EMERGENCY MODE">
                        <div class="absolute inset-0 bg-red-600/10 group-hover:bg-red-600/20 transition-colors"></div>
                        <svg class="w-5 h-5 text-red-600 group-hover:scale-110 transition-transform" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const panicBtn = document.getElementById('panic-button');
            const alertBar = document.getElementById('emergency-alert');
            const statusTag = document.getElementById('system-status-tag');

            // Check session storage
            if (sessionStorage.getItem('emergencyMode') === 'true') {
                enableEmergencyMode(false);
            }

            panicBtn.addEventListener('click', () => {
                const isActive = !document.body.classList.contains('emergency-mode');
                sessionStorage.setItem('emergencyMode', isActive);

                if (isActive) {
                    enableEmergencyMode(true);
                } else {
                    disableEmergencyMode();
                }
            });

            function enableEmergencyMode(animate) {
                document.body.classList.add('emergency-mode');
                alertBar.classList.remove('hidden');
                statusTag.textContent = 'System: Intervention';
                statusTag.classList.replace('text-yellow-400', 'text-red-500');

                if (animate) {
                    // GSAP Effects
                    const tl = gsap.timeline();

                    // Flash
                    tl.to("body", { backgroundColor: "#ef4444", duration: 0.05, yoyo: true, repeat: 5 })
                        .to("body", { backgroundColor: "#1a0a0a", duration: 0.5 });

                    // Shake
                    gsap.fromTo("body",
                        { x: -10 },
                        { x: 10, duration: 0.08, repeat: 10, yoyo: true, ease: "none", clearProps: "x" }
                    );

                    // Show Overlay
                    gsap.to("#emergency-overlay", { opacity: 1, duration: 2 });
                } else {
                    document.getElementById('emergency-overlay').style.opacity = '1';
                }
            }

            function disableEmergencyMode() {
                document.body.classList.remove('emergency-mode');
                alertBar.classList.add('hidden');
                statusTag.textContent = 'System: Ready';
                statusTag.classList.replace('text-red-500', 'text-yellow-400');
                gsap.to("#emergency-overlay", { opacity: 0, duration: 0.5 });
            }
        });
    </script>