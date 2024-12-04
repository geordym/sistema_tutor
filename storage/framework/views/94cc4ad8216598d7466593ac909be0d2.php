

<?php $__env->startSection('title', 'Crear Espacio'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<br>

<div class="container mt-4">
    <h2>Cambiar Imagen de Perfil</h2>

    <!-- Mostrar la imagen actual si existe -->
    <div class="mb-3">
        <?php if(auth()->user()->imagen_perfil): ?>
            <p>Imagen de perfil actual:</p>
            <img src="<?php echo e(asset('storage/' . auth()->user()->imagen_perfil)); ?>" alt="Imagen de Perfil" class="img-thumbnail" style="width: 150px; height: 150px;">
        <?php else: ?>
            <p>No tienes una imagen de perfil actualmente.</p>
        <?php endif; ?>
    </div>

    <!-- Formulario para actualizar la imagen -->
    <form action="<?php echo e(route('user.updateProfileImage')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="profile_image">Selecciona una nueva imagen de perfil:</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Actualizar Imagen</button>
    </form>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/perfil/perfil.blade.php ENDPATH**/ ?>