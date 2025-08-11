document.addEventListener("DOMContentLoaded", function() {
  cargarAsignacionHorarios();
});

function cargarAsignacionHorarios() {
  fetch('citas/get_citas.php')
    .then(response => response.json())
    .then(citas => {
      
      const citasFiltradas = citas.filter(cita => 
        cita.estado.toLowerCase() === 'pendiente' || cita.estado.toLowerCase() === 'confirmada'
      );

      
      const prioridadValor = {
        alta: 1,
        media: 2,
        baja: 3
      };

      
      citasFiltradas.sort((a, b) => {
        let pA = prioridadValor[a.prioridad.toLowerCase()] || 4;
        let pB = prioridadValor[b.prioridad.toLowerCase()] || 4;
        if (pA !== pB) return pA - pB;

       
        if (a.hora < b.hora) return -1;
        if (a.hora > b.hora) return 1;
        return 0;
      });

      
      const tabla = document.getElementById('tablaAsignacion');
      tabla.innerHTML = '';

      citasFiltradas.forEach(cita => {
       
        const horaFormatted = formatoHora12(cita.hora);

        tabla.innerHTML += `
          <tr>
            <td>${cita.paciente}</td>
            <td style="text-transform: capitalize;">${cita.prioridad}</td>
            <td>${horaFormatted}</td>
          </tr>
        `;
      });

      if (citasFiltradas.length === 0) {
        tabla.innerHTML = '<tr><td colspan="3">No hay citas para asignar.</td></tr>';
      }
    })
    .catch(error => {
      console.error('Error al cargar citas:', error);
      const tabla = document.getElementById('tablaAsignacion');
      tabla.innerHTML = '<tr><td colspan="3">Error al cargar las citas.</td></tr>';
    });
}


function formatoHora12(hora24) {
  if (!hora24) return '';
  const [hourStr, min] = hora24.split(':');
  let hour = parseInt(hourStr);
  const ampm = hour >= 12 ? 'PM' : 'AM';
  hour = hour % 12;
  hour = hour ? hour : 12; 
  return `${hour}:${min} ${ampm}`;
}
