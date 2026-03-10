<?php require_once __DIR__ . '/layout/header.php';
$isEn = \App\Helpers\Language::getCurrent() === 'en';
?>

<section class="pt-48 pb-32 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col mb-20 animate-fade-in">
            <span class="text-red-500 text-xs font-black uppercase tracking-[0.3em] mb-4">Transmission / Logs</span>
            <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none mb-8">
                DEV_<span class="text-yellow-400">LOG</span>
            </h1>
            <p class="text-stone-500 max-w-2xl font-mono text-sm">
                // Documentation of technical procedures, system updates, and research findings.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <?php foreach ($posts as $post): ?>
                <article
                    class="group relative bg-[#0c0a09] border border-stone-800 p-8 hover:border-yellow-400/50 transition-all duration-500">
                    <div class="flex justify-between items-start mb-6">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-500">
                            <?php echo date('Y-m-d', strtotime($post['published_at'] ?? $post['created_at'])); ?>
                        </span>
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                    </div>

                    <h2 class="text-2xl font-black tracking-tighter uppercase group-hover:text-yellow-400 transition mb-4">
                        <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>">
                            <?php echo htmlspecialchars($isEn ? ($post['title_en'] ?? $post['title']) : $post['title']); ?>
                        </a>
                    </h2>

                    <p class="text-stone-400 text-sm leading-relaxed mb-8 line-clamp-3 font-light">
                        <?php echo htmlspecialchars($isEn ? ($post['excerpt_en'] ?? $post['excerpt']) : $post['excerpt']); ?>
                    </p>

                    <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>"
                        class="inline-flex items-center text-[10px] font-black uppercase tracking-[0.3em] text-yellow-400 hover:text-white transition font-mono">
                        READ_MANUAL.SH
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layout/footer.php'; ?>