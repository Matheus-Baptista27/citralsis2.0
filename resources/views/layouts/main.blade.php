<!DOCTYPE html>
<html lang="pt-BR">
<head>  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Language" content="pt-BR">
        <meta name="google" content="notranslate">

        <title>@yield('title')</title>
         <!-- fonte google--> <!--<link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->

         <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

         <!-- CSS BOOTSTRAP-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- CSS DA APLICAÇÃO -->
        <link rel="stylesheet" href="/css/styles.css">
        <!-- <script src="/js/scripts.js"></script> -->
    </head>
    <body>
        <header>
           <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="/" class="navbar-brand">
                <img src="/img/logoSemFundo.png" alt="logoSemFundo">
            </a>


                     @auth
                        <li class="nav-item nav-link">
                            Olá, <strong>{{ auth()->user()->name }}</strong>

                            @if(auth()->user()->is_admin)
                                <span class="badge badge-danger">ADMIN</span>
                            @endif
                        </li>
                    @endauth

            <!-- BOTÃO HAMBURGUER -->
            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a href="/" class="nav-link">Início</a>
                    </li>

                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Atividade</a>
                    </li>


                    @auth
                    @if(auth()->user()->is_admin)

                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                Usuários
                            </a>
                        </li>
                    @endif
                    @endauth

                    @auth
                   <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            {{ auth()->user()->is_admin ? 'Todas as Atividades' : 'Minhas Atividades' }}
                        </a>
                    </li>

                <!-- aqui era onde estav ao código para aparecer o "Olá, usuario" na navbar-->

                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="nav-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </a>
                        </form>
                    </li>
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <!--<li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>-->
                    @endguest

                </ul>
            </div>

        </nav>
            </header>

            <main>
                <div class="container-fluid">
                    <div class="row">
                        @if(session('msg'))
                        <p class="msg"> {{ session('msg') }}</p>
                        @endif
                         @yield('content')
                        </div>
                    </div>
                </main>
                <footer>
                    <p>CITRAL SIS 2.0 &copy; 2026</p>
                    <p class="footer-author">Desenvolvido por: Matheus Baptista</p>
                 </footer>

                  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
                  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
