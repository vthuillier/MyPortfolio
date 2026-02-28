<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Accès Sécurisé</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0c0a09;
            color: #f5f5f4;
        }

        .glass-card {
            background: rgba(28, 25, 23, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(250, 204, 21, 0.1);
        }

        .accent-bg-yellow {
            background-color: #facc15;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6">
    <div class="fixed inset-0 opacity-5 pointer-events-none"
        style="background-image: repeating-linear-gradient(-45deg, #facc15, #facc15 40px, transparent 40px, transparent 80px);">
    </div>

    <div class="max-w-md w-full p-10 glass-card rounded-sm relative">
        <div class="absolute top-0 left-0 w-full h-1 accent-bg-yellow"></div>
        <div class="text-center mb-10">
            <h1 class="text-2xl font-black uppercase tracking-[0.2em] text-white">Base Admin</h1>
            <p class="text-stone-500 text-[10px] font-bold uppercase tracking-widest mt-2">Authentification requise pour
                intervention</p>
        </div>

        <?php if (isset($error)): ?>
            <div
                class="bg-red-600/10 border border-red-600/20 text-red-500 p-4 rounded-sm mb-6 text-xs font-bold uppercase tracking-wider text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-6">
            <?php echo \App\Helpers\Csrf::field(); ?>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Opérateur</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 rounded-sm focus:border-yellow-400 outline-none transition text-white text-sm">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Code
                    d'accès</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 rounded-sm focus:border-yellow-400 outline-none transition text-white text-sm">
            </div>
            <button type="submit"
                class="w-full accent-bg-yellow text-black py-4 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">Déverrouiller
                le système</button>
        </form>
    </div>
</body>

</html>