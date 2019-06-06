<?php

    require_once ('../verificarUsuario.php');

    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $codEvento = $_GET['codEvento'];
    $codEndereco = $_GET['codEndereco'];

    $titulo = null;
    $promotor = null;
    $entrada = null;
    $descricao = null;
    $data = null;
    $logradouro = null;
    $numero = null;
    $bairro = null;
    $cep = null;
    $cidade = null;
    $estado = null;

    $sql = "SELECT tabEvent.cod_evento, tabEvent.titulo_evento, tabEvent.host, 
            tabEvent.entrada, tabEvent.imagem, tabEvent.descricao, tabEvent.data,
            tabEvent.status, tabEvent.cod_endereco, 
            tabAddress.logradouro, tabAddress.numero,
            tabAddress.bairro, tabAddress.cep,
            tabCity.cidade, tabState.estado, tabCity.cod_cidade
            FROM tbl_evento AS tabEvent
            INNER JOIN tbl_endereco AS tabAddress
            ON tabEvent.cod_endereco = tabAddress.cod_endereco
            INNER JOIN tbl_cidade AS tabCity
            ON tabAddress.cod_cidade = tabCity.cod_cidade
            INNER JOIN tbl_estado AS tabState
            ON tabCity.cod_estado = tabState.cod_estado
            WHERE tabEvent.cod_evento = ".$codEvento." AND tabEvent.cod_endereco = ".$codEndereco;

    $select = mysqli_query($conexao, $sql);

    if($rsEvento = mysqli_fetch_array($select)){
        $titulo = $rsEvento['titulo_evento'];
        $promotor = $rsEvento['host'];
        $entrada = $rsEvento['entrada'];
        $descricao = $rsEvento['descricao'];
        $dataBanco = explode("-", $rsEvento['data']);
        $data = $dataBanco[2]."/".$dataBanco[1]."/".$dataBanco[0];
        $logradouro = $rsEvento['logradouro'];
        $numero = $rsEvento['numero'];
        $bairro = $rsEvento['bairro'];
        $cep = $rsEvento['cep'];
        $cidade = $rsEvento['cidade'];
        $estado = $rsEvento['estado'];
        $_SESSION['cod_cidade'] = $rsEvento['cod_cidade'];
        $_SESSION['cod_endereco'] = $rsEvento['cod_endereco'];
        $_SESSION['cod_evento'] = $rsEvento['cod_evento'];
        $_SESSION['img'] = $rsEvento['imagem'];
    }

?>

<script src="./js/jquery-3.3.1.min.js"></script>
<!-- SCRIPT PARA FECHAR A MODAL -->
<script>
    $(document).ready(function(){
        $('#fechar-modal-evento').click(function(){
            $('#container').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-evento">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<!-- FORMULARIO COM CAMPOS DO ENDERECO DO EVENTO -->
<form enctype="multipart/form-data" action="mngEventos.php" method="POST" name="frm_eventos">
    <div id="form-modal-eventos">
        <div id="caixa-titulo" class="flexbox">
            <h3><label for="titulo-evento" >Título:</label></h3>
            <input maxlength="30" type="text" id="titulo-evento" name="txt_titulo" value="<?php echo $titulo ?>"> <!-- CAMPO DO TITULO -->
        </div>
        <div id="caixa-promotor" class="flexbox">
            <h3><label for="promotor-evento" >Promotor do Evento:</label></h3>
            <input maxlength="75" type="text" id="promotor-evento" name="txt_promotor" value="<?php echo $promotor ?>"> <!-- CAMPO DO PROMOTOR DO EVENTO -->
        </div>
        <div id="caixa-entrada" class="flexbox">
            <h3><label for="entrada-evento" >Entrada(R$):</label></h3>
            <input maxlength="25" type="text" id="entrada-evento" name="txt_entrada" value="<?php echo $entrada ?>"> <!-- CAMPO DO ENTRADA DO EVENTO -->
        </div>
        <div id="caixa-data" class="flexbox">
            <h3><label for="data-evento" >Data:</label></h3>
            <input maxlength="10" placeholder="Ex.: 01/01/2019" type="text" id="data-evento" name="txt_data" value="<?php echo $data ?>"> <!-- CAMPO DO DATA -->
        </div>
        <div id="caixa-imagem" class="flexbox">
            <h3><label for="imagem-evento" >Imagem do Evento:</label></h3>
            <input type="file" id="imagem-evento" name="file_evento"> <!-- CAMPO DO IMAGEM -->
        </div>
        <div id="caixa-descricao" class="flexbox">
            <h3><label for="descricao-evento" >Descrição:</label></h3>
            <textarea maxlength="60000" id="descricao-evento" name="txt_descricao"><?php echo $descricao ?></textarea><!-- CAMPO DO DESCRICAO -->
        </div>
        <div id="caixa-cep" class="flexbox">
            <h3><label for="cep" >Cep:</label></h3>
            <input maxlength="9" type="text" id="cep" name="txt_cep" value="<?php echo $cep ?>"> <!-- CAMPO DO CEP -->
        </div>
        <div id="caixa-estado" class="flexbox">
            <h3><label >Estado:</label></h3>
            <input type="text" id="estado" name="txt_estado" readonly value="<?php echo $estado ?>"> <!-- CAMPO DO ESTADO -->
        </div>
        <div id="caixa-cidade" class="flexbox">
            <h3><label >Cidade:</label></h3>
            <input type="text" id="cidade" name="txt_cidade" readonly value="<?php echo $cidade ?>"> <!-- CAMPO DO CIDADE -->
        </div>
        <div id="caixa-logradouro" class="flexbox">
            <h3><label >Logradouro:</label></h3>
            <input type="text" id="logradouro" name="txt_logradouro" readonly value="<?php echo $logradouro ?>"> <!-- CAMPO DO LOGRADOURO -->
        </div>
        <div id="caixa-numero">
            <h3><label for="numero" >Nº :</label></h3>
            <input maxlength="10" type="text" id="numero" name="txt_numero" value="<?php echo $numero ?>"> <!-- CAMPO DO NUMERO -->
        </div>
        <div id="caixa-bairro" class="flexbox">
            <h3><label >Bairro:</label></h3>
            <input type="text" id="bairro" name="txt_bairro" readonly value="<?php echo $bairro ?>"> <!-- CAMPO DO BAIRRO -->
        </div>
        <div id="caixa-btn-evento" class="flexbox">
            <input type="submit" name="btn_atualizar_evento" class="btn-confirmacao" value="ATUALIZAR"> <!-- CAMPO DO CEP -->
        </div>
    </div>
</form>
