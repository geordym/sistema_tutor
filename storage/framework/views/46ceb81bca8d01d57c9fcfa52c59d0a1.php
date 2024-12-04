

<?php $__env->startSection('title', 'Crear Espacio'); ?>

<?php $__env->startSection('content_header'); ?>
<h1>Crear Espacio</h1>
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

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>


    <div class="row">
        <h2 class="text-center mb-4">Selecciona el espacio para agendar</h2>
        <br>

        <!-- Formulario de selección de fecha y hora -->
        <form action="<?php echo e(route('espacios.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="tutor" id="tutor" value="<?php echo e($tutor->id); ?>">

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora_inicio">Hora de Inicio</label>
                <select class="form-control" id="hora_inicio" name="hora_inicio" required>
                    <?php for($i = 8; $i < 18; $i++): ?> <!-- Aquí defines el rango de horas -->
                        <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:00"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:00</option>
                        <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:30"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:30</option>
                        <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hora_fin">Hora de Fin</label>
                <select class="form-control" id="hora_fin" name="hora_fin" required>
                    <?php for($i = 9; $i < 19; $i++): ?> <!-- Las horas fin deben ser al menos una hora después -->
                        <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:00"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:00</option>
                        <option value="<?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:30"><?php echo e(str_pad($i, 2, '0', STR_PAD_LEFT)); ?>:30</option>
                        <?php endfor; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Espacio</button>
        </form>
    </div>


    <div id="calendar"></div> <!-- El contenedor donde se renderizará el calendario -->

</div>


<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css" rel="stylesheet">

<script>
  
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/tutores/espacio_create.blade.php ENDPATH**/ ?>