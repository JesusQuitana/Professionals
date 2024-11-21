(function() {
document.addEventListener("DOMContentLoaded", function() {
    const darkmode = document.querySelector(".darkmode");
    const moon = document.querySelector(".fa-moon");
    const sun = document.querySelector(".fa-sun");

    if(window.matchMedia('(prefers-color-scheme:dark)').matches) {
        document.querySelector("body").classList.add("dark");
        sun.classList.add("select");
    } else {
        document.querySelector("body").classList.remove("dark");
        moon.classList.add("select");
    }
    
    darkmode.addEventListener("click", ()=> {

        if(sun.classList.contains("select")) {
            sun.classList.remove("select");
            moon.classList.add("select");
            document.querySelector("body").classList.remove("dark");
        } else if(moon.classList.contains("select")) {
            moon.classList.remove("select");
            sun.classList.add("select");
            document.querySelector("body").classList.add("dark");
        }
    })
})
})();