
<?php 
include_once "..//../componentes/menu/menu.php";
include_once "relatorioestoque.php";
 ?>
 
 
 <html>
    <head>
    <title>Relatorio De Estoque | Medify</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
    <div class="relatorio">
            <h1>Relatorio De Estoque</h1>
            <table>
                <tr>
                    <th>Ação</th>
                    <th>Medicamento</th>
                    <th>estoque</th>
                    <th>ocPendente</th>
                    <th>vendaPendente</th>

                </tr>
                <tr>
                
                <?php
                    //Utilizar a função foreach
                    //para iterar entre ositens do array
                    //que é o nosso $relatorio

                    foreach($relatorioHome as $estoquecompra){
                        echo("
                            <tr>

                                <td><button>Excluir</button></td>
                                <td>".$estoquecompra['nome']."</td>
                                <td>".$estoquecompra['estoque']."</td>
                                <td>".$estoquecompra['ocPendente']."</td>
                                <td>".$estoquecompra['vendaPendente']."</td>
                                
                            
                            </tr>
                        ");
                    }


                ?>
            </table>


            </div>
    </body>
 </html>