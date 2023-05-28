import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'

import SitioInterno from './sitioInterno/App.vue'
import Votante from './sitioInterno/votante/App.vue'

const routes = [
    { path: '/sitioInterno/:idUsuario', component: SitioInterno,
        children:[
            { path: '/votante/:idUsuario', component: Votante }
        ]
    },
]
  
const router = createRouter({
    history: createWebHistory(),
    routes: routes
})
  
const app = createApp(App)
  
app.use(router)

app.mount('#app')