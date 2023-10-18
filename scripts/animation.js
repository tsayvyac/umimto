window.addEventListener('scroll', () => {
    var text1 = document.querySelector('.text1');
    var text2 = document.querySelector('.text2');
    var text3 = document.querySelector('.text3');
    var textPosition1 = text1.getBoundingClientRect().top;
    var textPosition2 = text2.getBoundingClientRect().top;
    var textPosition3 = text3.getBoundingClientRect().top;
    var screenPosition = window.innerHeight /1.3;
    if (textPosition1 < screenPosition) {
        text1.classList.add('active');
    } else {
        text1.classList.remove('active');
    }
    if (textPosition2 < screenPosition) {
        text2.classList.add('active');
    } else {
        text2.classList.remove('active');
    }
    if (textPosition3 < screenPosition) {
        text3.classList.add('active');
    } else {
        text3.classList.remove('active');
    }
});