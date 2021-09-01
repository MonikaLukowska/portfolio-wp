class SmoothScroll {
  constructor() {
    this.links = document.querySelectorAll('.nav__list__link');
    this.logo = document.querySelector('.header__logo');
    this.ctBtn = document.querySelector('.hero__content__btn')
    this.bindEvent()
  }

  bindEvent() {
    this.links.forEach(link => {
      link.addEventListener('click', (e) => {this.scrollToSection(e, link)})
    })
   this.logo.addEventListener('click', () => {this.scrollTop()})
   this.ctBtn.addEventListener('click', (e) => { this.scrollToSection(e,this.ctBtn)})
  }

  scrollToSection(e, link) {
    e.preventDefault();
   
    const element = document.querySelector(link.getAttribute('href'))

    element.scrollIntoView({
      behavior: 'smooth'
    })
  }

  scrollTop() {
    window.scrollTo({
      top:0,
      behavior: 'smooth'
    })
  }
}

export default SmoothScroll