

<?php $__env->startSection('title', 'Crear Curso'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Contenedor de ancho medio -->
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
                <h2 class="text-center mb-4">Formulario de Registro de alumno</h2>
            </div>

            <form action="<?php echo e(route('collaborators.alumns.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name">Nombre Completo:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>

                <div class="form-group">
                    <label for="name">CURP:</label>
                    <input type="text" class="form-control" id="curp" name="curp" required>
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="<?php echo e(route('collaborators.alumns.index')); ?>">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar alumno</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/collaborators/alumns/create.blade.php ENDPATH**/ ?>