<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <span class="text-xl font-bold text-slate-900">Admin Panel</span>
                <div class="flex items-center space-x-4">
                    <a href="/" target="_blank" class="text-sm font-medium text-slate-500 hover:text-slate-900">Voir le
                        site</a>
                    <a href="/logout"
                        class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-800 transition">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Projects Section -->
            <div class="lg:col-span-2 space-y-8">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Mes Projets</h2>
                    <a href="/admin/project/create"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-indigo-700 transition flex items-center shadow-lg shadow-indigo-100">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Ajouter un projet
                    </a>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Image</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Titre</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Catégorie</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($projects as $project): ?>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="<?php echo $project['image_url'] ?: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=100'; ?>"
                                            class="w-12 h-12 rounded-lg object-cover">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-slate-900">
                                            <?php echo htmlspecialchars($project['title']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 uppercase tracking-tighter">
                                            <?php echo htmlspecialchars($project['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="/admin/project/edit?id=<?php echo $project['id']; ?>"
                                            class="inline-block p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.242 19.142l3.858-3.858a2 2 0 000-2.828l-3.858-3.858a2 2 0 00-2.828 0l-3.858 3.858a2 2 0 000 2.828l3.858 3.858a2 2 0 002.828 0z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="/admin/project/delete?id=<?php echo $project['id']; ?>"
                                            onclick="return confirm('Confirmer la suppression ?')"
                                            class="inline-block p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="space-y-8">
                <h2 class="text-2xl font-bold">Base de Données Perso</h2>
                <form action="/admin/settings" method="POST" class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Nom Complet</label>
                        <input type="text" name="user_name" value="<?php echo htmlspecialchars($settings['user_name'] ?? ''); ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Métier / Titre</label>
                        <input type="text" name="user_job" value="<?php echo htmlspecialchars($settings['user_job'] ?? ''); ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Statut d'Intervention</label>
                        <select name="is_available" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition">
                            <option value="1" <?php echo ($settings['is_available'] ?? '1') === '1' ? 'selected' : ''; ?>>Disponible (Prêt)</option>
                            <option value="0" <?php echo ($settings['is_available'] ?? '0') === '0' ? 'selected' : ''; ?>>Occupé (En mission)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Bio courte (Hero)</label>
                        <textarea name="site_bio" rows="2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition"><?php echo htmlspecialchars($settings['site_bio'] ?? ''); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Rapport détaillé (À propos)</label>
                        <textarea name="about_text" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition"><?php echo htmlspecialchars($settings['about_text'] ?? ''); ?></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">LinkedIn</label>
                            <input type="text" name="social_linkedin" value="<?php echo htmlspecialchars($settings['social_linkedin'] ?? ''); ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">GitHub</label>
                            <input type="text" name="social_github" value="<?php echo htmlspecialchars($settings['social_github'] ?? ''); ?>" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-yellow-400 transition">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-yellow-400 hover:text-black transition">Mise à jour blindée</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>