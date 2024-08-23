<?php
include_once '../../backend/vendas/relatoriovenda.php';
include_once '../../backend/produto/buscarmedicamento.php';


   //Requer conexão com o banco de dados
   require_once '../../backend/database/conexao.php';

   //Iniciliza variavel de mensagem
   $mensagem_erro = '';
   
   
   //Iniciar a estrutura de tentativa try
   try{
   
       //Prepara a query SQL para execução
       $preparo = $conexao->prepare("
      select
        med.nome,
        sum(vni.quantidade) as quantidade
        from tb_venda vn
        inner join `tb_venda item` vni on vni.venda = vn.id
        inner join tb_medicamento med on med.id = vni.medicamento
        where vn.situacao = 1
        group by med.nome;"
    );
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