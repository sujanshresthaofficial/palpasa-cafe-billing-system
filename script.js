let scrollTop = document.getElementById("scrollTop");

window.addEventListener("scroll", () => {
    if(window.scrollY > 300){
        scrollTop.style.display = "block";
    }else{
        scrollTop.style.display = "none";
    }
});

scrollTop.addEventListener("click", () => {
    window.scrollTo({
        top:0,
        behavior:"smooth"
    });
});