(function() {
document.addEventListener("DOMContentLoaded", function() {
    const img = document.querySelector("#img");
    const img_up = document.querySelector("#img_up");
    if(img_up) {
        img.addEventListener("input", (e)=>{
            const nameImg = document.createElement("P");
            img_up.innerHTML = "";
            nameImg.classList.add("img_upload");
            nameImg.textContent = e.target.files[0].name;
            img_up.appendChild(nameImg);
        })
    }
})
})();