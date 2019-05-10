<?php
    // INPORTANO E EXECUTANDO FUNÇÃO DE CONEXAO COM BANCO DE DADOS
    require_once('./bd/conexao.php');
    $conexao = conexaoMySQL();
    
    // DECLARAÇÃO DE VARIÁVEIS
    $nome = null;
    $celular = null;
    $telefone = null;
    $sexo = null;
    $email = null;
    $profissao =  null;
    $homePage = null;
    $facebook = null;
    $assunto = null;
    $mensagem = null;

    // FUNÇÃO DE INSERÇÃO DE DADOS NO BANCO DE DADOS
    if(isset($_POST['btn_enviar'])){
        $nome = trim($_POST['txt_nome']);
        $celular = trim($_POST['txt_celular']);
        $telefone = trim($_POST['txt_telefone']);
        $sexo = trim($_POST['rdo_sexo']);
        $email = trim($_POST['txt_email']);
        $profissao = trim($_POST['txt_profissao']);
        $homePage = trim($_POST['txt_home_page']);
        $facebook = trim($_POST['txt_facebook']);
        $assunto = trim($_POST['txt_assunto']);
        $mensagem = trim($_POST['txt_msg']);

        $sql = "INSERT INTO tbl_fale_conosco (nome, celular, telefone, sexo, email, profissao, home_page, facebook, cod_assunto, mensagem)
            VALUES ('".$nome."','".$celular."','".$telefone."','".$sexo."','".$email."','".$profissao."','".$homePage."','".$facebook."',".$assunto.",'".$mensagem."')";

        if(mysqli_query($conexao, $sql)){
            header('location: contato.php');
        }else{
            echo $sql;
            echo("<script>alert('Ouve um erro no envio da mensagem. Tente novamente.'); </script>");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/slider.css" media="screen">
        <link rel="stylesheet" href="css/fontes.css">
        <title>FALE CONOSCO</title>
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <!-- DIV QUE SEGURADO TODA A PAGINA -->
        <div id="pagina">
            <!-- IMPORTANDO HEADER -->
            <?php 
                require_once('header.html');
            ?>
            <!-- AREA ONDE ESTÁ TODA ESTRUTURA DO SITE, EXCETO HEADER E FOOTER -->
            <div id="tudo" class="center">
                <!-- AREA COM TITULO DA PAGINA -->
                <div id="titulo-pagina">
                    <h1>FALE CONOSCO</h1>
                </div>
                <!-- AREA COM INSTRUÇÃO E CAMPOS DO FORMULARIO DE CONTATO -->
                <div id="conteudo-contato">
                    <div id="container-contato">
                        <!-- INSTRUÇÃO PARA USUARIO -->
                        <div id="instrucao-contato">
                            <p>Preencha os campos ao lado para enviar-nos uma mensagem.</p>
                            <hr>
                            <p class="obrigatorio">*Campos Obrigatórios</p>
                        </div>
                        <!-- AREA FORMULARIO DECONTATO -->
                        <form action="contato.php" method="post" name="frm_contato">
                            <div id="texts-contato">
                                <!-- CAMPO DE DIGITAÇÃO DO NOME DO USUARIO -->
                                <div id="contato-nome">
                                    <h3><label for="txt-nome-contato">nome:</label><span class="obrigatorio">*</span></h3>
                                    <input maxlength="100" type="text" placeholder="Ex.: José da Silva" name="txt_nome" id="txt-nome-contato" required oninvalid="setCustomValidity('Digite apenas letras neste campo.')" onchange="try{setCustomValidity('')}catch(e){}">
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DO CELULAR DO USUARIO -->
                                <div id="contato-celular">
                                    <h3><label for="txt-celular-contato">celular:</label><span class="obrigatorio">*</span></h3>
                                    <input maxlength="15" type="tel" placeholder="Ex.: (XX) 00000-0000" name="txt_celular" id="txt-celular-contato" required oninvalid="setCustomValidity('Respeite o formato do campo(espaço e traço opcionais).')" onchange="try{setCustomValidity('')}catch(e){}">
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DO TELEFONE DO USUARIO -->
                                <div id="contato-telefone">
                                    <h3><label for="txt-telefone-contato">telefone:</label></h3>
                                    <input maxlength="14" type="tel" placeholder="Ex.: (XX) 0000-0000" name="txt_telefone" id="txt-telefone-contato" oninvalid="setCustomValidity('Respeite o formato acima(espaço e traço opcionais).')" onchange="try{setCustomValidity('')}catch(e){}">
                                </div>
                                <!-- CAMPO DE SELEÇÃO DO SEXO DO USUARIO -->
                                <div id="contato-sexo">
                                    <h3>sexo:<span class="obrigatorio">*</span></h3>
                                <!-- CAMPO DE SELEÇÃO DO SEXO MASCULINO -->
                                    <input type="radio" id="rdo-masc" name="rdo_sexo" value="M" required>
                                    <label class="lbl-masc" for="rdo-masc">Masculino</label>
                                <!-- CAMPO DE SELEÇÃO DO SEXO FEMININO -->
                                    <input type="radio" id="rdo-femi" name="rdo_sexo" value="F" required>
                                    <label class="lbl-femi" for="rdo-femi">Feminino</label>
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DO EMAIL DO USUARIO -->
                                <div id="contato-email">
                                    <h3><label for="txt-email-contato">e-mail:</label><span class="obrigatorio">*</span></h3>
                                    <input maxlength="100" type="email" placeholder="exemplo@exemplo.com" name="txt_email" id="txt-email-contato" required oninvalid="setCustomValidity('Respeite o formato acima.')" onchange="try{setCustomValidity('')}catch(e){}">
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DA PROFISSAO DO USUARIO -->
                                <div id="contato-profissao">
                                    <h3><label for="txt-profissao-contato">profissão:</label><span class="obrigatorio">*</span></h3>
                                    <input maxlength="100" type="text" name="txt_profissao" placeholder="Ex.: Piloto" id="txt-profissao-contato" required oninvalid="setCustomValidity('Digite apenas letras neste campo.')" onchange="try{setCustomValidity('')}catch(e){}">
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DA HOME PAGE(WEBSITE) DO USUARIO -->
                                <div id="contato-home-page">
                                    <h3><label for="txt-home-page-contato">Home Page:</label></h3>
                                    <input maxlength="150" type="url" name="txt_home_page" id="txt-home-page-contato">
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DO LINK DO FACEBOOK DO USUARIO -->
                                <div id="contato-face">
                                    <h3><label for="txt-face-contato">facebook:</label></h3>
                                    <input maxlength="150" type="url" name="txt_facebook" id="txt-face-contato">
                                </div>
                                <!-- CAMPO DE SELEÇÃO DO ASSUNTO DA MENSAGEM DO USUARIO -->
                                <div id="contato-assunto">
                                    <h3><label>assunto:</label><span class="obrigatorio">*</span></h3>
                                    <select name="txt_assunto" id="slc-assunto-contato" required>
                                        <option value="">Selecione o Assunto</option>
                                        <option value="1">Informar sobre Produto</option>
                                        <option value="2">Sugestão/Crítica</option>
                                        <option value="3">Geral</option>
                                    </select>
                                </div>
                                <!-- CAMPO DE DIGITAÇÃO DA MENSAGEM DO USUARIO -->
                                <div id="contato-msg">
                                    <h3><label for="txt-msg-contato">mensagem:</label><span class="obrigatorio">*</span></h3>
                                    <textarea name="txt_msg" id="txt-msg-contato" required oninvalid="setCustomValidity('Este campo não pode permanecer vazio.')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                </div>
                                <!-- BOTAO DE SUBMISSAO(ENVIO) DO FORMULARIO DO USUARIO -->
                                <input type="submit" name="btn_enviar" id="btn-enviar" value="ENVIAR">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- IMPORTANDO FOOTER -->
            <?php 
                require_once('footer.html');
            ?>
        </div>
        <!-- IMPORTANDO ARQUIVO COM VALIDAÇÃO DAS INFORMAÇÕES DOS DADOS DIGITADOS PELO USUARIO -->
        <script src="js/validador.js"></script>
    </body>
</html>