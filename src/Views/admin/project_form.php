<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $action === 'create' ? 'Ajouter un projet' : 'Modifier le projet'; ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 py-20">
        <div class="mb-10 flex items-center justify-between">
            <h1 class="text-3xl font-bold">
                <?php echo $action === 'create' ? 'Nouveau Projet' : 'Édition : ' . htmlspecialchars($project['title']); ?>
            </h1>
            <a href="/admin" class="text-slate-500 hover:text-slate-900 font-medium">← Retour au dashboard</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data"
            class="bg-white p-10 rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Titre du projet</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>"
                        required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie</label>
                    <input type="text" name="category" placeholder="Web Design, PHP, Mobile..."
                        value="<?php echo htmlspecialchars($project['category'] ?? ''); ?>" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="5" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Lien du projet (URL)</label>
                <input type="url" name="project_link"
                    value="<?php echo htmlspecialchars($project['project_link'] ?? ''); ?>"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Image du projet</label>
                <div class="mt-2 flex items-center space-x-6">
                    <?php if (!empty($project['image_url'])): ?>
                        <div class="shrink-0">
                            <img class="h-20 w-20 object-cover rounded-xl" src="<?php echo $project['image_url']; ?>"
                                alt="Current image">
                        </div>
                    <?php endif; ?>
                    <label class="block cursor-pointer">
                        <span class="sr-only">Choisir un fichier</span>
                        <input type="file" name="image" <?php echo $action === 'create' ? 'required' : ''; ?>
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full
                        file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100">
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    <?php echo $action === 'create' ? 'Créer le projet' : 'Mettre à jour'; ?>
                </button>
            </div>
        </form>
    </div>
</body>

</html>