(function () {
document.addEventListener("DOMContentLoaded", function() {
    const idUser = document.querySelector("idUser");
    projects = []
    if(document.querySelector(".projectUser")) {
        innit();
    }
})

async function innit() {
    const url = `${window.location}/api`;
    datos = new FormData();
    datos.append("id", idUser.value);
    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();

    if(resultado.resultado) {
        projects = resultado.registro;
        mostrarRegistros();
    }
}

function mostrarRegistros() {
    const projectUser = document.querySelector(".projectUser");

    projects.forEach(project => {
        const article = document.createElement("ARTICLE");
        const h3 = document.createElement("H3");
        h3.textContent = project.nombre;

        article.appendChild(h3);
        projectUser.appendChild(article);

        article.addEventListener("click", ()=>{
            modal(project);
        })
    });
}

function modal(proyecto) {
    const {id, nombre, descripcion, confirmado, precio} = proyecto;
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

    const nameProy = document.createElement("P");
    nameProy.classList.add("name");
    nameProy.textContent = `${nombre}`;

    const descrip = document.createElement("TEXTAREA");
    descrip.classList.add("descrip");
    descrip.setAttribute("disabled", true);
    descrip.textContent = `${descripcion}`;

    const form = document.createElement("FORM");
    form.classList.add("formPagar");

    const label = document.createElement("LABEL");
    label.textContent = `Seleccione un metodo de pago`;

    const zinliDiv = document.createElement("DIV");
    zinliDiv.classList.add("zinliDiv");
    const zinli = document.createElement("INPUT");
    const zinliLabel = document.createElement("LABEL");
    zinliLabel.setAttribute("for", "zinli");
    zinliLabel.textContent = `Zinli`;
    zinli.setAttribute("type", "radio");
    zinli.setAttribute("value", 1);
    zinli.setAttribute("id", "zinli");
    zinli.setAttribute("name", "pagar");

    zinliDiv.appendChild(zinli);
    zinliDiv.appendChild(zinliLabel);

    const paypalDiv = document.createElement("DIV");
    paypalDiv.classList.add("paypalDiv");
    const paypal = document.createElement("INPUT");
    const paypalLabel = document.createElement("LABEL");
    paypalLabel.setAttribute("for", "paypal");
    paypalLabel.textContent = `Paypal`;
    paypal.setAttribute("type", "radio");
    paypal.setAttribute("value", 2);
    paypal.setAttribute("id", "paypal");
    paypal.setAttribute("name", "pagar");

    paypalDiv.appendChild(paypal);
    paypalDiv.appendChild(paypalLabel);

    const div = document.createElement("DIV");

    cerrarModal.addEventListener("click", () => {
        modal.remove();
    })

    titulo.appendChild(nameProy);
    titulo.appendChild(cerrarModal);
    form.appendChild(label);
    form.appendChild(zinliDiv);
    form.appendChild(paypalDiv);

    card.appendChild(titulo);
    card.appendChild(descrip);
    modal.appendChild(card);
    body.appendChild(modal);

    if(confirmado !== 0) {
        card.appendChild(form);
        card.appendChild(div);
    } else {
        const notconfirm = document.createElement("P");
        notconfirm.classList.add("alertas__naranja");
        notconfirm.style = `color: #fff`;
        notconfirm.textContent = `Debe esperar a que el administrador confirme su proyecto Aprox 24Hr`;
        card.appendChild(notconfirm);
    }

    zinli.addEventListener("input", ()=>{
        const qrpay = document.createElement("IMG");
        qrpay.classList.add("qrpay");
        qrpay.setAttribute("src", `/build/img/qr.jpg`);

        if(div.firstChild) {
            div.firstChild.remove();
        }
    
        div.appendChild(qrpay);
    })

    paypal.addEventListener("input", ()=>{
        const paypalpay = document.createElement("A");
        paypalpay.classList.add("btn");
        paypalpay.classList.add("verde");
        paypalpay.setAttribute("href", `#`);
        paypalpay.textContent = "Enlace de pago Paypal (Imagina)"

        if(div.firstChild) {
            div.firstChild.remove();
        }
    
        div.appendChild(paypalpay);
    })
}
})();