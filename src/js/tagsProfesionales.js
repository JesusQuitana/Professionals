import { InlineFunctions } from "terser";

(function() {
    let tags = [];
document.addEventListener("DOMContentLoaded", function() {
    if(document.querySelector("#tags")) {
        leerTags();
        consultarTags();
    }
})

function leerTags() {
    const input = document.querySelector("#tags");
    input.addEventListener("keydown", (e)=>{
        if(e.keyCode === 32) {
            (e.target.value.trim() !== "") ? tags = [...tags, e.target.value.trim().toLowerCase()] : null;
            input.value = "";
            mostrarTags();
        }
    })
}
function mostrarTags() {
    const contenedorTags = document.querySelector(".tags");
    contenedorTags.innerHTML = "";
    tags.forEach((tag)=>{
        const tagName = document.createElement("LI");
        tagName.classList.add("tag");
        tagName.textContent = tag;
        contenedorTags.append(tagName);

        tagName.addEventListener("click", (e)=>{
            eliminarTag(e.target.innerText.toLowerCase());
        })
    })
    guardarTags();
}

function eliminarTag(etiqueta) {
    tags = tags.filter((tag => tag !== etiqueta));
    mostrarTags();
}

function guardarTags() {
    const inputEtiquetas = document.querySelector("#tag");
    inputEtiquetas.value = tags;
}

function consultarTags() {
    const inputHidden = document.querySelector("#tag");
    if(inputHidden.value !== "") {
        inputHidden.value.split(",").forEach((tag)=>{
            tags = [...tags, tag];
        })
        mostrarTags();
    }
}
})();