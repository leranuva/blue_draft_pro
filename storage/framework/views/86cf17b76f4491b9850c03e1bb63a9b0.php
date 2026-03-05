

<?php $__env->startSection('title', $service->seo_title ?: $service->title . ' | Blue Draft'); ?>
<?php $__env->startSection('meta_description', $service->seo_description); ?>

<?php $__env->startPush('tracking_data'); ?>
<script>window.__trackingData = { service_slug: '<?php echo e($service->slug); ?>', service_title: '<?php echo e(addslashes($service->title)); ?>' };</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('services.show', $service->slug)); ?>">
    <meta property="og:title" content="<?php echo e($service->seo_title ?: $service->title . ' | Blue Draft'); ?>">
    <meta property="og:description" content="<?php echo e(Str::limit($service->seo_description ?? $service->hero_subtitle ?? $service->title, 160)); ?>">
    <meta property="og:url" content="<?php echo e(route('services.show', $service->slug)); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/logo-original.png')); ?>">
    <meta property="og:type" content="website">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('schema'); ?>
<?php if (isset($component)) { $__componentOriginal9f9fbfe657b101279de04e6aabe5da16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f9fbfe657b101279de04e6aabe5da16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-breadcrumb','data' => ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Services', 'url' => route('home') . '#services'],
    ['name' => $service->title, 'url' => route('services.show', $service->slug)],
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Services', 'url' => route('home') . '#services'],
    ['name' => $service->title, 'url' => route('services.show', $service->slug)],
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
<?php if (isset($component)) { $__componentOriginal30f1a3333d91642339db71e3785856bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30f1a3333d91642339db71e3785856bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-service','data' => ['service' => $service]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-service'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['service' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30f1a3333d91642339db71e3785856bc)): ?>
<?php $attributes = $__attributesOriginal30f1a3333d91642339db71e3785856bc; ?>
<?php unset($__attributesOriginal30f1a3333d91642339db71e3785856bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30f1a3333d91642339db71e3785856bc)): ?>
<?php $component = $__componentOriginal30f1a3333d91642339db71e3785856bc; ?>
<?php unset($__componentOriginal30f1a3333d91642339db71e3785856bc); ?>
<?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($service->faq_json) && count($service->faq_json) > 0): ?>
<?php if (isset($component)) { $__componentOriginalff01659efe7d00432b9a60d5c292949f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff01659efe7d00432b9a60d5c292949f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-faq','data' => ['faqs' => $service->faq_json]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-faq'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['faqs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($service->faq_json)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff01659efe7d00432b9a60d5c292949f)): ?>
<?php $attributes = $__attributesOriginalff01659efe7d00432b9a60d5c292949f; ?>
<?php unset($__attributesOriginalff01659efe7d00432b9a60d5c292949f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff01659efe7d00432b9a60d5c292949f)): ?>
<?php $component = $__componentOriginalff01659efe7d00432b9a60d5c292949f; ?>
<?php unset($__componentOriginalff01659efe7d00432b9a60d5c292949f); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <section class="relative py-32 bg-gradient-to-br from-[#003366] to-[#336699] dark:from-[#003366] dark:to-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4">
                <?php echo e($service->hero_title ?: $service->title); ?>

            </h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->hero_subtitle): ?>
            <p class="text-xl text-white/90 mb-8"><?php echo e($service->hero_subtitle); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg shadow-lg">
                <?php echo e($hero['cta_text']); ?>

                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->content): ?>
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300">
                <?php echo nl2br(e($service->content)); ?>

            </div>
            <?php else: ?>
            <p class="text-xl text-gray-600 dark:text-gray-300">Content coming soon. <a href="<?php echo e(route('home')); ?>#quote" class="text-[#336699] hover:underline">Get a free quote</a>.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- FAQs -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($service->faq_json) && count($service->faq_json) > 0): ?>
    <section class="py-24 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-12 text-center">Frequently Asked Questions</h2>
            <div class="space-y-6" x-data="{ open: null }">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $service->faq_json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <button @click="open = open === <?php echo e($index); ?> ? null : <?php echo e($index); ?>" class="w-full text-left flex justify-between items-center">
                        <span class="font-semibold text-[#003366] dark:text-white"><?php echo e($faq['question'] ?? ''); ?></span>
                        <svg class="w-5 h-5 text-[#336699] transition-transform" :class="open === <?php echo e($index); ?> ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open === <?php echo e($index); ?>" x-transition class="mt-4 text-gray-600 dark:text-gray-300">
                        <?php echo nl2br(e($faq['answer'] ?? '')); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Internal Linking: Related Services, Projects, Pillar -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedServices->isNotEmpty() || $relatedProjects->isNotEmpty()): ?>
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Explore More</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if($relatedServices->isNotEmpty()): ?>
                <div class="space-y-3">
                    <h3 class="font-semibold text-[#003366] dark:text-white">Related Services</h3>
                    <ul class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('services.show', $rs->slug)); ?>" class="text-[#336699] hover:underline"><?php echo e($rs->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProjects->isNotEmpty()): ?>
                <div class="space-y-3">
                    <h3 class="font-semibold text-[#003366] dark:text-white">Related Projects</h3>
                    <ul class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $relatedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('projects.show', $rp->slug ?? $rp->id)); ?>" class="text-[#336699] hover:underline"><?php echo e($rp->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('pillar.nyc')); ?>" class="inline-flex items-center text-[#336699] font-medium hover:underline">
                    Construction Company New York →
                </a>
            </div>
        </div>
    </section>
    <?php else: ?>
    <section class="py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <a href="<?php echo e(route('pillar.nyc')); ?>" class="text-[#336699] font-medium hover:underline">Construction Company New York →</a>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Related Projects -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->isNotEmpty()): ?>
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-12 text-center">Related Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('projects.show', $project->slug ?? $project->id)); ?>" class="group block bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->image_after): ?>
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="<?php echo e(Storage::disk('public')->url($project->image_after)); ?>" alt="<?php echo e($project->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="p-6">
                        <span class="text-xs font-medium text-[#336699] uppercase tracking-wider"><?php echo e($project->category); ?></span>
                        <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mt-2 group-hover:text-[#336699]"><?php echo e($project->title); ?></h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->description): ?>
                        <p class="text-gray-600 dark:text-gray-300 mt-2 line-clamp-2"><?php echo e(Str::limit($project->description, 100)); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-center mt-12">
                <a href="<?php echo e(route('home')); ?>#projects" class="text-[#336699] dark:text-[#4a90e2] font-medium hover:underline">View all projects →</a>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- CTA -->
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-white/90 mb-8">Get your free estimate today. We usually respond within 24 hours.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo e(route('home')); ?>#quote" class="inline-flex items-center justify-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                    <?php echo e($hero['cta_text']); ?>

                </a>
                <a href="tel:<?php echo e($contact['phone_link']); ?>" class="inline-flex items-center justify-center border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white/10 transition-all font-medium text-lg">
                    Call <?php echo e($contact['phone']); ?>

                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/services/show.blade.php ENDPATH**/ ?>