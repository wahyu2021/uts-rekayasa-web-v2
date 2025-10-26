import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import './bootstrap';
import './typingEffect';
import './stepRulerHover';
import './scrollToTop';


import AOS from 'aos';
AOS.init({
  once: true, // whether animation should happen only once - while scrolling down
});
