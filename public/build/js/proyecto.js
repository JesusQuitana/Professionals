!function(){let e=[],t=[],n=[];function d(){const e=document.querySelector(".nombreProfesionalesSeleccionados");e.innerHTML="",t.forEach((o=>{nombreSeleccionado=document.createElement("LI"),nombreSeleccionado.textContent=`${o.nombre} ${o.apellido}`,e.appendChild(nombreSeleccionado),nombreSeleccionado.addEventListener("click",(()=>{t=t.filter((e=>e.id!==o.id)),n=n.filter((e=>e!==o.id)),document.querySelector("#profesional").value=n,d(),console.log(document.querySelector("#profesional"))}))}))}document.addEventListener("DOMContentLoaded",(function(){input=document.querySelector("#profesionals"),input.addEventListener("input",(o=>{!async function(o){const a=`${window.location}/profesionals`,c=new FormData;c.append("habilidad",o);const i=await fetch(a,{method:"POST",body:c}),s=await i.json();s.resultado&&(e=[],s.registro.forEach((t=>{e=[...e,t]})),function(e){const o=document.querySelector(".profesionals");o.innerHTML="",e.forEach((e=>{const{id:a,nombre:c,apellido:i,tags:s}=e,l=document.createElement("DIV");l.classList.add("profesional");const r=document.createElement("P");r.textContent=`${c} ${i}`,l.appendChild(r),o.appendChild(l),l.addEventListener("click",(()=>{!function(e){const{id:o,nombre:a,apellido:c,imagen:i,redes:s,tags:l}=e,r=document.querySelector("body"),p=document.createElement("DIV");p.classList.add("modal");const m=document.createElement("DIV");m.classList.add("card");const u=document.createElement("DIV");u.classList.add("titulo");const f=document.createElement("I");f.classList.add("fa-solid"),f.classList.add("fa-x");const E=document.createElement("P");E.classList.add("name"),E.textContent=`${a} ${c}`;const h=document.createElement("PICTURE"),b=document.createElement("SOURCE"),C=document.createElement("IMG");b.setAttribute("srcset",`/build/img/profes/${i}.webp`),b.setAttribute("type","image/webp"),C.setAttribute("loading","eager"),C.setAttribute("width","200px"),C.setAttribute("src",`/build/img/profes/${i}.png`),C.setAttribute("alt","profesional"),h.appendChild(b),h.appendChild(C);const L=document.createElement("A");L.classList.add("btn"),L.classList.add("verde"),L.textContent="Seleccionar";const S=document.createElement("DIV");S.classList.add("habilidades"),l.split(",").forEach((e=>{const t=document.createElement("P");t.classList.add("habilidad"),t.textContent=e.toUpperCase(),S.appendChild(t)})),socialMedia=JSON.parse(s);const g=document.createElement("DIV");g.classList.add("redesSociales"),Object.keys(socialMedia).forEach((e=>{const t=document.createElement("A");t.setAttribute("href",socialMedia[e]),t.innerHTML=`<i class="fa-brands fa-${e}"></i>`,g.appendChild(t)})),L.addEventListener("click",(()=>{const o=document.querySelector("#profesional");t=[...t,e],n=[...n,e.id],o.value=[n],d(),p.remove()})),f.addEventListener("click",(()=>{p.remove()})),u.appendChild(E),u.appendChild(f),m.appendChild(u),m.appendChild(h),m.appendChild(S),m.appendChild(g),m.appendChild(L),p.appendChild(m),r.appendChild(p)}(e)}))}))}(e))}(o.target.value)}))}))}();
//# sourceMappingURL=proyecto.js.map