<template>
    <header id="header">
       <!--menu, se asigna el contenedor-->
       <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
           <!--menu a la izquierda-->
           <div class="uk-navbar-left">
               <ul class="uk-navbar-nav">
                   <li class="uk-parent">
                       <router-link class="text-menu" to="/home">
                           <img src="/assets/imagenes/logo.png" class="logo img-responsive" />
                       </router-link>
                   </li>
                   <li class="uk-parent uk-visible@m"><a class="text-menu" href="/home#lstClientes">Clientes</a></li>
                   
                   <li class="uk-parent uk-visible@m"><a class="text-menu" href="#">Caracteristicas</a></li>
                   <div class="uk-navbar-dropdown uk-visible@m">
                       <ul class="uk-nav uk-navbar-dropdown-nav">
                           <li class=""><a href="/home#lstCaractFuncUsuario">Usuario</a></li>
                           <li class=""><a href="/home#lstCaractTenicas">Técnicas</a></li>
                       </ul>
                   </div>
   
                   <li class="uk-parent uk-visible@m"><a class="text-menu" href="/home#lstFuncAdministradores">Funcionalidades administradores</a></li>
                   <li class="uk-parent uk-visible@m"><a class="text-menu" href="/home#srvCliente">Servicio al cliente</a></li>
                   <li class="uk-parent uk-visible@m"><a class="text-menu" href="/home#planesPrecios">Planes y precios</a></li>
               </ul>
           </div>
           <!--menu a la derecha-->
           <div class="uk-navbar-right red-on-hover">
               <ul class="uk-navbar-nav">
                   <li class="uk-parent uk-visible@m"><router-link class="text-menu" to="/register">Registrarse</router-link></li>
                   <li class="uk-parent uk-visible@m"><router-link class="text-menu" to="/login">Ingresar</router-link></li>
                   <li class="uk-hidden@m">
                       <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#menu-responsivo" uk-toggle></a>
                   </li>
               </ul>
           </div>
       </nav>
       <!-- This is the off-canvas -->
       <nav id="menu-responsivo" uk-offcanvas class="uk-hidden@m">
           <div class="uk-offcanvas-bar">
               <button class="uk-offcanvas-close" type="button" uk-close></button>
               <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
                   <li>
                       <router-link class="text-menu" to="/#bienvenida">
                           <img src="/assets/imagenes/logo.png" class="logo img-responsive" style="margin-left: -5px; margin-top: -13px;" />
                       </router-link>
                   </li>
                   <li><a class="text-menu" href="/#lstClientes">Clientes</a></li>
                   <li class="uk-parent">
                       <a href="#" class="text-menu">Caracteristicas</a>
                       <ul class="uk-nav-sub">
                           <li class=""><a class="text-menu" href="/#lstCaractFuncUsuario">Usuario</a></li>
                           <li class=""><a class="text-menu" href="/#lstCaractTenicas">Técnicas</a></li>
                       </ul>
                   </li>
                   <li><a class="text-menu" href="/#lstFuncAdministradores">Funcionalidades administradores</a></li>
                   <li><a class="text-menu" href="/#srvCliente">Servicio al cliente</a></li>
                   <li><a class="text-menu" href="/#planesPrecios" >Planes y precios</a></li>
                   <li class="uk-nav-divider"></li>
                   <li><router-link class="text-menu" to="/register">Registrarse</router-link></li>
                   <li><router-link class="text-menu" to="/login">Ingresar</router-link></li>
               </ul>
           </div>
       </nav>
   </header>
   </template>
   
   