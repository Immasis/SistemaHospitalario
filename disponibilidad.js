const form = document.querySelector('.availability-form');
const mensajeDiv = document.getElementById('mensaje');
const listaCitasDiv = document.getElementById('lista-citas');

function cargarCitas() {
  fetch('mostrar_citas.php')
    .then(response => response.json())
    .then(citas => {
      if (citas.length === 0) {
        listaCitasDiv.innerHTML = '<h2>Citas Guardadas</h2><p>No hay citas guardadas.</p>';
        return;
      }
      let html = '<h2>Citas Guardadas</h2>';
      citas.forEach(cita => {
        html += `
          <div class="cita">
            <p><strong>Paciente:</strong> ${cita.paciente}</p>
            <p><strong>Fecha:</strong> ${cita.fecha}</p>
            <p><strong>Hora:</strong> ${cita.hora}</p>
            <p><strong>Especialidad:</strong> ${cita.especialidad}</p>
            <hr/>
          </div>
        `;
      });
      listaCitasDiv.innerHTML = html;
    })
    .catch(error => {
      console.error('Error al cargar citas:', error);
      listaCitasDiv.innerHTML = '<p>Error al cargar las citas.</p>';
    });
}

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const paciente = document.getElementById('paciente').value.trim();
  const specialty = document.getElementById('specialty').value;
  const fecha = document.getElementById('fecha').value;
  const hora = document.getElementById('hora').value;

  if (!paciente || !specialty || !fecha || !hora) {
    mensajeDiv.textContent = "Por favor completa todos los campos.";
    mensajeDiv.style.color = "red";
    return;
  }

  const formData = new FormData();
  formData.append('paciente', paciente);
  formData.append('especialidad', specialty);
  formData.append('fecha', fecha);
  formData.append('hora', hora);

  fetch('guardar_citas.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    mensajeDiv.textContent = data;
    mensajeDiv.style.color = data.includes("correctamente") ? "green" : "red";
    if (data.includes("correctamente")) {
      form.reset();
      cargarCitas();
    }
  })
  .catch(error => {
    console.error('Error en la peticion:', error);
    mensajeDiv.textContent = "Error al hacer la peticion";
    mensajeDiv.style.color = "red";
  });
});

window.addEventListener('DOMContentLoaded', cargarCitas);