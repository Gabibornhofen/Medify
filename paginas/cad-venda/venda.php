<?php
include_once '../../backend/situacao/buscaSituacoes.php';
include_once '../../backend/vendas/relatoriovenda.php';
include_once '../../backend/vendas/buscaTipo.php';
include_once '../../backend/produto/buscarmedicamento.php';
?>

<html>

<head>
    <title>Venda | Medify</title>
    <link rel="stylesheet" href="venda.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.php">
</head>

<body>
    <?php
    include_once '../../componentes/menu/menu.php';
    ?>
</body>



<section class="pagina">
    <header>
        <h1> Venda de Medicamento</h1>
    </header>
    <form action="../../backend/vendas/criavenda.php" method="post">
        <div class="inputs">
           <div><input type="text" name="cliente" placeholder="Nome do Cliente">
           <label for="text">Data de Venda</label><input type="date" name="dt_venda" placeholder="dt_venda"></div>
           <div>
            <input type="text" name="metodo_pagamento" placeholder="metodo_pagamento">
            <label for="text">Data de Pagamento</label><input type="date" name="dt_pagamento" placeholder="dt_pagamento"></div>
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
            <select name="tipo">
                <option value="">Tipo</option>
                <?php
                if (isset($arrtipo)) {
                    foreach ($arrtipo as $tipo) {
                        echo ("<option value=" . $tipo["id"] . ">" . $tipo["descricao"] . "</option>");
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
        </div>
            </select>

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
                <th>dt_venda</th>
                <th>metodo_pagamento</th>
                <th>cliente</th>
                <th>tipo</th>
                <th>situacao</th>
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
                                <td>" . $compra['dt_venda'] . "</td>
                                <td>" . $compra['metodo_pagamento'] . "</td>
                                <td>" . $compra['cliente'] . "</td>
                                <td>" . $compra['ds_tipo'] . "</td>
                                <td>" . $compra['ds_situacao'] . "</td>
                                
                            
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