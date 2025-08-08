document.addEventListener("DOMContentLoaded", cargarCitas);

function cargarCitas() {
    fetch("get_citas.php")
        .then(res => res.json())
        .then(data => {
            const tabla = document.getElementById("tablaCitas");
            tabla.innerHTML = "";
            data.forEach(cita => {
                tabla.innerHTML += `
                    <tr>
                        <td>${cita.paciente}</td>
                        <td>${cita.fecha}</td>
                        <td>${cita.hora}</td>
                        <td>${cita.especialidad}</td>
                        <td><span class="status ${cita.estado.toLowerCase()}">${cita.estado}</span></td>
                        <td>
                            <button class="btn-small btn-danger" onclick="eliminarCita(${cita.id})">Cancelar</button>
                        </td>
                    </tr>
                `;
            });
        });
}

document.getElementById("formCita").addEventListener("submit", function(e) {
    e.preventDefault();
    const datos = new FormData(this);
    fetch("agregar_cita.php", { method: "POST", body: datos })
        .then(res => res.text())
        .then(() => {
            this.reset();
            cargarCitas();
        });
});

function eliminarCita(id) {
    if (confirm("¿Eliminar esta cita?")) {
        fetch(`eliminar_cita.php?id=${id}`)
            .then(() => cargarCitas());
    }
}
