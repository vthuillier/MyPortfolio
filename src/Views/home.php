<?php require_once __DIR__ . '/layout/header.php'; ?>

<!-- Hero Section -->
<section class="relative pt-48 pb-32 px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex flex-col items-center md:items-start text-center md:text-left">
            <div
                class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-yellow-400/10 border border-yellow-400/20 text-yellow-400 text-[10px] font-black uppercase tracking-[0.2em] mb-8">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full <?php echo ($settings['is_available'] ?? '1') === '1' ? 'bg-green-400' : 'bg-red-400'; ?> opacity-75"></span>
                    <span
                        class="relative inline-flex rounded-full h-2 w-2 <?php echo ($settings['is_available'] ?? '1') === '1' ? 'bg-green-500' : 'bg-red-500'; ?>"></span>
                </span>
                <span><?php echo ($settings['is_available'] ?? '1') === '1' ? 'Unité prête pour intervention' : 'En cours d\'opération'; ?></span>
            </div>

            <h1
                class="text-6xl md:text-9xl font-black mb-8 tracking-tighter uppercase leading-[0.8] mix-blend-difference">
                <?php echo str_replace(' ', '<br>', strtoupper($settings['user_name'] ?? 'VALENTIN THUILLIER')); ?>
            </h1>

            <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8 mb-12">
                <p class="text-xl text-stone-400 font-medium tracking-tight">
                    <?php echo $settings['user_job'] ?? 'Développeur DevOps & Sapeur-Pompier'; ?>
                </p>
                <div class="hidden md:block w-12 h-px bg-stone-800"></div>
                <p class="text-stone-500 max-w-lg italic">
                    "<?php echo $settings['site_bio'] ?? ''; ?>"
                </p>
            </div>

            <div class="flex flex-wrap gap-4">
                <a href="#projects"
                    class="accent-bg-yellow text-black px-10 py-5 rounded-sm font-black uppercase tracking-widest hover:bg-white transition duration-300">Voir
                    les missions</a>
                <a href="<?php echo $settings['social_cv'] ?? '#'; ?>"
                    class="px-10 py-5 border border-stone-800 text-white rounded-sm font-black uppercase tracking-widest hover:border-red-600 hover:text-red-500 transition duration-300">Consulter
                    le dossier (CV)</a>
            </div>
        </div>
    </div>

    <!-- Decorative industrial lines -->
    <div class="absolute top-1/2 right-0 -translate-y-1/2 hidden lg:block opacity-10">
        <div class="flex flex-col space-y-2 translate-x-12 rotate-[-45deg]">
            <?php for ($i = 0; $i < 10; $i++): ?>
                <div class="h-8 w-[1000px] bg-yellow-400"></div>
                <div class="h-8 w-[1000px] bg-black"></div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-32 relative bg-[#0c0a09]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="aspect-square bg-stone-900 rounded-lg overflow-hidden border border-stone-800 group">
                    <img src="<?php echo !empty($settings['hero_image']) ? $settings['hero_image'] : 'https://images.unsplash.com/photo-1516733725897-1aa73b87c8e8?w=800'; ?>"
                        class="w-full h-full object-cover grayscale brightness-75 group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-red-600/10 mix-blend-overlay"></div>
                </div>
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-yellow-400/10 rounded-full blur-[80px]"></div>
            </div>

            <div class="space-y-10">
                <div class="flex flex-col space-y-2">
                    <span class="text-red-600 text-xs font-black uppercase tracking-[0.3em]">Code Rouge /
                        Engagement</span>
                    <h2 class="text-5xl font-black tracking-tighter uppercase leading-none">Valeurs &<br><span
                            class="text-yellow-400">Compétences</span></h2>
                </div>
                <div class="text-lg text-stone-400 leading-relaxed font-light">
                    <?php echo nl2br(htmlspecialchars($settings['about_text'] ?? '')); ?>
                </div>
                <div class="grid grid-cols-2 gap-8 border-t border-stone-800 pt-10">
                    <div>
                        <div class="text-yellow-400 font-black text-2xl tracking-tighter uppercase">Infrastructure</div>
                        <div class="text-stone-500 text-xs font-bold uppercase tracking-wider mt-1">Automatisation
                            (CI/CD)</div>
                    </div>
                    <div>
                        <div class="text-red-500 font-black text-2xl tracking-tighter uppercase">Secours</div>
                        <div class="text-stone-500 text-xs font-bold uppercase tracking-wider mt-1">Gestion de crise &
                            Réponse</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-32 bg-[#080706] border-y border-stone-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col mb-20">
            <span class="text-stone-500 text-xs font-black uppercase tracking-[0.3em] mb-4">Rapport
                d'intervention</span>
            <h3 class="text-4xl font-black uppercase tracking-tighter">Projets Sélectionnés</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($projects as $project): ?>
                <div
                    class="group relative bg-[#0c0a09] border border-stone-800 p-1 hover:border-yellow-400/50 transition duration-500">
                    <div
                        class="aspect-video overflow-hidden relative grayscale group-hover:grayscale-0 transition duration-700">
                        <img src="<?php echo $project['image_url'] ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800'; ?>"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-stone-950/40"></div>
                    </div>
                    <div class="p-8 space-y-4">
                        <div class="flex justify-between items-start">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-red-500"><?php echo htmlspecialchars($project['category']); ?></span>
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        </div>
                        <h4 class="text-2xl font-black tracking-tighter uppercase group-hover:text-yellow-400 transition">
                            <?php echo htmlspecialchars($project['title']); ?></h4>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-2">
                            <?php echo htmlspecialchars($project['description']); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($project['project_link']); ?>" target="_blank"
                            class="flex items-center text-[10px] font-black uppercase tracking-[0.3em] text-white pt-4 group-hover:text-yellow-400 transition">
                            Ouvrir le dossier
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-32 relative bg-[#0c0a09]">
    <div class="max-w-4xl mx-auto px-6">
        <div class="glass-card p-12 lg:p-20 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-yellow-400"></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h3 class="text-4xl font-black uppercase tracking-tighter mb-6">Contact d'urgence</h3>
                    <p class="text-stone-400 mb-10 leading-relaxed font-light">
                        Pour toute demande de collaboration ou intervention technique, utilisez le formulaire sécurisé
                        ci-contre.
                    </p>
                    <div class="space-y-4">
                        <div
                            class="flex items-center space-x-4 text-xs font-bold uppercase tracking-widest text-stone-500">
                            <span class="text-yellow-400">LOC</span>
                            <span>Lille / Nord / France</span>
                        </div>
                        <div
                            class="flex items-center space-x-4 text-xs font-bold uppercase tracking-widest text-stone-500">
                            <span class="text-red-500">STA</span>
                            <span class="text-green-500">Opérationnel</span>
                        </div>
                    </div>
                </div>

                <form action="/contact" method="POST" class="space-y-6">
                    <?php if (isset($_GET['success'])): ?>
                        <div
                            class="bg-yellow-400 text-black px-6 py-4 font-black uppercase tracking-tighter text-sm mb-6 animate-pulse">
                            Message envoyé / Transmission OK</div>
                    <?php endif; ?>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Identité</label>
                        <input type="text" name="name" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700"
                            placeholder="VOTRE NOM">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Canal de
                            réponse</label>
                        <input type="email" name="email" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700"
                            placeholder="VOTRE@EMAIL.COM">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Détails de
                            la mission</label>
                        <textarea name="message" rows="4" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700"
                            placeholder="VOTRE MESSAGE..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-red-600 text-white py-5 font-black uppercase tracking-[0.2em] text-xs hover:bg-white hover:text-black transition duration-300">Lancer
                        l'alerte (Envoyer)</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layout/footer.php'; ?>