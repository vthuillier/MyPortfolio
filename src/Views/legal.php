<?php require_once __DIR__ . '/layout/header.php'; ?>

<main class="pt-48 pb-32 px-6">
    <div class="max-w-4xl mx-auto space-y-12">
        <header class="space-y-4">
            <span class="text-yellow-500 text-xs font-black uppercase tracking-[0.3em]">Compliance / Privacy</span>
            <h1 class="text-5xl font-black uppercase tracking-tighter">Mentions Légales & <span
                    class="text-stone-500">Confidentialité</span></h1>
        </header>

        <div class="glass-card p-10 space-y-8 font-light text-stone-400 leading-relaxed border border-stone-800">
            <!-- Analytics Section -->
            <section class="space-y-4">
                <h2 class="text-xl font-black text-white uppercase tracking-widest flex items-center">
                    <span class="w-8 h-px bg-yellow-400 mr-4"></span>
                    Statistiques de visite
                </h2>
                <div class="pl-12 space-y-4">
                    <p>Ce site utilise un système de suivi des statistiques auto-hébergé et respectueux de la vie
                        privée. Contrairement aux outils tiers classiques, aucune donnée n'est transmise à des
                        entreprises externes.</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong class="text-stone-200">Anonymisation</strong> : Les adresses IP sont anonymisées
                            immédiatement avant d'être enregistrées (masquage des derniers octets).</li>
                        <li><strong class="text-stone-200">Aucun Cookie</strong> : Ce système n'utilise aucun cookie de
                            traçage. Votre navigation sur ce site reste strictement privée et non-identifiable.</li>
                        <li><strong class="text-stone-200">Données collectées</strong> : Nous mesurons uniquement le
                            nombre de visites par page et le nombre de téléchargements du CV pour améliorer l'expérience
                            utilisateur.</li>
                    </ul>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="space-y-4">
                <h2 class="text-xl font-black text-white uppercase tracking-widest flex items-center">
                    <span class="w-8 h-px bg-red-600 mr-4"></span>
                    Données de contact
                </h2>
                <div class="pl-12 space-y-4">
                    <p>Les informations envoyées via le formulaire de contact (nom, email, message) sont utilisées
                        exclusivement pour répondre à vos demandes. Elles ne seront jamais vendues ou cédées à des
                        tiers.</p>
                </div>
            </section>

            <!-- Rights Section -->
            <section class="space-y-4">
                <h2 class="text-xl font-black text-white uppercase tracking-widest flex items-center">
                    <span class="w-8 h-px bg-stone-600 mr-4"></span>
                    Vos Droits
                </h2>
                <div class="pl-12 space-y-4">
                    <p>Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression de vos
                        données personnelles. Pour toute demande, vous pouvez utiliser le formulaire de contact présent
                        sur la page d'accueil.</p>
                </div>
            </section>
        </div>

        <div class="flex justify-center">
            <a href="/"
                class="text-[10px] font-black uppercase tracking-widest text-stone-500 hover:text-yellow-400 transition">
                <-- Back to Ground Control </a>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/layout/footer.php'; ?>