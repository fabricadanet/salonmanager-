<section class="min-h-screen bg-soft pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-16">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block mb-3">Legal & Transparency</span>
            <h1 class="text-5xl font-serif italic text-primary uppercase leading-tight">
                Política de Privacidade
            </h1>
        </div>
        
        <div class="bg-white rounded-[3rem] p-12 md:p-16 shadow-2xl border border-white prose-custom overflow-hidden">
            <?= htmlspecialchars_decode(htmlspecialchars_decode((string)$content)) ?>
        </div>
    </div>
</section>

<style>
    .prose-custom {
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        white-space: normal !important;
        font-family: 'Inter', sans-serif !important;
    }
    .prose-custom * {
        max-width: 100% !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        white-space: normal !important;
    }
    .prose-custom h1, .prose-custom h2, .prose-custom h3 { 
        font-family: 'Playfair Display', serif !important; 
        font-style: italic;
        color: #0f172a; 
        margin-top: 2.5rem; 
        margin-bottom: 1.5rem;
        font-size: 1.875rem;
        line-height: 1.25;
        display: block !important;
    }
    .prose-custom p, .prose-custom li { 
        font-family: 'Inter', sans-serif !important;
        margin-bottom: 1.5rem; 
        line-height: 1.8; 
        color: #475569; 
        font-size: 0.9375rem;
        display: block !important;
    }
    .prose-custom ul {
        list-style-type: disc !important;
        margin-left: 1.5rem !important;
        margin-bottom: 1.5rem;
        color: #475569;
        display: block !important;
    }
    .prose-custom li {
        margin-bottom: 0.5rem;
    }
</style>
