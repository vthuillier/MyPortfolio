<?php require_once __DIR__ . '/../layout/header.php'; ?>

<section class="pt-48 pb-32 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <h1 class="text-4xl font-black uppercase tracking-tighter">
                <?php echo $action === 'create' ? 'LOG_NEW_ENTRY' : 'EDIT_LOG_ENTRY'; ?>
            </h1>
            <a href="/admin"
                class="text-xs font-black text-stone-500 hover:text-yellow-400 uppercase tracking-widest font-mono">
                [ ABORT_AND_EXIT ]
            </a>
        </div>

        <form action="" method="POST" class="space-y-8 bg-[#0c0a09] border border-stone-800 p-8 md:p-12">
            <?php echo \App\Helpers\Csrf::field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Post Title
                        (FR)</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>"
                        required
                        class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Post Title
                        (EN)</label>
                    <input type="text" name="title_en" value="<?php echo htmlspecialchars($post['title_en'] ?? ''); ?>"
                        class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">URL Slug (Keep
                    empty for auto-gen)</label>
                <input type="text" name="slug" value="<?php echo htmlspecialchars($post['slug'] ?? ''); ?>"
                    placeholder="e.g. my-first-devlog"
                    class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Excerpt
                        (FR)</label>
                    <textarea name="excerpt" rows="3"
                        class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm"><?php echo htmlspecialchars($post['excerpt'] ?? ''); ?></textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Excerpt
                        (EN)</label>
                    <textarea name="excerpt_en" rows="3"
                        class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm"><?php echo htmlspecialchars($post['excerpt_en'] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Content
                    (FR)</label>
                <textarea name="content" rows="10" required
                    class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm"><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Content
                    (EN)</label>
                <textarea name="content_en" rows="10"
                    class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm"><?php echo htmlspecialchars($post['content_en'] ?? ''); ?></textarea>
            </div>

            <div class="flex items-center space-x-8 pt-4">
                <div class="flex items-center space-x-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" id="is_published" <?php echo ($post['is_published'] ?? 0) == 1 ? 'checked' : ''; ?>
                    class="w-4 h-4 accent-yellow-400 bg-stone-900 border-stone-800">
                    <label for="is_published"
                        class="text-[10px] font-black text-stone-400 uppercase tracking-widest select-none">Publish_Now</label>
                </div>

                <div class="flex-1 space-y-2">
                    <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Published
                        Date</label>
                    <input type="datetime-local" name="published_at"
                        value="<?php echo isset($post['published_at']) ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : ''; ?>"
                        class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-2 text-white font-mono text-xs">
                </div>
            </div>

            <div class="pt-8 bg-stone-900/30 -mx-8 -mb-8 p-8 flex justify-end">
                <button type="submit"
                    class="bg-yellow-400 text-black px-12 py-4 font-black uppercase tracking-widest hover:bg-white transition">
                    <?php echo $action === 'create' ? 'INITIALIZE_BLOG_ENTRY' : 'UPDATE_LOG_DATA'; ?>
                </button>
            </div>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>