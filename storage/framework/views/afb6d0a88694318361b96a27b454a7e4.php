<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div style="padding: 1.5rem; max-width: 100%;">
        <!-- Welcome Section -->
        <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <div style="flex-shrink: 0;">
                    <div style="width: 4rem; height: 4rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #111827; margin: 0;">
                        Welcome to Blue Draft Administration Panel
                    </h2>
                    <p style="color: #4b5563; margin-top: 0.5rem; margin: 0;">
                        Manage all your website content from one place
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <!-- Hero Settings -->
            <a href="<?php echo e(route('filament.admin.pages.hero-settings')); ?>" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #dbeafe; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Hero Settings
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Configure the main section of your site
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Projects -->
            <a href="<?php echo e(route('filament.admin.resources.projects.index')); ?>" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #d1fae5; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Projects
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Manage your project gallery
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Quotes -->
            <a href="<?php echo e(route('filament.admin.resources.quotes.index')); ?>" style="text-decoration: none; color: inherit;">
                <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem; transition: box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <div style="width: 3rem; height: 3rem; background: #f3e8ff; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: #9333ea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                Quotes
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; margin-top: 0.25rem; margin: 0;">
                                Review quote requests
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Information Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <!-- What is this Dashboard -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem;">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem; margin-top: 0; display: flex; align-items: center;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #003366; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    What is this Dashboard?
                </h3>
                <p style="color: #4b5563; font-size: 0.875rem; line-height: 1.5; margin: 0;">
                    This is the administration panel for <strong>Blue Draft Corporation</strong>. From here you can manage all your website content without technical knowledge. You can update texts, images, projects, and review quote requests from your clients.
                </p>
            </div>

            <!-- Quick Guide -->
            <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; padding: 1.5rem;">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 0.75rem; margin-top: 0; display: flex; align-items: center;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #003366; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Quick Guide
                </h3>
                <ul style="color: #4b5563; font-size: 0.875rem; list-style: none; padding: 0; margin: 0;">
                    <li style="display: flex; align-items: start; margin-bottom: 0.5rem;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Site Settings:</strong> Configure the content of each site section</span>
                    </li>
                    <li style="display: flex; align-items: start; margin-bottom: 0.5rem;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Projects:</strong> Add and manage your projects with before/after images</span>
                    </li>
                    <li style="display: flex; align-items: start;">
                        <span style="color: #003366; margin-right: 0.5rem;">•</span>
                        <span><strong>Quotes:</strong> Review your clients' requests</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Features Section -->
        <div style="background: linear-gradient(to right, #f0f9ff, #e0f2fe); border-radius: 0.5rem; border: 1px solid #bae6fd; padding: 1.5rem;">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1rem; margin-top: 0;">
                Panel Features
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Easy Editing</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Update content without code
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Image Management</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Upload and organize images easily
                        </p>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 0.75rem;">
                    <div style="flex-shrink: 0;">
                        <div style="width: 2rem; height: 2rem; background: #003366; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 style="font-weight: 500; color: #111827; margin: 0; margin-bottom: 0.25rem;">Secure & Private</h4>
                        <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">
                            Restricted and protected access
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\blue_draft_web\resources\views/filament/pages/custom-dashboard.blade.php ENDPATH**/ ?>