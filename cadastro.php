<html>
<head>
    <title>Cadastro de novo usuário</title>
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

</head>
<body>
    <div class="container">
        <?php include 'navigation-bar.php'; ?>
        <div class="row d-flex">
            <h1 id="cadastro-title" class="display-2 centralized-element">Cadastro de novo aluno</h1>
            <img id="banner-image" class="centralized-element" src="images/banner.jpg">

            <div class="centralized-element col-12 w-75" style="border: 2px solid green">
                <h2>Informações</h2>
                <form id="form" action="processa-cadastro.php" method="post">
                    <div id="studentEmailContainer" class="centralized-element">
                        <label>Email: </label>
                        <input id="studentEmailTextField" name="studentEmail" type="email" placeholder="Digite seu email" onkeyup="keyUp()">
                    </div>

                    <div id="studentPasswordContainer" class="centralized-element">
                        <label>Senha: </label>
                        <input id="studentPasswordTextField" name="studentPassword" type="password" placeholder="Digite sua senha" onkeyup="keyUp()">
                    </div>

                    <div id="studentPasswordConfirmationContainer" class="centralized-element">
                        <label>confirmação: </label>
                        <input id="studentPasswordConfirmationTextField" name="studentPasswordConfirmation" type="password" placeholder="Confirme sua senha" onkeyup="keyUp()">
                    </div>

                    <!-- TODO: trocar para data de nascimento -->

                    <div class="centralized-element">
                        <label>Data de Nascimento: </label>
                        <input id="studentBirthdayDatePicker" name="studentBirthday" type="date" onkeyup="keyUp()">
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
                            <option>Sim</option>
                            <option>Não</option>
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
                <button onclick="validateAndSubmit()">Cadastrar</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>