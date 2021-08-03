class SmoothScroll {
  constructor() {
    this.links = document.querySelectorAll('.nav__list__link');
    this.bindEvent()
  }

  bindEvent() {
    this.links.forEach(link => {
      link.addEventListener('click', (e) => {this.scrollToSection(e, link)})
    })
  }

  scrollToSection(e, link) {
    e.preventDefault();
   
    const element = document.querySelector(link.getAttribute('href'))

    element.scrollIntoView({
      behavior: 'smooth'
    })
  }
}

export default SmoothScroll