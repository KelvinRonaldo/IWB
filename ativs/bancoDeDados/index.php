<?php

    require_once("./bd/conexao.php");

    $conexao = conexaoMySql();
    // var_dump($conexao);
    if(isset($_POST['btn_salvar'])){
        $nome = trim($_POST['txt_nome']);
        $sexo = trim($_POST['rdo_sexo']);
        $data_nasc = trim($_POST['txt_data_nasc']);
        $endereco = trim($_POST['txt_endereco']);
        $bairro = trim($_POST['txt_bairro']);
        $cep = trim($_POST['txt_cep']);
        $telefone = trim($_POST['txt_telefone']);
        $celular = trim($_POST['txt_celular']);
        $email = trim($_POST['txt_email']);
        $obs = trim($_POST['txt_obs']);

        // '".$variavel."' → se for INT não colocar aspas simples ('')
        $sql = "INSERT INTO tblcontatos (nome, sexo, data_nasc, endereco, bairro, cep, telefone, celular, email, obs)
        VALUES ('".$nome."', '".$sexo."', '".$data_nasc."', '".$endereco."', '".$bairro."', '".$cep."', '".$telefone."', '".$celular."', '".$email."', '".$obs."');";
        /*abre aspas de linguagem (") abre aspas do sql (') fecha aspas da linguagem (") concatema com a variável (.) coloca a varíavel com o conteúdo ($...) concatena com a linguagem (.) abre aspas pra continuar a linguagem (") fecha aspas do sql (')
        */
EXEMPLO → .....('Kelvin',....
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Banco de Dados</title>
    </head>
    <body>
        <header>
            <h1>ATIVIDADE PHP</h1>                    
        </header>
        <!-- 
            required - tartamento para obrigar o usuario a fornecer um dado
            placeholder -  coloca uma mensagem informativa na caixa de texto

            pattern - atribui padrões ao input, como expressões regulares

            type =  text
                    tel
                    email
                    url
                    number → min e max odem ser configurados na tag como parâmetro
                    range → min e max odem ser configurados na tag como parâmetro
                    *date - não funciona em todos os browser
                    *month - não funciona em todos os browser
                    *week - não funciona em todos os browser
                    color
         -->
        <div id="conteudo" class="center">
            <form name="frm_contatos" action="index.php" method="post">
                <section id="formulario" class="center">
                    <h2 hidden>FORMULARIO</h2>
                    <div id="nome" name="txt_nome">
                        <h2>Nome:</h2>
                        <input placeholder="Digite seu nome:" required type="text" id="txt-nome" name="txt_nome">
                    </div>
                    <div id="sexo" name="rdo_sexo"> 
                        <h2>Sexo:</h2>
                        <input type="radio" value="F" id="rdo-sexo" name="rdo_sexo">Feminino<br>
                        <input type="radio" value="M" id="rdo-sexo" name="rdo_sexo">Masculino
                    </div>         
                    <div id="data_nasc" name="txt_dt_nasc">                            
                        <h2>Data de Nascimento:</h2>
                        <input type="text" id="txt-data-nasc" name="txt_data_nasc">
                    </div>
                    <div id="endereco" name="txt_endereco">                            
                        <h2>Endereço:</h2>
                        <input type="text" id="txt-endereco" name="txt_endereco">
                    </div>         
                    <div id="bairro" name="txt_bairro">                            
                        <h2>Bairro:</h2>
                        <input type="text" id="txt-bairro" name="txt_bairro">
                    </div>
                    <div id="cep" name="txt_cep">                            
                        <h2>Cep:</h2>
                        <input type="text" id="txt-cep" name="txt_cep">
                    </div>         
                    <div id="telefone" name="txt_telefone">                            
                        <h2>Telefone:</h2>
                        <input type="tel" id="txt-telefone" name="txt_telefone">
                    </div>
                    <div id="celular" name="txt_celular">                            
                        <h2>Celular:</h2>
                        <input type="tel" id="txt-celular" name="txt_celular">
                    </div>         
                    <div id="email" name="txt_email">                            
                        <h2>E-mail:</h2>
                        <input type="email" id="txt-email" name="txt_email">
                    </div>
                    <div id="obs" name="txt_obs">                            
                        <h2>Observação:</h2>
                        <textarea placeholder="Obs.:" id="txt-obs" name="txt_obs"></textarea>
                    </div>   
                    <div id="btns" name="btns">   
                        <input type="submit" id="btn-salvar" name="btn_salvar" value="SALVAR">
                        <input type="submit" id="btn-limpar" name="btn_limpar" value="LIMPAR">
                    </div>   
                </section>
            </form>
            <section id="contatos">
                <h2 hidden>TABELA</h2>
                <table id="tbl-contatos">
                    <tr id="title-tbl">
                        <th colspan="5"><h2>CONSULTA DE CONTATOS</h2></th>
                    </tr>
                    <tr>
                        <th class="tbl-title">
                            
                        </th>
                        <th class="tbl-title">
                            
                        </th>
                        <th class="tbl-title">
                            
                        </th>
                        <th class="tbl-title">
                            
                        </th>
                        <th class="tbl-title">
                            
                        </th>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </section>
        </div>
    </body>
</html>