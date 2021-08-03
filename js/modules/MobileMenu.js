class MobileMenu {
  constructor() {
    this.menu = document.querySelector(".nav");
    this.burger = document.querySelector(".header__burger");
    this.links = document.querySelectorAll('.nav__list__link');
    this.events()
  }

  events() {
   window.addEventListener('resize', () => {this.adaptNav()})
   this.burger.addEventListener("click", (e) => this.toggleMenu());
   this.links.forEach(link => {
    link.addEventListener('click', (e) => {this.toggleMenu()})
  })
  }

  toggleMenu() {
    this.menu.classList.toggle("active")
    this.burger.classList.toggle('close')
  }

  adaptNav() {
    if(window.matchMedia('(min-width:1366px)').matches && this.menu.classList.contains('active')) {
      this.menu.classList.remove('active')
      this.burger.classList.remove('close')
    }
  }
}

export default MobileMenu
