import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'

import SitioInterno from './sitioInterno/App.vue'

import CrearVotacion from './sitioInterno/votacion/create.vue'

import VotanteIndex from './sitioInterno/votante/index.vue'
import Votar from './sitioInterno/votante/vote.vue'

import ResultadosIndex from './sitioInterno/resultados/index.vue'
import resultDetalle from './sitioInterno/resultados/resultDetails.vue'
import Votaciones from './sitioInterno/votacion/index.vue'
import Votacion from './sitioInterno/votacion/edit.vue'

import SitioPublicidad from './sitioPublicidad/App.vue'
import Home from './sitioPublicidad/home.vue'
import Register from './sitioPublicidad/seguridad/register.vue'
import Login from './sitioPublicidad/seguridad/login.vue'

const routes = [
    { 
        path: '/', component: SitioPublicidad ,
        children: [
            { path: '/', component: Home },
            { path: '/home', component: Home },
            { path: '/register', component: Register },
            { path: '/login', component: Login }
        ]
    }, 
    { 
        path: '/sitioInterno/:idUsuario', component: SitioInterno,
        children:[
            { path: '/votante/:idUsuario', component: VotanteIndex },
            { path: '/votante/:idUsuario/:idVotacion/votar', component: Votar },
            { path: '/votacion/create/:idUsuario', component: CrearVotacion },
            //{ path: '/votacion/:idUsuario', component:  },--componente index de editar
            //{ path: '/votacion/:idUsuario/:idVotacion/', component:  }, --componente editar votacion
            { path: '/resultados/:idUsuario', component: ResultadosIndex },
            { path: '/resultados/:idUsuario/:idVotacion', component: resultDetalle },
            { path: '/votaciones/:idUsuario', component: Votaciones },
            { path: '/votacion/:idUsuario/:idVotacion/edit', component: Votacion },
        ]
    },
    /*{
        path: '/sitioPublicidad', component: SitioPublicidad,
        children: [
            { path: '/home', component: Home },
            { path: '/register', component: Register },,
            { path: '/login', component: Login }
        ]
    },*/
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

const app = createApp(App)

app.use(router)

app.mount('#app')