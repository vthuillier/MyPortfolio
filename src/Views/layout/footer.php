<footer class="bg-[#020617] py-20 px-4 border-t border-white/5">
    <div class="max-w-7xl mx-auto flex flex-col items-center">
        <div class="flex flex-wrap justify-center gap-8 mb-10">
            <?php if (!empty($settings['social_github'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_github']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">GitHub</a>
            <?php endif; ?>
            <?php if (!empty($settings['social_linkedin'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_linkedin']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">LinkedIn</a>
            <?php endif; ?>
            <?php if (!empty($settings['social_twitter'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_twitter']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest">Twitter
                    / X</a>
            <?php endif; ?>
        </div>
        <p class="text-slate-600 text-sm font-medium uppercase tracking-[0.25em]">
            Nord, France • © <?php echo date('Y'); ?> <?php echo $settings['site_title'] ?? 'Valentin Thuillier'; ?>
        </p>
    </div>
</footer>
</body>

</html>