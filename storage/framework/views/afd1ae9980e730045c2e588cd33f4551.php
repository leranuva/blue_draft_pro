

<?php $__env->startSection('title', ($post->meta_title ?: $post->title) . ' | Blue Draft'); ?>
<?php $__env->startSection('meta_description', $post->meta_description ?: Str::limit($post->excerpt ?? $post->content, 160)); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('blog.show', $post->slug)); ?>">
    <meta property="og:title" content="<?php echo e($post->meta_title ?: $post->title . ' | Blue Draft'); ?>">
    <meta property="og:description" content="<?php echo e(Str::limit($post->meta_description ?? $post->excerpt ?? strip_tags($post->content), 160)); ?>">
    <meta property="og:url" content="<?php echo e(route('blog.show', $post->slug)); ?>">
    <meta property="og:image" content="<?php echo e($post->featured_image_url ?? asset('images/logo-original.png')); ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?php echo e($post->published_at?->toIso8601String() ?? $post->created_at->toIso8601String()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('schema'); ?>
<?php if (isset($component)) { $__componentOriginal9f9fbfe657b101279de04e6aabe5da16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f9fbfe657b101279de04e6aabe5da16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-breadcrumb','data' => ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Blog', 'url' => route('blog.index')],
    ['name' => $post->title, 'url' => route('blog.show', $post->slug)],
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Blog', 'url' => route('blog.index')],
    ['name' => $post->title, 'url' => route('blog.show', $post->slug)],
])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f9fbfe657b101279de04e6aabe5da16)): ?>
<?php $attributes = $__attributesOriginal9f9fbfe657b101279de04e6aabe5da16; ?>
<?php unset($__attributesOriginal9f9fbfe657b101279de04e6aabe5da16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f9fbfe657b101279de04e6aabe5da16)): ?>
<?php $component = $__componentOriginal9f9fbfe657b101279de04e6aabe5da16; ?>
<?php unset($__componentOriginal9f9fbfe657b101279de04e6aabe5da16); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative py-24 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="<?php echo e(route('blog.index')); ?>" class="hover:text-white">Blog</a>
                <span class="mx-2">/</span>
                <span><?php echo e($post->title); ?></span>
            </nav>
            <time class="text-white/80 text-sm"><?php echo e($post->published_at?->format('F j, Y') ?? $post->created_at->format('F j, Y')); ?></time>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 mb-6"><?php echo e($post->title); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
            <p class="text-xl text-white/90"><?php echo e($post->excerpt); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->featured_image): ?>
            <div class="mb-12 rounded-xl overflow-hidden">
                <img src="<?php echo e($post->featured_image_url); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-auto" loading="eager">
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="prose prose-lg dark:prose-invert max-w-none
                prose-headings:font-serif prose-headings:text-[#003366] dark:prose-headings:text-white prose-headings:font-bold
                prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:pb-2 prose-h2:border-b prose-h2:border-[#336699]/20
                prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                prose-h4:text-lg prose-h4:mt-6 prose-h4:mb-2
                prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                prose-a:text-[#336699] dark:prose-a:text-[#4a90e2] prose-a:no-underline hover:prose-a:underline prose-a:font-medium
                prose-blockquote:border-l-[#336699] prose-blockquote:bg-[#003366]/5 dark:prose-blockquote:bg-[#336699]/10 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:italic prose-blockquote:text-gray-700 dark:prose-blockquote:text-gray-300
                prose-ul:my-4 prose-ol:my-4 prose-li:my-1
                prose-img:rounded-lg prose-img:shadow-md prose-img:w-full
                prose-strong:text-[#003366] dark:prose-strong:text-white">
                <?php echo $post->rendered_content; ?>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-4">Ready to Start Your Project?</h2>
            <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center bg-[#003366] text-white px-8 py-4 rounded-lg hover:bg-[#336699] transition-all font-medium">
                <?php echo e($hero['cta_text']); ?>

            </a>
        </div>
    </section>

    <!-- Related Posts -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedPosts->isNotEmpty()): ?>
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8">Related Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('blog.show', $related->slug)); ?>" class="block group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->featured_image): ?>
                    <div class="aspect-[16/9] rounded-lg overflow-hidden mb-3">
                        <img src="<?php echo e($related->featured_image_url); ?>" alt="<?php echo e($related->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white group-hover:text-[#336699]"><?php echo e($related->title); ?></h3>
                    <time class="text-sm text-gray-500"><?php echo e($related->published_at?->format('M j, Y') ?? $related->created_at->format('M j, Y')); ?></time>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/blog/show.blade.php ENDPATH**/ ?>