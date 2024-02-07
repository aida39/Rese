document.addEventListener('DOMContentLoaded', function () {
    const target = document.getElementById("menu");
    const menuImage = document.getElementById("menuImage");

    target.addEventListener('click', () => {
        target.classList.toggle('open');
        const nav = document.getElementById("nav");
        nav.classList.toggle('in');

        const isOpen = target.classList.contains('open');
        menuImage.src = isOpen ? "/images/logo_close.png" : "/images/logo_open.png";

        const inputElements = document.querySelectorAll('input');
        inputElements.forEach(input => {
            if (isOpen) {
                input.setAttribute('data-placeholder', input.placeholder);
                input.placeholder = '';
            } else {
                const originalPlaceholder = input.getAttribute('data-placeholder');
                input.placeholder = originalPlaceholder;
            }
        });
    });
});
