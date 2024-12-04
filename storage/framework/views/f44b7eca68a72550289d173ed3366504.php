

<?php $__env->startSection('title', 'Dashboard Administración'); ?>

<?php $__env->startSection('content_header'); ?>
<h1>Usuarios</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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



<div class="container mt-4">
    <h2 class="text-center mb-4">Lista de usuarios</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Habilitado</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($usuario->id); ?></td>
                <td><?php echo e($usuario->name); ?></td>
                <td><?php echo e($usuario->email); ?></td>
                <td><?php echo e($usuario->user_type); ?></td>
                <td><?php echo e($usuario->habilitado ? 'Sí' : 'No'); ?></td>
                <td><?php echo e($usuario->created_at); ?></td>
                <td>
                    <?php if($usuario->habilitado): ?>
                    <a href="<?php echo e(route('admin.usuarios.desactivar', $usuario->id)); ?>" class="btn btn-danger">Desactivar usuario</a>
                    <?php else: ?>
                    <a href="<?php echo e(route('admin.usuarios.activar', $usuario->id)); ?>" class="btn btn-success">Activar usuario</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">No hay usuarios registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/admin/usuarios.blade.php ENDPATH**/ ?>