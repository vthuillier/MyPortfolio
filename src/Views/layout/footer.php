<footer class="bg-[#020617] py-20 px-4 border-t border-white/5">
    <div class="max-w-7xl mx-auto flex flex-col items-center">
        <div class="flex flex-wrap justify-center gap-6 md:gap-12 mb-10 text-center">
            <?php if (!empty($settings['social_github'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_github']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest p-2">GitHub</a>
            <?php endif; ?>
            <?php if (!empty($settings['social_linkedin'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_linkedin']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest p-2">LinkedIn</a>
            <?php endif; ?>
            <?php if (!empty($settings['social_twitter'])): ?>
                <a href="<?php echo htmlspecialchars($settings['social_twitter']); ?>" target="_blank"
                    class="text-slate-500 hover:text-white transition-colors text-xs font-black uppercase tracking-widest p-2">X</a>
            <?php endif; ?>
            <a href="/legal"
                class="text-slate-500 hover:text-yellow-400 transition-colors text-xs font-black uppercase tracking-widest p-2">Legal</a>
        </div>
        <p class="text-slate-600 text-sm font-medium uppercase tracking-[0.25em]">
            Nord, France • © <?php echo date('Y'); ?> <?php echo $settings['site_title'] ?? 'Valentin Thuillier'; ?>
        </p>
    </div>
</footer>
</body>

</html>