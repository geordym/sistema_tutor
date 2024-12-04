

<?php $__env->startSection('title', 'Ver tutores'); ?>

<?php $__env->startSection('content'); ?>
<!-- Agregar los enlaces de Bootstrap 4.5 -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .list-group-item {
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    ul {
        padding-left: 20px;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-4">Tutores Disponibles</h1>

    <!-- Barra lateral (Sidebar) -->
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <?php $__currentLoopData = $areasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- Área -->
                <div class="list-group-item">
                    <h5>
                        <!-- Botón para desplegar materias con dropdown -->
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#materias-<?php echo e($area['nombre']); ?>">
                            <?php echo e($area['nombre']); ?>

                        </button>
                    </h5>

                    <!-- Materias asociadas al área (ocultas por defecto) -->
                    <div class="collapse" id="materias-<?php echo e($area['nombre']); ?>">
                        <ul class="list-unstyled">
                            <?php $__currentLoopData = $area['materias']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('public.tutorias.porMateriaId', $materia['id'])); ?>" class="d-block"><?php echo e($materia['nombre']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="list-group">
                <?php if(empty($tutores)): ?>
                <p class="text-muted">No hay tutores disponibles para esta materia.</p>
                <?php else: ?>
                <?php $__currentLoopData = $tutores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('agendar.tutor', $tutor->id  )); ?>" class="list-group-item list-group-item-action">
                    <?php echo e($tutor->user_name); ?> <!-- Mostrar el nombre del tutor -->
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/public/tutorias.blade.php ENDPATH**/ ?>