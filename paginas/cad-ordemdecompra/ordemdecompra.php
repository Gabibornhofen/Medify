<?php
include_once '../../backend/situacao/buscaSituacoes.php';
include_once '../../backend/ordemdecompra/relatorioordemdecompra.php';
include_once '../../backend/produto/buscarmedicamento.php';
?>


<html>

<head>
    <title>Ordem de Compra | Medify</title>
    <link rel="stylesheet" href="ordemdecompra.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.php">
</head>

<body>
    <?php
    include_once '../../componentes/menu/menu.php';
    ?>
</body>



<section class="pagina">
    <header>
        <h1> Compra de Medicamento</h1>
    </header>
    <form action="../../backend/ordemdecompra/criarordemdecompra.php" method="post">
        <div class="inputs">
            <label for="solicitação">solicitação</label><input type="date" name="dt_solicitacao"
                placeholder="dt_solicitacao">
            <label for="Previsão">Previsão</label><input type="date" name="dt_previsao" placeholder="dt_previsao">
            <label for="Entregue">Entregue</label><input type="date" name="dt_entregue" placeholder="dt_entregue">
            <label for="Pagamento">Pagamento</label><input type="date" name="dt_pagamento" placeholder="dt_pagamento">
            <select name="situacao">
                <option value="">Situação</option>
                <?php
                if (isset($arrSituacoes)) {
                    foreach ($arrSituacoes as $situacao) {
                        echo ("<option value=" . $situacao["id"] . ">" . $situacao["descricao"] . "</option>");
                    }
                }
                ?>
            </select>
        </div>
        <div class="linha">
            <input type="number" name="quantidade" placeholder="Quantidade">
            <select name="medicamento">

                <option value="">Medicamentos</option>
                <?php
                if (isset($arrmedicamento)) {
                    foreach ($arrmedicamento as $tipo) {
                        echo ("<option value=" . $tipo["id"] . ">" . $tipo["nome"] . "</option>");
                    }
                }
                ?>
        
        </select>
        </div>
        <div class="linha">
            <input type="number" name="qtd2" placeholder="Quantidade">
            <select name="med2">

                <option value="">Medicamentos</option>
                <?php
                if (isset($arrmedicamento)) {
                    foreach ($arrmedicamento as $tipo) {
                        echo ("<option value=" . $tipo["id"] . ">" . $tipo["nome"] . "</option>");
                    }
                }
                ?>
            </select>
            <div class="linha">
                <input type="number" name="qtd3" placeholder="Quantidade">
                <select name="med3">

                    <option value="">Medicamentos</option>
                    <?php
                    if (isset($arrmedicamento)) {
                        foreach ($arrmedicamento as $tipo) {
                            echo ("<option value=" . $tipo["id"] . ">" . $tipo["nome"] . "</option>");
                        }
                    }
                    ?>
                </select>

            </div>










            <div class="controles">
                <button type="submit" class="salvar">Salvar</button>
                <button type="reset" class="cancelar">Cancelar</button>
            </div>
            </for>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                        <th>Açâo</th>
                        <th>Id</th>
                        <th>dt_solicitacao</th>
                        <th>dt_previsao</th>
                        <th>dt_entregue</th>
                        <th>dt_pagamento</th>
                    </tr>
                    <?php
                    //Utilizar a função foreach
                    //para iterar entre ositens do array
                    //que é o nosso $relatorio
                    
                    foreach ($relatorio as $compra) {
                        echo ("
                            <tr>

                                <td><button>Excluir</button></td>
                                <td>" . $compra['id'] . "</td>
                                <td>" . $compra['dt_solicitacao'] . "</td>
                                <td>" . $compra['dt_previsao'] . "</td>
                                <td>" . $compra['dt_entregue'] . "</td>
                                <td>" . $compra['dt_pagamento'] . "</td>
                                
                            
                            </tr>
                        ");
                    }


                    ?>
                </table>


            </div>



            </select>










</section>
</body>

</html>