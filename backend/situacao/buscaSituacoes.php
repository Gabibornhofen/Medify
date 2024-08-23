<?php
//Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';
//Inicia váriavel de mensagem
$mensagem_erro = '';
try{
    $preparo = $conexao->prepare("
    select
    id,
    descricao
    from tb_situacao"
);
$preparo->execute();
$arrSituacoes = $preparo->fetchall();
}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}