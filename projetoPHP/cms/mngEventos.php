<?php

    require_once ('./verificarUsuario.php');

    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    require_once ('./uploadArquivo.php');


//    $time = mktime(null, null, null, "12", "24", "2008");
//    echo '<br>'.$time;
    // echo time('2010-02-10');
    // echo '<br>'.date('d-M-Y' , '2010-02-10');

    if(isset($_POST['btn_enviar_evento'])){

        $errorImg = $_FILES['file_evento']['error'];

        if(isset($_POST['txt_titulo']) && isset($_POST['txt_descricao']) && isset($_POST['txt_data']) && isset($_POST['txt_logradouro'])
            && isset($_POST['txt_numero']) && isset($_POST['txt_bairro']) && isset($_POST['txt_cep']) && isset($_POST['txt_estado'])
            && isset($_POST['txt_cidade'])) {

            if (!empty($_POST['txt_titulo']) && !empty($_POST['txt_descricao']) && !empty($_POST['txt_data']) && !empty($_POST['txt_logradouro'])
                && !empty($_POST['txt_numero']) && !empty($_POST['txt_bairro']) && !empty($_POST['txt_cep']) && !empty($_POST['txt_estado'])
                && !empty($_POST['txt_cidade']) && $errorImg == 0) {

                $titulo = $_POST['txt_titulo'];
                $promotor = $_POST['txt_promotor'];
                $entrada = $_POST['txt_entrada'];
                $campoData = explode("/", $_POST['txt_data']);
                $data = $campoData[2] . "-" . $campoData[1] . "-" . $campoData[0];
                $descricao = $_POST['txt_descricao'];
                $cep = $_POST['txt_cep'];
                $estado = $_POST['txt_estado'];
                $cidade = $_POST['txt_cidade'];
                $logradouro = $_POST['txt_logradouro'];
                $numero = $_POST['txt_numero'];
                $bairro = $_POST['txt_bairro'];
                $imagem = salvarArquivo($_FILES['file_evento'], 'inserir');

                if($imagem != 'sizeError' && $imagem != 'extensionError'){
                    $sql = "INSERT INTO tbl_endereco (logradouro, numero, bairro, cep, cod_cidade) 
                            VALUES ('" . $logradouro . "', '" . $numero . "', '" . $bairro . "', '" . $cep . "', (SELECT c.cod_cidade FROM tbl_cidade AS c INNER JOIN tbl_estado AS e ON c.cod_estado = e.cod_estado WHERE c.cidade = '".$cidade."' AND e.estado = '".$estado."'));";
                    if (mysqli_query($conexao, $sql)) {

                        $codEndereco = mysqli_insert_id($conexao);

                        $sql = "INSERT INTO tbl_evento (titulo_evento, descricao, data, host, entrada, imagem, cod_endereco) 
                                VALUES ('" . $titulo . "', '" . $descricao . "', '" . $data . "', '" . $promotor . "', '" . $entrada . "', '".$imagem."', '" . $codEndereco . "')";

                        if(mysqli_query($conexao, $sql)){
                            header('location: mngEventos.php?foi=SIM');
                        }else{
                            echo $sql;
                        }
                    }else{
                        echo $sql;
                    }
                }elseif($imagem == 'extensionError'){
                    echo("<script>alert('$imagem O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }elseif($imagem == 'sizeError'){
                    echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                }
            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
            }
        }else{
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }elseif(isset($_POST['btn_atualizar_evento'])){

        if(isset($_POST['txt_titulo']) && isset($_POST['txt_descricao']) && isset($_POST['txt_data']) && isset($_POST['txt_logradouro'])
        && isset($_POST['txt_numero']) && isset($_POST['txt_bairro']) && isset($_POST['txt_cep']) && isset($_POST['txt_estado'])
        && isset($_POST['txt_cidade'])) {

            if (!empty($_POST['txt_titulo']) && !empty($_POST['txt_descricao']) && !empty($_POST['txt_data']) && !empty($_POST['txt_logradouro'])
                && !empty($_POST['txt_numero']) && !empty($_POST['txt_bairro']) && !empty($_POST['txt_cep']) && !empty($_POST['txt_estado'])
                && !empty($_POST['txt_cidade'])) {

                $titulo = $_POST['txt_titulo'];
                $promotor = $_POST['txt_promotor'];
                $entrada = $_POST['txt_entrada'];
                $campoData = explode("/", $_POST['txt_data']);
                $data = $campoData[2] . "-" . $campoData[1] . "-" . $campoData[0];
                $descricao = $_POST['txt_descricao'];
                $cep = $_POST['txt_cep'];
                $estado = $_POST['txt_estado'];
                $cidade = $_POST['txt_cidade'];
                $logradouro = $_POST['txt_logradouro'];
                $numero = $_POST['txt_numero'];
                $bairro = $_POST['txt_bairro'];

                if(isset($_FILES['file_evento']) && $_FILES['file_evento']['name'] != null) {
                    $imagem = salvarArquivo($_FILES['file_evento'], 'atualizar');
                    if ($imagem != 'sizeError' && $imagem != 'extensionError') {
                        $sqlUpdateEndereco = "UPDATE tbl_endereco SET logradouro = '" . $logradouro . "', numero = '" . $numero . "', bairro = '" . $bairro . "', cep = '" . $cep . "', cod_cidade = ".$_SESSION['cod_cidade']."
                                WHERE cod_endereco = ".$_SESSION['cod_endereco'];

                        $sqlUpdateEvento = "UPDATE tbl_evento SET titulo_evento = '" . $titulo . "', descricao = '" . $descricao . "', data = '" . $data . "', host = '" . $promotor . "', entrada = '" . $entrada . "', imagem = '" . $imagem . "', cod_endereco = '" . $_SESSION['cod_endereco'] . "'
                                    WHERE cod_evento = ".$_SESSION['cod_evento'];
                    } elseif ($imagem == 'extensionError') {
                        echo("<script>alert('$imagem O TIPO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    } elseif ($imagem == 'sizeError') {
                        echo("<script>alert('O TAMANHO DO ARQUIVO ESCOLHIDO É INVÁLIDO.')</script>");
                    }
                }else{
                    $sqlUpdateEndereco = "UPDATE tbl_endereco SET logradouro = '" . $logradouro . "', numero = '" . $numero . "', bairro = '" . $bairro . "', cep = '" . $cep . "', cod_cidade = ".$_SESSION['cod_cidade']."
                                WHERE cod_endereco = ".$_SESSION['cod_endereco'];

                    $sqlUpdateEvento = "UPDATE tbl_evento SET titulo_evento = '" . $titulo . "', descricao = '" . $descricao . "', data = '" . $data . "', host = '" . $promotor . "', entrada = '" . $entrada . "', cod_endereco = '" . $_SESSION['cod_endereco'] . "'
                                    WHERE cod_evento = ".$_SESSION['cod_evento'];
                }

                if (mysqli_query($conexao, $sqlUpdateEndereco)) {
                    if (mysqli_query($conexao, $sqlUpdateEvento)) {
                        header('location: mngEventos.php');
                    } else {
                        echo $sqlUpdateEvento;
                    }
                } else {
                    echo $sqlUpdateEndereco;
                }

                $_SESSION['cod_cidade'] = null;
                $_SESSION['cod_endereco'] = null;
                $_SESSION['cod_evento'] = null;
            }else{
                echo("<script>alert('HÁ CAMPOS QUE NÃO FORAM PREENCHIDOS OU ITENS NÃO SELECIONADOS.')</script>");
            }
        }else{
            echo("<script>alert('HÁ ALGO QUE NAO EXISTEM!')</script>");
        }
    }

    if(isset($_GET['modo']) && $_GET['modo'] == 'excluir'){
        $codEvento = $_GET['codEvento'];
        $codEndereco = $_GET['codEndereco'];
        $imgEvento = $_GET['imgEvento'];

        $sql = "DELETE FROM tbl_evento WHERE cod_evento = ".$codEvento;

        if(mysqli_query($conexao, $sql)){
            $sql = "DELETE FROM tbl_endereco WHERE cod_endereco = ".$codEndereco;
            excluirArquivo($imgEvento);
            if(mysqli_query($conexao, $sql)){
                header("location: mngEventos.php");
            }else{
                echo "nao foi evento -- ".$sql;
            }
        }else{
            echo "nao foi endereco-- ".$sql;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>GERENCIAR EVENTOS</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container').fadeIn(400);
                });
            });
            const viewModalAtualizarEvento = (codEvento, codEndereco) =>{
                $.ajax({
                    type: "GET",
                    url: "./modais/atualizarEvento.php",
                    data: {codEvento: codEvento, codEndereco: codEndereco},
                    success: function(dados){
                        // alert(`${codEvento} e ${codEndereco}`);
                        $('#modal-evento').html(dados);
                    }
                });
            }
            const ativarDesativarEvento = (codEvento, codEndereco, status) =>{
                $.ajax({
                    type: "GET",
                    url: "./status.php",
                    data: {pagina: 'eventos', codigo: codEvento, codEndereco: codEndereco, status: status},
                    complete: function (response) {
                        alert(response.responseText);
                        location.reload();
                    },
                    error: function (response) {
                        // alert(response.responseText);
                    }
                });
            }

            const confirmarExclusaoEvento = (tituloEvento) =>{
                return confirm(`Deseja mesmo excluir ${tituloEvento}?`)
            }

        </script>
    </head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-evento" class="center">

            </div>
        </div>
        <!-- AREA DE TODO O CONTEUDO DA PAGINA -->
        <div id="tudo">
            <!-- IMPORTANDO ARQUIVO COM HEADER DA PAGINA -->
            <?php
                require_once('./header.html');
            ?>
            <div id="menu" class="center flexbox">
                <!-- IMPORTANDO ARQUIVO COM MENU DA PAGINA -->
                <?php
                    require_once('./menu.php');
                ?>
            </div>
            <!-- AREA COM O CONTEUDO DA PAGINA -->
            <div id="conteudo-eventos">
                <div id="container-evento">
                    <!-- FORMULARIO COM CAMPOS DO ENDERECO DO EVENTO -->
                    <form enctype="multipart/form-data" action="mngEventos.php" method="POST" name="frm_eventos">
                        <div id="form-add-eventos">                            
                            <div id="caixa-titulo" class="flexbox">
                                <h3><label for="titulo-evento" >Título:</label></h3>
                                <input maxlength="20" type="text" id="titulo-evento" name="txt_titulo"> <!-- CAMPO DO TITULO -->
                            </div>
                            <div id="caixa-promotor" class="flexbox">
                                <h3><label for="promotor-evento" >Promotor do Evento:</label></h3>
                                <input maxlength="75" type="text" id="promotor-evento" name="txt_promotor"> <!-- CAMPO DO PROMOTOR DO EVENTO -->
                            </div>
                            <div id="caixa-entrada" class="flexbox">
                                <h3><label for="entrada-evento" >Entrada(R$):</label></h3>
                                <input maxlength="25" type="text" id="entrada-evento" name="txt_entrada"> <!-- CAMPO DO ENTRADA DO EVENTO -->
                            </div>
                            <div id="caixa-data" class="flexbox">
                                <h3><label for="data-evento" >Data:</label></h3>
                                <input type="text" id="data-evento" name="txt_data"> <!-- CAMPO DO DATA -->
                            </div>
                            <div id="caixa-imagem" class="flexbox">
                                <h3><label for="imagem-evento" >Imagem do Evento:</label></h3>
                                <input type="file" id="imagem-evento" name="file_evento"> <!-- CAMPO DO IMAGEM -->
                            </div>
                            <div id="caixa-descricao" class="flexbox">
                                <h3><label for="descricao-evento" >Descrição:</label></h3>
                                <textarea type="text" id="descricao-evento" name="txt_descricao"></textarea><!-- CAMPO DO DESCRICAO -->
                            </div>
                            <div id="caixa-cep" class="flexbox">
                                <h3><label for="cep" >Cep:</label></h3>
                                <input maxlength="9" type="text" id="cep" name="txt_cep"> <!-- CAMPO DO CEP -->
                            </div>
                            <div id="caixa-estado" class="flexbox">
                                <h3><label >Estado:</label></h3>
                                <input type="text" id="estado" name="txt_estado" readonly> <!-- CAMPO DO ESTADO -->
                            </div>
                            <div id="caixa-cidade" class="flexbox">
                                <h3><label >Cidade:</label></h3>
                                <input type="text" id="cidade" name="txt_cidade" readonly> <!-- CAMPO DO CIDADE -->
                            </div>
                            <div id="caixa-logradouro" class="flexbox">
                                <h3><label >Logradouro:</label></h3>
                                <input type="text" id="logradouro" name="txt_logradouro" readonly> <!-- CAMPO DO LOGRADOURO -->
                            </div>
                            <div id="caixa-numero">
                                <h3><label for="numero" >Nº :</label></h3>
                                <input type="text" id="numero" name="txt_numero"> <!-- CAMPO DO NUMERO -->
                            </div>     
                            <div id="caixa-bairro" class="flexbox">
                                <h3><label >Bairro:</label></h3>
                                <input type="text" id="bairro" name="txt_bairro" readonly> <!-- CAMPO DO BAIRRO -->
                            </div>
                            <div id="caixa-btn-evento" class="flexbox">
                                <input type="submit" name="btn_enviar_evento" class="btn-confirmacao" id="btn-enviar-evento" value="ENVIAR"> <!-- CAMPO DO CEP -->
                                <input type="button" class="btn-cancelar" id="btn-cancelar" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                            </div>
                        </div>                       
                    </form>
                    <input type="button" id="btn-add-evento" class="btn-confirmacao" name="btn_add_evento" value="ADICIONAR">
                    <div id="container-table-eventos">
                        <div id="tabela-evento">
                            <table id="table-evento">
                                <tr class="table-titles">
                                    <th class="title-titulo-evento">Título do Evento</th>
                                    <th class="title-data">Data</th>
                                    <th class="title-editar">Editar</th>
                                    <th class="title-excluir">Excluir</th>
                                    <th class="title-status">Status</th>
                                </tr>
                                <?php
                                    $sql = "SELECT * FROM tbl_evento";
                                    $select = mysqli_query($conexao, $sql);
                                    while($rsEvento = mysqli_fetch_array($select)) {
                                        $codEvento = $rsEvento['cod_evento'];
                                        $codEndereco = $rsEvento['cod_endereco'];
                                        $tituloEvento = $rsEvento['titulo_evento'];
                                        $dataBanco = explode("-", $rsEvento['data']);
                                        $data = $dataBanco[2]."/".$dataBanco[1]."/".$dataBanco[0];
                                        $imagemEvento = $rsEvento['imagem'];
                                        $status = "'".$rsEvento['status']."'";

                                        $altTitle = $rsEvento['status'] == 'ativado' ? 'Desativar Registro '.$codEvento : 'Ativar Registro '.$codEvento;
                                        $img = $rsEvento['status'] == 'ativado' ? 'ativado.png': 'desativado.png';
                                ?>
                                <tr class="tables-registers">
                                    <td class="txt-titulo-evento"><?php echo $tituloEvento ?></td>
                                    <td class="txt-data"><?php echo $data ?></td>
                                    <td class="txt-editar">
                                        <figure>
                                            <img class="icon-edit visualizar" onclick="viewModalAtualizarEvento(<?php echo $codEvento.', '.$codEndereco ?>)" src="./icons/edit.png" alt="<?php echo 'Editar Registro '.$codEvento ?>" title="<?php echo 'Editar Registro '.$codEvento ?>">
                                        </figure>
                                    </td>
                                    <td class="txt-excluir">
                                        <a href="?modo=excluir&codEvento=<?php echo $codEvento ?>&codEndereco=<?php echo $codEndereco ?>&imgEvento=<?php echo $imagemEvento ?>">
                                            <figure>
                                                <img class="icon-del" onclick="return confirmarExclusaoEvento(<?php echo "'".$tituloEvento."'" ?>)" src="./icons/trash.png" alt="<?php echo 'Exluir Registro '.$codEvento ?>" title="<?php echo 'Exluir Registro '.$codEvento ?>">
                                            </figure>
                                        </a>
                                    </td>
                                    <td class="txt-status">
                                        <figure>
                                            <img onclick="ativarDesativarEvento(<?php echo($codEvento.', '.$codEndereco.', '.$status); ?>)" class="icon-status" src="./icons/<?php echo $img ?>" alt="<?php echo $altTitle ?>" title="<?php echo $altTitle ?>">
                                        </figure>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
        <script src="./js/preencherEndereco.js"></script>
        <script>
            const btnAddEvento = document.getElementById("btn-add-evento");
            const btnCancelar = document.getElementById("btn-cancelar");
            const caixaAddEvento = document.getElementById("form-add-eventos");

            const showCaixaAddEvento = () =>{
                caixaAddEvento.style.display = "flex";
                btnAddEvento.style.display = "none";
            }

            const hiddeCaixaAddEvento = () =>{
                caixaAddEvento.style.display = "none";
                btnAddEvento.style.display = "inline";
            }

            btnAddEvento.addEventListener('click', showCaixaAddEvento);
            btnCancelar.addEventListener('click', hiddeCaixaAddEvento);
        </script>
    </body>
</html>