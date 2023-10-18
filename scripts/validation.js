var form = document.getElementById("form");

form.addEventListener("submit", (e) => {
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var passwordCheck = document.getElementById("passwordCheck");
    var email = document.getElementById("email");
    var usernameValue = username.value.trim();
    var passwordValue = password.value.trim();
    var passwordCheckValue = passwordCheck.value.trim();
    var emailValue = email.value.trim();

    if (usernameValue === "") {
        e.preventDefault();
        setErrorFor(username, "Pole je povinné");
    } else if (!usernameControl(usernameValue)) {
        e.preventDefault();
        setErrorFor(username, "Musí obsahovat symboly a-Z a 0-9");
    } else if (usernameValue.length < 3) {
        e.preventDefault();
        setErrorFor(username, "Musí mít délku alespoň 3");
    } else {
        setSuccessFor(username);
    }

    if (emailValue === "") {
        e.preventDefault();
        setErrorFor(email, "Pole je povinné");
    } else if (!emailControl(emailValue)) {
        e.preventDefault();
        setErrorFor(email, "Špatný formát e-mailové adresy");
    } else {
        setSuccessFor(email);
    }

    if (passwordValue === "") {
        e.preventDefault();
        setErrorFor(password, "Pole je povinné");
    } else if (passwordValue.length < 8) {
        e.preventDefault();
        setErrorFor(password, "Musí mít délku alespoň 8");
    } else if (!passwordControl(password.value)) {
        setErrorFor(password, "Musí obsahovat alespoň jedno velké písmeno")
    } else {
        setSuccessFor(password);
    }

    if (passwordCheckValue !== passwordValue) {
        e.preventDefault();
        setErrorFor(passwordCheck, "Hesla se neshodují");
    } else {
        setSuccessFor(passwordCheck);
    }

    function setErrorFor(input, message) {
        var formControl = input.parentElement;
        var small = formControl.querySelector("small");
        small.innerText = message;
        formControl.className = "form__control error";
    }
    
    function setSuccessFor(input) {
        var formControl = input.parentElement;
        formControl.className = "form__control success";
    }
    
    function emailControl(email) {
        return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }
    
    function usernameControl(username) {
        return /^[a-zA-Z0-9]{3,}/.test(username);
    }

    function passwordControl(password) {
        return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password);
    }
});