<?php

    require_once('./verificarUsuario.php');

    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/fontes.css">
        <title>GERENCIAR LOJAS</title>
        <meta charset="utf-8">
        <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
        <script src="./js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container').fadeIn(300);
                });
            });
            const editarLoja = (codLoja) =>{
                $.ajax({
                    type: 'get', 
                    url: './modais/atualizarLoja.php',
                    data: {codigo: codLoja},
                    success: function(dados) {
                        console.log(dados);
                        $('#modal-loja').html(dados);
                    }
                });
            }
            const excluirLoja = (codLoja, codEndereco) =>{
                let confirmarExclusao = confirm(`Deseja mesmo excluir a loja ${codLoja}?`);
                if(confirmarExclusao){
                    window.location.href=`crudLojas.php?modo=excluir&codloja=${codLoja}&codendereco=${codEndereco}`;
                }
            }
            const ativarDesativarLoja = (codigo, status, endereco) =>{
                $.ajax({
                    type: 'get',
                    url: './status.php',
                    data: {pagina: 'lojas', codigo: codigo, status: status, codEndereco: endereco},
                    complete: function(response){
                        alert(response.responseText);
                        location.reload();
                    },
                    error: function(){
                        alert('error');
                    }
                });
            }
        </script>
    </head>
    <body>
        <!-- CONTAINER DO MODAL -->
        <div id="container">
            <div id="modal-loja" class="center">

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
            <div id="conteudo-lojas">
                <div id="container-loja">
                    <!-- FORMULARIO COM CAMPOS DO ENDERECO DA LOJA -->
                    <form action="crudLojas.php" method="GET" name="frm_lojas">
                        <div id="form-add-loja">
                            <div id="caixa-cep" class="flexbox">
                                <h3><label for="cep" >Cep:</label></h3>
                                <input type="text" id="cep" name="txt_cep" required> <!-- CAMPO DO CEP -->
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
                                <input type="text" id="numero" name="txt_numero" required> <!-- CAMPO DO NUMERO -->
                            </div>     
                            <div id="caixa-bairro" class="flexbox">
                                <h3><label >Bairro:</label></h3>
                                <input type="text" id="bairro" name="txt_bairro" readonly> <!-- CAMPO DO BAIRRO -->
                            </div>
                            <div id="caixa-btn-loja" class="flexbox">
                                <input type="submit" name="btn_enviar_loja" class="btn-confirmacao" id="btn-enviar-loja" value="ENVIAR"> <!-- CAMPO DO CEP -->
                                <input type="button" class="btn-cancelar" id="btn-cancelar" value="CANCELAR"> <!-- CANCELAR INSERÇÃO -->
                            </div>
                        </div>                       
                    </form>
                    <input type="button" name="btn_add_loja" class="btn-confirmacao" id="btn-add-loja" value="ADICIONAR">
                    <div id="container-table-loja">
                        <table id="tabela-lojas">
                            <tr class="table-titles">
                                <th id="titulo-codigo">CÓDIGO</th>
                                <th id="titulo-endereco">ENDEREÇO</th>
                                <th class="title-editar">EDITAR</th>
                                <th class="title-excluir">EXCLUIR</th>
                                <th class="title-status">STATUS</th>
                            </tr>
                            <?php

                                $sql = "SELECT l.cod_loja, l.status, e.logradouro, e.numero, e.bairro, e.cep, cd.cidade, e.cod_endereco, et.uf
                                FROM tbl_loja AS l INNER JOIN tbl_endereco AS e ON l.cod_endereco = e.cod_endereco
                                INNER JOIN tbl_cidade AS cd ON e.cod_cidade = cd.cod_cidade
                                INNER JOIN tbl_estado AS et ON cd.cod_estado = et.cod_estado
                                ORDER BY l.cod_loja DESC;";

                                $select = mysqli_query($conexao, $sql);

                                while($rsLoja = mysqli_fetch_array($select)){
                                    $codLoja = $rsLoja['cod_loja'];
                                    $codEndereco = $rsLoja['cod_endereco'];
                                    $logradouro = $rsLoja['logradouro'];
                                    $numero = $rsLoja['numero'];
                                    $bairro = $rsLoja['bairro'];
                                    $cidade = $rsLoja['cidade'];
                                    $uf = $rsLoja['uf'];
                                    $status = "'".$rsLoja['status']."'";

                                    $cidade = strtolower($cidade);
                                    $cidade = ucwords($cidade);

                                    $alt = $rsLoja['status'] == 'ativado' ? 'Ativar' : 'Desativar';
                                    $title = $rsLoja['status'] == 'ativado' ? 'Ativar' : 'Desativar';
                                    $img = $rsLoja['status'] == 'ativado' ? 'ativado.png' : 'desativado.png';
                            ?>
                            <tr class="tables-registers">
                                <td class="registro-codigo-loja"><?php echo($codLoja); ?></td>
                                <td class="registro-endereco-loja"><?php echo($logradouro." ".$numero.", ".$bairro.", ".$cidade." - ".$uf); ?></td>
                                <td class="txt-editar">
                                    <figure>
                                        <!-- BOTAO QUE CHAMA MODAL PARA EDITAR NOTICIA -->
                                        <img onclick="editarLoja(<?php echo($codLoja); ?>)" class="icon-edit visualizar" alt="Editar Registro <?php echo($codLoja); ?>" title="Editar Registro <?php echo($codLoja); ?>" src="icons/edit.png">
                                    </figure>
                                </td>
                                <td class="txt-excluir">
                                    <figure>
                                    <!-- BOTAO QUE EXCLUI NOTICIA -->
                                        <img onclick="excluirLoja(<?php echo($codLoja.', '.$codEndereco); ?>)" class="icon-del" alt="Excluir Registro <?php echo($codLoja); ?>" title="Excluir Registro <?php echo($codLoja); ?>" src="icons/trash.png">
                                    </figure>
                                </td>
                                <td class="txt-status">
                                    <figure>
                                        <!-- BOTAO QUE ATIVA OU DESATIVA NOTICIA -->
                                        <img onclick="ativarDesativarLoja(<?php echo($codLoja.', '.$status.', '.$codEndereco); ?>)" class="icon-status" alt="<?php echo($alt); ?> Registro" title="<?php echo($title); ?> Registro" src="icons/<?php echo($img); ?>">
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
            <!-- IMPORTANDO ARQUIVO COM FOOTER DA PAGINA -->
            <?php
                require_once('./footer.html');
            ?>
        </div>
        <script src="./js/preencherEndereco.js"></script>
        <script>

            const btnSend = document.getElementById('btn-enviar-loja');
            const btnCancel = document.getElementById('btn-cancelar');
            const btnAdd = document.getElementById('btn-add-loja');
            const formAddLoja = document.getElementById('form-add-loja');

            function showAddLoja(){
                formAddLoja.style.display = "flex";
                btnAdd.style.display = "none";
            }
            function hiddenAddLoja(){
                formAddLoja.style.display = "none";
                btnAdd.style.display = "inline";
            }

            btnAdd.addEventListener('click', showAddLoja);
            btnCancel.addEventListener('click', hiddenAddLoja);

        </script>
    </body>
</html>