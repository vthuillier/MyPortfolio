<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $action === 'create' ? 'Nouvelle Compétence' : 'Modifier Compétence'; ?> - Admin
    </title>
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
    </style>
</head>

<body class="min-h-screen py-16 px-6">
    <div class="max-w-2xl mx-auto">
        <a href="/admin"
            class="text-stone-500 hover:text-yellow-400 text-xs font-black uppercase tracking-widest mb-8 inline-block">←
            Back to Dashboard</a>

        <h2 class="text-4xl font-black uppercase tracking-tighter mb-12">
            <?php echo $action === 'create' ? 'Add Skill' : 'Edit Skill'; ?>
        </h2>

        <form action="" method="POST" class="glass-card p-8 rounded-sm space-y-6">
            <?php echo \App\Helpers\Csrf::field(); ?>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Catégorie
                        (FR)</label>
                    <input type="text" name="category" required
                        value="<?php echo htmlspecialchars($skill['category'] ?? ''); ?>"
                        class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Category
                        (EN)</label>
                    <input type="text" name="category_en" required
                        value="<?php echo htmlspecialchars($skill['category_en'] ?? ''); ?>"
                        class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-sm">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Skill Name</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($skill['name'] ?? ''); ?>"
                    class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-sm">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Level
                        (%)</label>
                    <input type="number" name="level" required min="0" max="100"
                        value="<?php echo htmlspecialchars($skill['level'] ?? '80'); ?>"
                        class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Order
                        Index</label>
                    <input type="number" name="order_index"
                        value="<?php echo htmlspecialchars($skill['order_index'] ?? '0'); ?>"
                        class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-sm">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 text-black py-4 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">
                <?php echo $action === 'create' ? 'Activate Entry' : 'Update Manifest'; ?>
            </button>
        </form>
    </div>
</body>

</html>