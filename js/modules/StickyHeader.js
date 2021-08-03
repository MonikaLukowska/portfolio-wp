class StickyHeader {
  constructor() {
    this.header = document.querySelector('.header')
    this.sticky = false;
    this.bindEvent()
  }

  bindEvent() {
    window.addEventListener('scroll', () => { this.stickHeader() })
  }

  stickHeader() {
    window.scrollY >= 100 && !this.scroll ? this.addClass()  : this.removeClass()
  }

  addClass() {
    this.header.classList.add('sticky');
    this.sticky= true;
  }

  removeClass() {
    if(!this.sticky) return
    this.header.classList.remove('sticky')
  }
}

export default StickyHeader