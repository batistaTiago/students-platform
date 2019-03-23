<?php

    require 'validate-login.php';
    require 'student.php';
    // TODO:
        // preencher o formulario com as informações recuperadas

    // echo '<pre>';
    // print_r(unserialize($_SESSION['user']));
    // echo '<pre>';

?>


<html>
<head>
    <title>Editar perfil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="scripts/cadastro.js"></script>


    <!-- Bootstrap -->
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous">
</script>
    <script src="scripts/get-user-data.js"></script>
</head>
<body onload="requestUserData()">

    <div class="container">
        <?php include 'navigation-bar.php'; ?>
        <div class="row d-flex">
            <h1 id="cadastro-title" class="display-2 centralized-element">Editar informações de Aluno</h1>
            <img id="banner-image" class="centralized-element" src="images/banner.jpg">

            <div class="centralized-element col-12 w-75" style="border: 2px solid green">
                <h2>Informações</h2>
                <form id="form" action="processa-edicao-cadastro.php" method="post">
                    <div id="studentEmailContainer" class="centralized-element">
                        <label>Nome: </label>
                        <input id="studentEmailTextField" name="studentEmail" type="email" onkeyup="keyUp()" value="" readonly>
                    </div>

                    <div id="studentPasswordContainer" class="centralized-element">
                        <label>Senha: </label>
                        <input id="studentPasswordTextField" name="studentPassword" type="password" placeholder="Digite sua senha" onkeyup="keyUp()">
                    </div>

                    <div id="studentPasswordConfirmationContainer" class="centralized-element">
                        <label>confirmação: </label>
                        <input id="studentPasswordConfirmationTextField" name="studentPasswordConfirmation" type="password" placeholder="Confirme sua senha" onkeyup="keyUp()">
                    </div>

                    <div class="centralized-element">
                        <label>Idade: </label>
                        <input id="studentAgeNumberField" name="studentAge" type="number" placeholder="Digite sua idade" onkeyup="keyUp()">
                    </div>

                    <div class="centralized-element">
                        <label>Escolaridade: </label>
                        <select id="studentSchoolLevelComboBox" name="studentSchoolLevel">
                            <option>Selecione</option>
                            <option>Fundamental</option>
                            <option>Médio</option>
                            <option>Pré-vestibular</option>
                        </select>
                    </div>

                    <div class="centralized-element">
                        <label>Fez ENEM antes: </label>
                        <select id="studentIsExperiencedComboBox" name="studentIsExperienced">
                            <option>Selecione</option>
                            <option id="exp-0">Não</option>
                            <option id="exp-1">Sim</option>
                        </select>
                    </div>

                    <div class="centralized-element">
                        <label>Area de preferência: </label>
                        <select id="studentPreferredAreaComboBox" name="studentPreferredArea">
                            <option>Selecione</option>
                            <option>Exatas</option>
                            <option>Tecnológica</option>
                            <option>Biológicas</option>
                            <option>Humanas</option>
                            <option>Saúde</option>
                        </select>
                    </div>

                    <div class="centralized-element">
                        <label>Curso pretendido: </label>
                        <select>
                            <!-- talvez seja melhor adicionar pelo js ao inves de adicionar na mão -->
                            <option>adicionar cursos...</option>
                        </select>
                    </div>

                </form>
                <button onclick="validateAndSubmit()">Editar</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>