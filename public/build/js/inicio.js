document.addEventListener("DOMContentLoaded",(function(){!function(){const e=document.querySelectorAll(".contacto_radio");e&&e.forEach((e=>{e.addEventListener("input",(e=>{!function(e){const t=document.querySelector(".acerca_de");if(t.lastChild&&t.lastChild.remove(),1==e){const e=document.createElement("INPUT");e.setAttribute("type","tel"),e.setAttribute("name","telf"),e.setAttribute("placeholder","Ej. 04144663318"),t.appendChild(e)}else if(2==e){const e=document.createElement("INPUT");e.setAttribute("type","email"),e.setAttribute("name","email"),e.setAttribute("placeholder","Ej. correo@correo.com"),t.appendChild(e)}}(e.target.value)}))}))}(),async function(){if(document.querySelector(".carrusel")){const e=`${window.location}/profesionals`,t=await fetch(e),o=await t.json();console.log(o)}}()}));
//# sourceMappingURL=inicio.js.map