<?php

    //Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';

//Iniciliza variavel de mensagem
$mensagem_erro = '';


//Iniciar a estrutura de tentativa try
try{

    //Prepara a query SQL para execução
    $preparo = $conexao->prepare("
    select
        u.id,
        u.nome,
        if(u.controlado=1,1,0) as controlado,
        if(u.alta_vigilancia=1,1,0) as alta_vigilancia,
        u.valor,
        if(u.ativo=1,1,0) as ativo
    from tb_medicamento u
    ");
    //Executa a query
    $preparo->execute();

    //coloca o resultado em um array usando o fetch_assoc
    $relatorio = $preparo->fetchALL();

    
    //### Testar se deu certo, remover depois ###
    //foreach($relatorio as $linha){
     //   print_r($linha);
    //}

}catch(PDOException $erro){
    //Imprime o erro na tela
    print_r($erro);
    //Coloca que deu erro na variavel mensagem_erro
    $mensagem_erro = 'erro';
}







?>