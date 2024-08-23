<?php

//Requer conexão com o banco de dados
require_once '../database/conexao.php';
//Coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;
$senha = sha1('123Mudar!');
//Utilixa uma estrutura de tentativa para tentar
//inserir as informaões no baco de dados
try{
    //Utiliza o método prepare() da variável conexao (que está disponível
    //no arquivo por meio do require_once), para prepararuma instrução
    //sql (banco de dados).
    $preparacao = $conexao->prepare("
    insert into tb_usuario(
    nome, sobrenome, endereco, telefone, login, senha, tipo
    )values (
    :nome, :sobrenome, :endereco, :telefone, :login, :senha, :tipo
    )
    ");
    //Utiliza o método bindParam da classe PreparedStatement disponível
    //na variavel preparação, que recebeu a preparação acima.
    //A função bindParam troca um dos parametros da instrução sql pelo
    //Valor contido em uma variável. Não esquecer de mudar o tipo no
    //ultimo argumento.
    $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
    $preparacao->bindParam(':sobrenome',$requisicao['sobrenome'],PDO::PARAM_STR);
    $preparacao->bindParam(':endereco',$requisicao['endereco'],PDO::PARAM_STR);
    $preparacao->bindParam(':telefone',$requisicao['telefone'],PDO::PARAM_STR);
    $preparacao->bindParam(':login',$requisicao['usuario'],PDO::PARAM_STR);
    $preparacao->bindParam(':senha',$senha, PDO::PARAM_STR);
    $preparacao->bindParam(':tipo',$requisicao['tipo'],PDO::PARAM_INT);
    //Ao final da troca dos parametros, estamos prontos para executar
    //a instrução, por isso utilizamos o método execute() da classe
    //PreparedStatement.
    $preparacao->execute();
    //Ao executar, precisamos verificar se o valor foi de fato
    //inserido no banco de dados, para isso verificamos se o valor do
    //rowCount() é igual a 1 (quantidade de linhas que foram inseridas)
    if($preparacao->rowCount()==1){
        //Caso isso seja positivo, retorna para a página de acdastro
        //com o status 201 (Created)
        header('Location: ../../paginas/cad-usuario/usuario.php?status=201');
        //Morre a execução para evitar lacunas de segurança.
        die();
    }else{
        //Caso a quantidade não seja 1, retorna com o status
        //400 (Bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-usuario/usuario.php?status=400');
        //Morre a execução para evitar lacunas de segurança.
        die();
    }
}
    catch(PDOException$erro){
        print_r($erro);
    //Executa caso receba algum erro
    //Volta para a página de cadastro e apresenta
    //Um erro do tipo 500(Server Error)
    //header('Location: ../../paginas/cad-usuario/usuario.php?status=500');
    //Morre a execução para evitar lacunas de segurança.
    die();
}


?>