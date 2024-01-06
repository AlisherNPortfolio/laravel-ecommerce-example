import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import http from './http-common';
import i18n from './lang/i18n';
import {Store} from 'vuex';

import { Quasar, Notify, Dialog } from 'quasar'

import '@quasar/extras/material-icons/material-icons.css';
import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'
import 'quasar/src/css/index.sass';


// import 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css';
// import 'http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css';

const app = createApp(App);

declare module '@vue/runtime-core' {
    export interface ComponentCustomProperties {
        // $filters: null, <-- in order to add filters
        // $notification: null, <-- in order to add global notification tool
        $store: Store<any>
    }
}

// app.config.globalProperties.$filters = filters; <-- in order to add filters
// app.config.globalProperties.$notification = notification; <-- in order to add global notification tool

app.use(i18n);
app.use(store);
app.use(router);
app.provide('$api', http);

app.use(Quasar, {
    plugins: {
        Notify,
        Dialog
    },
    config: {
        notify: {

        }
    }
  })


app.config.compilerOptions.isCustomElement = (tag: any) => tag.includes('-');
app.config.devtools = false;

app.mount('#app');
