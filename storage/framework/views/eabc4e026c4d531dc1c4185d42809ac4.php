

<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('meta_description', $metaDescription); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('pillar.city', $city)); ?>">
    <meta property="og:title" content="<?php echo e($title); ?>">
    <meta property="og:description" content="<?php echo e(Str::limit($metaDescription, 160)); ?>">
    <meta property="og:url" content="<?php echo e(route('pillar.city', $city)); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/logo-original.png')); ?>">
    <meta property="og:type" content="website">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('schema'); ?>
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => "Construction Company {$cityName}", 'url' => route('pillar.city', $city)],
]" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative py-32 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span>Construction Company <?php echo e($cityName); ?></span>
            </nav>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4">
                <?php echo e($heroTitle); ?>

            </h1>
            <p class="text-xl text-white/90 mb-8"><?php echo e($heroSubtitle); ?></p>
            <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg shadow-lg">
                <?php echo e($hero['cta_text']); ?>

                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-a:text-[#336699]">
                <?php echo $content; ?>

            </div>
        </div>
    </section>

    <!-- Internal Links: Services -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Our Construction Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('services.show', $service->slug)); ?>" class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 dark:border-gray-700">
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white mb-2"><?php echo e($service->title); ?></h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300"><?php echo e($service->hero_subtitle); ?></p>
                    <span class="text-[#336699] text-sm font-medium mt-2 inline-block">Learn more →</span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Internal Links: Projects -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->isNotEmpty()): ?>
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Recent Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="block group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->image_after): ?>
                    <div class="aspect-[4/3] rounded-lg overflow-hidden mb-3">
                        <img src="<?php echo e($project->after_image_url); ?>" alt="<?php echo e($project->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white group-hover:text-[#336699]"><?php echo e($project->title); ?></h3>
                    <span class="text-xs text-[#336699] capitalize"><?php echo e($project->category); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- CTA -->
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Ready to Start Your <?php echo e($cityName); ?> Project?</h2>
            <p class="text-white/90 mb-8">Free estimates. We respond within 24 hours.</p>
            <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                <?php echo e($hero['cta_text']); ?>

            </a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/pages/pillar-city.blade.php ENDPATH**/ ?>