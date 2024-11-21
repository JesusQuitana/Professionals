document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelector("#img"),t=document.querySelector("#img_up");e.addEventListener("input",(e=>{const n=document.createElement("P");t.innerHTML="",n.classList.add("img_upload"),n.textContent=e.target.files[0].name,t.appendChild(n)}))}));
//# sourceMappingURL=upload_img.js.map
