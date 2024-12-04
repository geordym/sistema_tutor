

<?php $__env->startSection('title', 'Crear Espacio'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container">

    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>


    <div class="row">
        <h1>Espacios</h1>

    </div>
    <div class="row">
        <a type="button" href="<?php echo e(route('tutor.createEspacio')); ?>" class="btn btn-primary">
            Registrar Espacio
        </a>



    </div>
    <div class="container mt-4">

        <div id="calendar" style="height: 800px"></div>

    </div>

</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/tutores/agenda.blade.php ENDPATH**/ ?>