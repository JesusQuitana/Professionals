(function() {
    let profesionales = [];
    let profesionalesSeleccionado = [];
    let idProf = [];
document.addEventListener("DOMContentLoaded", function() {
    if(document.querySelector("#profesionals")) {
        find();
    }
});

function find() {
    console.log("hola");
    input = document.querySelector("#profesionals");
    input.addEventListener("input", (e) => {
        consultarProfesionales(e.target.value);
    })
}

async function consultarProfesionales(habilidad) {
    const url = `${window.location}/profesionals`;
    const datos = new FormData();
    datos.append("habilidad", habilidad);

    const respuesta = await fetch(url, {
        "method" : "POST",
        "body" : datos
    });
    const resultado = await respuesta.json();

    if(resultado.resultado) {
        profesionales = [];
        resultado.registro.forEach((prof) => {
            profesionales = [...profesionales, prof];
        })
        mostrarProfesinales(profesionales);
    }
}

function mostrarProfesinales(profesionales) {
    const profesionals = document.querySelector(".profesionals");
    profesionals.innerHTML = "";
    
    profesionales.forEach((profes) => {
        const {id, nombre, apellido, tags} = profes;

        const contenedorProf = document.createElement("DIV");
        contenedorProf.classList.add("profesional");

        const nombreProf = document.createElement("P");
        nombreProf.textContent = `${nombre} ${apellido}`;

        contenedorProf.appendChild(nombreProf);
        profesionals.appendChild(contenedorProf);

        contenedorProf.addEventListener("click", ()=>{
            modal(profes)
        })
    })
}

function modal(registro) {
    const {id, nombre, apellido, imagen, redes, tags} = registro;
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
    namePro.textContent = `${nombre} ${apellido}`;

    const picture = document.createElement("PICTURE");
    const source = document.createElement("SOURCE");
    const imagenPro = document.createElement("IMG");

    source.setAttribute("srcset", `/build/img/profes/${imagen}.webp`);
    source.setAttribute("type", "image/webp");
    imagenPro.setAttribute("loading", "eager");
    imagenPro.setAttribute("width", "200px");
    imagenPro.setAttribute("src", `/build/img/profes/${imagen}.png`);
    imagenPro.setAttribute("alt", "profesional");
    picture.appendChild(source);
    picture.appendChild(imagenPro);

    const btnSeleccionar = document.createElement("A");
    btnSeleccionar.classList.add("btn")
    btnSeleccionar.classList.add("verde")
    btnSeleccionar.textContent = `Seleccionar`;

    const habilidades = document.createElement("DIV");
    habilidades.classList.add("habilidades");
    tags.split(",").forEach((tag)=>{
        const habilidad = document.createElement("P");
        habilidad.classList.add("habilidad");
        habilidad.textContent = tag.toUpperCase();

        habilidades.appendChild(habilidad);
    })

    socialMedia = JSON.parse(redes);
    const redesSociales = document.createElement("DIV");
    redesSociales.classList.add("redesSociales");

    Object.keys(socialMedia).forEach((social)=>{
        const red = document.createElement("A");
        red.setAttribute("href", socialMedia[social]);
        red.innerHTML = `<i class="fa-brands fa-${social}"></i>`;

        redesSociales.appendChild(red);
    })

    btnSeleccionar.addEventListener("click", ()=>{
        const inputHidden = document.querySelector("#profesional");
        profesionalesSeleccionado = [...profesionalesSeleccionado, registro];
        idProf = [...idProf, registro.id];
        inputHidden.value = [idProf];

        mostrarSeleccionado();
        modal.remove();
    });

    cerrarModal.addEventListener("click", () => {
        modal.remove();
    })

    titulo.appendChild(namePro);
    titulo.appendChild(cerrarModal);
    card.appendChild(titulo);
    card.appendChild(picture);
    card.appendChild(habilidades);
    card.appendChild(redesSociales);
    card.appendChild(btnSeleccionar);
    modal.appendChild(card);
    body.appendChild(modal);
}

function mostrarSeleccionado() {
    const profesionales = document.querySelector(".nombreProfesionalesSeleccionados");
    profesionales.innerHTML = "";

    profesionalesSeleccionado.forEach((profesional)=>{
        nombreSeleccionado = document.createElement("LI");
        nombreSeleccionado.textContent = `${profesional.nombre} ${profesional.apellido}`;

        profesionales.appendChild(nombreSeleccionado);

        nombreSeleccionado.addEventListener("click", ()=>{
            profesionalesSeleccionado = profesionalesSeleccionado.filter(profes => profes.id !== profesional.id);
            idProf = idProf.filter((id) => id !== profesional.id);
            document.querySelector("#profesional").value = idProf
            mostrarSeleccionado();
        })
    })
}
})();