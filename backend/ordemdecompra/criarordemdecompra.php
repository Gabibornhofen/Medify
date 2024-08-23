<?php

//Requer conexão com o banco de dados
require_once '../database/conexao.php';
//Coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;



//Utilixa uma estrutura de tentativa para tentar
//inserir as informaões no baco de dados
try {
    //Utiliza o método prepare() da variável conexao (que está disponível
    //no arquivo por meio do require_once), para prepararuma instrução
    //sql (banco de dados).
    $preparacao = $conexao->prepare("
    insert into tb_ordem_compra(
     dt_solicitacao, dt_previsao, dt_entregue, dt_pagamento,situacao
    )values (
    :dt_solicitacao, :dt_previsao , :dt_entregue, :dt_pagamento,:situacao
    )
    ");

    //Utiliza o método bindParam da classe PreparedStatement disponível
    //na variavel preparação, que recebeu a preparação acima.
    //A função bindParam troca um dos parametros da instrução sql pelo
    //Valor contido em uma variável. Não esquecer de mudar o tipo no
    //ultimo argumento.
    $preparacao->bindParam(':dt_solicitacao', $requisicao['dt_solicitacao'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_previsao', $requisicao['dt_previsao'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_entregue', $requisicao['dt_entregue'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_pagamento', $requisicao['dt_pagamento'], PDO::PARAM_STR);
    $preparacao->bindParam(':situacao', $requisicao['situacao'], PDO::PARAM_STR);
    //Ao final da troca dos parametros, estamos prontos para executar
    //a instrução, por isso utilizamos o método execute() da classe
    //PreparedStatement.
    $preparacao->execute();
    $stmt2 = $conexao->prepare('select last_insert_id() as id');
    $stmt2->execute();
    $res = $stmt2->fetchAll();
    $id = $res[0]['id'];

    if (isset($requisicao['medicamento']) && $requisicao['medicamento'] != '') {
        $stmt3 = $conexao->prepare("
        insert into `tb_oc item`(
            ordem_de_compra,medicamento,quantidade
        )values(
            :ordem_compra,:medicamento,:quantidade
         )");
        $stmt3->bindParam(':ordem_compra', $id, PDO::PARAM_INT);
        $stmt3->bindParam(':medicamento', $requisicao["medicamento"], PDO::PARAM_INT);
        $stmt3->bindParam(':quantidade', $requisicao["quantidade"], PDO::PARAM_INT);
        $stmt3->execute();
    }

    if (isset($requisicao['med2']) && $requisicao['med2'] != '') {
        echo ('valor: ' . $requisicao['med2']);
        $stmt3 = $conexao->prepare("
        insert into `tb_oc item`(
            ordem_de_compra,medicamento,quantidade
        )values(
            :ordem_compra,:medicamento,:quantidade
        )");
        $stmt3->bindParam(':ordem_compra', $id, PDO::PARAM_INT);
        $stmt3->bindParam(':medicamento', $requisicao["med2"], PDO::PARAM_INT);
        $stmt3->bindParam(':quantidade', $requisicao["qtd2"], PDO::PARAM_INT);
        $stmt3->execute();
    }

    if (isset($requisicao['med3']) && $requisicao['med3'] != '') {
        $stmt3 = $conexao->prepare("
        insert into `tb_oc item`(
            ordem_de_compra,medicamento,quantidade
        )values(
            :ordem_compra,:medicamento,:quantidade
        )");
        $stmt3->bindParam(':ordem_compra', $id, PDO::PARAM_INT);
        $stmt3->bindParam(':medicamento', $requisicao["med3"], PDO::PARAM_INT);
        $stmt3->bindParam(':quantidade', $requisicao["qtd3"], PDO::PARAM_INT);
        $stmt3->execute();
    }









    if ($preparacao->rowCount() == 1) {
        //caso isso seja positivo, retorna para a página de cadastro
        //com o status 201(created)
        header('Location: ../../paginas/cad-ordemdecompra/ordemdecompra.php?status=201');
        //Morre a execução para evitar lacunas de segurança
        die();
    } else {
        //Caso a quantidade não seja q, retorna com o status
        //400 (bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-ordemdecompra/ordemdecompra.php?status=400');
        die();
    }
} catch (PDOException $erro) {
    print_r($erro);
    //Executa caso receba algum erro
    //Volta para a página de cadastro e apresenta
    //Um erro do tipo 500(Server Error)
    //header('Location: ../../paginas/cad-produto/produto.php?status=500');
    //Morre a execução para evitar lacunas de segurança.
    die();
}


?>