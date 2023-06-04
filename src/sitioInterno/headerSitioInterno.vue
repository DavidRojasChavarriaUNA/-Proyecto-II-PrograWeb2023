<template>
  <header>
    <!-- Navbar en color oscuro -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <router-link class="navbar-brand" :to="/sitioInterno/ + usuario.id">
          <img id="logoMenu" src="/assets/imagenes/logo.png">
        </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" id="menuVotante" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">Votante</a>
              <ul class="dropdown-menu" aria-labelledby="menuVotante">
                <li>
                  <router-link class="dropdown-item" :to="`/votante/${usuario.id}`">Votaciones pendientes</router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-light" id="menuAdmin"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración</a>
              <ul class="dropdown-menu" aria-labelledby="menuAdmin">
                <li>
                  <router-link class="dropdown-item" :to="`/votacion/create/${usuario.id}`">Crear votación</router-link>
                </li>
                <li>
                  <router-link class="dropdown-item" :to="`/votaciones/${usuario.id}`">Modificar votación</router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link class="nav-link text-light" :to="`/resultados/${usuario.id}`">Resultados</router-link>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav d-flex">
            <li class="me-3">
              <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search">
                <button class="btn btn-primary" type="button">Search</button>
              </form>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light">{{usuario.user}}</a>
            </li>
            <li class="nav-item">
              <router-link class="nav-link text-light" to="/">Salir</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
  export default {
    props: ['usuario'],
  }
</script>