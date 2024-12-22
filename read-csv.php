<?php

include "FunctionsCsv.php";
 
 if(isset($_GET['file'])){
    $file = $_GET['file'];


    if(isset($_GET['function']) && $_GET['function'] == 'parse') {
        parse_csv_rows($file);

    }
    else {
        read_csv_data($file);

    }
    
 }
 else {
    echo "Variável file= NÃO CONFIGURADA! ";
 }

?>