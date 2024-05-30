document.addEventListener('DOMContentLoaded', function () {
    const target = document.getElementById("menu");
    const menuImage = document.getElementById("menuImage");
    const nav = document.getElementById("nav");
    const searchButton = document.querySelector(".search__button");
    const inputElements = document.querySelectorAll('input');

    target.addEventListener('click', () => {
        target.classList.toggle('open');
        nav.classList.toggle('in');

        const isOpen = target.classList.contains('open');
        menuImage.src = isOpen ? "/images/logo_close.jpg" : "/images/logo_open.jpg";

        if (isOpen) {
            inputElements.forEach(input => {
                input.setAttribute('data-placeholder', input.placeholder);
                input.placeholder = '';
            });
        } else {
            inputElements.forEach(input => {
                const originalPlaceholder = input.getAttribute('data-placeholder');
                input.placeholder = originalPlaceholder;
            });
        }

        if (isOpen) {
            searchButton.classList.add('hidden');
        } else {
            searchButton.classList.remove('hidden');
        }
    });
});
