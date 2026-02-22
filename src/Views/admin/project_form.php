<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Manifest - Valentin Thuillier</title>
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
                <?php echo $action === 'create' ? 'Initiate New Mission' : 'Update Deployment Log'; ?>
            </h1>

            <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Designation
                                Name (FR)</label>
                            <input type="text" name="title"
                                value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Designation
                                Name (EN)</label>
                            <input type="text" name="title_en"
                                value="<?php echo htmlspecialchars($project['title_en'] ?? ''); ?>"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Service
                            Class (Category)</label>
                        <input type="text" name="category"
                            value="<?php echo htmlspecialchars($project['category'] ?? ''); ?>" required
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Mission
                            Objective (FR)</label>
                        <textarea name="description" rows="4" required
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Mission
                            Objective (EN)</label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($project['description_en'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Base URL /
                        Repository</label>
                    <input type="text" name="project_link"
                        value="<?php echo htmlspecialchars($project['project_link'] ?? ''); ?>" placeholder="https://"
                        class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Visual Recon
                        (Image)</label>
                    <?php if (isset($project['image_url']) && $project['image_url']): ?>
                        <div class="mb-4">
                            <img src="<?php echo (strpos($project['image_url'], 'http') === 0) ? $project['image_url'] : '/' . $project['image_url']; ?>"
                                class="h-32 rounded-sm border border-stone-800">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" <?php echo $action === 'create' ? 'required' : ''; ?>
                        class="w-full text-xs text-stone-500 file:mr-4 file:py-3 file:px-6 file:rounded-sm file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-stone-800 file:text-white hover:file:bg-stone-700 cursor-pointer">
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full accent-bg-yellow text-black py-5 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">
                        <?php echo $action === 'create' ? 'Commit to Registry' : 'Overwrite Registry Data'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>