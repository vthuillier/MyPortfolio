<?php require_once __DIR__ . '/layout/header.php';
$isEn = \App\Helpers\Language::getCurrent() === 'en';
?>

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
                <span>SYSTEM STATUS:
                    <?php echo ($settings['is_available'] ?? '1') === '1' ? \App\Helpers\Language::get('status_ready') : \App\Helpers\Language::get('status_busy'); ?></span>
            </div>

            <h1 class="glitch-text text-6xl md:text-9xl font-black mb-8 tracking-tighter uppercase leading-[0.8] mix-blend-difference"
                data-text="<?php echo strtoupper($settings['user_name'] ?? 'VALENTIN THUILLIER'); ?>">
                <?php echo str_replace(' ', '<br>', strtoupper($settings['user_name'] ?? 'VALENTIN THUILLIER')); ?>
            </h1>

            <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8 mb-12">
                <p class="text-xl text-stone-400 font-medium tracking-tight">
                    <?php echo $isEn ? ($settings['user_job_en'] ?? $settings['user_job']) : $settings['user_job']; ?>
                </p>
                <div class="hidden md:block w-12 h-px bg-stone-800"></div>
                <p class="text-stone-500 max-w-lg italic font-mono text-sm">
                    //
                    "<?php echo $isEn ? ($settings['site_bio_en'] ?? $settings['site_bio']) : $settings['site_bio']; ?>"
                </p>
            </div>

            <div class="flex flex-wrap gap-4">
                <a href="#projects"
                    class="accent-bg-yellow text-black px-10 py-5 rounded-sm font-black uppercase tracking-widest hover:bg-white transition duration-300"><?php echo \App\Helpers\Language::get('hero_browse'); ?></a>
                <a href="<?php echo $settings['social_cv'] ?? '#'; ?>"
                    class="px-10 py-5 border border-stone-800 text-white rounded-sm font-black uppercase tracking-widest hover:border-red-600 hover:text-red-500 transition duration-300"><?php echo \App\Helpers\Language::get('hero_cv'); ?></a>
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
            <div class="relative w-full">
                <!-- Terminal Window Wrapper -->
                <div
                    class="rounded-lg overflow-hidden border border-stone-800 shadow-2xl shadow-yellow-400/5 bg-[#0c0a09]">
                    <!-- Window Header -->
                    <div class="bg-stone-900/80 px-4 py-2 flex items-center justify-between border-b border-stone-800">
                        <div class="flex items-center space-x-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500/20 border border-red-500/40"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/20 border border-yellow-500/40"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500/20 border border-green-500/40"></div>
                        </div>
                        <div class="text-[9px] font-bold text-stone-600 uppercase tracking-widest mono">V-SHELL //
                            PORTFOLIO_CMD</div>
                        <div class="w-10"></div>
                    </div>

                    <!-- Terminal Content -->
                    <div id="v-terminal"
                        class="h-[450px] bg-black/80 overflow-auto p-6 font-mono text-[11px] text-stone-300 relative group cursor-text scrollbar-thin scrollbar-thumb-stone-800">
                        <div class="terminal-output mb-4"></div>
                        <div class="flex items-center space-x-2">
                            <span class="terminal-prefix text-yellow-400 font-bold">visitor@valentin:~$</span>
                            <input type="text" class="bg-transparent border-none outline-none flex-1 text-white"
                                autofocus>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-48 h-48 bg-yellow-400/5 rounded-full blur-[80px] pointer-events-none -z-10">
                </div>
            </div>

            <script src="/assets/js/terminal.js"></script>

            <div class="space-y-10">
                <div class="flex flex-col space-y-2">
                    <span class="text-red-600 text-xs font-black uppercase tracking-[0.3em]">Core Profile /
                        Engineering</span>
                    <h2 class="text-5xl font-black tracking-tighter uppercase leading-none">
                        <?php echo \App\Helpers\Language::get('about_title'); ?><br><span
                            class="text-yellow-400"><?php echo \App\Helpers\Language::get('about_intervention'); ?></span>
                    </h2>
                </div>
                <div class="text-lg text-stone-400 leading-relaxed font-light">
                    <?php echo nl2br(htmlspecialchars($isEn ? ($settings['about_text_en'] ?? $settings['about_text']) : $settings['about_text'])); ?>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-stone-800 pt-10 font-mono">
                    <div
                        class="p-6 border border-stone-800 hover:border-yellow-400/30 transition shadow-2xl shadow-yellow-400/0 hover:shadow-yellow-400/5 group">
                        <div class="text-yellow-400 font-black text-xl tracking-tighter uppercase mb-2">>
                            <?php echo htmlspecialchars($isEn ? ($settings['about_exp1_title_en'] ?? 'Automation') : ($settings['about_exp1_title'] ?? 'Automation')); ?>
                        </div>
                        <div class="text-stone-500 text-[10px] font-bold uppercase tracking-wider">
                            <?php echo htmlspecialchars($isEn ? ($settings['about_exp1_tags_en'] ?? 'CI/CD, Docker, Kubernetes, Ansible') : ($settings['about_exp1_tags'] ?? 'CI/CD, Docker, Kubernetes, Ansible')); ?>
                        </div>
                    </div>
                    <div
                        class="p-6 border border-stone-800 hover:border-red-500/30 transition shadow-2xl shadow-red-500/0 hover:shadow-red-500/5 group">
                        <div class="text-red-500 font-black text-xl tracking-tighter uppercase mb-2">>
                            <?php echo htmlspecialchars($isEn ? ($settings['about_exp2_title_en'] ?? 'Rescue Ops') : ($settings['about_exp2_title'] ?? 'Rescue Ops')); ?>
                        </div>
                        <div class="text-stone-500 text-[10px] font-bold uppercase tracking-wider">
                            <?php echo htmlspecialchars($isEn ? ($settings['about_exp2_tags_en'] ?? 'Crisis Management, Courage & Dedication') : ($settings['about_exp2_tags'] ?? 'Crisis Management, Courage & Dedication')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-32 bg-[#0c0a09] border-t border-stone-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col mb-20">
            <span class="text-yellow-500 text-xs font-black uppercase tracking-[0.3em] mb-4">Core Competencies /
                Stack</span>
            <h3 class="text-4xl font-black uppercase tracking-tighter">
                <?php echo \App\Helpers\Language::get('skills_title'); ?></h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12" data-test="true">
            <!-- DevOps -->
            <div class="space-y-8">
                <h4 class="text-xl font-black uppercase tracking-widest text-white border-l-4 border-yellow-400 pl-4">
                    DevOps & CI/CD</h4>
                <div class="space-y-6">
                    <?php
                    $devops = [
                        ['GitLab CI', 90],
                        ['Jenkins', 85],
                        ['Ansible', 80],
                        ['Docker/K8s', 75],
                        ['IaC', 80]
                    ];
                    foreach ($devops as $s): ?>
                        <div class="space-y-2">
                            <div
                                class="flex justify-between text-[10px] font-black uppercase tracking-widest text-stone-500">
                                <span><?php echo $s[0]; ?></span>
                                <span><?php echo $s[1]; ?>%</span>
                            </div>
                            <div class="h-1 bg-stone-900 w-full">
                                <div class="h-full bg-yellow-400" style="width: <?php echo $s[1]; ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Databases -->
            <div class="space-y-8">
                <h4 class="text-xl font-black uppercase tracking-widest text-white border-l-4 border-red-600 pl-4">
                    Databases & Ops</h4>
                <div class="space-y-6">
                    <?php
                    $dbs = [
                        ['PostgreSQL', 85],
                        ['MongoDB', 80],
                        ['Redis', 75],
                        ['Elasticsearch', 70],
                        ['Linux SysAdmin', 90]
                    ];
                    foreach ($dbs as $s): ?>
                        <div class="space-y-2">
                            <div
                                class="flex justify-between text-[10px] font-black uppercase tracking-widest text-stone-500">
                                <span><?php echo $s[0]; ?></span>
                                <span><?php echo $s[1]; ?>%</span>
                            </div>
                            <div class="h-1 bg-stone-900 w-full">
                                <div class="h-full bg-red-600" style="width: <?php echo $s[1]; ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Methodology -->
            <div class="space-y-8">
                <h4 class="text-xl font-black uppercase tracking-widest text-white border-l-4 border-stone-600 pl-4">
                    Philosophy</h4>
                <div class="grid grid-cols-1 gap-4">
                    <div class="p-6 bg-stone-900/50 border border-stone-800 hover:border-white/10 transition">
                        <div class="text-white font-black uppercase text-xs mb-2">
                            <?php echo $isEn ? 'Automation First' : 'Automatisation d\'abord'; ?>
                        </div>
                        <p class="text-stone-500 text-xs leading-relaxed">
                            <?php echo $isEn ? 'If it happens twice, automate it. Full lifecycle focus.' : 'Si cela arrive deux fois, automatisez-le. Focus sur le cycle de vie complet.'; ?>
                        </p>
                    </div>
                    <div class="p-6 bg-stone-900/50 border border-stone-800 hover:border-white/10 transition">
                        <div class="text-white font-black uppercase text-xs mb-2">
                            <?php echo $isEn ? 'Scalability' : 'Scalabilité'; ?>
                        </div>
                        <p class="text-stone-500 text-xs leading-relaxed">
                            <?php echo $isEn ? 'Designing for growth and handling high-pressure traffic.' : 'Concevoir pour la croissance et gérer les pics de trafic.'; ?>
                        </p>
                    </div>
                    <div class="p-6 bg-stone-900/50 border border-stone-800 hover:border-white/10 transition">
                        <div class="text-white font-black uppercase text-xs mb-2">
                            <?php echo $isEn ? 'Crisis Ready' : 'Prêt pour la crise'; ?>
                        </div>
                        <p class="text-stone-500 text-xs leading-relaxed">
                            <?php echo $isEn ? 'Quick thinking and decision making inherited from field experience.' : 'Réflexion rapide et prise de décision héritées de l\'expérience sur le terrain.'; ?>
                        </p>
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
            <span
                class="text-stone-500 text-xs font-black uppercase tracking-[0.3em] mb-4"><?php echo \App\Helpers\Language::get('projects_log'); ?></span>
            <h3 class="text-4xl font-black uppercase tracking-tighter">
                <?php echo \App\Helpers\Language::get('projects_title'); ?>
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($projects as $project): ?>
                <div
                    class="group relative bg-[#0c0a09] border border-stone-800 p-1 hover:border-yellow-400/50 transition duration-500">
                    <div
                        class="aspect-video overflow-hidden relative grayscale group-hover:grayscale-0 transition duration-700">
                        <img src="<?php
                        if (!empty($project['image_url'])) {
                            echo (strpos($project['image_url'], 'http') === 0) ? $project['image_url'] : '/' . $project['image_url'];
                        } else {
                            echo 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800';
                        }
                        ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-stone-950/40"></div>
                    </div>
                    <div class="p-8 space-y-4">
                        <div class="flex justify-between items-start">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-red-500"><?php echo htmlspecialchars($project['category']); ?></span>
                            <div class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                        </div>
                        <h4 class="text-2xl font-black tracking-tighter uppercase group-hover:text-yellow-400 transition">
                            <?php echo htmlspecialchars($isEn ? ($project['title_en'] ?? $project['title']) : $project['title']); ?>
                        </h4>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-2 font-light">
                            <?php echo htmlspecialchars($isEn ? ($project['description_en'] ?? $project['description']) : $project['description']); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($project['project_link']); ?>" target="_blank"
                            class="flex items-center text-[10px] font-black uppercase tracking-[0.3em] text-white pt-4 group-hover:text-yellow-400 transition font-mono">
                            cat repository.url
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

<!-- Timeline (Education/Experience) Section -->
<section id="experience" class="py-32 bg-[#0c0a09]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
            <!-- Experience -->
            <div>
                <h3
                    class="text-3xl font-black uppercase tracking-tighter mb-16 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    <?php echo \App\Helpers\Language::get('field_experience'); ?>
                </h3>
                <div class="space-y-12">
                    <?php
                    $experiences = array_filter($timeline, function ($item) {
                        return $item['type'] === 'experience';
                    });
                    foreach ($experiences as $item):
                        ?>
                        <div class="relative pl-8 border-l border-stone-800">
                            <div class="absolute -left-[5px] top-0 w-2 h-2 bg-yellow-400"></div>
                            <div class="text-[10px] font-black text-stone-500 uppercase tracking-[0.2em] mb-2">
                                <?php echo htmlspecialchars($isEn ? ($item['period_en'] ?? $item['period']) : $item['period']); ?>
                            </div>
                            <h4 class="text-white font-black uppercase text-lg">
                                <?php echo htmlspecialchars($isEn ? ($item['title_en'] ?? $item['title']) : $item['title']); ?>
                                <span class="text-yellow-400 mx-2">//</span>
                                <span
                                    class="text-stone-400 text-sm"><?php echo htmlspecialchars($isEn ? ($item['organization_en'] ?? $item['organization']) : $item['organization']); ?></span>
                            </h4>
                            <p class="text-stone-500 text-sm mt-2 font-light">
                                <?php echo htmlspecialchars($isEn ? ($item['description_en'] ?? $item['description']) : $item['description']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Education -->
            <div>
                <h3
                    class="text-3xl font-black uppercase tracking-tighter mb-16 underline decoration-red-600 decoration-4 underline-offset-8">
                    <?php echo \App\Helpers\Language::get('formation'); ?>
                </h3>
                <div class="space-y-12">
                    <?php
                    $education = array_filter($timeline, function ($item) {
                        return $item['type'] === 'education';
                    });
                    foreach ($education as $item):
                        ?>
                        <div class="relative pl-8 border-l border-stone-800">
                            <div class="absolute -left-[5px] top-0 w-2 h-2 bg-red-600"></div>
                            <div class="text-[10px] font-black text-stone-500 uppercase tracking-[0.2em] mb-2">
                                <?php echo htmlspecialchars($isEn ? ($item['period_en'] ?? $item['period']) : $item['period']); ?>
                            </div>
                            <h4 class="text-white font-black uppercase text-lg">
                                <?php echo htmlspecialchars($isEn ? ($item['title_en'] ?? $item['title']) : $item['title']); ?>
                                <span class="text-red-600 mx-2">//</span>
                                <span
                                    class="text-stone-400 text-sm"><?php echo htmlspecialchars($isEn ? ($item['organization_en'] ?? $item['organization']) : $item['organization']); ?></span>
                            </h4>
                            <p class="text-stone-500 text-sm mt-2 font-light">
                                <?php echo htmlspecialchars($isEn ? ($item['description_en'] ?? $item['description']) : $item['description']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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
                    <h3 class="text-4xl font-black uppercase tracking-tighter mb-6">
                        <?php echo \App\Helpers\Language::get('contact_title'); ?>
                    </h3>
                    <p class="text-stone-400 mb-10 leading-relaxed font-light">
                        <?php echo \App\Helpers\Language::get('contact_text'); ?>
                    </p>
                    <div class="space-y-4 font-mono">
                        <div
                            class="flex items-center space-x-4 text-xs font-bold uppercase tracking-widest text-stone-500">
                            <span class="text-yellow-400">LOC:</span>
                            <span>Lille / France</span>
                        </div>
                        <div
                            class="flex items-center space-x-4 text-xs font-bold uppercase tracking-widest text-stone-500">
                            <span class="text-red-500">NET:</span>
                            <span class="text-green-500">Online</span>
                        </div>
                    </div>
                </div>

                <form action="/contact" method="POST" class="space-y-6">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="bg-yellow-400 text-black px-6 py-4 font-black uppercase tracking-tighter text-sm mb-6">
                            <?php echo \App\Helpers\Language::get('contact_success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest"><?php echo \App\Helpers\Language::get('contact_identity'); ?></label>
                        <input type="text" name="name" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700 font-mono"
                            placeholder="NAME">
                    </div>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest"><?php echo \App\Helpers\Language::get('contact_route'); ?></label>
                        <input type="email" name="email" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700 font-mono"
                            placeholder="EMAIL">
                    </div>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest"><?php echo \App\Helpers\Language::get('contact_payload'); ?></label>
                        <textarea name="message" rows="4" required
                            class="w-full px-0 py-4 bg-transparent border-b border-stone-800 focus:border-yellow-400 outline-none transition text-white placeholder-stone-700 font-mono"
                            placeholder="MESSAGE..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-red-600 text-white py-5 font-black uppercase tracking-[0.2em] text-xs hover:bg-white hover:text-black transition duration-300"><?php echo \App\Helpers\Language::get('contact_trigger'); ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layout/footer.php'; ?>