

<?php $__env->startSection('title', 'Your NYC Renovation Guide | Blue Draft'); ?>
<?php $__env->startSection('meta_description', 'Essential tips for kitchen remodeling, bathroom renovation, and home improvement in New York City.'); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('lead-magnet.guide')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-200">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <h1 class="text-3xl md:text-4xl font-serif font-bold text-[#003366] dark:text-white mb-6">
            Your NYC Renovation Guide
        </h1>

        <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-a:text-[#336699]">
            <h2>1. Plan Your Budget Early</h2>
            <p>NYC renovations can vary widely. Kitchen remodels typically range from $15,000 to $75,000+, while bathroom renovations often run $10,000–$35,000. Get at least 2–3 quotes before committing.</p>

            <h2>2. Know Your Building Requirements</h2>
            <p>Co-ops and condos in NYC often have strict rules. Check your building's alteration agreement (Alteration Agreement, or "Alt 1") before starting. Some work requires board approval.</p>

            <h2>3. Permits Matter</h2>
            <p>Electrical, plumbing, and structural changes usually need DOB permits. Working without permits can lead to fines and complications when selling. A licensed contractor will handle this.</p>

            <h2>4. Choose the Right Contractor</h2>
            <p>Look for licensed, insured contractors with NYC experience. Check reviews, ask for references, and verify they're familiar with local codes and building requirements.</p>

            <h2>5. Timeline Expectations</h2>
            <p>NYC projects often take longer due to building logistics, elevator reservations, and inspections. Add buffer time to any estimate—especially in high-rise buildings.</p>

            <h2>6. Material Selection</h2>
            <p>Order materials early. Supply chain delays are common. Consider durable, low-maintenance finishes that hold up to NYC wear and tear.</p>
        </div>

        <div class="mt-12 p-6 bg-[#003366]/5 dark:bg-[#336699]/10 rounded-xl border border-[#336699]/20">
            <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-4">Ready for a Custom Quote?</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Get a free, no-obligation estimate for your NYC renovation project.</p>
            <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-6 py-3 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium">
                <?php echo e($hero['cta_text'] ?? 'Get Free Quote'); ?>

                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/pages/lead-magnet-guide.blade.php ENDPATH**/ ?>