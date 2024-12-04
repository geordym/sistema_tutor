

<?php $__env->startSection('title', 'Ver tutores'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Tutores Disponibles</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php $__currentLoopData = $tutores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <!-- Imagen del tutor -->
                <div class="card-body">
                    <!-- Información del tutor -->
                    <h5 class="card-title"><?php echo e($tutor->nombre); ?></h5>
                    <p class="card-text">
                        <strong>Area:</strong> <?php echo e($tutor->area_name ?? 'No especificada'); ?><br>
                        <strong>Materia:</strong> <?php echo e($tutor->materia_name ?? 'No especificada'); ?><br>

                        <strong>Teléfono:</strong> <?php echo e($tutor->telefono ?? 'No especificado'); ?><br>
                        <strong>Costo por hora:</strong> $<?php echo e(number_format($tutor->costo_por_hora, 2)); ?>

                    </p>
                </div>
                <div class="card-footer text-center">
                    <!-- Botón para agendar clase -->
                    <a href="<?php echo e(route('agendar.tutor', $tutor->id)); ?>" class="btn btn-primary">Agendar Clase</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/public/tutores.blade.php ENDPATH**/ ?>