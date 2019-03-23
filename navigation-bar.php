<?php

  //TODO:
      // customizar baseado no status de logado ou não

?>


<header>
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="container bg-dark">
          <!-- logo -->
          <a href="#" class="navbar-brand">
            <div class="sr-only">Finans</div>
            <img src="" width="142">  
          </a>

          <!-- botao de hamburger -->
          <button class="navbar-toggler" data-toggle="collapse" data-target="#main-navigation-area">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- div para agrupar todos os elementos que serão escodindios em telas pequenas -->
          <div class="collapse navbar-collapse" id="main-navigation-area">
            <!-- menu -->
            <ul class="navbar-nav mr-5 ml-auto">
              <li class="nav-item">
                <a href="home.php" class="nav-link text-light">Home</a>
              </li>
              <li class="nav-item">
                <a href="cadastro.php" class="nav-link text-light">Cadastrar</a>
              </li>
              <li class="nav-item">
                <a href="login.php" class="nav-link text-light">Login</a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link text-light">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>