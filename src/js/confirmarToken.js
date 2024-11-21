(function() {
document.addEventListener("DOMContentLoaded", function() {
    if(document.querySelector("#token")) {
        verificarInput();
    }
})

function verificarInput() {
    const input = document.querySelector("#token");
    input.addEventListener("input", (e)=>{
        if(e.target.value.length > 6) {
            input.value = e.target.value.slice(0, 6);
        } else if(e.target.value.length == 6) {
            document.querySelector(".formulario__loading").innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i>`;
            validarToken(e.target.value);
        }
    })
}

function limpiarInputs() {
    const input = document.querySelector("#token");
    const loading = document.querySelector(".formulario__loading");
    input.value = "";
    loading.innerHTML = "";
}

async function validarToken(token) {
    const url = `${window.location.origin}/confirmar`;
    const datos = new FormData();
    datos.append("token", token);

    const respuesta = await fetch(url, {
        method : "POST",
        body : datos
    });
    const resultado = await respuesta.json();

    if(resultado.resultado) {
        limpiarInputs();
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            color: "#000",
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: `<span style='color: #000'>${resultado.mensaje} (Redirigiendo <i class="fa-solid fa-spinner fa-spin"></i>)</span>`
        });
        setTimeout(()=>{
            window.location.href = window.location.origin;
        },2000)
    }
    else {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            color: "#000",
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: `<span style='color: #000'>${resultado.error}</span>`
        });
    }
}
})();