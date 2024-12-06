

<?php $__env->startSection('title', 'Ver mis citas'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<br>

<div class="container my-5">
    <h1 class="text-center mb-4">Mis Citas</h1>

    <?php if(empty($citas)): ?>
    <p class="text-center">No tienes citas agendadas.</p>
    <?php else: ?>
    <div class="list-group">
        <?php $__currentLoopData = $citas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="list-group-item">
            <h5><?php echo e($cita->nombre); ?> - <?php echo e($cita->tipo); ?> </h5>
            <p><strong>Nombre del estudiante:</strong> <?php echo e($cita->nombre); ?> </p>
            <p><strong>Telefono del estudiante:</strong> <?php echo e($cita->telefono); ?> </p>
            <p><strong>Correo del estudiante:</strong> <?php echo e($cita->correo); ?> </p>
            <p><strong>Fecha:</strong> <?php echo e($cita->fecha); ?> </p>
            <p><strong>Hora:</strong> <?php echo e($cita->hora_inicio); ?> - <?php echo e($cita->hora_fin); ?> </p>
            <p><strong>Estado:</strong> <?php echo e($cita->estado); ?></p>
            <p><strong>Costo Total:</strong> <?php echo e($cita->costo_total); ?> </p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

</div>


<br>
<br>
<br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/tutores/citas.blade.php ENDPATH**/ ?>