function openMenu(){
    var heightOfHeader = document.getElementById("header");
    var loginBtn = document.getElementById("hide__login--containerID");
    if (loginBtn.className === "hide__login--container") {
        loginBtn.className += " responsive";
        heightOfHeader.className = " responsive";
    } else {
        loginBtn.className = "hide__login--container";
        heightOfHeader.className = "header";
    }
}

var acc = document.getElementsByClassName('label');
for (var i=0; i<acc.length; i++) {
  acc[i].addEventListener('click', function() {
    this.classList.toggle('active');
    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + 'px';
    }
  });
}