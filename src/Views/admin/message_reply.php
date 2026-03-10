<?php require_once __DIR__ . '/../layout/header.php'; ?>

<section class="pt-48 pb-32 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-12 border-b border-stone-800 pb-8">
            <div>
                <span
                    class="text-yellow-400 text-xs font-black uppercase tracking-[0.3em] mb-2 block">Communication_Relay</span>
                <h1 class="text-4xl font-black uppercase tracking-tighter">REPLY_TO_TRANSMISSION</h1>
            </div>
            <a href="/admin"
                class="text-xs font-black text-stone-500 hover:text-yellow-400 uppercase tracking-widest font-mono">
                [ ABORT ]
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-8">
                <form action="" method="POST" class="space-y-6">
                    <?php echo \App\Helpers\Csrf::field(); ?>

                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Recipient</label>
                        <input type="text"
                            value="<?php echo htmlspecialchars($msg['name'] . ' <' . $msg['email'] . '>'); ?>" disabled
                            class="w-full bg-stone-900/30 border border-stone-800 px-4 py-3 text-stone-500 font-mono text-sm cursor-not-allowed">
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Subject</label>
                        <input type="text" name="subject"
                            value="RE: Message from <?php echo htmlspecialchars($_ENV['APP_NAME'] ?? 'Portfolio'); ?>"
                            required
                            class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm">
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Transmission_Content</label>
                        <textarea name="reply_content" rows="12" required placeholder="Type your response here..."
                            class="w-full bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none px-4 py-3 text-white font-mono text-sm leading-relaxed"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-yellow-400 text-black py-4 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">
                            EXECUTE_SEND_COMMAND
                        </button>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="bg-[#0c0a09] border border-stone-800 p-6">
                    <h3 class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-4">Original_Payload
                    </h3>
                    <div
                        class="text-stone-400 text-xs font-mono leading-relaxed bg-stone-900/30 p-4 border border-stone-800/50 italic">
                        "
                        <?php echo nl2br(htmlspecialchars($msg['message'])); ?>"
                    </div>
                    <div class="mt-4 pt-4 border-t border-stone-800 text-[9px] text-stone-600 font-mono">
                        RECEIVED:
                        <?php echo date('Y-m-d H:i:s', strtotime($msg['created_at'])); ?><br>
                        ORIGIN:
                        <?php echo htmlspecialchars($msg['email']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>