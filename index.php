<?php
    require('CalculoMegaSena.php');
    $result = new CalculoMegaSena(6,10);
    echo $result->retorno_html();