<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Project Evaluation — Blue Draft'); ?></title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=playfair-display:400,500,600,700" rel="stylesheet" />
    <script>
        (function() {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', prefersDark);
        })();
    </script>
    <?php
        $manifestPath = public_path('build/manifest.json');
        $useProductionAssets = file_exists($manifestPath);
    ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($useProductionAssets): ?>
        <?php $manifest = json_decode(file_get_contents($manifestPath), true); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($manifest['resources/css/app.css']['file'])): ?>
            <link rel="stylesheet" href="<?php echo e(asset('build/' . $manifest['resources/css/app.css']['file'])); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($manifest['resources/js/app.js']['file'])): ?>
            <script type="module" src="<?php echo e(asset('build/' . $manifest['resources/js/app.js']['file'])); ?>"></script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php else: ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <style>
        html { scroll-behavior: smooth; }
        .presentation-section { scroll-margin-top: 6rem; }
        [x-cloak] { display: none !important; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="antialiased bg-white dark:bg-gray-900 text-[#003366] dark:text-gray-100 font-sans transition-colors duration-300">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-[#CCCC99]/20 dark:border-gray-700/30 shadow-sm transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-2 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white font-medium text-sm uppercase tracking-wider transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Site
            </a>
            <nav class="hidden sm:flex flex-wrap gap-1">
                <a href="#summary" class="px-3 py-1.5 rounded-lg text-[#003366]/80 dark:text-gray-400 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-white/5 text-sm font-medium transition-colors">Summary</a>
                <a href="#modules" class="px-3 py-1.5 rounded-lg text-[#003366]/80 dark:text-gray-400 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-white/5 text-sm font-medium transition-colors">Modules</a>
                <a href="#metrics" class="px-3 py-1.5 rounded-lg text-[#003366]/80 dark:text-gray-400 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-white/5 text-sm font-medium transition-colors">Metrics</a>
                <a href="#evaluation" class="px-3 py-1.5 rounded-lg text-[#003366]/80 dark:text-gray-400 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-white/5 text-sm font-medium transition-colors">Evaluation</a>
                <a href="#conclusion" class="px-3 py-1.5 rounded-lg text-[#003366]/80 dark:text-gray-400 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-white/5 text-sm font-medium transition-colors">Conclusion</a>
            </nav>
        </div>
    </header>

    <main class="pt-24 pb-20">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-[#003366] dark:bg-gray-900 text-[#CCCC99] dark:text-gray-400 py-8 text-center text-sm transition-colors duration-300">
        <p>&copy; <?php echo e(date('Y')); ?> Blue Draft — Confidential evaluation for client presentation</p>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\projects\blue_draft_pro\resources\views/layouts/presentation.blade.php ENDPATH**/ ?>