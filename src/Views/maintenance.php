<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - System Offline</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@900&family=JetBrains+Mono&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0c0a09;
            color: #f5f5f4;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6">
    <div class="max-w-2xl w-full border border-stone-800 p-12 bg-[#0c0a09] relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <svg class="w-32 h-32 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
            </svg>
        </div>

        <div class="relative z-10">
            <span class="text-yellow-400 text-xs font-black uppercase tracking-[0.4em] mb-4 block">System_Status:
                OFFLINE</span>
            <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none mb-8">
                UNDER_<br><span class="text-stone-700">MAINTENANCE</span>
            </h1>
            <p class="text-stone-500 font-mono text-sm leading-relaxed mb-12">
                // System is currently undergoing scheduled optimization and database synchronization.
                // Estimated time to recovery: Unknown.
            </p>

            <div class="flex items-center space-x-4">
                <div class="w-2 h-2 bg-red-600 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-black uppercase tracking-widest text-stone-600">Restricted access mode
                    active</span>
            </div>
        </div>

        <div class="mt-20 pt-8 border-t border-stone-900 flex justify-between items-center">
            <span class="text-[10px] text-stone-700 font-mono uppercase tracking-widest">Protocol: 0x82C2</span>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/admin"
                    class="text-[10px] text-yellow-400 font-black uppercase tracking-widest hover:text-white transition">Back
                    to Control Center</a>
            <?php else: ?>
                <a href="/login"
                    class="text-[10px] text-stone-800 font-black uppercase tracking-widest hover:text-stone-500 transition">Admin
                    Access</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>