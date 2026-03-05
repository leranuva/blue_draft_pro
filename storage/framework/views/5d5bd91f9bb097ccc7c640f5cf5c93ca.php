

<?php $__env->startSection('title', 'NYC Renovation Insights by Blue Draft'); ?>
<?php $__env->startSection('meta_description', 'Tips, guides, and insights on construction, renovation, and remodeling in NYC. Kitchen, bathroom, commercial projects.'); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('blog.index')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="pt-32 pb-24 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">NYC Renovation Insights by Blue Draft</h1>
            <p class="text-xl text-white/90">Real cost breakdowns, permit guidance, and expert advice from licensed New York contractors.</p>
        </div>
    </section>

    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->isEmpty()): ?>
            <div class="text-center py-16">
                <p class="text-xl text-gray-600 dark:text-gray-300">No posts yet. Check back soon for construction tips and guides.</p>
                <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex mt-6 text-[#336699] font-medium hover:underline"><?php echo e($hero['cta_text']); ?></a>
            </div>
            <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="group">
                    <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="block h-full bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100/80 dark:border-gray-700/50 hover:border-[#336699]/30 dark:hover:border-[#4a90e2]/30">
                        <div class="aspect-[16/10] overflow-hidden bg-gradient-to-br from-[#003366]/10 to-[#336699]/10 dark:from-[#003366]/20 dark:to-[#336699]/20">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->featured_image): ?>
                            <img src="<?php echo e($post->featured_image_url); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-[#003366]/20 dark:text-[#4a90e2]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16a6 6 0 01-5-5 6 6 0 0012 0 6 6 0 01-5 5m8 0h3m2 0h-1m-1 0h-2m-2 0h-2m-2 0h-1m-1 0h-2"></path>
                                </svg>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="p-6 lg:p-7">
                            <time class="inline-block text-xs font-medium uppercase tracking-wider text-[#336699] dark:text-[#4a90e2] mb-3">
                                <?php echo e($post->published_at?->format('M j, Y') ?? $post->created_at->format('M j, Y')); ?>

                            </time>
                            <h2 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-3 leading-tight group-hover:text-[#336699] dark:group-hover:text-[#4a90e2] transition-colors line-clamp-2">
                                <?php echo e($post->title); ?>

                            </h2>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3 mb-4"><?php echo e($post->excerpt); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="inline-flex items-center gap-2 text-[#336699] dark:text-[#4a90e2] font-semibold text-sm group-hover:gap-3 transition-all">
                                Read article
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </div>
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="mt-12">
                <?php echo e($posts->links()); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/blog/index.blade.php ENDPATH**/ ?>