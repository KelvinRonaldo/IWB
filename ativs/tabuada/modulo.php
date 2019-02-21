<?php

    function tabuada($tab, $conta){
        //↓ ???????????????????
        global $result;

        for($cont = 1; $cont <= $conta; $cont++){
            $result .= $tab . ' x ' . $cont . ' = '  . $tab*$cont . '<br>';
        }
        return isset($result)? $result : $result;
    }
?>