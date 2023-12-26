const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

window.addEventListener('DOMContentLoaded', initJsToggle);

function initJsToggle() {
    $$('.js-toggle').forEach((button) => {
        const target = button.getAttribute('toggle-target');
        button.onclick = (e) => {
            e.preventDefault();
            const isHidden = $(target).classList.contains('hide');

            if (isHidden) {
                $(target).classList.toggle('show');
            } else {
                $(target).classList.toggle('hide');
            }
        };
    });
}
