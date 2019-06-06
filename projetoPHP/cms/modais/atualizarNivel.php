<?php

    require_once ('../verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $nomeNivel = null;
    $admConteudos = null;
    $admFaleConosco = null;
    $admProdutos = null;
    $admUsuarios = null;

    $codNivelUsuario = $_GET['codigo'];

    $sql = "SELECT * FROM tbl_nivel_usuario WHERE cod_nivel_usuario = ".$codNivelUsuario;

    $select = mysqli_query($conexao, $sql);

    if($rsNivel = mysqli_fetch_array($select)){
        $nomeNivel = $rsNivel['nivel'];
        $admConteudos = $rsNivel['adm_conteudo'] == 'ativado' ? 'checked' : '';
        $admFaleConosco = $rsNivel['adm_fale_conosco'] == 'ativado' ? 'checked' : '';
        $admProdutos = $rsNivel['adm_produto'] == 'ativado' ? 'checked' : '';
        $admUsuarios = $rsNivel['adm_usuario'] == 'ativado' ? 'checked' : '';
        $_SESSION['cod_nivel_usuario_atual'] = $codNivelUsuario;
    }

?>


<script>
    $(document).ready(function(){
        $('#fechar-modal-nivel').click(function(){
            $('#container-nivel').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-nivel">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<form name="frm_niveis" method="get" action="cmsUsuarios.php">
    <div id="container-edit-nivel">
        <div id="nome-nivel" class="flexbox">
            <h3><label>Nome Nível:</label></h3>
            <input maxlength="30" type="text" id="txt-nome-nivel" name="txt_nome_nivel" value="<?php echo $nomeNivel ?>">
        </div>
        <h3><label>PERMISSÕES:</label></h3>
        <hr>
        <div id="container-permissoes">
            <div class="caixas-permissoes flexbox">
                <h3><label>Conteúdos:</label></h3>
                <div class="on-off-adm-conteudos">
                    <input <?php echo $admConteudos ?> type="checkbox" name="itr_conteudo" class="interruptores" id="on-off-conteudos">
                    <label class="lbl-interruptores" for="on-off-conteudos"></label>
                </div>
            </div>
            <div class="caixas-permissoes flexbox">
                <h3><label>Fale Conosco:</label></h3>
                <div class="on-off-adm-conteudos">
                    <input <?php echo $admFaleConosco ?> type="checkbox" name="itr_fale_conosco" class="interruptores" id="on-off-fale-conosco">
                    <label class="lbl-interruptores" for="on-off-fale-conosco"></label>
                </div>
            </div>
            <div class="caixas-permissoes flexbox">
                <h3><label>Produtos:</label></h3>
                <div class="on-off-adm-conteudos">
                    <input <?php echo $admProdutos ?> type="checkbox" name="itr_produtos" class="interruptores" id="on-off-produtos">
                    <label class="lbl-interruptores" for="on-off-produtos"></label>
                </div>
            </div>
            <div class="caixas-permissoes flexbox">
                <h3><label>Usuários:</label></h3>
                <div class="on-off-adm-conteudos">
                    <input <?php echo $admUsuarios ?> type="checkbox" name="itr_usuarios" class="interruptores" id="on-off-usuarios">
                    <label class="lbl-interruptores" for="on-off-usuarios"></label>
                </div>
            </div>
        </div>
        <div id="caixa-btn-nivel" class="flexbox">
            <input type="submit" name="btn_atualizar_nivel" class="btn-confirmacao" id="btn-enviar-nivel" value="Atualizar">
        </div>
    </div>
</form>