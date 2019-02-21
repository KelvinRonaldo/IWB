<?php
/*    Para retirar os dados de um elemento html utilizando o metodo get utilizamos "$_GET"
    $nome = $_GET['txt_nome'];
    $estado = $_GET['cmb_estados'];
    $graduacao = $_GET['chk_graduacao'];
    $pos = $_GET['chk_pos'];
    $mestrado = $_GET['chk_mestrado'];
    $sexo = $_GET['rdo_sexo'];
    $senha = $_GET['txt_senha'];
    $obs = $_GET['txt_obs'];
*/
//    Para retirar os dados de um elemento html utilizando o metodo post utilizamos "$_POST"
    $nome = $_POST['txt_nome'];
    $estado = $_POST['cmb_estados'];
    $graduacao = $_POST['chk_graduacao'];
    $pos = $_POST['chk_pos'];
    $mestrado = $_POST['chk_mestrado'];
    $sexo = $_POST['rdo_sexo'];
    $senha = $_POST['txt_senha'];
    $obs = $_POST['txt_obs'];

    echo(
    'Nome: '.$nome."<br>"
    .'Estado: '.$estado."<br>"
    .'Curso: '.$graduacao."<br>"
    .'Curso: '.$pos."<br>"
    .'Curso: '.$mestrado."<br>"
    .'Sexo: '.$sexo."<br>"
    .'Senha: '.$senha."<br>"
    .'Obs.: '.$obs);
?>

<html>
    <head>
        <title>
            PHP AULA 1 - Formulário
        </title>
        <meta charset="utf-8">
        <style>
            textarea{
                resize: none;
            }
        </style>
    </head>
    <body>
        <!-- tag form - formulario, para pegar informaçãoes da pagina para usa-las em outro lugar 
            método get = manda do dados o form para a url(EX: www.kelvin.com.br/index.php?txtNome=ronaldo&txtIdade=19)
                                                                               endereço ←↑→ variáveis criar pelo form [& = concatenação]
        -->
        <!-- tag action = para onde os dados serão enviados -->
        <form name="frm_cadastro" method="post" action="index.php">
            <table width="600" border="2">
                <tr>
                    <td>Nome:</td>
                    <td>
<!--                        colocar maxlength em caixas de texto com o numero maximo igual ao valor colocado no banco de dados-->
                       <input type="text" name="txt_nome" value="" size="20" maxlength="20">
                    </td>
                </tr>
                <tr>
                    <td>Estados:</td>
                    <td>
                        <select name="cmb_estados">
                            <option value="" selected>Selecione um estado</option>
                            <option value="SP">São Paulo</option>
                            <option value="RJ">Rio de Janeiro</option>
                        </select>
                    </td>
                </tr>
                <tr>
<!--                    checked = iniciar sistema com elemento marcado, serve tanto para o radio ou checkbox-->
                    <td>Cursos:</td>
                    <td>
                        <input type="checkbox" name="chk_graduacao" value="graduacao">Graduação
                        <input type="checkbox" name="chk_pos" value="pos">Pos-Graduação
                        <input type="checkbox" name="chk_mestrado" value="mestrado">Mestrado
                    </td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td>
<!--                    para que o radio funcione(possa selecionar apenas 1) eles devem ter o mesmo "name"-->
                        <input type="radio" name="rdo_sexo" value="F">Feminino 
                        <input type="radio" name="rdo_sexo" value="M">Masculino
                    </td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td>
                        <input type="password" name="txt_senha" value="" size="20" maxlength="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="reset" name="btn_limpar" value="Limpar">
                    </td>
                    <td>
<!--                        botao do tipo "submit" = aciona o form que pega as informações dele e manda pro action-->
                        <input type="submit" name="btn_salvar" value="Salvar">
                    </td>
                </tr>
                <tr>
                    <td>Obs:</td>
                    <td>
                        <textarea name="txt_obs" rows="5" cols="21"></textarea>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>