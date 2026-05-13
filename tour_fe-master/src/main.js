import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Default from './Layout/Wrapper/index.vue'
import Client from './layout/wrapper/client.vue'
import Auth from './layout/wrapper/auth.vue'
import axios from 'axios';

import Toaster from "@meforma/vue-toaster";

const app = createApp(App)

app.use(router, axios, Toaster)
app.component("client-layout", Client);
app.component("auth-layout", Auth);
app.component("default-layout", Default);

app.mount("#app")