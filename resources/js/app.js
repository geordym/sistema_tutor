import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    // Función para cargar eventos desde la API
    function loadEvents(date) {
      fetch('/api/tutor/espacios', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          tutor_id: 1,
          fecha: date // Envia la fecha seleccionada
        })
      })
      .then(response => response.json())
      .then(data => {
        // Si la respuesta es exitosa, extraemos los eventos
        if (!data.error) {
          const events = data.data.map(event => ({
            title: `${event.titulo}`,
            start: `${event.fecha}T${event.hora_inicio}`,
            end: `${event.fecha}T${event.hora_fin}`
          }));
    
          // Actualiza los eventos en el calendario
          calendar.removeAllEvents(); // Elimina los eventos anteriores
          calendar.addEventSource(events); // Agrega los nuevos eventos
        } else {
          console.error("No se encontraron espacios.");
        }
      })
      .catch(error => {
        console.error("Error al cargar los eventos:", error);
      });
    }
  
    // Inicializa el calendario
    var calendar = new Calendar(calendarEl, {
      plugins: [timeGridPlugin],
      initialView: 'timeGridDay',
      date: '2024-12-01', // Fecha inicial
      allDaySlot: false,
      slotDuration: '00:30:00', // Duración de cada franja horaria (30 minutos)
      slotLabelInterval: '00:30', // Intervalo de etiquetas para las horas (30 minutos)
      slotMinTime: '06:00:00', // Hora mínima visible (6 AM)
      slotMaxTime: '21:00:00', // Hora máxima visible (9 PM)

      // Evento que se ejecuta cuando el calendario cambia de vista
      datesSet: function(info) {
        loadEvents(info.view.currentStart.toISOString().split('T')[0]); // Llama a la función para cargar eventos
      }
    });
  
    // Carga los eventos iniciales
    loadEvents('2024-12-01'); // Llama a la función para cargar eventos al cargar la página
  
    calendar.render();
  });