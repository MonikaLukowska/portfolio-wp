class Modal{
  constructor() {
    this.portfolioBtns = document.querySelectorAll('.portfolio__grid__view');
    this.modal = document.querySelector('.modal')
    this.image = document.querySelector('.modal__image')
    this.figcaption = document.querySelector('.modal__figcaption')
    this.close = document.querySelector('.modal__close')
    this.current;
    this.src;
    this.link;
    this.open = false;
    this.bindEvent()
  }

  bindEvent() {
    this.portfolioBtns.forEach(btn => {
      btn.addEventListener('click', () => { this.openModal(btn) })
    })
    this.close.addEventListener('click', () => { this.closeModal() })
  }

  openModal(btn) {
    this.open = true;
    this.current = btn.dataset.currentNo;
    this.src = btn.dataset.src;
    this.link = btn.dataset.link;

    this.image.src = this.src;
    this.figcaption.innerHTML = `Live: <a href=${this.link}>${this.link}</a>`;

    this.open == true ? this.modal.classList.add('open') : ''

  }

  closeModal() {
    this.modal.classList.remove('open');
    this.open = false;
  }
}

export default Modal