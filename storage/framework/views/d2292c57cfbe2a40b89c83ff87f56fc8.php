

<?php $__env->startSection('title', 'Agendar Clase'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        <!-- Confirmación de Datos -->
        <div class="col-md-6">
            <h3 class="mb-4">Detalles de la Clase</h3>
            <div class="card p-4">
                <h5><strong>Tutor:</strong> <?php echo e($tutor->nombre); ?></h5>
                <p><strong>Materia:</strong> <?php echo e($tutor->materia); ?></p>
                <p><strong>Costo por hora:</strong> $<?php echo e(number_format($tutor->costo_por_hora, 2)); ?></p>
                <p><strong>Espacio:</strong> <?php echo e($espacio->titulo); ?></p>
                <p><strong>Fecha:</strong> <?php echo e(\Carbon\Carbon::parse($espacio->fecha)->format('d-m-Y')); ?></p>
                <p><strong>Hora:</strong> <?php echo e(\Carbon\Carbon::parse($espacio->hora_inicio)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($espacio->hora_fin)->format('H:i')); ?></p>
                <p><strong>Cantidad de Personas:</strong> <?php echo e($cantidadPersonas); ?></p>
                <p><strong>Costo Total:</strong> $<?php echo e(number_format($costoTotal, 2)); ?></p>
            </div>
        </div>

        <!-- Formulario de Pago -->
        <div class="col-md-6">
            <h3 class="mb-4">Método de Pago</h3>
            <div class="card p-4">
                <form action="<?php echo e(route('agendar.tutor.finalizar')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!-- Método de Pago -->
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago:</label>
                        <select id="metodo_pago" name="metodo_pago" class="form-select" required>
                            <option value="transferencia_bancaria" selected>Transferencia Bancaria</option>
                        </select>
                    </div>

                    <!-- Foto de Comprobante -->
                    <div class="mb-3">
                        <label for="comprobante_pago" class="form-label">Adjuntar Comprobante de Pago:</label>
                        <input type="file" class="form-control" id="comprobante_pago" name="comprobante_pago" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Confirmar Pago</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/estudiantes/agendar_finalizacion.blade.php ENDPATH**/ ?>