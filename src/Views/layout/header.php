<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $settings['site_title'] ?? 'Valentin Thuillier'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0c0a09;
            color: #f5f5f4;
        }

        .glass-nav {
            background: rgba(12, 10, 9, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(250, 204, 21, 0.1);
        }

        .glass-card {
            background: rgba(28, 25, 23, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(250, 204, 21, 0.1);
        }

        .yellow-glow {
            background: radial-gradient(circle at 50% -20%, rgba(250, 204, 21, 0.12), transparent 70%);
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
            background-color: #facc15;
        }

        .selection-yellow ::selection {
            background: #facc15;
            color: #000;
        }
    </style>
</head>

<body class="selection:bg-yellow-400/30 selection:text-yellow-900 overflow-x-hidden">
    <div class="fixed inset-0 yellow-glow pointer-events-none z-0"></div>
    <nav class="fixed w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div
                        class="w-8 h-8 accent-bg-yellow rounded-lg flex items-center justify-center font-black text-black transform group-hover:rotate-12 transition">
                        V</div>
                    <span
                        class="text-xl font-bold tracking-tight text-white"><?php echo $settings['user_name'] ?? 'Portfolio'; ?></span>
                </a>
                <div class="hidden md:flex space-x-10">
                    <a href="#about"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors">Stratégie</a>
                    <a href="#projects"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors">Interventions</a>
                    <a href="#contact"
                        class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-yellow-400 transition-colors">Contact</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/login"
                        class="px-4 py-2 border border-stone-800 rounded-lg text-[10px] font-black uppercase tracking-widest text-stone-500 hover:border-yellow-400/50 hover:text-yellow-400 transition">Base
                        Admin</a>
                </div>
            </div>
        </div>
    </nav>