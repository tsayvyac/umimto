// var loguser = document.getElementById("loguser");
// var logpass = document.getElementById("logpass");

// form.addEventListener("submit", (e) => {
//     e.preventDefault();
    
//     checkLogInputs();
// })

// function checkLogInputs() {
//     var loguserValue = loguser.value.trim();
//     var logpassValue = logpass.value.trim();

//     if (loguserValue ==="")
// }

var form = document.getElementById("form");
var username = document.getElementById("username");
var password = document.getElementById("password");
var passwordCheck = document.getElementById("passwordCheck");
var email = document.getElementById("email");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    checkInputs();
})

function checkInputs() {
    var usernameValue = username.value.trim();
    var passwordValue = password.value.trim();
    var passwordCheckValue = passwordCheck.value.trim();
    var emailValue = email.value.trim();

    if (usernameValue === "") {
        setErrorFor(username, "Invalid username");
        e.preventDefault();
    } else if (!usernameControl(usernameValue)) {
        setErrorFor(username, "Invalid sym");
        return false;
    } else if (usernameValue.length < 3) {
        setErrorFor(username, "Short user");
        return false;
    } else {
        setSuccessFor(username);
    }

    if (emailValue === "") {
        setErrorFor(email, "Invalid email");
        return false;
    } else if (!emailControl(emailValue)) {
        setErrorFor(email, "Invalid sym");
        return false;
    } else {
        setSuccessFor(email);
    }

    if (passwordValue === "") {
        setErrorFor(password, "Invalid password");
        return false;
    } else if (passwordValue.length < 8) {
        setErrorFor(password, "Short");
        return false;
    } else {
        setSuccessFor(password);
    }

    if (passwordCheckValue !== passwordValue) {
        setErrorFor(passwordCheck, "Invalid password");
        return false;
    } else if (passwordCheckValue === "") {
        setErrorFor(passwordCheck, "Invalid password");
        return false;
    } else if (passwordCheckValue.length <8) {
        setErrorFor(passwordCheck, "Short");
        return false;
    } else {
        setSuccessFor(passwordCheck);
    }
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

// LIVE VALIDATION FORM JS!!!------------------------------------------------------------------
