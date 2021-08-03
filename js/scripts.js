import "../css/style.css";

import StickyHeader from './modules/StickyHeader'
import MobileMenu from "./modules/MobileMenu";
import Modal from "./modules/Modal";
import SmoothScroll from "./modules/SmoothScroll";





// Allow new JS and CSS to load in browser without a traditional page refresh
if (module.hot) {
  module.hot.accept();
}

const APP = window.APP || {}
const initApp = () => {
  window.APP = APP

  //APP.Layout = new Layout()
 
  new Modal
  new MobileMenu
  new SmoothScroll
  new StickyHeader
}




if (document.readyState === 'complete' || (document.readyState !== 'loading' && !document.documentElement.doScroll)) {
  initApp()
 
}else {
  document.addEventListener('DOMContentLoaded', initApp)
}
