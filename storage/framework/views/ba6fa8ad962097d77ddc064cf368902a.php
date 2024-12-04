

<?php $__env->startSection('title', 'Mis Facturas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Mis Facturas</h1>

    <?php if(empty($facturas)): ?>
        <p class="text-center">No tienes facturas disponibles.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($factura->id); ?></td>
                            <td><?php echo e($factura->fecha_emision); ?></td>
                            <td>$<?php echo e(number_format($factura->total, 2)); ?></td>
                            <td><?php echo e(ucfirst($factura->estado)); ?></td>
                            <td>
                                <a href="<?php echo e(route('estudiantes.facturas_visualizar', $factura->id)); ?>" class="btn btn-primary btn-sm">Ver Detalles</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/estudiantes/facturas.blade.php ENDPATH**/ ?>