<?php require_once __DIR__ . '/layout/header.php';
$isEn = \App\Helpers\Language::getCurrent() === 'en';
$title = htmlspecialchars($isEn ? ($post['title_en'] ?? $post['title']) : $post['title']);
$content = $isEn ? ($post['content_en'] ?? $post['content']) : $post['content'];
?>

<section class="pt-48 pb-32 px-6">
    <div class="max-w-4xl mx-auto">
        <a href="/blog"
            class="inline-flex items-center text-[10px] font-black uppercase tracking-[0.3em] text-stone-500 hover:text-yellow-400 transition mb-12 font-mono">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            cd ..
        </a>

        <div class="flex flex-col mb-16">
            <div class="flex items-center space-x-4 mb-4">
                <span class="text-yellow-500 text-xs font-black uppercase tracking-[0.3em]">
                    <?php echo date('Y-m-d', strtotime($post['published_at'] ?? $post['created_at'])); ?>
                </span>
                <span class="text-stone-800">//</span>
                <span class="text-stone-500 text-[10px] font-black uppercase tracking-widest">System_Log</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-tight mb-8">
                <?php echo $title; ?>
            </h1>
        </div>

        <div class="prose prose-invert prose-stone max-w-none font-light leading-relaxed text-stone-300">
            <?php echo nl2br($content); ?>
        </div>

        <div class="mt-24 pt-12 border-t border-stone-900">
            <div
                class="flex flex-col md:flex-row justify-between items-center bg-[#0c0a09] border border-stone-800 p-8">
                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-500 mb-4 md:mb-0">
                    END_OF_TRANSMISSION //
                    <?php echo date('H:i:s'); ?>
                </div>
                <a href="/blog"
                    class="px-8 py-4 bg-yellow-400 text-black font-black uppercase tracking-widest text-xs hover:bg-white transition">
                    BACK_TO_LOGS
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layout/footer.php'; ?>