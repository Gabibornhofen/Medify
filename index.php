<?php

$erro = null;

if($_GET){
    if($_GET['erro']){
        $erro = $_GET['erro'];
    }
}
?>


<html>
    <head>
        <title>Login | Medify </title>
        <link rel="stylesheet" href="index.css">
        <meta charset="utf-8">
    </head>
    <body>
        <section class =login>
            <article>
            <form action="backend/login/login.php" method="post">
                <h1>Login: Medify</h1>
                <div>
                    <label>Usuário</label>
                    <input type="text" name="usuario">
                </div>
                <div>
                    <label>Senha</label>
                    <input type="password" name="senha">
                   
                </div>
                <p href="index.php">Esquece a senha?</p>
                <button type="submit">Login</button>
            </form>
            <?php
            if($erro !=null){
                switch($erro){
                    case'401':
                        echo("<p class=\"erro\">Usuário ou senha inválido</p>");
                        break;
                        case'500':
                            echo("<p class=\"erro\">Erro no servidor, tente novamente, mais tarde</p>");
                            break;
                }
            }



            ?>
            </article>
        </section>

    </body>
</html>