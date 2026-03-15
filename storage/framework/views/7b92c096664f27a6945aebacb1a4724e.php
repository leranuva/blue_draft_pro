<?php $__env->startSection('title', 'Blue Draft - Expert Construction Solutions'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section - Minimalist & Elegant with Reveal Animation -->
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden <?php echo e($hero['background_image'] ? '' : 'bg-gradient-to-b from-[#CCCC99] via-white to-[#f5f5f0]'); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hero['background_image']): ?>
            <!-- Background Image Container with Overlays -->
            <div class="absolute inset-0 z-0">
                <!-- Background Image -->
                <img src="<?php echo e(Storage::disk('public')->url($hero['background_image'])); ?>" 
                     alt="Hero Background" 
                     class="absolute inset-0 w-full h-full object-cover"
                     style="z-index: 1;">
                <!-- Overlay oscuro para mejor legibilidad - suave -->
                <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.4); z-index: 2; pointer-events: none;"></div>
                <!-- Overlay adicional con color de marca para mantener la identidad visual -->
                <div class="absolute inset-0" style="background: linear-gradient(to bottom right, rgba(0, 51, 102, 0.3), rgba(0, 51, 102, 0.25), rgba(51, 102, 153, 0.25)); z-index: 3; pointer-events: none;"></div>
            </div>
        <?php else: ?>
            <!-- Default Gradient Background -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-96 h-96 bg-[#336699] rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#003366] rounded-full blur-3xl"></div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20" style="z-index: 10; position: relative;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-left reveal">
                    <div class="inline-block mb-6">
                        <span class="text-sm font-medium text-white uppercase tracking-wider"><?php echo e($hero['badge']); ?></span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-4 leading-tight">
                        <?php echo e($hero['title_line1']); ?><br><?php echo e($hero['title_line2']); ?>

                    </h1>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($hero['subtitle'])): ?>
                    <p class="text-xl md:text-2xl text-white/95 font-medium mb-4">
                        <?php echo e($hero['subtitle']); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p class="text-lg text-white/90 mb-8 leading-relaxed max-w-xl">
                        <?php echo e($hero['description']); ?>

                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contact" class="group bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg inline-flex items-center justify-center shadow-lg">
                            <?php echo e($hero['cta_text']); ?>

                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="tel:<?php echo e(str_replace(['.', ' ', '-'], '', $hero['phone'])); ?>" class="text-white hover:text-[#CCCC99] px-8 py-4 rounded-lg border-2 border-white/50 hover:border-white transition-all font-medium text-lg inline-flex items-center justify-center backdrop-blur-sm bg-white/10">
                            <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <?php echo e($hero['phone_display']); ?>

                        </a>
                    </div>
                </div>
                
                <!-- Right Image/Placeholder -->
                <div class="relative hidden lg:block reveal" style="z-index: 10; position: relative;">
                    <div class="relative aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hero['placeholder_image']): ?>
                            <!-- Mostrar imagen de fondo si está configurada -->
                            <img src="<?php echo e(Storage::disk('public')->url($hero['placeholder_image'])); ?>" 
                                 alt="<?php echo e($hero['image_text']); ?>" 
                                 class="absolute inset-0 w-full h-full object-cover z-0">
                            <!-- Overlay para mejorar visibilidad del SVG y texto -->
                            <div class="absolute inset-0 bg-black/60 z-[1]" style="background-color: rgba(0, 0, 0, 0.6);"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-[#003366]/50 via-[#003366]/40 to-[#336699]/40 z-[1]" style="background: linear-gradient(to bottom right, rgba(0, 51, 102, 0.5), rgba(0, 51, 102, 0.4), rgba(51, 102, 153, 0.4));"></div>
                        <?php else: ?>
                            <!-- Gradiente de fondo si no hay imagen -->
                            <div class="absolute inset-0 bg-gradient-to-br from-[#336699] to-[#003366] z-0"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- SVG y texto siempre visibles encima -->
                        <div class="absolute inset-0 flex items-center justify-center z-[2]" style="z-index: 2;">
                            <div class="text-center text-white">
                                <svg class="w-24 h-24 mx-auto mb-4 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.5));">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($hero['image_svg_path']); ?>"></path>
                                </svg>
                                <p class="text-lg font-medium text-white drop-shadow-lg"><?php echo e($hero['image_text']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- About Section - Clean & Spacious with Reveal -->
    <section id="about" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block"><?php echo e($about['badge']); ?></span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6"><?php echo e($about['title']); ?></h2>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <h3 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-6"><?php echo e($about['subtitle']); ?></h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                        <?php echo e($about['description_1']); ?>

                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                        <?php echo e($about['description_2']); ?>

                    </p>
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#003366] dark:text-white mb-1"><?php echo e($about['stat_years']); ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Years Experience</div>
                        </div>
                        <div class="w-px h-12 bg-[#CCCC99] dark:bg-gray-600"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#003366] dark:text-white mb-1"><?php echo e($about['stat_projects']); ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Projects Completed</div>
                        </div>
                        <div class="w-px h-12 bg-[#CCCC99] dark:bg-gray-600"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#003366] dark:text-white mb-1"><?php echo e($about['stat_satisfaction']); ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Satisfaction</div>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($about['stat_borough'])): ?>
                    <p class="mt-6 text-lg font-semibold text-[#003366] dark:text-[#4a90e2]">
                        <?php echo e($about['stat_borough']); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <div class="relative reveal">
                    <div class="aspect-square rounded-2xl overflow-hidden shadow-xl">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($about['image']): ?>
                            <!-- Mostrar imagen si está configurada -->
                            <img src="<?php echo e(Storage::disk('public')->url($about['image'])); ?>" loading="lazy" 
                                 alt="<?php echo e($about['image_text']); ?>" 
                                 class="absolute inset-0 w-full h-full object-cover" style="z-index: 0;">
                            <!-- Overlay para mejorar visibilidad del SVG y texto -->
                            <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.4); z-index: 1; pointer-events: none;"></div>
                            <div class="absolute inset-0" style="background: linear-gradient(to bottom right, rgba(0, 51, 102, 0.3), rgba(0, 51, 102, 0.25), rgba(51, 102, 153, 0.3)); z-index: 1; pointer-events: none;"></div>
                        <?php else: ?>
                            <!-- Gradiente de fondo si no hay imagen -->
                            <div class="absolute inset-0 bg-gradient-to-br from-[#CCCC99] to-[#336699]" style="z-index: 0;"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- SVG y texto siempre visibles encima -->
                        <div class="absolute inset-0 flex items-center justify-center" style="z-index: 2;">
                            <div class="text-center text-white">
                                <svg class="w-32 h-32 mx-auto mb-4 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.5));">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo e($about['image_svg_path']); ?>"></path>
                                </svg>
                                <p class="text-lg font-medium text-white drop-shadow-lg"><?php echo e($about['image_text']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Projects Section - Portfolio Style with Filters and Before/After -->
    <section id="projects" class="py-24 bg-[#CCCC99]/20 dark:bg-gray-800/50 transition-colors duration-300" x-data="{ activeFilter: 'all', selectedProject: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Our Work</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6">Our Projects</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    Explore our portfolio of successful construction projects
                </p>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-12 reveal">
                <button @click="activeFilter = 'all'" 
                        :class="activeFilter === 'all' ? 'bg-[#003366] dark:bg-[#336699] text-white' : 'bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm text-[#003366] dark:text-gray-200 hover:bg-white dark:hover:bg-gray-700'"
                        class="px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm">
                    All Projects
                </button>
                <button @click="activeFilter = 'residential'" 
                        :class="activeFilter === 'residential' ? 'bg-[#003366] dark:bg-[#336699] text-white' : 'bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm text-[#003366] dark:text-gray-200 hover:bg-white dark:hover:bg-gray-700'"
                        class="px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm">
                    Residential
                </button>
                <button @click="activeFilter = 'commercial'" 
                        :class="activeFilter === 'commercial' ? 'bg-[#003366] dark:bg-[#336699] text-white' : 'bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm text-[#003366] dark:text-gray-200 hover:bg-white dark:hover:bg-gray-700'"
                        class="px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm">
                    Commercial
                </button>
                <button @click="activeFilter = 'renovation'" 
                        :class="activeFilter === 'renovation' ? 'bg-[#003366] dark:bg-[#336699] text-white' : 'bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm text-[#003366] dark:text-gray-200 hover:bg-white dark:hover:bg-gray-700'"
                        class="px-6 py-2.5 rounded-lg font-medium text-sm transition-all shadow-sm">
                    Renovation
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->image_before && $project->image_after): ?>
                        <!-- Project with Before/After Slider -->
                        <div x-show="activeFilter === 'all' || activeFilter === '<?php echo e($project->category); ?>'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="group project-card bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300" 
                             x-data="{ sliderPosition: 50 }">
                            <a href="<?php echo e(route('projects.show', $project->slug ?? $project->id)); ?>" class="block">
                            <div class="aspect-[4/3] relative overflow-hidden">
                                <div class="relative w-full h-full">
                                    <!-- After Image -->
                                    <img src="<?php echo e($project->image_after ? Storage::disk('public')->url($project->image_after) : '#'); ?>" 
                                         alt="<?php echo e($project->title); ?>" 
                                         class="absolute inset-0 w-full h-full object-cover" loading="lazy"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="absolute inset-0 bg-gradient-to-br from-[#CCCC99] to-[#336699] hidden items-center justify-center">
                                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <!-- Before Image -->
                                    <img src="<?php echo e($project->image_before ? Storage::disk('public')->url($project->image_before) : '#'); ?>" 
                                         alt="<?php echo e($project->title); ?> - Before" 
                                         class="absolute inset-0 w-full h-full object-cover" loading="lazy" 
                                         :style="`clip-path: inset(0 ${100 - sliderPosition}% 0 0);`"
                                         onerror="this.style.display='none';">
                                    <div class="absolute inset-0 bg-gradient-to-br from-gray-400 to-gray-600 hidden" 
                                         :style="`clip-path: inset(0 ${100 - sliderPosition}% 0 0);`"></div>
                                    <!-- Slider Handle -->
                                    <div class="absolute inset-0 cursor-ew-resize" 
                                         @mousemove="if ($event.buttons === 1) { sliderPosition = Math.max(0, Math.min(100, ($event.offsetX / $event.currentTarget.offsetWidth) * 100)) }"
                                         @touchmove.prevent="sliderPosition = Math.max(0, Math.min(100, ($event.touches[0].clientX - $event.currentTarget.getBoundingClientRect().left) / $event.currentTarget.offsetWidth * 100))">
                                        <div class="absolute top-0 bottom-0 w-0.5 bg-white shadow-lg" 
                                             :style="`left: ${sliderPosition}%`">
                                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-[#003366]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-medium text-[#003366] shadow-sm capitalize"><?php echo e($project->category); ?></span>
                                    </div>
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <span class="bg-white/90 backdrop-blur-md px-2 py-1 rounded text-xs font-medium text-[#003366] shadow-sm">Before</span>
                                        <span class="bg-white/90 backdrop-blur-md px-2 py-1 rounded text-xs font-medium text-[#003366] shadow-sm">After</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-2"><?php echo e($project->title); ?></h3>
                                <p class="text-gray-600 dark:text-gray-300"><?php echo e($project->description ?? 'Transform your existing space with expert renovation services. Drag to see before/after.'); ?></p>
                            </div>
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Regular Project Card -->
                        <a href="<?php echo e(route('projects.show', $project->slug ?? $project->id)); ?>">
                        <div x-show="activeFilter === 'all' || activeFilter === '<?php echo e($project->category); ?>'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="group project-card bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                            <div class="aspect-[4/3] bg-gradient-to-br from-[#336699] to-[#003366] relative overflow-hidden">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->image_after): ?>
                                    <img src="<?php echo e(Storage::disk('public')->url($project->image_after)); ?>" alt="<?php echo e($project->title); ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white text-sm"><?php echo e($project->description ?? 'Custom construction project with precision and attention to detail.'); ?></p>
                                </div>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-medium text-[#003366] shadow-sm capitalize"><?php echo e($project->category); ?></span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-2"><?php echo e($project->title); ?></h3>
                                <p class="text-gray-600 dark:text-gray-300"><?php echo e($project->description ?? 'Custom construction project with precision and attention to detail.'); ?></p>
                            </div>
                        </div>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">No projects available yet. Check back soon!</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="text-center mt-16 reveal">
                <a href="#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-8 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg shadow-lg">
                    <?php echo e($hero['cta_text']); ?>

                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Services Section - Clean Cards -->
    <section id="services" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block"><?php echo e($services['badge']); ?></span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6"><?php echo e($services['title']); ?></h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    <?php echo e($services['description']); ?>

                </p>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($services['service1']['svg_path']); ?>"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-4"><?php echo e($services['service1']['title']); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?php echo e($services['service1']['description']); ?>

                    </p>
                </div>
                
                <!-- Service Card 2 -->
                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($services['service2']['svg_path']); ?>"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-4"><?php echo e($services['service2']['title']); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?php echo e($services['service2']['description']); ?>

                    </p>
                </div>
                
                <!-- Service Card 3 -->
                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($services['service3']['svg_path']); ?>"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-4"><?php echo e($services['service3']['title']); ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?php echo e($services['service3']['description']); ?>

                    </p>
                </div>
            </div>
            
            <div class="text-center mt-16 reveal">
                <a href="#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-8 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg shadow-lg">
                    <?php echo e($hero['cta_text']); ?>

                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Process Section - 4 Steps -->
    <section id="process" class="py-24 bg-[#CCCC99]/20 dark:bg-gray-800/50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">How It Works</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6">Our Simple 4-Step Process</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    From consultation to completion, we make it easy
                </p>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl">1</div>
                    <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-3">Contact Us</h3>
                    <p class="text-gray-600 dark:text-gray-300">Get your free quote in minutes. No obligation.</p>
                </div>
                <div class="text-center reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl">2</div>
                    <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-3">Consultation</h3>
                    <p class="text-gray-600 dark:text-gray-300">We discuss your project and provide a detailed estimate.</p>
                </div>
                <div class="text-center reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl">3</div>
                    <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-3">Agreement</h3>
                    <p class="text-gray-600 dark:text-gray-300">Clear timeline and contract. No surprises.</p>
                </div>
                <div class="text-center reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#336699] to-[#003366] rounded-full flex items-center justify-center mx-auto mb-6 text-white font-bold text-2xl">4</div>
                    <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-3">Construction</h3>
                    <p class="text-gray-600 dark:text-gray-300">Quality work delivered on time. Guaranteed.</p>
                </div>
            </div>
            
            <div class="text-center mt-16 reveal">
                <a href="#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-8 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg shadow-lg">
                    <?php echo e($hero['cta_text']); ?>

                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Guarantee Section -->
    <section class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full mb-6">
                <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-[#003366] dark:text-white mb-6">100% Satisfaction Guarantee</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                We stand behind our work. If you're not completely satisfied with our construction services, we'll make it right. Your peace of mind is our priority.
            </p>
            <a href="#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-8 py-4 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-lg shadow-lg">
                <?php echo e($hero['cta_text']); ?>

                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </section>
    
    <!-- Testimonials Section - Customer Reviews -->
    <section id="testimonials" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block"><?php echo e($testimonials['badge']); ?></span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6"><?php echo e($testimonials['title']); ?></h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    <?php echo e($testimonials['description']); ?>

                </p>
                <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-[#003366] dark:text-white font-medium mb-6">
                    <span><?php echo e($about['stat_projects'] ?? '200+'); ?> projects completed</span>
                    <span><?php echo e($about['stat_years'] ?? '15+'); ?> years in business</span>
                    <span><?php echo e($about['stat_rating'] ?? '4.9/5'); ?> average rating</span>
                </div>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="relative" x-data="{ currentSlide: 0, testimonials: [
                {
                    name: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['name'])->toHtml() ?>,
                    role: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['role'])->toHtml() ?>,
                    project: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['project'])->toHtml() ?>,
                    rating: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['rating'])->toHtml() ?>,
                    text: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['text'])->toHtml() ?>,
                    image: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial1']['image'])->toHtml() ?>
                },
                {
                    name: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['name'])->toHtml() ?>,
                    role: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['role'])->toHtml() ?>,
                    project: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['project'])->toHtml() ?>,
                    rating: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['rating'])->toHtml() ?>,
                    text: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['text'])->toHtml() ?>,
                    image: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial2']['image'])->toHtml() ?>
                },
                {
                    name: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['name'])->toHtml() ?>,
                    role: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['role'])->toHtml() ?>,
                    project: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['project'])->toHtml() ?>,
                    rating: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['rating'])->toHtml() ?>,
                    text: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['text'])->toHtml() ?>,
                    image: <?php echo \Illuminate\Support\Js::from($testimonials['testimonial3']['image'])->toHtml() ?>
                }
            ]}">
                <!-- Testimonials Container -->
                <div class="relative overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out" 
                         :style="`transform: translateX(-${currentSlide * 100}%)`">
                        <template x-for="(testimonial, index) in testimonials" :key="index">
                            <div class="min-w-full px-4">
                                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl p-8 md:p-12 shadow-xl max-w-4xl mx-auto">
                                    <div class="flex items-center mb-6">
                                        <div class="text-6xl mr-6" x-text="testimonial.image"></div>
                                        <div>
                                            <h4 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-1" x-text="testimonial.name"></h4>
                                            <p class="text-gray-600 dark:text-gray-300" x-text="testimonial.role"></p>
                                            <p class="text-sm text-[#336699] font-medium" x-text="testimonial.project"></p>
                                        </div>
                                    </div>
                                    <div class="flex mb-4">
                                        <template x-for="i in testimonial.rating">
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </template>
                                    </div>
                                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed" x-text="testimonial.text"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Navigation Arrows -->
                <button @click="currentSlide = (currentSlide - 1 + testimonials.length) % testimonials.length"
                        class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-700 transition-all z-10">
                    <svg class="w-6 h-6 text-[#003366] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % testimonials.length"
                        class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-700 transition-all z-10">
                    <svg class="w-6 h-6 text-[#003366] dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Dots Indicator -->
                <div class="flex justify-center gap-2 mt-8">
                    <template x-for="(testimonial, index) in testimonials" :key="index">
                        <button @click="currentSlide = index"
                                :class="currentSlide === index ? 'bg-[#003366]' : 'bg-gray-300'"
                                class="w-3 h-3 rounded-full transition-all"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quote Request Section - Multi-Step Form -->
    <section id="quote" class="py-24 bg-gradient-to-b from-white to-[#CCCC99]/20 dark:from-gray-900 dark:to-gray-800/50 transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-8 p-6 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl text-green-800 dark:text-green-200 text-center">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Get Started</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6">Request Your Free Quote</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    Tell us about your project and we'll provide a detailed estimate
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-xl mx-auto mb-2">We respond within 24h. No spam.</p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($contact['schedule_url'])): ?>
                <p class="text-sm mb-4">
                    <a href="<?php echo e($contact['schedule_url']); ?>" target="_blank" rel="noopener" class="text-[#336699] dark:text-[#4a90e2] hover:underline font-medium">Schedule a Call Instead</a>
                </p>
                <?php else: ?>
                <p class="text-sm mb-4">
                    <a href="tel:<?php echo e($contact['phone_link'] ?? '+13476366128'); ?>" class="text-[#336699] dark:text-[#4a90e2] hover:underline font-medium">Prefer to call? <?php echo e($contact['phone'] ?? '+1.3476366128'); ?></a>
                </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-2xl p-8 md:p-12 shadow-2xl" 
                 x-data="{ 
                     currentStep: 1, 
                     totalSteps: 2,
                     partialQuoteId: null,
                     saving: false,
                     quotePrefill: <?php echo \Illuminate\Support\Js::from($quotePrefill ?? [])->toHtml() ?>,
                     formData: {
                         service: '',
                         name: '',
                         email: '',
                         phone: '',
                         address: '',
                         budget: '',
                         timeline: '',
                         property_type: '',
                         message: '',
                         photos: [],
                         calculator_budget_min: '',
                         calculator_budget_max: '',
                         estimated_value: '',
                         calculator_sqft: '',
                         calculator_type: '',
                         calculator_borough: '',
                         calculator_finish_level: '',
                         calculator_algorithm_version: '',
                         calculation_hash: '',
                         from_calculator: false
                     },
                     uploadedFiles: [],
                     init() {
                         if (this.quotePrefill.service) this.formData.service = this.quotePrefill.service;
                         if (this.quotePrefill.budget) this.formData.budget = this.quotePrefill.budget;
                         if (this.quotePrefill.budget_min) { this.formData.calculator_budget_min = this.quotePrefill.budget_min; this.formData.from_calculator = true; }
                         if (this.quotePrefill.budget_max) { this.formData.calculator_budget_max = this.quotePrefill.budget_max; this.formData.from_calculator = true; }
                         if (this.quotePrefill.estimated_value) this.formData.estimated_value = this.quotePrefill.estimated_value;
                         if (this.quotePrefill.calc_sqft) this.formData.calculator_sqft = this.quotePrefill.calc_sqft;
                         if (this.quotePrefill.calc_type) this.formData.calculator_type = this.quotePrefill.calc_type;
                         if (this.quotePrefill.calc_borough) this.formData.calculator_borough = this.quotePrefill.calc_borough;
                         if (this.quotePrefill.calc_finish) this.formData.calculator_finish_level = this.quotePrefill.calc_finish;
                         if (this.quotePrefill.calc_version) this.formData.calculator_algorithm_version = this.quotePrefill.calc_version;
                         if (this.quotePrefill.calculation_hash) this.formData.calculation_hash = this.quotePrefill.calculation_hash;
                     },
                     async nextStep() {
                         if (!this.formData.name || !this.formData.email || !this.formData.service) return;
                         this.saving = true;
                         try {
                             const payload = {
                                 name: this.formData.name,
                                 email: this.formData.email,
                                 service: this.formData.service,
                                 timeline: this.formData.timeline || null,
                                 property_type: this.formData.property_type || null,
                                 from_calculator: this.formData.from_calculator,
                                 calculator_budget_min: this.formData.calculator_budget_min || null,
                                 calculator_budget_max: this.formData.calculator_budget_max || null,
                                 estimated_value: this.formData.estimated_value || null,
                                 calculator_sqft: this.formData.calculator_sqft || null,
                                 calculator_type: this.formData.calculator_type || null,
                                 calculator_borough: this.formData.calculator_borough || null,
                                 calculator_finish_level: this.formData.calculator_finish_level || null,
                                 calculator_algorithm_version: this.formData.calculator_algorithm_version || null,
                                 calculation_hash: this.formData.calculation_hash || null
                             };
                             const res = await fetch('<?php echo e(route('quote.partial')); ?>', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                     'Accept': 'application/json',
                                     'X-Requested-With': 'XMLHttpRequest'
                                 },
                                 body: JSON.stringify(payload)
                             });
                             const data = await res.json();
                             if (data.success && data.quote_id) {
                                 this.partialQuoteId = data.quote_id;
                                 this.currentStep = 2;
                             } else {
                                 alert('Something went wrong. Please try again.');
                             }
                         } catch (e) {
                             alert('Something went wrong. Please try again.');
                         }
                         this.saving = false;
                     },
                     
                     prevStep() {
                         if (this.currentStep > 1) {
                             this.currentStep--;
                         }
                     },
                     
                     handleFileUpload(event) {
                         const files = Array.from(event.target.files);
                         files.forEach(file => {
                             if (file.type.startsWith('image/')) {
                                 this.uploadedFiles.push({
                                     file: file,
                                     preview: URL.createObjectURL(file),
                                     name: file.name,
                                     size: file.size
                                 });
                                 this.formData.photos.push(file);
                             }
                         });
                     },
                     
                     removeFile(index) {
                         if (this.uploadedFiles[index].preview) {
                             URL.revokeObjectURL(this.uploadedFiles[index].preview);
                         }
                         this.uploadedFiles.splice(index, 1);
                         this.formData.photos.splice(index, 1);
                     },
                     
                     handleDrop(event) {
                         event.preventDefault();
                         const files = Array.from(event.dataTransfer.files);
                         files.forEach(file => {
                             if (file.type.startsWith('image/')) {
                                 this.uploadedFiles.push({
                                     file: file,
                                     preview: URL.createObjectURL(file),
                                     name: file.name,
                                     size: file.size
                                 });
                                 this.formData.photos.push(file);
                             }
                         });
                     },
                     
                     handleDragOver(event) {
                         event.preventDefault();
                     }
                 }">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium text-[#003366] dark:text-white">Step <span x-text="currentStep"></span> of <span x-text="totalSteps"></span></span>
                        <span class="text-sm text-gray-500 dark:text-gray-400" x-text="Math.round((currentStep / totalSteps) * 100) + '%'"></span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-[#336699] to-[#003366] dark:from-[#4a90e2] dark:to-[#336699] h-2 rounded-full transition-all duration-300" 
                             :style="`width: ${(currentStep / totalSteps) * 100}%`"></div>
                    </div>
                </div>
                
                <form action="<?php echo e(route('quote.complete')); ?>" method="POST" enctype="multipart/form-data" id="quoteForm" x-ref="quoteForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="quote_id" :value="partialQuoteId" x-model="partialQuoteId">
                    
                    <!-- Step 1: Name, Email, Service Type -->
                    <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6">Let's get started</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Full Name *</label>
                                <input type="text" name="name" x-model="formData.name" required
                                       class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Email Address *</label>
                                <input type="email" name="email" x-model="formData.email" required
                                       class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">What service do you need? *</label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="service" value="residential" x-model="formData.service" @change="formData.service = 'residential'" class="peer sr-only" required>
                                <div class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all peer-checked:border-[#003366] dark:peer-checked:border-[#336699] peer-checked:bg-[#003366]/5 dark:peer-checked:bg-[#336699]/20">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-[#003366] dark:text-white">Residential</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Homes & Renovations</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="service" value="commercial" x-model="formData.service" @change="formData.service = 'commercial'" class="peer sr-only" required>
                                <div class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all peer-checked:border-[#003366] dark:peer-checked:border-[#336699] peer-checked:bg-[#003366]/5 dark:peer-checked:bg-[#336699]/20">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-[#003366] dark:text-white">Commercial</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Business & Offices</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="service" value="renovation" x-model="formData.service" @change="formData.service = 'renovation'" class="peer sr-only" required>
                                <div class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all peer-checked:border-[#003366] dark:peer-checked:border-[#336699] peer-checked:bg-[#003366]/5 dark:peer-checked:bg-[#336699]/20">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-[#003366] dark:text-white">Renovation</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Remodeling & Updates</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="service" value="other" x-model="formData.service" @change="formData.service = 'other'" class="peer sr-only" required>
                                <div class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all peer-checked:border-[#003366] dark:peer-checked:border-[#336699] peer-checked:bg-[#003366]/5 dark:peer-checked:bg-[#336699]/20">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-[#003366] dark:text-white">Other</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Custom Projects</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Timeline</label>
                                <select x-model="formData.timeline" class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                    <option value="">Select timeline</option>
                                    <option value="asap">ASAP</option>
                                    <option value="1-3 months">1–3 months</option>
                                    <option value="3-6 months">3–6 months</option>
                                    <option value="6+ months">6+ months</option>
                                    <option value="planning">Just planning</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Property type</label>
                                <select x-model="formData.property_type" class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                    <option value="">Select property type</option>
                                    <option value="single_family">Single family home</option>
                                    <option value="condo">Condo</option>
                                    <option value="coop">Co-op</option>
                                    <option value="multi_family">Multi-family</option>
                                    <option value="commercial">Commercial</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="nextStep()" 
                                    :disabled="!formData.name || !formData.email || !formData.service || saving"
                                    :class="(formData.name && formData.email && formData.service && !saving) ? 'bg-[#003366] dark:bg-[#336699] hover:bg-[#004080] dark:hover:bg-[#4a90e2]' : 'bg-gray-300 dark:bg-gray-600 cursor-not-allowed'"
                                    class="text-white px-8 py-3 rounded-lg font-medium transition-all">
                                <span x-show="!saving">Next Step →</span>
                                <span x-show="saving" x-cloak>Saving...</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Contact Info + Details -->
                    <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                        <h3 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6">Your Contact Information & Project Details</h3>
                        <div class="space-y-4 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Phone Number</label>
                                    <input type="tel" name="phone" x-model="formData.phone"
                                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Project Address</label>
                                    <input type="text" name="address" x-model="formData.address"
                                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Estimated Budget (Optional)</label>
                                <select name="budget" x-model="formData.budget"
                                        class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                    <option value="">Select budget range</option>
                                    <option value="under-25k">Under $25,000</option>
                                    <option value="25k-50k">$25,000 - $50,000</option>
                                    <option value="50k-100k">$50,000 - $100,000</option>
                                    <option value="over-100k">Over $100,000</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Project Description (Optional)</label>
                                <textarea name="message" x-model="formData.message" rows="4"
                                          class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all"
                                          placeholder="Tell us more about your project..."></textarea>
                            </div>
                            
                            <!-- Drag & Drop File Upload -->
                            <div>
                                <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Upload Photos (Optional)</label>
                                <div @drop.prevent="handleDrop($event)"
                                     @dragover.prevent="handleDragOver($event)"
                                     class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all cursor-pointer"
                                     :class="uploadedFiles.length > 0 ? 'border-[#336699] dark:border-[#4a90e2] bg-[#336699]/5 dark:bg-[#4a90e2]/10' : ''">
                                    <input type="file" name="photos[]" multiple accept="image/*" 
                                           @change="handleFileUpload($event)"
                                           class="hidden" id="photoUpload">
                                    <label for="photoUpload" class="cursor-pointer">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="text-gray-600 dark:text-gray-300 mb-2">
                                            <span class="text-[#336699] dark:text-[#4a90e2] font-medium">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 10MB</p>
                                    </label>
                                </div>
                                
                                <!-- Uploaded Files Preview -->
                                <div x-show="uploadedFiles.length > 0" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <template x-for="(file, index) in uploadedFiles" :key="index">
                                        <div class="relative group">
                                            <img :src="file.preview" :alt="file.name" 
                                                 class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                                            <button type="button" @click="removeFile(index)"
                                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                            <p class="text-xs text-gray-500 mt-1 truncate" x-text="file.name"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        
                        <!-- reCAPTCHA (solo si está configurado) -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recaptchaSiteKey): ?>
                        <div class="mb-6">
                            <div class="g-recaptcha" data-sitekey="<?php echo e($recaptchaSiteKey); ?>"></div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <div class="flex justify-between items-center">
                            <button type="button" @click="prevStep()" 
                                    class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white px-8 py-3 rounded-lg font-medium border-2 border-[#CCCC99] dark:border-gray-600 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all">
                                ← Previous
                            </button>
                            <div class="text-right">
                                <button type="submit" 
                                        :disabled="!partialQuoteId"
                                        :class="partialQuoteId ? 'bg-[#003366] hover:bg-[#004080] dark:bg-[#336699] dark:hover:bg-[#4a90e2]' : 'bg-gray-300 dark:bg-gray-600 cursor-not-allowed'"
                                        class="text-white px-8 py-3 rounded-lg font-medium transition-all">
                                    Submit Request
                                </button>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">We usually respond in under 24 hours</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">No obligation, completely free</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Contact Section - Grid Layout -->
    <section id="contact" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block"><?php echo e($contact['badge']); ?></span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-6"><?php echo e($contact['title']); ?></h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-4">
                    <?php echo e($contact['description']); ?>

                </p>
                <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div class="reveal">
                    <h3 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-8">Contact Information</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#003366] dark:text-white mb-1">Address</h4>
                                <p class="text-gray-600 dark:text-gray-300"><?php echo e($contact['address']); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#003366] dark:text-white mb-1">Phone</h4>
                                <a href="tel:<?php echo e($contact['phone_link']); ?>" class="text-[#336699] dark:text-[#4a90e2] hover:text-[#003366] dark:hover:text-white transition-colors"><?php echo e($contact['phone']); ?></a>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#003366] dark:text-white mb-1">Email</h4>
                                <a href="mailto:<?php echo e($contact['email']); ?>" class="text-[#336699] dark:text-[#4a90e2] hover:text-[#003366] dark:hover:text-white transition-colors"><?php echo e($contact['email']); ?></a>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#003366] dark:text-white mb-1">Business Hours</h4>
                                <p class="text-gray-600 dark:text-gray-300"><?php echo e($contact['hours']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="reveal">
                    <h3 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-8"><?php echo e($contact['form_title']); ?></h3>
                    <form action="<?php echo e(route('contact.submit')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Name *</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Email *</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Service Type *</label>
                            <select name="service" required
                                    class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all">
                                <option value="">Select a service</option>
                                <option value="residential">Residential Construction</option>
                                <option value="commercial">Commercial Construction</option>
                                <option value="renovation">Renovation & Remodeling</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#003366] dark:text-gray-200 mb-2">Message</label>
                            <textarea name="message" rows="5"
                                      class="w-full px-4 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border-2 border-gray-200 dark:border-gray-700 rounded-lg focus:border-[#336699] dark:focus:border-[#4a90e2] focus:outline-none transition-all"></textarea>
                        </div>
                        
                        <!-- reCAPTCHA (solo si está configurado) -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recaptchaSiteKey): ?>
                        <div>
                            <div class="g-recaptcha" data-sitekey="<?php echo e($recaptchaSiteKey); ?>"></div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <button type="submit" 
                                class="w-full bg-[#003366] dark:bg-[#336699] hover:bg-[#004080] dark:hover:bg-[#4a90e2] text-white px-8 py-4 rounded-lg font-medium text-lg transition-all">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Google Maps -->
            <div class="mt-16 reveal">
                <div class="rounded-2xl overflow-hidden shadow-2xl" style="height: 400px;">
                    <iframe src="<?php echo e($contact['google_maps_embed_url'] ?? $contact['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.184133583885!2d-73.94482368459418!3d40.67834397932778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae6c5b3b3b%3A0x8b5e5e5e5e5e5e5e!2sBrooklyn%2C%20NY%2C%20USA!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus'); ?>" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Blue Draft Location"></iframe>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projects\blue_draft_pro\resources\views/home.blade.php ENDPATH**/ ?>