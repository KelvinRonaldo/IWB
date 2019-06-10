<?php

    require_once ('../verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $userName = null;
    $nomeUser = null;
    $email = null;
    $senha = null;
    $codNivelUser = 0;


    // $codNivelUser = $_GET['codNivelUsuario'];
    $codUsuario = $_GET['codUsuario'];

    $sql = "SELECT user.cod_usuario, user.nome_usuario, user.nome, user.email,
            user.cod_nivel_usuario, nivel_user.nivel
            FROM tbl_usuario AS user
            INNER JOIN tbl_nivel_usuario AS nivel_user
            ON user.cod_nivel_usuario = nivel_user.cod_nivel_usuario
            WHERE cod_usuario = ".$codUsuario;

    $select = mysqli_query($conexao, $sql);

    if($rsUser = mysqli_fetch_array($select)){        
        $codUsuario = $rsUser['cod_usuario'];
        $codNivelUser = $rsUser['cod_nivel_usuario'];
        $nomeNivelUser = $rsUser['nivel'];
        $userName = $rsUser['nome_usuario'];
        $nomeUser = $rsUser['nome'];
        $email = $rsUser['email'];
        $_SESSION['cod_usuario_atual'] = $codUsuario;
    }

?>
<script>
    $(document).ready(function(){
        $('#fechar-modal-user').click(function(){
            $('#container-user').fadeOut(300);
        });
    });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-user">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<form name="frm_user" action="cmsUsuarios.php" method="post">
    <div id="container-edit-user" class="flexbox">
        <div id="username-user" class="flexbox">
            <h3><label>Nome de Usuário (Login):</label></h3>
            <input maxlength="30" required type="text" id="txt-username-user" name="txt_username_user" value="<?php echo $userName ?>">
        </div>
        <div id="nome-user" class="flexbox">
            <h3><label>Nome:</label></h3>
            <input maxlength="45" required type="text" id="txt-nome-user" name="txt_nome_user" value="<?php echo $nomeUser ?>">
        </div>
        <div id="email-user" class="flexbox">
            <h3><label>E-mail:</label></h3>
            <input maxlength="100" required type="email" id="txt-email-user" name="txt_email_user" value="<?php echo $email ?>">
        </div>
        <div id="senha-user" class="flexbox">
            <h3><label>Senha:</label></h3>
            <input minlength="5" type="password" id="txt-senha-user" name="txt_senha_user" value="">
        </div>
        <div id="confirmar-senha-user" class="flexbox">
            <h3><label>Confirmar Senha:</label></h3>
            <input minlength="5" type="password" id="txt-confirmar-senha-user" value="">
        </div>
        <div id="nivel-user" class="flexbox">
            <h3><label>Nível de Usuário:</label></h3>
            <select required id="slt-nivel-user" name="slt_nivel_user">
                <?php
                    if($codNivelUser == 0){
                ?>
                <option value="">Escolha um Produto</option>
                <?php
                    }else{
                ?>
                <option value="">Escolha um Produto</option>
                <option selected value="<?php echo $codNivelUser ?>"><?php echo $nomeNivelUser ?></option>
                <?php
                    }
                    $sql = "SELECT * FROM tbl_nivel_usuario WHERE cod_nivel_usuario <> ".$codNivelUser;

                    $select = mysqli_query($conexao, $sql);

                    while($rsUsers = mysqli_fetch_array($select)) {
                        $nomeNivelUser = $rsUsers['nivel'];
                        $codNivelUser = $rsUsers['cod_nivel_usuario'];
                ?>
                <option value="<?php echo $codNivelUser ?>"><?php echo $nomeNivelUser ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div id="caixa-btn-user" class="flexbox">
            <input type="submit" onclick="return confirmarSenha()" name="btn_atualizar_user" class="btn-confirmacao" id="btn-enviar-user" value="Atualizar"><!-- CAMPO DO CEP -->
        </div>
    </div>
</form>
<script src="js/confirmarSenha.js"></script>