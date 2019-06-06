<?php

    require_once('../verificarUsuario.php');

    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $codLoja = $_GET['codigo'];

    $sql = "SELECT l.cod_loja, l.status, e.logradouro, e.numero, e.bairro, e.cep, cd.cidade, et.estado, e.cep, e.cod_endereco
    FROM tbl_loja AS l 
    INNER JOIN tbl_endereco AS e ON l.cod_endereco = e.cod_endereco
    INNER JOIN tbl_cidade AS cd ON e.cod_cidade = cd.cod_cidade
    INNER JOIN tbl_estado AS et ON cd.cod_estado = et.cod_estado
    WHERE l.cod_loja = '".$codLoja."'";

    $select = mysqli_query($conexao, $sql);

    if($rsLoja = mysqli_fetch_array($select)){
        $cep = $rsLoja['cep'];
        $logradouro = $rsLoja['logradouro'];
        $numero = $rsLoja['numero'];
        $bairro = $rsLoja['bairro'];
        $cidade = $rsLoja['cidade'];
        $estado = $rsLoja['estado'];
        $status = $rsLoja['status'];
        $_SESSION['cod_endereco'] = $rsLoja['cod_endereco'];
    }
?>
<script>
    $(document).ready(function(){
        $('#fechar-modal-loja').click(function(){
            $('#container').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-loja">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<form action="crudLojas.php" method="GET" name="frm_lojas">
    <div id="form-edit-loja">
        <!-- <input hidden type="text" name="txt_cod_endereco" value="<?php echo(!empty($codEndereco) ? $codEndereco : ''); ?>"> -->
        <div id="caixa-cep" class="flexbox">
            <h3><label for="cep" >Cep:</label></h3>
            <input maxlength="9" type="text" id="cep" name="txt_cep" value="<?php echo(!empty($cep) ? $cep : ''); ?>"> <!-- CAMPO DO CEP -->
        </div>
        <div id="caixa-estado" class="flexbox">
            <h3><label >Estado:</label></h3>
            <input type="text" id="estado" name="txt_estado" readonly value="<?php echo(!empty($estado) ? $estado : ''); ?>"> <!-- CAMPO DO ESTADO -->
        </div>
        <div id="caixa-cidade" class="flexbox">
            <h3><label >Cidade:</label></h3>
            <input type="text" id="cidade" name="txt_cidade" readonly value="<?php echo(!empty($cidade) ? $cidade : ''); ?>"> <!-- CAMPO DO CIDADE -->
        </div>
        <div id="caixa-logradouro" class="flexbox">
            <h3><label >Logradouro:</label></h3>
            <input type="text" id="logradouro" name="txt_logradouro" readonly value="<?php echo(!empty($logradouro) ? $logradouro : ''); ?>"> <!-- CAMPO DO LOGRADOURO -->
        </div>
        <div id="caixa-numero">
            <h3><label for="numero" >Nº :</label></h3>
            <input maxlength="10" type="text" id="numero" name="txt_numero" value="<?php echo(!empty($numero) ? $numero : ''); ?>"> <!-- CAMPO DO NUMERO -->
        </div>     
        <div id="caixa-bairro" class="flexbox">
            <h3><label>Bairro:</label></h3>
            <input type="text" id="bairro" name="txt_bairro" readonly value="<?php echo(!empty($bairro) ? $bairro : ''); ?>"> <!-- CAMPO DO BAIRRO -->
        </div>
        <div id="caixa-btn-loja" class="flexbox">
            <input type="submit" name="btn_atualizar_loja" class="btn-confirmacao" value="ENVIAR"> <!-- CAMPO DO CEP -->
        </div>
    </div>                       
</form>
<script src="./js/preencherEndereco.js"></script>