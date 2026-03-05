

<?php $__env->startPush('tracking_data'); ?>
<script>window.__trackingData = { page_type: 'lead_magnet', content_name: 'free_renovation_guide' };</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Free NYC Renovation Guide | Blue Draft'); ?>
<?php $__env->startSection('meta_description', 'Download our free guide: essential tips for kitchen remodeling, bathroom renovation, and home improvement in New York City.'); ?>

<?php $__env->startPush('meta'); ?>
    <link rel="canonical" href="<?php echo e(route('lead-magnet.show')); ?>">
    <meta property="og:title" content="Free NYC Renovation Guide | Blue Draft">
    <meta property="og:description" content="Essential tips for kitchen remodeling, bathroom renovation, and home improvement in NYC.">
    <meta property="og:url" content="<?php echo e(route('lead-magnet.show')); ?>">
    <meta property="og:type" content="website">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('schema'); ?>
<?php if (isset($component)) { $__componentOriginal9f9fbfe657b101279de04e6aabe5da16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f9fbfe657b101279de04e6aabe5da16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-breadcrumb','data' => ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Free Renovation Guide', 'url' => route('lead-magnet.show')],
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Free Renovation Guide', 'url' => route('lead-magnet.show')],
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
<section class="relative py-24 bg-gradient-to-br from-[#003366] to-[#336699] min-h-[60vh] flex items-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
        <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <span>Free Renovation Guide</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">
            Free NYC Renovation Guide
        </h1>
        <p class="text-xl text-white/90 mb-8">
            Essential tips for kitchen remodeling, bathroom renovation, and home improvement in New York City.
        </p>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 md:p-10 text-left">
            <form action="<?php echo e(route('lead-magnet.submit')); ?>" method="POST" class="space-y-6" data-tracking="lead_magnet">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Email *</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo e(old('email')); ?>"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent"
                           placeholder="you@example.com">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Name (optional)</label>
                    <input type="text" id="name" name="name"
                           value="<?php echo e(old('name')); ?>"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-[#003366] dark:text-gray-100 focus:ring-2 focus:ring-[#336699] focus:border-transparent"
                           placeholder="Your name">
                </div>
                <button type="submit"
                        class="w-full bg-[#003366] dark:bg-[#336699] text-white px-6 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg">
                    Get Free Guide
                </button>
            </form>
        </div>

        <p class="mt-6 text-sm text-white/70">
            No spam. Unsubscribe anytime. We respect your privacy.
        </p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/pages/lead-magnet.blade.php ENDPATH**/ ?>