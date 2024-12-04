

<?php $__env->startSection('title', 'Detalle de Factura'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Detalle de Factura</h1>

    <?php if(empty($factura)): ?>
    <p class="text-center">Factura no encontrada.</p>
    <?php else: ?>
    <?php
    $factura = $factura[0]; // Selecciona la primera fila del resultado
    ?>

    <div class="card">
        <div class="card-header">
            <h4>Factura ID: <?php echo e($factura->id); ?></h4>
        </div>
        <div class="card-body">
            <p><strong>Fecha:</strong> <?php echo e($factura->fecha_emision); ?></p>
            <p><strong>Total:</strong> $<?php echo e(number_format($factura->total, 2)); ?></p>
            <p><strong>Estado:</strong> <?php echo e(ucfirst($factura->estado)); ?></p>
        </div>
    </div>

    <?php
    $facturaItems = DB::select('SELECT * FROM facturas_items WHERE factura_id = ?', [$factura->id]);
    ?>

    <h3 class="mt-4">Artículos de la Factura</h3>
    <?php if(empty($facturaItems)): ?>
    <p>No hay artículos en esta factura.</p>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $facturaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->descripcion); ?></td>
                    <td><?php echo e($item->cantidad); ?></td>
                    <td>$<?php echo e(number_format($item->precio_unitario, 2)); ?></td>
                    <td>$<?php echo e(number_format($item->cantidad * $item->precio_unitario, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/estudiantes/facturas_visualizar.blade.php ENDPATH**/ ?>