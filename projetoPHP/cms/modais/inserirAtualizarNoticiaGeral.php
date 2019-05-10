<!-- MODAL DE ADIÇÃO DE NOTICIA PRINCIPAL -->
<?php
    session_start();
    // CONEXAO COM O BANCO
    require_once("../../bd/conexao.php");
    $conexao = conexaoMySql();

    $titulo = null;
    $autor = null;
    $dataTxt = null;
    $data = null;
    $resumo = null;

    if($_POST['modo'] == 'inserir'){
        $btn = 'enviar';
        $btnValue = 'Enviar';
    }elseif($_POST['modo'] == 'atualizar'){
        $btn = 'atualizar';
        $btnValue = 'Atualizar';
        if((isset($_POST['codigo'])) && $_POST['codigo'] != 0){
            $_SESSION['cod_noticia'] = $_POST['codigo'];

            $codNoticia = $_POST['codigo'];
        
            // SCRIPT SQL QUE TRAZ A NOTICIA O QUAL FOI CLICADA NA TABELA
            $sql = "SELECT * FROM tbl_noticia WHERE cod_noticia = ".$_SESSION['cod_noticia'];
        
            $select = mysqli_query($conexao, $sql);
            
            if($rsNoticia = mysqli_fetch_array($select)){
                $titulo = $rsNoticia['titulo_noticia'];
                $autor = $rsNoticia['autor'];
                $dataTxt = explode("-", $rsNoticia['data']);
                $data = $dataTxt[2]."/".$dataTxt[1]."/".$dataTxt[0];
                $resumo = $rsNoticia['resumo'];
                $imagem = $rsNoticia['imagem'];
                $_SESSION['img'] = $imagem;
            } 
            // session_destroy();   
        }
    }
?>
<script src="./js/jquery-3.3.1.min.js"></script>
<script>
        $(document).ready(function(){
            $('#fechar-modal-noticia').click(function(){
                $('#container').fadeOut(300);
            });
        });
</script>
<!-- BOTAO DE FECHAR O MODAL -->
<div id="fechar-modal-noticia">
    <img class="icon-close" alt="Fechar" title="Fechar" src="icons/close.png">
</div>
<div id="tipos-noticias" class="flexbox">
    <!-- TIPO DA NOTICIA -->
    <div id="tipo-gerais" class="flexbox">
        <h2>Notícias Gerais</h2>
    </div>
</div>
<!-- FORMULARIO DE EDIÇÃO DE NOTICIA GERAL -->
<form enctype="multipart/form-data" method="POST" action="mngNoticias.php" name="frm-gerais">
    <div id="formulario-gerais">
        <div id="titulo">
            <h3><label for="txt-titulo">Titulo da Notícia:</label></h3> <!-- CAMPO DE TITULO -->
            <input required maxlength="75" id="txt-titulo" type="text" name="txt_titulo" value="<?php echo(!empty($titulo)?$titulo:''); ?>">
        </div>
        <div id="autor">
            <h3><label for="txt-autor">Autor:</label></h3> <!-- CAMPO DE AUTOR -->
            <input required maxlength="50" id="txt-autor" type="text" name="txt_autor" value="<?php echo(!empty($autor)?$autor:''); ?>">
        </div>
        <div id="resumo">
            <h3><label for="txt-resumo">Resumo:</label></h3> <!-- CAMPO DE RESUMO -->
            <textarea required maxlength="105" id="txt-resumo" name="txt_resumo"><?php echo(!empty($resumo)?$resumo:''); ?></textarea>
        </div>
        <div id="center-img-data">
            <div id="data">
                <h3><label for="txt-data">Data:</label></h3> <!-- CAMPO DE DATA -->
                <input maxlength="10" id="txt-data" type="text" name="txt_data" value="<?php echo(!empty($data)?$data:''); ?>">
            </div>
                <h3><label for="btn-arquivo">Imagem da Notícia:</label></h3> <!-- CAMPO DE IMAGEM -->
                <input type="file" id="btn-arquivo" name="foto_noticia" value="Escolher Arquivo">
            </div>
        </div>
        <div id="enviar-principal"> <!-- CAMPO DE BOTAO DE SUBMISSAO -->
            <input type="submit" class="btn-confirmacao" name="btn_<?php echo $btn; ?>_gerais" value="<?php echo $btnValue; ?>">
        </div>
    </div>
</form>
Avenida Presidente Joaquim Augusto da Costa Marques