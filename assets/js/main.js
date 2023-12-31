const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

window.addEventListener('DOMContentLoaded', initJsToggle);

function initJsToggle() {
    $$('.js-toggle').forEach((button) => {
        const target = button.getAttribute('toggle-target');
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const isHidden = $(target).classList.contains('hide');

            if (isHidden) {
                $(target).classList.remove('hide');
                $(target).classList.add('show');
            } else {
                $(target).classList.remove('show');
                $(target).classList.add('hide');
            }
        });
    });
}
