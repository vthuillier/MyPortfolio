<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Valentin Thuillier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0c0a09;
            color: #f5f5f4;
        }

        .glass-card {
            background: rgba(28, 25, 23, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(250, 204, 21, 0.1);
        }

        .accent-bg-yellow {
            background-color: #facc15;
        }
    </style>
</head>

<body class="min-h-screen">
    <nav class="bg-black/50 border-b border-stone-800 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 accent-bg-yellow flex items-center justify-center font-black text-black">V</div>
                    <span class="text-xl font-bold uppercase tracking-tighter">Terminal Admin</span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/" target="_blank"
                        class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-500 hover:text-white transition">Visit
                        Station</a>
                    <a href="/logout"
                        class="px-5 py-2 border border-red-900 text-red-500 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-red-900/20 transition">Shutdown</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Stats Section -->
            <div class="lg:col-span-3 space-y-10">
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl font-black uppercase tracking-tighter">System Analytics</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Total Visits Card -->
                    <div class="glass-card p-6 border-l-4 border-yellow-400">
                        <div class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-2">Total Visits
                        </div>
                        <div class="text-4xl font-black text-white"><?php echo number_format($stats['total_visits']); ?>
                        </div>
                    </div>

                    <!-- CV Downloads Card -->
                    <div class="glass-card p-6 border-l-4 border-red-600">
                        <div class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-2">Manifest
                            Downloads (CV)</div>
                        <div class="text-4xl font-black text-white">
                            <?php echo number_format($stats['total_downloads']); ?>
                        </div>
                    </div>

                    <!-- Messages Card -->
                    <div class="glass-card p-6 border-l-4 border-stone-600">
                        <div class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-2">Feedback
                            Received</div>
                        <div class="text-4xl font-black text-white"><?php echo count($messages); ?></div>
                    </div>

                    <!-- Projects Card -->
                    <div class="glass-card p-6 border-l-4 border-stone-400">
                        <div class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-2">Active
                            Interventions</div>
                        <div class="text-4xl font-black text-white"><?php echo count($projects); ?></div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="glass-card p-8 border border-stone-800">
                    <div class="text-[10px] font-black text-stone-500 uppercase tracking-widest mb-6">Traffic Analysis
                        (Last 14 Days)</div>
                    <div class="h-[300px] w-full">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Projects Section -->
            <div class="lg:col-span-2 space-y-10">
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl font-black uppercase tracking-tighter">Interventions List</h2>
                    <a href="/admin/project/create"
                        class="accent-bg-yellow text-black px-6 py-3 font-black uppercase tracking-widest text-[10px] hover:bg-white transition">
                        New Mission
                    </a>
                </div>

                <div class="glass-card rounded-sm overflow-x-auto border border-stone-800">
                    <table class="min-w-[800px] md:min-w-full divide-y divide-stone-800">
                        <thead class="bg-stone-900/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                    Feed</th>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                    Designation</th>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                    Class</th>
                                <th
                                    class="px-6 py-4 text-right text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-800">
                            <?php foreach ($projects as $project): ?>
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="<?php
                                        $img = $project['image_url'] ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=100';
                                        echo (strpos($img, 'http') === 0) ? $img : '/' . $img;
                                        ?>" class="w-12 h-12 object-cover border border-stone-800">
                                    </td>
                                    <td class="px-6 py-4 font-bold text-stone-200">
                                        <?php echo htmlspecialchars($project['title']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-[9px] font-black px-2 py-1 border border-yellow-400/20 text-yellow-400 uppercase tracking-widest"><?php echo htmlspecialchars($project['category']); ?></span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="/admin/project/edit?id=<?php echo $project['id']; ?>"
                                            class="text-stone-500 hover:text-yellow-400 transition text-[10px] font-black uppercase tracking-widest">Edit</a>
                                        <a href="/admin/project/delete?id=<?php echo $project['id']; ?>"
                                            onclick="return confirm('Confirm Deletion?')"
                                            class="text-red-900 hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Timeline Section -->
                <div class="space-y-10 pt-10 border-t border-stone-800">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-black uppercase tracking-tighter">Timeline Logs</h2>
                        <a href="/admin/timeline/create"
                            class="accent-bg-yellow text-black px-6 py-3 font-black uppercase tracking-widest text-[10px] hover:bg-white transition">
                            New Entry
                        </a>
                    </div>

                    <div class="glass-card rounded-sm overflow-x-auto border border-stone-800">
                        <table class="min-w-[800px] md:min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-900/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Type</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Designation / Org</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Period</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                <?php foreach ($timeline as $item): ?>
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-[9px] font-black px-2 py-1 border <?php echo $item['type'] === 'experience' ? 'border-yellow-400/20 text-yellow-400' : 'border-red-600/20 text-red-600'; ?> uppercase tracking-widest">
                                                <?php echo htmlspecialchars($item['type']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-stone-200">
                                                <?php echo htmlspecialchars($item['title']); ?>
                                            </div>
                                            <div class="text-[10px] text-stone-500 font-mono">
                                                <?php echo htmlspecialchars($item['organization']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-stone-400 text-xs font-mono">
                                            <?php echo htmlspecialchars($item['period']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3">
                                            <a href="/admin/timeline/edit?id=<?php echo $item['id']; ?>"
                                                class="text-stone-500 hover:text-yellow-400 transition text-[10px] font-black uppercase tracking-widest">Edit</a>
                                            <a href="/admin/timeline/delete?id=<?php echo $item['id']; ?>"
                                                onclick="return confirm('Confirm Deletion?')"
                                                class="text-red-900 hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Messages Section -->
                <div class="space-y-10 pt-10 border-t border-stone-800">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-black uppercase tracking-tighter">Transmission Logs (Messages)</h2>
                    </div>

                    <div class="glass-card rounded-sm overflow-x-auto border border-stone-800">
                        <table class="min-w-[900px] md:min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-900/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Origin</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Payload</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Date</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                <?php foreach ($messages as $msg): ?>
                                    <tr
                                        class="hover:bg-white/5 transition <?php echo $msg['is_read'] ? 'opacity-60' : ''; ?>">
                                        <td class="px-6 py-4">
                                            <?php if (!$msg['is_read']): ?>
                                                <span class="flex h-2 w-2 rounded-full bg-yellow-400"></span>
                                            <?php else: ?>
                                                <span class="flex h-2 w-2 rounded-full bg-stone-700"></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-stone-200">
                                                <?php echo htmlspecialchars($msg['name']); ?>
                                            </div>
                                            <div class="text-[10px] text-stone-500 font-mono">
                                                <?php echo htmlspecialchars($msg['email']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-stone-400 text-xs line-clamp-2 max-w-md">
                                                <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-stone-500 text-[10px] font-mono whitespace-nowrap">
                                            <?php echo date('Y-m-d H:i', strtotime($msg['created_at'])); ?>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                            <?php if (!$msg['is_read']): ?>
                                                <a href="/admin/message/read?id=<?php echo $msg['id']; ?>"
                                                    class="text-yellow-400 hover:text-white transition text-[10px] font-black uppercase tracking-widest">Mark
                                                    read</a>
                                            <?php endif; ?>
                                            <a href="/admin/message/reply?id=<?php echo $msg['id']; ?>"
                                                class="text-stone-400 hover:text-yellow-400 transition text-[10px] font-black uppercase tracking-widest">Reply</a>
                                            <a href="/admin/message/delete?id=<?php echo $msg['id']; ?>"
                                                onclick="return confirm('Erase transmission record?')"
                                                class="text-red-900 hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest">Erase</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (empty($messages)): ?>
                            <div class="p-10 text-center text-stone-600 font-mono text-xs italic">
                                NO INCOMING TRANSMISSIONS DETECTED.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Dev Log Section -->
                <div class="space-y-10 pt-10 border-t border-stone-800">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-black uppercase tracking-tighter">Dev Log Entries</h2>
                        <a href="/admin/post/create"
                            class="accent-bg-yellow text-black px-6 py-3 font-black uppercase tracking-widest text-[10px] hover:bg-white transition">
                            New Log
                        </a>
                    </div>

                    <div class="glass-card rounded-sm overflow-x-auto border border-stone-800">
                        <table class="min-w-[800px] md:min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-900/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Title</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Published</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                <?php foreach ($posts as $post): ?>
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-stone-200">
                                                <?php echo htmlspecialchars($post['title']); ?>
                                            </div>
                                            <div class="text-[10px] text-stone-500 font-mono">
                                                /blog/<?php echo htmlspecialchars($post['slug']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-[9px] font-black px-2 py-1 border <?php echo $post['is_published'] ? 'border-green-400/20 text-green-400' : 'border-stone-600/20 text-stone-600'; ?> uppercase tracking-widest">
                                                <?php echo $post['is_published'] ? 'PUBLISHED' : 'DRAFT'; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-stone-400 text-xs font-mono">
                                            <?php echo $post['published_at'] ? date('Y-m-d', strtotime($post['published_at'])) : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3">
                                            <a href="/admin/post/edit?id=<?php echo $post['id']; ?>"
                                                class="text-stone-500 hover:text-yellow-400 transition text-[10px] font-black uppercase tracking-widest">Edit</a>
                                            <a href="/admin/post/delete?id=<?php echo $post['id']; ?>"
                                                onclick="return confirm('Confirm Deletion?')"
                                                class="text-red-900 hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (empty($posts)): ?>
                            <div class="p-10 text-center text-stone-600 font-mono text-xs italic">
                                NO LOG ENTRIES FOUND.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Technical Expertise Section -->
                <div class="space-y-10 pt-10 border-t border-stone-800">
                    <div class="flex justify-between items-center">
                        <h2 class="text-3xl font-black uppercase tracking-tighter">Technical Expertise</h2>
                        <a href="/admin/skill/create"
                            class="accent-bg-yellow text-black px-6 py-3 font-black uppercase tracking-widest text-[10px] hover:bg-white transition">
                            New Skill
                        </a>
                    </div>

                    <div class="glass-card rounded-sm overflow-x-auto border border-stone-800">
                        <table class="min-w-[800px] md:min-w-full divide-y divide-stone-800">
                            <thead class="bg-stone-900/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Category</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Skill</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Level</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-stone-500 uppercase tracking-widest">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                <?php foreach ($skills as $skill): ?>
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="px-6 py-4">
                                            <span
                                                class="text-[9px] font-black px-2 py-1 border border-stone-800 text-stone-400 uppercase tracking-widest">
                                                <?php echo htmlspecialchars($skill['category']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 font-bold text-stone-200">
                                            <?php echo htmlspecialchars($skill['name']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-20 h-1 bg-stone-900">
                                                    <div class="h-full bg-yellow-400"
                                                        style="width: <?php echo $skill['level']; ?>%"></div>
                                                </div>
                                                <span
                                                    class="text-[10px] font-mono text-stone-500"><?php echo $skill['level']; ?>%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3">
                                            <a href="/admin/skill/edit?id=<?php echo $skill['id']; ?>"
                                                class="text-stone-500 hover:text-yellow-400 transition text-[10px] font-black uppercase tracking-widest">Edit</a>
                                            <a href="/admin/skill/delete?id=<?php echo $skill['id']; ?>"
                                                onclick="return confirm('Confirm Deletion?')"
                                                class="text-red-900 hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="space-y-10">
                <h2 class="text-3xl font-black uppercase tracking-tighter">System Configuration</h2>
                <form action="/admin/settings" method="POST" enctype="multipart/form-data"
                    class="glass-card p-8 rounded-sm space-y-6">
                    <?php echo \App\Helpers\Csrf::field(); ?>

                    <div class="space-y-4 pt-4 border-b border-stone-800 pb-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="space-y-1">
                                <h3 class="text-[10px] font-black text-white uppercase tracking-widest">Maintenance_Mode
                                </h3>
                                <p class="text-[9px] text-stone-500 uppercase tracking-widest">Offline for public users
                                </p>
                            </div>
                            <div
                                class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input type="checkbox" name="maintenance_mode" value="1" id="maintenance_toggle" <?php echo ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : ''; ?>
                                    class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-stone-700 border-4 border-stone-800 appearance-none cursor-pointer checked:right-0 checked:bg-yellow-400 right-4 transition-all duration-300">
                                <label for="maintenance_toggle"
                                    class="toggle-label block overflow-hidden h-6 rounded-full bg-stone-900 border border-stone-800 cursor-pointer"></label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Identity
                            Manifest</label>
                        <input type="text" name="user_name"
                            value="<?php echo htmlspecialchars($settings['user_name'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>

                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Analytics
                                Script (Plasisuble, etc.)</label>
                            <textarea name="analytics_script" rows="2"
                                placeholder="<!-- <script defer data-domain='...' src='...'></script> -->"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-stone-400 font-mono text-xs"><?php echo htmlspecialchars($settings['analytics_script'] ?? ''); ?></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Contact
                                Notification Email</label>
                            <input type="email" name="contact_email"
                                value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>"
                                placeholder="votre@email.com"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Designation
                            Title (FR)</label>
                        <input type="text" name="user_job"
                            value="<?php echo htmlspecialchars($settings['user_job'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Metadata /
                                SEO (FR)</label>
                            <textarea name="meta_description" rows="2"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['meta_description'] ?? ''); ?></textarea>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Metadata /
                                SEO (EN)</label>
                            <textarea name="meta_description_en" rows="2"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['meta_description_en'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Designation
                            Title (EN)</label>
                        <input type="text" name="user_job_en"
                            value="<?php echo htmlspecialchars($settings['user_job_en'] ?? ''); ?>"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm">
                    </div>
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Intervention
                            Readiness</label>
                        <select name="is_available"
                            class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm appearance-none">
                            <option value="1" <?php echo ($settings['is_available'] ?? '1') === '1' ? 'selected' : ''; ?>>
                                OPERATIONAL (Green)</option>
                            <option value="0" <?php echo ($settings['is_available'] ?? '0') === '0' ? 'selected' : ''; ?>>
                                BUSY / RESCUING (Red)</option>
                        </select>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Hero
                                Stream / Bio (FR)</label>
                            <textarea name="site_bio" rows="2"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['site_bio'] ?? ''); ?></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">Hero
                                Stream / Bio (EN)</label>
                            <textarea name="site_bio_en" rows="2"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['site_bio_en'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">About
                                Rapport / Bio (FR)</label>
                            <textarea name="about_text" rows="3"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['about_text'] ?? ''); ?></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-stone-500 uppercase tracking-widest">About
                                Rapport / Bio (EN)</label>
                            <textarea name="about_text_en" rows="3"
                                class="w-full px-4 py-3 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none transition text-white text-sm"><?php echo htmlspecialchars($settings['about_text_en'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="flex justify-between items-center">
                            <h3 class="text-[10px] font-black text-stone-400 uppercase tracking-widest">System Files
                            </h3>
                            <a href="/admin/db-export"
                                class="text-[9px] font-black text-yellow-400 hover:text-white transition uppercase tracking-widest border border-yellow-400/20 px-3 py-1 rounded-sm">Download
                                Backup</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Curriculum
                                    Vitae (PDF/Doc)</label>
                                <input type="file" name="cv_file"
                                    class="w-full text-xs text-stone-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-stone-800 file:text-stone-300 hover:file:bg-stone-700 transition">
                                <?php if (!empty($settings['social_cv'])): ?>
                                    <div class="text-[8px] text-green-500 font-mono">CURRENT:
                                        <?php echo basename($settings['social_cv']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Station
                                    Icon (Favicon)</label>
                                <input type="file" name="favicon"
                                    class="w-full text-xs text-stone-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-stone-800 file:text-stone-300 hover:file:bg-stone-700 transition">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <h3 class="text-[10px] font-black text-stone-400 uppercase tracking-widest">Network Links</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">GitHub
                                    URL</label>
                                <input type="text" name="social_github"
                                    value="<?php echo htmlspecialchars($settings['social_github'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">LinkedIn
                                    URL</label>
                                <input type="text" name="social_linkedin"
                                    value="<?php echo htmlspecialchars($settings['social_linkedin'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Twitter
                                    / X URL</label>
                                <input type="text" name="social_twitter"
                                    value="<?php echo htmlspecialchars($settings['social_twitter'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-stone-800">
                        <div class="space-y-4">
                            <h3 class="text-[10px] font-black text-yellow-400 uppercase tracking-widest">Expertise 1
                                (Yellow Block)</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label
                                        class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Title
                                        (FR)</label>
                                    <input type="text" name="about_exp1_title"
                                        value="<?php echo htmlspecialchars($settings['about_exp1_title'] ?? ''); ?>"
                                        class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Title
                                        (EN)</label>
                                    <input type="text" name="about_exp1_title_en"
                                        value="<?php echo htmlspecialchars($settings['about_exp1_title_en'] ?? ''); ?>"
                                        class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Tags
                                    (FR)</label>
                                <input type="text" name="about_exp1_tags"
                                    value="<?php echo htmlspecialchars($settings['about_exp1_tags'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Tags
                                    (EN)</label>
                                <input type="text" name="about_exp1_tags_en"
                                    value="<?php echo htmlspecialchars($settings['about_exp1_tags_en'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-yellow-400 outline-none text-white text-xs">
                            </div>
                        </div>

                        <div class="space-y-4 pt-4 border-t border-stone-800">
                            <h3 class="text-[10px] font-black text-red-500 uppercase tracking-widest">Expertise 2 (Red
                                Block)</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label
                                        class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Title
                                        (FR)</label>
                                    <input type="text" name="about_exp2_title"
                                        value="<?php echo htmlspecialchars($settings['about_exp2_title'] ?? ''); ?>"
                                        class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-red-500 outline-none text-white text-xs">
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Title
                                        (EN)</label>
                                    <input type="text" name="about_exp2_title_en"
                                        value="<?php echo htmlspecialchars($settings['about_exp2_title_en'] ?? ''); ?>"
                                        class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-red-500 outline-none text-white text-xs">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Tags
                                    (FR)</label>
                                <input type="text" name="about_exp2_tags"
                                    value="<?php echo htmlspecialchars($settings['about_exp2_tags'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-red-500 outline-none text-white text-xs">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[9px] font-bold text-stone-500 uppercase tracking-widest">Tags
                                    (EN)</label>
                                <input type="text" name="about_exp2_tags_en"
                                    value="<?php echo htmlspecialchars($settings['about_exp2_tags_en'] ?? ''); ?>"
                                    class="w-full px-4 py-2 bg-stone-900/50 border border-stone-800 focus:border-red-500 outline-none text-white text-xs">
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full accent-bg-yellow text-black py-4 font-black uppercase tracking-widest text-xs hover:bg-white transition duration-300">Synchronize
                        Data</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('analyticsChart').getContext('2d');

        // Prepare data from PHP
        const visitsData = <?php echo json_encode($stats['visits_daily']); ?>;
        const downloadsData = <?php echo json_encode($stats['downloads_daily']); ?>;

        // Generate last 14 days labels
        const allDates = [];
        for (let i = 13; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            allDates.push(d.toISOString().split('T')[0]);
        }

        const visitCounts = allDates.map(date => {
            const found = visitsData.find(d => d.date === date);
            return found ? found.count : 0;
        });

        const downloadCounts = allDates.map(date => {
            const found = downloadsData.find(d => d.date === date);
            return found ? found.count : 0;
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: allDates,
                datasets: [
                    {
                        label: 'Visits',
                        data: visitCounts,
                        borderColor: '#facc15',
                        backgroundColor: 'rgba(250, 204, 21, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#facc15',
                        pointBorderColor: '#0c0a09',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    },
                    {
                        label: 'Downloads',
                        data: downloadCounts,
                        borderColor: '#dc2626',
                        backgroundColor: 'rgba(220, 38, 38, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#dc2626',
                        pointBorderColor: '#0c0a09',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#78716c',
                            font: {
                                family: 'monospace',
                                size: 10
                            },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#78716c',
                            font: {
                                family: 'monospace',
                                size: 10
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            color: '#d6d3d1',
                            font: {
                                size: 10,
                                family: 'monospace',
                                weight: 'bold'
                            },
                            boxWidth: 12,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1c1917',
                        titleColor: '#facc15',
                        titleFont: { family: 'monospace' },
                        bodyFont: { family: 'monospace' },
                        borderColor: 'rgba(250, 204, 21, 0.2)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false
                    }
                }
            }
        });
    </script>
</body>

</html>