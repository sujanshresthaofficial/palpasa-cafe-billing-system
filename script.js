let scrollTop = document.getElementById("scrollTop");

window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
        scrollTop.style.display = "block";
    } else {
        scrollTop.style.display = "none";
    }
});

scrollTop.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

function validateLogin() {
    username = document.getElementById("loginEmail").value;
    password = document.getElementById("loginPassword").value;
    signinError = document.getElementById("signinError");

    if ((username && password) == "") {
        signinError.innerHTML = "Email or Password is invalid!";
        return false;
    } else if (username != "admin@palpasa.cafe") {
        signinError.innerHTML = "Email doesn't match!";
        return false;
    } else if(password != "admin") {
        signinError.innerHTML = "Password doesn't match!"
        return false;
    }
    window.location.href = "dashboard.html";
    return false;
}