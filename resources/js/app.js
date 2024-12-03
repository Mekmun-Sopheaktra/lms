import './bootstrap';
import 'bootstrap/dist/js/bootstrap.min.js';
import './library/smoothscroll.min.js';
import 'animate.css';
import VueAwesomePaginate from "vue-awesome-paginate";
import '../style/app.scss';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import piniaPersist from 'pinia-plugin-persistedstate';

const app = createApp(App)
app.use(router)
const pinia = createPinia()
pinia.use(piniaPersist)
app.use(pinia)
app.use(VueAwesomePaginate)
app.mount('#app')

SmoothScroll({
    animationTime: 800,
    stepSize: 75,
    accelerationDelta: 30,
    accelerationMax: 2,
    keyboardSupport: true,
    arrowScroll: 50,
    pulseAlgorithm: true,
    pulseScale: 4,
    pulseNormalize: 1,
    touchpadSupport: true,
    fixedBackground: true
});
