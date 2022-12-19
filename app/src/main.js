import {createApp, VueElement} from 'vue'
import App from './App.vue'
import router from './router'

import {request} from "@/utils/http";

VueElement.prototype.$request = request
createApp(App).use(router).mount('#app')
