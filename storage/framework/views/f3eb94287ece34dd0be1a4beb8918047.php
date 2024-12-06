

<?php $__env->startSection('title', 'Ver mis citas'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<br>

<div class="container my-5">
    <h1 class="text-center mb-4">Su saldo es: <?php echo e($saldo ?? 0); ?></h1>





</div>


<br>
<br>
<br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/tutores/saldo.blade.php ENDPATH**/ ?>