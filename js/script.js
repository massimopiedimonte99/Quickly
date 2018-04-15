addEventListener('DOMContentLoaded', () => {
  document.querySelector('.quickly-navbar-hamburger-menu').onclick = function(e) {
    document.querySelector('.quickly-navbar-content').classList.toggle('quickly-navbar-content-on');
    document.querySelectorAll('.js-quickly-navbar-hamburger-menu-item')[0].classList.toggle('js-quickly-navbar-hamburger-menu-item-on');
    document.querySelectorAll('.js-quickly-navbar-hamburger-menu-item')[1].classList.toggle('js-quickly-navbar-hamburger-menu-item-on');
    document.querySelectorAll('.js-quickly-navbar-hamburger-menu-item')[2].classList.toggle('js-quickly-navbar-hamburger-menu-item-on');
    document.querySelector('.quickly-navbar-brand').classList.toggle('js-quickly-navbar-brand-on');
  }
});
