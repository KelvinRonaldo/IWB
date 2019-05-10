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
    $destaque = null;
    $codDestaque = 0;


    if($_POST['modo'] == 'inserir'){
        $btnName = 'enviar';
        $btnValue = 'Enviar';
    }elseif($_POST['modo'] == 'atualizar'){
        $btnName = 'atualizar';
        $btnValue = 'Atualizar';
        if((isset($_POST['codigo'])) && $_POST['codigo'] != 0){
            $_SESSION['cod_noticia'] = $_POST['codigo'];
        
            // SCRIPT SQL QUE TRAZ A NOTICIA O QUAL FOI CLICADA NA TABELA
            $sql = "SELECT * FROM tbl_noticia_principal AS np
            INNER JOIN tbl_destaque_noticia_principal AS dnp
            ON np.cod_destaque = dnp.cod_destaque
            WHERE cod_noticia = ".$_SESSION['cod_noticia'];
        
            $select = mysqli_query($conexao, $sql);
            
            if($rsNoticia = mysqli_fetch_array($select)){
                $titulo = $rsNoticia['titulo_noticia'];
                $autor = $rsNoticia['autor'];
                $dataTxt = explode("-", $rsNoticia['data']);
                $data = $dataTxt[2]."/".$dataTxt[1]."/".$dataTxt[0];
                $resumo = $rsNoticia['resumo'];
                $codDestaque = $rsNoticia['cod_destaque'];
                $nvlDestaque = $rsNoticia['destaque'];
                $imagem = $rsNoticia['imagem'];
                $_SESSION['img'] = $imagem;
        
                $nvlAlto = $destaque == 1 ? ' selected ' : '' ;
                $nvlMedio = $destaque == 2 ? ' selected ' : '' ;
                $nvlBaixo = $destaque == 3 ? ' selected ' : '' ;
            }     
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
    <div id="tipo-principais" class="flexbox">
        <h2>Notícia Principais</h2>
    </div>
</div>
<form enctype="multipart/form-data" method="POST" action="mngNoticias.php" name="frm-principais">
    <div id="formulario-principais">
        <div id="titulo">
            <h3><label for="txt-titulo">Titulo da Notícia:</label></h3> <!-- CAMPO DE TITULO -->
            <input required maxlength="20" id="txt-titulo" type="text" name="txt_titulo" value="<?php echo($titulo); ?>">
        </div>
        <div id="autor">
            <h3><label for="txt-autor">Autor:</label></h3> <!-- CAMPO DE AUTOR -->
            <input required maxlength="45" id="txt-autor" type="text" name="txt_autor" value="<?php echo($autor); ?>">
        </div>
        <div id="resumo">
            <h3><label for="txt-resumo">Resumo:</label></h3> <!-- CAMPO DE RESUMO -->
            <textarea required maxlength="80" id="txt-resumo" name="txt_resumo"><?php echo($resumo); ?></textarea>
        </div>
        <div id="center-data-nivel">
            <div id="data">
                <h3><label for="txt-data">Data:</label></h3> <!-- CAMPO DE DATA -->
                <input maxlength="10" id="txt-data" type="text" name="txt_data" value="<?php echo($data); ?>">
            </div>
            <div id="nivel">
                <h3><label for="cmb-nivel">Nível de Destaque:</label></h3> <!-- CAMPO DE destaque -->
                <select required id="cmb-nivel" name="cmb_destaque">
                    <?php  
                        if($codDestaque != 0){
                    ?>
                    <option value="<?php echo $codDestaque ?>"><?php echo $nvlDestaque ?></option>
                    <?php
                        }else{
                    ?>
                    <option value="">Escolha o nível da noticia</option>
                    <?php
                        }
                    ?>
                    <?php
                        $sql = "SELECT * FROM tbl_destaque_noticia_principal WHERE cod_destaque <> ".$codDestaque;
                        $select = mysqli_query($conexao, $sql);

                        while($rsDestaque = mysqli_fetch_array($select)){
                            $codDestaque = $rsDestaque['cod_destaque'];
                            $nvlDestaque = $rsDestaque['destaque'];
                    ?>
                    <option value="<?php echo $codDestaque ?>"><?php echo $nvlDestaque; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div id="enviar-arquivo">
            <h3><label for="btn-arquivo">Imagem da Notícia:</label></h3> <!-- CAMPO DE IMAGEM -->
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
            <input type="file" id="btn-arquivo" name="foto_noticia" value="Escolher Arquivo">
        </div>
        <div id="enviar-principal"> <!-- CAMPO DE BOTAO E SUBMISSAO -->
            <input type="submit" class="btn-confirmacao" name="btn_<?php echo $btnName; ?>_principais" value="<?php echo $btnValue; ?>">
        </div>
    </div>
</form>