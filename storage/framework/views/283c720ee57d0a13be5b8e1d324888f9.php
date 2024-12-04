

<?php $__env->startSection('title', 'Agendar Clase'); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row">
        <!-- Confirmación de Datos -->
        <div class="col-md-6">
            <h3 class="mb-4">Detalles de la Clase</h3>
            <div class="card p-4">
                <h5><strong>Tutor:</strong> <?php echo e($tutor->nombre); ?></h5>
                <p><strong>Materia:</strong> <?php echo e($tutor->materia_id); ?></p>
                <p><strong>Costo por hora:</strong> $<?php echo e(number_format($tutor->costo_por_hora, 2)); ?></p>
                <p><strong>Espacio:</strong> <?php echo e($espacio->titulo); ?></p>
                <p><strong>Fecha:</strong> <?php echo e(\Carbon\Carbon::parse($espacio->fecha)->format('d-m-Y')); ?></p>
                <p><strong>Hora:</strong> <?php echo e(\Carbon\Carbon::parse($espacio->hora_inicio)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($espacio->hora_fin)->format('H:i')); ?></p>
                <p><strong>Cantidad de Personas:</strong> <?php echo e($cantidadPersonas); ?></p>
                <p><strong>Costo Total:</strong> $<?php echo e(number_format($costoTotal, 2)); ?></p>
                <p><strong>Tipo de sesion:</strong> <?php echo e($tipoSesion); ?></p>

            </div>
        </div>

        <!-- Formulario de Pago -->
        <div class="col-md-6">
            <h3 class="mb-4">Método de Pago</h3>
            <div class="card p-4">
                <form action="<?php echo e(route('agendar.tutor.finalizar')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="tutor_id" id="tutor_id" value="<?php echo e($tutor->id); ?>">
                    <input type="hidden" name="espacio_id" id="espacio_id" value="<?php echo e($espacio->id); ?>">
                    <input type="hidden" name="cantidad_personas" id="cantidad_personas" value="<?php echo e($cantidadPersonas); ?>">
                    <input type="hidden" name="tipo" id="tipo" value="<?php echo e($tipoSesion); ?>">
                    <input type="hidden" name="costo_total" id="costo_total" value="<?php echo e($costoTotal); ?>">
                    <input type="hidden" name="fecha" value="<?php echo e($espacio->fecha); ?>">
                    <input type="hidden" name="hora_inicio" value="<?php echo e($espacio->hora_inicio); ?>">
                    <input type="hidden" name="hora_fin" value="<?php echo e($espacio->hora_fin); ?>">

                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Banco:</label>
                        <input type="text" class="form-control" id="banco" name="banco" required>
                    </div>

                    <div class="mb-3">
                        <label for="numero_cuenta" class="form-label">Numero de cuenta:</label>
                        <input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago:</label>
                        <select id="metodo_pago" name="metodo_pago" class="form-select" required>
                            <option value="transferencia_bancaria" selected>Transferencia Bancaria</option>
                        </select>
                    </div>

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
<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/estudiantes/agendar_confirmacion.blade.php ENDPATH**/ ?>