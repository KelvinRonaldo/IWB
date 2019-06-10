<?php
    require_once ('../verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $_SESSION['cod_sobre'] = $_GET['codSobre'];

    $tituloSobre = null;
    $textoSobre = null;
    $assinatura = null;
    $imagemSobre = null;

    $sql = "SELECT * FROM tbl_sobre WHERE cod_sobre = ".$_SESSION['cod_sobre'];
    $select = mysqli_query($conexao, $sql);

    if($rsSobre = mysqli_fetch_array($select)){
        $tituloSobre = $rsSobre['titulo_sobre'];
        $textoSobre = $rsSobre['sobre'];
        $assinatura = $rsSobre['assinatura'];
        $_SESSION['img'] = $rsSobre['imagem'];
    }

?>
<script src="js/jquery-3.3.1.min.js"></script>
<!-- SCRIPT PARA FECHAR A MODAL -->
<script>
    $(document).ready(function(){
        $('#fechar-modal-sobre').click(function(){
            $('#container').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-sobre">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<form action="mngSobre.php" method="POST" enctype="multipart/form-data" name="frm-sobre">
    <div id="container-modal-sobre" class="flexbox">
        <div id="titulo-sobre" class="flexbox">
            <h3><label for="txt-titulo-sobre">Título da Página Sobre:</label></h3>
            <input maxlength="25" type="text" name="txt_titulo_sobre" id="txt-titulo-sobre" value="<?php echo $tituloSobre; ?>">
        </div>
        <div id="imagem-sobre" class="flexbox">
            <h3><label for="txt-sobre">Imagem da Página Sobre:</label></h3>
            <input type="file" name="file_sobre" id="file-sobre">
        </div>
        <div id="assinatura-sobre" class="flexbox">
            <h3><label for="txt-sobre">Assinatura:</label></h3>
            <input maxlength="50" type="text" id="txt-assinatura" name="txt_assinatura" value="<?php echo $assinatura; ?>">
        </div>
        <div id="texto-sobre" class="flexbox">
            <h3><label for="txt-sobre">Sobre A Road Runner:</label></h3>
            <textarea maxlength="60000" id="txt-sobre" name="txt_sobre"><?php echo $textoSobre; ?></textarea>
        </div>
        <div id="caixa-btn-sobre" class="flexbox">
            <input type="submit" name="btn_atualizar_sobre" class="btn-confirmacao" value="ATUALIZAR"> <!-- CAMPO DO CEP -->
        </div>
    </div>
</form>
