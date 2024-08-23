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
        v.id,
        v.metodo_pagamento,
        v.dt_venda,
        v.dt_pagamento,
        v.cliente,
        v.tipo,
        t.descricao as ds_tipo,
        v.situacao,
        s.descricao as ds_situacao
    from tb_venda v
        inner join tb_tipo t on t.id = v.tipo
        inner join tb_situacao s on s.id=v.situacao
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