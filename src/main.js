import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'

import SitioInterno from './sitioInterno/App.vue'
import VotanteIndex from './sitioInterno/votante/index.vue'
import Votar from './sitioInterno/votante/vote.vue'

import SitioPublicidad from './sitioPublicidad/App.vue'
import Register from './sitioPublicidad/seguridad/register.vue'
import Login from './sitioPublicidad/seguridad/login.vue'

const routes = [
    { path: '/sitioInterno/:idUsuario', component: SitioInterno,
        children:[
            { path: '/votante/:idUsuario', component: VotanteIndex },
            { path: '/votante/:idUsuario/:idVotacion/votar', component: Votar }
        ]
    },
    { path: '/sitioPublicidad', component: SitioPublicidad,
    children:[
        { path: '/register', component: Register },
        { path: '/login', component: Login }
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