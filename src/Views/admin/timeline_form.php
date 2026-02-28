<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Entry - Valentin Thuillier</title>
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

<body class="min-h-screen py-20 px-6">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center space-x-4 mb-12">
            <a href="/admin"
                class="text-stone-500 hover:text-white transition text-[10px] font-black uppercase tracking-widest flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Abort & Return
            </a>
        </div>

        <div class="glass-card p-12 rounded-sm border border-stone-800">
            <div class="absolute top-0 left-0 w-full h-1 accent-bg-yellow"></div>
            <h1 class="text-4xl font-black uppercase tracking-tighter mb-10">
                <?php echo $action === 'create' ? 'Add Timeline Entry' : 'Edit Timeline Entry'; ?>
            </h1>

            <form action="" method="POST" class="space-y-8">
                <?php echo \App\Helpers\Csrf::field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Type</label>
                        <select name="type" required
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm appearance-none">
                            <option value="experience" <?php echo ($item['type'] ?? '') === 'experience' ? 'selected' : ''; ?>>Experience</option>
                            <option value="education" <?php echo ($item['type'] ?? '') === 'education' ? 'selected' : ''; ?>>Education</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Order
                            Index</label>
                        <input type="number" name="order_index"
                            value="<?php echo htmlspecialchars($item['order_index'] ?? '0'); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Title
                            (FR)</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>"
                            required
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Title
                            (EN)</label>
                        <input type="text" name="title_en"
                            value="<?php echo htmlspecialchars($item['title_en'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Organization
                            (FR)</label>
                        <input type="text" name="organization"
                            value="<?php echo htmlspecialchars($item['organization'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Organization
                            (EN)</label>
                        <input type="text" name="organization_en"
                            value="<?php echo htmlspecialchars($item['organization_en'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Period
                            (FR)</label>
                        <input type="text" name="period" value="<?php echo htmlspecialchars($item['period'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Period
                            (EN)</label>
                        <input type="text" name="period_en"
                            value="<?php echo htmlspecialchars($item['period_en'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Description
                            (FR)</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Description
                            (EN)</label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($item['description_en'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full accent-bg-yellow text-black py-5 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">
                        <?php echo $action === 'create' ? 'Save Entry' : 'Update Entry'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>