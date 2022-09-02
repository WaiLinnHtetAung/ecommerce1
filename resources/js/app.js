require('./bootstrap');
import { createApp } from "vue/dist/vue.esm-bundler";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import { loadFonts } from "./plugins/webfontloader";
import NotificationComponent from './components/NotificationComponent.vue';
import AuthorizationComponent from './components/Authorization.vue';
import Post from './components/notification/Post.vue';
import EmailVerify from './components/EmailVerify.vue';
import Swal from "sweetalert2";
import moment from 'moment';

loadFonts();
window.Swal = Swal;
window.moment=moment;
const app = createApp({
    data(){
        return {
            message:'Hello Welcome',
        }
    },
    components:{
        'notification-component':NotificationComponent,
        'app-component':App,
        'auth-component':AuthorizationComponent,
        'email-component':EmailVerify
    }
});
app.use(store);
app.use(router);
app.use(vuetify);
app.mount("#app");
