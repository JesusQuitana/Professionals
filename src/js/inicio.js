(function() {
document.addEventListener("DOMContentLoaded", function() {
    contacto();
})

function contacto() {
    const contactos = document.querySelectorAll(".contacto_radio");
    if(contactos) {
        contactos.forEach((contacto)=>{
            contacto.addEventListener("input", (e)=>{
                mostrarInput(e.target.value);
            })
        })
    }
}

function mostrarInput(valor) {
    const acerca_de = document.querySelector(".acerca_de");

    if(acerca_de.lastChild) {
        acerca_de.lastChild.remove();
    }

    if(valor == 1) {
        const telf = document.createElement("INPUT");
        telf.setAttribute("type", "tel");
        telf.setAttribute("name", "telf");
        telf.setAttribute("placeholder", "Ej. 04144663318");

        acerca_de.appendChild(telf);
    } else if(valor == 2) {
        const email = document.createElement("INPUT");
        email.setAttribute("type", "email");
        email.setAttribute("name", "email");
        email.setAttribute("placeholder", "Ej. correo@correo.com");

        acerca_de.appendChild(email);
    }
}
})();