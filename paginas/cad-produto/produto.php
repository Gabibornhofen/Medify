<?php
//Inclui o relatorio de usuários
include_once '../../backend/produto/relatorioproduto.php';


//Inicializa uma variavel com nome de mensagem por meio de GET
$mensagem = null;
//Verifica se essa informção é um status
if ($_GET) {
    //Utiliza a estrutura de decisão switch para verificarnqual
    //status foi recebido e atribuir uma mensagem conforme necssário
    if ($_GET['status']) {
        switch ($_GET['status']) {
            case 201:
                //Criado
                $mensagem = 'Adicionado com sucesso!';
                break;
            case 400;
                //Bad Request
                $mensagem = 'Inserção não funcionou';
                break;
            case 500:
                //Erro no servidor
                $mensagem = 'Erro ao tentar inserir informações';
                break;


        }
    }
}
?>


<html>

<head>
    <title>Medicamento | Medify</title>
    <link rel="stylesheet" href="produto.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.php">
</head>

<body>
    <?php
    include_once '../../componentes/menu/menu.php';
    ?>
</body>
<section class="pagina">
    <header>
        <h1>Administração | Cadastro De Medicamentos</h1>
    </header>
    <form action="../../backend/produto/criarproduto.php" method="post">
        <div class="inputs">
            <input type="text" name="nome" placeholder="Nome">


            <div class="linha">
                <input type="text" name="valor" placeholder="Valor">


            </div>
            <div class="linha">
                <input type="checkbox" name="alta_vigilancia" id="alta_vigilancia"> <label
                    for="alta_vigilancia">Alta_Vigilancia</label>
                <input type="checkbox" name="controlado" id="controlado"> <label for="controlado">Controlado</label>
                <input type="checkbox" name="ativo" id="ativo" checked> <label for="ativo">Ativo</label>
            </div>
        </div>

        <div class="controles">
            <button type="submit" class="salvar">Salvar</button>
            <button type="reset" class="cancelar">Cancelar</button>
        </div>
    </form>


    <div class="relatorio">
        <h1>Relatório</h1>
        <table>
            <tr>
                <th>Açâo</th>
                <th>Id</th>
                <th>nome</th>
                <th>controlado</th>
                <th>alta_vigilancia</th>
                <th>valor</th>
                <th>ativo</th>
            </tr>
            <tr>
                <td><button>Excluir</button></td>
                <td>123</td>
                <td>Paracetamol</td>
                <td>não</td>
                <td>não</td>
                <td>R$9,00</td>
                <td>Não</td>
            </tr>
            <?php
            //Utilizar a função foreach
            //para iterar entre ositens do array
            //que é o nosso $relatorio
            
            foreach ($relatorio as $medicamento) {
                echo ("
                            <tr>

                                <td><button>Excluir</button></td>
                                <td>" . $medicamento['id'] . "</td>
                                <td>" . $medicamento['nome'] . "</td>
                                <td>" . ($medicamento['controlado'] == 1 ? "Sim" : "Não") . "</td>
                                <td>" . ($medicamento['alta_vigilancia'] == 1 ? "Sim" : "Não"). "</td>
                                <td>" . $medicamento['valor'] . "</td>
                                <td>" . ($medicamento['ativo'] == 1 ? "Sim" : "Não"). "</td>
                                
                                
                            
                            </tr>
                        ");
            }


            ?>
        </table>


    </div>
</section>








</section>
</body>

</html>