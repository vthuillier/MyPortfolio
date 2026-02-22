<footer class="bg-[#020617] py-20 px-4 border-t border-white/5">
    <div class="max-w-7xl mx-auto flex flex-col items-center">
        <div class="flex space-x-8 mb-10">
            <a href="<?php echo $settings['social_github'] ?? '#'; ?>"
                class="text-slate-500 hover:text-white transition-colors">
                GitHub
            </a>
            <a href="<?php echo $settings['social_linkedin'] ?? '#'; ?>"
                class="text-slate-500 hover:text-white transition-colors">
                LinkedIn
            </a>
        </div>
        <p class="text-slate-600 text-sm font-medium uppercase tracking-[0.25em]">
            Nord, France • © <?php echo date('Y'); ?> <?php echo $settings['site_title'] ?? 'Valentin Thuillier'; ?>
        </p>
    </div>
</footer>
</body>

</html>