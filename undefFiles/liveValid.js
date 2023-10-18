var username = document.getElementById("username");
var password = document.getElementById("password");
var passwordCheck = document.getElementById("passwordCheck");
var email = document.getElementById("email");
var date = document.getElementById("date");

function checkUsername() {
    if (username.value === "") {
        setErrorFor(username, "Pole je povinné");
    } else if (!usernameControl(username.value)) {
        setErrorFor(username, "Musí obsahovat symboly a-Z a 0-9");
    } else if (username.value.length < 3) {
        setErrorFor(username, "Musí mít délku alespoň 3");
    } else {
        setSuccessFor(username, "");
    }
}

function checkPass() {
    if (password.value === "") {
        setErrorFor(password, "Pole je povinné");
    } else if (password.value.length < 8) {
        setErrorFor(password, "Musí mít délku alespoň 8");
    } else if (!passwordControl(password.value)) {
        setErrorFor(password, "Musí obsahovat alespoň jedno velké písmeno")
    } else {
        setSuccessFor(password, "");
    }
}

function checkPassCheck() {
    if (passwordCheck.value !== password.value) {
        setErrorFor(passwordCheck, "Hesla se neshodují");
    } else if( passwordCheck.value === ""){
        setErrorFor(passwordCheck, "Pole je povinné");
    } else {
        setSuccessFor(passwordCheck, "");
    }
}

function checkEmail() {
    if (email.value === "") {
        setErrorFor(email, "Pole je povinné");
    } else if (!emailControl(email.value)) {
        setErrorFor(email, "Špatný formát e-mailové adresy");
    } else {
        setSuccessFor(email, "");
    }
}

function setErrorFor(input, message) {
    var formControl = input.parentElement;
    var small = formControl.querySelector("small");
    small.innerText = message;
    formControl.className = "form__control error";
}

function setSuccessFor(input, message) {
    var formControl = input.parentElement;
    var small = formControl.querySelector("small");
    small.innerText = message;
    formControl.className = "form__control success";
}

function emailControl(email) {
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function usernameControl(username) {
    return /^[a-zA-Z0-9]+$/.test(username);
}

function passwordControl(password) {
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password);
}