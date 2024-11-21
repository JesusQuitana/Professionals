(function() {
    let paginacion = {
        totalRegistros : 0,
        totalPaginas : 0,
        offset : 0,
        registrosXPaginas : 6,
        paginaActual : 1
    }
document.addEventListener("DOMContentLoaded", ()=>{
    if(document.querySelector(".user_name")) {
        count();
    }
})

async function count() {
    const url = `${window.location}/count`;
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
    const url = `${window.location}/pages`;
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
        nombre.classList.add("name");
        nombre.textContent = registro.nombre

        const acciones = document.createElement("TD");

        const confirmar = document.createElement("P");
        if(registro.confirmado == 0) {
            confirmar.textContent = "No Confirmado";
            confirmar.classList.add("confirmar");
        } else {
            confirmar.textContent = "Confirmado";
            confirmar.classList.add("notconfirmar");
        }
        
        acciones.appendChild(confirmar);
        tr.appendChild(nombre);
        tr.appendChild(acciones);
        table.appendChild(tr);

        confirmar.addEventListener("click", ()=>{
            if(registro.confirmado == 0) {
                registros.filter(registr => registr.id == registro.id)[0].confirmado = 1;
                estatusProyecto(registro.id);
                mostrarRegistros(registros);
            } else {
                registros.filter(registr => registr.id == registro.id)[0].confirmado = 0;
                estatusProyecto(registro.id);
                mostrarRegistros(registros);
            }
        })
        
        nombre.addEventListener("click", ()=>{
            modal(registro);
        })
    })
}

async function estatusProyecto(id) {
    const url = `${window.location}/confirmar`;
    const datos = new FormData();
    datos.append("proyecto_id", id);

    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();
}

function modal(registro) {
    const body = document.querySelector("body");
    const modal = document.createElement("DIV");
    modal.classList.add("modal");

    const card = document.createElement("DIV");
    card.classList.add("card");

    const titulo = document.createElement("DIV");
    titulo.classList.add("titulo");

    const cerrarModal = document.createElement("I");
    cerrarModal.classList.add("fa-solid")
    cerrarModal.classList.add("fa-x")

    const namePro = document.createElement("P");
    namePro.classList.add("name");
    namePro.textContent = `${registro.nombre}`;

    const precio = document.createElement("P");
    precio.classList.add("precio");
    precio.textContent = `Precio: ${registro.precio}$`;

    const usuario = document.createElement("P");
    usuario.classList.add("user_name");

    const profesios = document.createElement("ul");
    profesios.classList.add("profesios");

    titulo.appendChild(namePro);
    titulo.appendChild(cerrarModal);
    card.appendChild(titulo);
    card.appendChild(usuario);
    card.appendChild(precio);
    card.appendChild(profesios);
    modal.appendChild(card);
    body.appendChild(modal);

    user(registro.usuario_id);
    profesio(registro.id);

    cerrarModal.addEventListener("click", () => {
        modal.remove();
    })
}

async function user(user) {
    const user_name = document.querySelector(".user_name");
    const url = `${window.location}/user`;
    const datos = new FormData();
    datos.append("usuario_id", user);

    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();
    if(resultado.resultado) {
        user_name.textContent = `Cliente: ${resultado.registro.nombre} ${resultado.registro.apellido}`;
    }
}

async function profesio(id) {
    const profesios = document.querySelector(".profesios");
    const url = `${window.location}/profesios`;
    const datos = new FormData();
    datos.append("id", id);

    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();
    if(resultado.resultado) {
        const li = document.createElement("P");
        li.textContent = `Encargado a:`;
        profesios.appendChild(li);
        resultado.registro.forEach(profesional => {
            const profesio = document.createElement("LI");
            profesio.textContent = `${profesional.registro.nombre} ${profesional.registro.apellido}`;
            profesios.appendChild(profesio);
        })
    }
}
})();