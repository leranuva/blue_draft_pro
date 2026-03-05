<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte Ejecutivo <?php echo e($period); ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; margin: 40px; }
        h1 { color: #003366; font-size: 22px; margin-bottom: 8px; }
        h2 { color: #336699; font-size: 14px; margin-top: 24px; margin-bottom: 8px; border-bottom: 1px solid #ccc; }
        .period { color: #666; font-size: 12px; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f5f5f5; font-weight: 600; color: #003366; }
        .kpi-value { font-weight: bold; font-size: 18px; color: #047857; }
        .footer { margin-top: 40px; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <h1>Blue Draft — Reporte Ejecutivo</h1>
    <p class="period"><?php echo e($period); ?></p>

    <h2>Resumen Ejecutivo</h2>
    <table>
        <tr><th>KPI</th><th>Valor</th></tr>
        <tr><td>Leads totales</td><td class="kpi-value"><?php echo e($data['leads_total']); ?></td></tr>
        <tr><td>Leads contactados &lt;24h (%)</td><td><?php echo e($data['contacted_24h_pct']); ?>%</td></tr>
        <tr><td>Propuestas enviadas</td><td><?php echo e($data['proposals_sent']); ?></td></tr>
        <tr><td>Close rate (%)</td><td><?php echo e($data['close_rate_pct']); ?>%</td></tr>
        <tr><td>Tiempo promedio cierre (días)</td><td><?php echo e($data['avg_close_days']); ?></td></tr>
        <tr><td>Revenue ganado</td><td class="kpi-value">$<?php echo e(number_format($data['revenue_won'], 0)); ?></td></tr>
        <tr><td>Pipeline potencial</td><td>$<?php echo e(number_format($data['revenue_pipeline'], 0)); ?></td></tr>
        <tr><td>Borough dominante</td><td><?php echo e($data['top_borough']); ?></td></tr>
        <tr><td>Servicio dominante</td><td><?php echo e($data['top_service']); ?></td></tr>
    </table>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['by_borough']->isNotEmpty()): ?>
    <h2>Leads por Borough</h2>
    <table>
        <tr><th>Borough</th><th>Total</th></tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['by_borough']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr><td><?php echo e($boroughs[$row->borough] ?? $row->borough); ?></td><td><?php echo e($row->total); ?></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </table>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['by_service']->isNotEmpty()): ?>
    <h2>Leads por Servicio</h2>
    <table>
        <tr><th>Servicio</th><th>Total</th></tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $data['by_service']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr><td><?php echo e(ucfirst($row->service_type)); ?></td><td><?php echo e($row->total); ?></td></tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </table>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <p class="footer">Generado automáticamente por Blue Draft CRM — <?php echo e(now()->format('Y-m-d H:i')); ?></p>
</body>
</html>
<?php /**PATH C:\projects\blue_draft_pro\resources\views/reports/monthly.blade.php ENDPATH**/ ?>