!function(){let e=[];function t(){const n=document.querySelector(".tags");n.innerHTML="",e.forEach((o=>{const a=document.createElement("LI");a.classList.add("tag"),a.textContent=o,n.append(a),a.addEventListener("click",(n=>{var o;o=n.target.innerText.toLowerCase(),e=e.filter((e=>e!==o)),t()}))})),document.querySelector("#tag").value=e}document.addEventListener("DOMContentLoaded",(function(){!function(){const n=document.querySelector("#tags");n.addEventListener("keydown",(o=>{32===o.keyCode&&(""!==o.target.value.trim()&&(e=[...e,o.target.value.trim().toLowerCase()]),n.value="",t())}))}(),function(){const n=document.querySelector("#tag");""!==n.value&&(n.value.split(",").forEach((t=>{e=[...e,t]})),t())}()}))}();
//# sourceMappingURL=tagsProfesionales.js.map