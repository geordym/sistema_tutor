

<?php $__env->startSection('title', 'Agendar Clase'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .btn-selected {
        background-color: #28a745 !important;
        color: white !important;
        border-color: #28a745 !important;
    }
</style>

<div class="container my-5">
    <h1 class="text-center mb-4">Agendar Clase</h1>

    <!-- Información del Tutor -->
    <div class="mb-4">
        <h3>Información del Tutor</h3>
        <p><strong>Nombre:</strong> <?php echo e($tutor->nombre); ?></p>
        <p><strong>Especialidad:</strong> <?php echo e($tutor->materia_id); ?></p>
        <p><strong>Costo por Hora:</strong> $<?php echo e(number_format($tutor->costo_por_hora, 2)); ?></p>
    </div>


    <!-- Formulario de Agendamiento -->
    <div class="card p-4">
        <h4>Detalles de la clase</h4>
        <form id="form-agendar-clase" method="POST" action="<?php echo e(route('agendar.tutor.confirmacion')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="tutor_id" value="<?php echo e($tutor->id); ?>">
            <!-- <input type="hidden" name="espacio_id" id="input_espacio_id"> -->

            <div class="mb-4">
                <h4>Espacios disponibles:</h4>
                <div class="form-group">
                    <label for="espacioSelect">Selecciona un espacio:</label>
                    <select id="input_espacio_id" name="espacio_id" class="form-control">
                        <?php $__currentLoopData = $espacios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $espacio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($espacio->id); ?>">
                            <?php echo e($espacio->titulo); ?> - <?php echo e($espacio->fecha); ?> - <?php echo e($espacio->hora_inicio); ?> - <?php echo e($espacio->hora_fin); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>


            <div class="mb-4">
                <h4>Tipo de sesión:</h4>
                <div id="tipo_sesion" class="d-flex flex-wrap gap-2">
                    <label class="btn btn-outline-primary">
                        <input type="radio" name="tipo_sesion" value="virtual" class="form-check-input">
                        Virtual
                    </label>

                    <label class="btn btn-outline-primary">
                        <input type="radio" name="tipo_sesion" value="presencial" class="form-check-input">
                        Presencial
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label for="cantidad-personas" class="form-label">Cantidad de personas:</label>
                <input type="number" name="cantidad_personas" id="cantidad-personas" class="form-control" min="1" max="4" value="1" required>
            </div>

            <div class="mb-3">
                <label for="cantidad-personas" class="form-label">Costo total:</label>
                <input type="number" name="costo_total" id="costo_total" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success w-100">Confirmar Agendamiento</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precioPorPersona = '<?php echo e($tutor->costo_por_hora); ?>';

        const cantidadPersonasInput = document.getElementById('cantidad-personas');
        const costoTotalInput = document.getElementById('costo_total');

        function actualizarCostoTotal() {
            const cantidadPersonas = parseInt(cantidadPersonasInput.value);

            // Verificar si la cantidad de personas es un número válido
            if (isNaN(cantidadPersonas) || cantidadPersonas < 1) {
                costoTotalInput.value = 0;
                return;
            }

            const costoTotal = cantidadPersonas * precioPorPersona;

            costoTotalInput.value = costoTotal;
        }

        cantidadPersonasInput.addEventListener('input', actualizarCostoTotal);

        actualizarCostoTotal();
    });

    // `


    //         document.addEventListener('DOMContentLoaded', function() {
    //             const botonesDias = document.querySelectorAll('.btn-day');
    //             const horariosContainer = document.getElementById('horarios-container');
    //             const inputFecha = document.getElementById('input-fecha');
    //             const inputHoraInicio = document.getElementById('input-hora-inicio');
    //             const inputHoraFin = document.getElementById('input-hora-fin');
    //             const inputEspacioId = document.getElementById('input_espacio_id');

    //             botonesDias.forEach(boton => {
    //                 boton.addEventListener('click', function() {
    //                     const diaSeleccionado = this.getAttribute('data-dia');
    //                     const tutorId = '<?php echo e($tutor->id); ?>'; // Obtener el ID del tutor desde la plantilla Blade

    //                     this.classList.add('btn-selected');

    //                     // Limpiar los horarios previos
    //                     horariosContainer.innerHTML = '<p>Cargando horarios...</p>';

    //                     // Realizar la solicitud al endpoint
    //                     fetch('/api/tutor/espacios', {
    //                             method: 'POST',
    //                             headers: {
    //                                 'Content-Type': 'application/json',
    //                             },
    //                             body: JSON.stringify({
    //                                 tutor_id: tutorId,
    //                                 fecha: diaSeleccionado
    //                             })
    //                         })
    //                         .then(response => response.json())
    //                         .then(data => {
    //                             // Verificar si hubo error
    //                             if (data.error) {
    //                                 horariosContainer.innerHTML = `<p>${data.message}</p>`;
    //                                 return;
    //                             }

    //                             // Filtrar los espacios disponibles
    //                             const espaciosDisponibles = data.data.filter(espacio => espacio.espacioTomado === 0);

    //                             // Mostrar los horarios
    //                             if (espaciosDisponibles.length > 0) {
    //                                 horariosContainer.innerHTML = '';
    //                                 espaciosDisponibles.forEach(espacio => {
    //                                     const botonHorario = document.createElement('button');
    //                                     botonHorario.classList.add('btn', 'btn-outline-success', 'btn-horario');
    //                                     botonHorario.textContent = `${espacio.hora_inicio} - ${espacio.hora_fin}`;
    //                                     botonHorario.dataset.horaInicio = espacio.hora_inicio;
    //                                     botonHorario.dataset.horaFin = espacio.hora_fin;
    //                                     botonHorario.dataset.horarioId = espacio.id;

    //                                     // Agregar evento al botón
    //                                     botonHorario.addEventListener('click', function() {
    //                                         console.log(espacio);
    //                                         inputEspacioId.value = espacio.id;

    //                                         // Marcar el botón seleccionado
    //                                         document.querySelectorAll('.btn-horario').forEach(btn => btn.classList.remove('btn-selected'));
    //                                         this.classList.add('btn-selected');
    //                                     });

    //                                     horariosContainer.appendChild(botonHorario);
    //                                 });
    //                             } else {
    //                                 horariosContainer.innerHTML = '<p>No hay horarios disponibles para este día.</p>';
    //                             }
    //                         })
    //                         .catch(error => {
    //                             console.error('Error:', error);
    //                             horariosContainer.innerHTML = '<p>Error al cargar los horarios. Intente de nuevo.</p>';
    //                         });
    //                 });
    //             });
    //         });`
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistema_cursos2\resources\views/estudiantes/agendar.blade.php ENDPATH**/ ?>