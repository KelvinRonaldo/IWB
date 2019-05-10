<!-- MODAL FALE CONOSCO -->
<?php
    require_once('../../bd/conexao.php');
    $conexao = conexaoMySql();

    $codMsg = $_GET['codigo'];

    // SCRIPT SQL QUE TRAZ OS DADOS DO REGISTRO CLICADO DO BANCO
    $sql = "SELECT f.nome, f.celular, f.telefone, f.sexo, f.email,
            f.profissao, f.home_page, f.facebook, f.mensagem,
            a.assunto, a.cod_assunto
            FROM tbl_fale_conosco AS f
            INNER JOIN tbl_assunto AS a
            ON f.cod_assunto = a.cod_assunto
            WHERE cod_mensagem = ".$codMsg;

    $select = mysqli_query($conexao, $sql);

    if($rsMsg = mysqli_fetch_array($select)){
        $nome = $rsMsg['nome'];
        $celular = $rsMsg['celular'];
        $telefone = $rsMsg['telefone'];
        $sexo = $rsMsg['sexo'];
        $email = $rsMsg['email'];
        $profissao = $rsMsg['profissao'];
        $homePage = $rsMsg['home_page'];
        $facebook = $rsMsg['facebook'];
        $mensagem = $rsMsg['mensagem'];
        $assunto = $rsMsg['assunto'];
        $codAssunto = $rsMsg['cod_assunto'];
    }

?>


<script src="./js/jquery-3.3.1.min.js"></script>
<!-- SCRIPT PARA FECHAR A MODAL -->
<script>
    $(document).ready(function(){
        $('#fechar-modal-fale-conosco').click(function(){
            $('#container').fadeOut(300);
        });
    });
</script>
<!-- AREA COM CAMPOS COM IFO DO RESGITRO CLICADO -->
<div id="conteudo-modal-fale-conosco">
    <!-- BOTAO PARA FECHAR MODAL -->
    <div id="fechar-modal-fale-conosco">
        <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
    </div>
    <div id="nome" class="flexbox"> <!-- CAMPO NOME -->
        <h2><?php echo($nome); ?></h2>
    </div>
    <div id="dados-mensagem" class="flexbox">
        <div id="email" class="flexbox"> <!-- CAMPO E-MAIL -->
            <div class="titulo-campos-modal">
                <h2>E-mail:</h2>
            </div>
            <p><?php echo($email); ?></p>
        </div>
        <div id="celular" class="flexbox"> <!-- CAMPO CELULAR -->
            <div class="titulo-campos-modal">
                <h2>Celular:</h2>
            </div>
            <p><?php echo($celular); ?></p>
        </div>
        <div id="telefone" class="flexbox"> <!-- CAMPO TELEFONE -->
            <div class="titulo-campos-modal">
                <h2>Telefone:</h2>
            </div>
            <p><?php echo(!empty($telefone) ? $telefone : '-------'); ?></p>
        </div>
        <div id="profissao" class="flexbox"> <!-- CAMPO PROFISSAO -->
            <div class="titulo-campos-modal">
                <h2>Profissão:</h2>
            </div>
            <p><?php echo($profissao); ?></p>
        </div>
        <div id="sexo" class="flexbox"> <!-- CAMPO SEXO -->
            <div class="titulo-campos-modal">
                <h2>Sexo:</h2>
            </div>
            <p><?php echo($sexo == 'F' ? 'Feminino' : 'Masculino'); ?></p>
        </div>
        <div id="caixa-homepage-facebook" class="flexbox">
            <div id="home-page" class="flexbox"> <!-- CAMPO HOME PAGE -->
                <div class="titulo-campos-modal">
                    <h2>Home Page:</h2>
                </div>
                <p><?php echo(!empty($homePage)? $homePage : '-------'); ?></p>
            </div>
            <div id="facebook" class="flexbox"> <!-- CAMPO FACEBOOK -->
                <div class="titulo-campos-modal">
                    <h2>Facebook:</h2>
                </div>
                <p><?php echo(!empty($facebook)? $facebook : '-------'); ?></p>
            </div>
        </div>
    </div>
    <div id="tipomsg-mensagem">
        <div id="assunto" class="flexbox"> <!-- CAMPO ASSUNTTO DA MENSAGEM -->
            <h2>Tipo da mensagem: <?php echo($assunto); ?></h2>
        </div>
        <div id="mensagem"> <!-- CAMPO MENSAGEM -->
            <p>&nbsp; <?php echo(nl2br($mensagem)); ?></p>
        </div>
    </div>
</div>