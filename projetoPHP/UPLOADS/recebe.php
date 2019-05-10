<?php

    echo($_FILES['userfile']['name'].'<br>');
    echo($_FILES['userfile']['type'].'<br>');
    echo($_FILES['userfile']['size'].'<br>');
    echo($_FILES['userfile']['tmp_name'].'<br>');
    echo($_FILES['userfile']['error'].'<br>');
    
    $uploaddir = './img/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    echo('<br>');
    var_dump($uploadfile);
    echo('<br>');

    echo '<pre>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Arquivo válido e enviado com sucesso.\n";
    } else {
        echo "Possível ataque de upload de arquivo!\n";
    }

    echo 'Aqui está mais informações de debug:';
    print_r($_FILES);

    print "</pre>";

?>