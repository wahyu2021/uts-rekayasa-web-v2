import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import './bootstrap';
import './typingEffect';
import './stepRulerHover';
import './scrollToTop';

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
window.Swal = Swal;

import AOS from 'aos';
AOS.init({
  once: true, // whether animation should happen only once - while scrolling down
});
