<?php

//Requer conexão com o banco de dados
require_once '../database/conexao.php';
//Coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;

$ativo = true;
$controlado = true;
$alta_vig = true;

if(!isset($requisicao['ativo'])){
    $ativo = false;
}
if(!isset($requisicao['controlado'])){
    $controlado = false;
}
if(!isset($requisicao['alta_Vigilancia'])){
    $alta_vig = false;
}


//Utilixa uma estrutura de tentativa para tentar
//inserir as informaões no baco de dados
try{
    //Utiliza o método prepare() da variável conexao (que está disponível
    //no arquivo por meio do require_once), para prepararuma instrução
    //sql (banco de dados).
    $preparacao = $conexao->prepare("
    insert into tb_medicamento(
     nome, controlado, alta_vigilancia, valor, ativo
    )values (
    :nome,:controlado , :alta_vigilancia, :valor, :ativo
    )
    ");

    //Utiliza o método bindParam da classe PreparedStatement disponível
    //na variavel preparação, que recebeu a preparação acima.
    //A função bindParam troca um dos parametros da instrução sql pelo
    //Valor contido em uma variável. Não esquecer de mudar o tipo no
    //ultimo argumento.
    $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
    $preparacao->bindParam(':controlado',$controlado, PDO::PARAM_BOOL);
    $preparacao->bindParam(':alta_vigilancia',$alta_vig,PDO::PARAM_BOOL);
    $preparacao->bindParam(':valor',$requisicao['valor'], PDO::PARAM_STR);
    $preparacao->bindParam(':ativo',$ativo, PDO::PARAM_BOOL);
    //Ao final da troca dos parametros, estamos prontos para executar
    //a instrução, por isso utilizamos o método execute() da classe
    //PreparedStatement.
    $preparacao->execute();
    if ($preparacao->rowCount() == 1) {
        //caso isso seja positivo, retorna para a página de cadastro
        //com o status 201(created)
        header('Location: ../../paginas/cad-produto/produto.php?status=201');
        //Morre a execução para evitar lacunas de segurança
        die();
    } else {
        //Caso a quantidade não seja q, retorna com o status
        //400 (bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-produto/produto.php?status=400');
        die();
    }
}
    catch(PDOException$erro){
        print_r($erro);
    //Executa caso receba algum erro
    //Volta para a página de cadastro e apresenta
    //Um erro do tipo 500(Server Error)
    //header('Location: ../../paginas/cad-produto/produto.php?status=500');
    //Morre a execução para evitar lacunas de segurança.
    die();
}


?>
