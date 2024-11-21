(function() {
    let paginacion = {
        totalRegistros : 0,
        totalPaginas : 0,
        offset : 0,
        registrosXPaginas : 6,
        paginaActual : 1
    }
document.addEventListener("DOMContentLoaded", ()=>{
    if(document.querySelector(".tabla-admin-profesionales")) {
        count();
    }
})

async function count() {
    const url = `${window.location}/profesional/count`;
    const respuesta = await fetch(url);
    const resultado = await respuesta.json();

    if(resultado.resultado) {
        paginacion.totalRegistros = parseInt(resultado.cantidad);
        paginacion.totalPaginas = Math.ceil((paginacion.totalRegistros / paginacion.registrosXPaginas));
        paginacion.offset = paginacion.registrosXPaginas * (paginacion.paginaActual - 1);
        btnPaginacion();
    }
}

async function consultarRegistros() {
    const url = `${window.location}/profesional/pages`;
    const datos = new FormData();
    datos.append("limit", paginacion.registrosXPaginas);
    datos.append("offset", paginacion.offset);

    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();
    if(resultado.resultado) {
        mostrarRegistros(resultado.registro);
    }
}

function btnPaginacion() {
    const {paginaActual, totalPaginas} = paginacion;
    const btnAnterior = document.querySelector(".btnAnterior");
    const btnSiguiente = document.querySelector(".btnSiguiente");
    consultarRegistros();

    btnAnterior.addEventListener("click", ()=>{
        paginacion.paginaActual--;
        funcionPaginacion();
    })
    btnSiguiente.addEventListener("click", ()=>{
        paginacion.paginaActual++;
        funcionPaginacion();
    })   
}

function funcionPaginacion(btn) {
    const {paginaActual, totalPaginas} = paginacion;
    const btnAnterior = document.querySelector(".btnAnterior");
    const btnSiguiente = document.querySelector(".btnSiguiente");

    paginacion.offset = paginacion.registrosXPaginas * (paginacion.paginaActual - 1); 

    if(paginaActual <= 1) {
        btnAnterior.classList.add("ocultar");
        btnSiguiente.classList.remove("ocultar");
    }
    else if(paginaActual >= totalPaginas) {
        btnSiguiente.classList.add("ocultar");
        btnAnterior.classList.remove("ocultar");
    }
    else {
        btnAnterior.classList.remove("ocultar");
        btnSiguiente.classList.remove("ocultar");
    }
    consultarRegistros();
}

function mostrarRegistros(registros) {
    const paginacionNumeros = document.querySelector(".paginacion__numeros");
    paginacionNumeros.innerHTML = "";

    const numero = document.createElement("P");
    numero.textContent = paginacion.paginaActual;
    paginacionNumeros.appendChild(numero);

    const table = document.querySelector("tbody");
    table.innerHTML = "";

    registros.forEach((registro)=>{
        const tr = document.createElement("TR");

        const nombre = document.createElement("TD");
        nombre.textContent = registro.nombre;

        const ubicacion = document.createElement("TD");
        ubicacion.textContent = registro.ubicacion;

        const acciones = document.createElement("TD");
        const editar = document.createElement("A");
        editar.setAttribute("href", `/admin/editar?p=${registro.id}`)
        editar.classList.add("editar");
        editar.textContent = "Editar";

        const eliminar = document.createElement("P");
        eliminar.classList.add("eliminar");
        eliminar.textContent = "Eliminar";
        
        acciones.appendChild(editar);
        acciones.appendChild(eliminar);
        tr.appendChild(nombre);
        tr.appendChild(ubicacion);
        tr.appendChild(acciones);
        table.appendChild(tr);

        eliminar.addEventListener("click", ()=>{
            eliminarProfesional(registro);
        })
    })
}

async function eliminarProfesional(registro) {
    const url = `${window.location}/profesional/editar`;
    const datos = new FormData();
    datos.append("id", registro.id)
    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();

    if(resultado.resultado) {
        consultarRegistros();
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: `${resultado.mensaje}`
            });
    } else {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "error",
            title: `${resultado.error}`
            });
    }
}
})();