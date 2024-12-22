<?php 

function read_csv_data($file) {

    echo "<p><b>Array</b></p>Lendo arquivo: $file <hr>";


    if (($open = fopen($file, "r")) !== false) {
        $linhas = 0;
        $arrCampos = [];
       
        $arrRows = [];
        
        while (($data = fgetcsv($open, 10000, ",")) !== false) {
            $array[] = $data;
            echo print_r($data) . "<br><br>";
            $linhas++;

            $arrValores = [];
            
            foreach($data as $coluna) {
                if ($coluna != "") {      
                    if ($linhas == 1) {
                        array_push($arrCampos,$coluna);
                    }
                    else {
                        array_push($arrValores,$coluna);
                    }                             
                    //echo $coluna . "<br>";
                }
            }
            if ($linhas == 1) {
                
                $arrRows[] = $arrCampos;
            }
            else {
                $arrRows[] = $arrValores;
            }

            //echo "<hr>";
        }
        fclose($open);
        echo "<br><br>Linhas: $linhas. <br>Campos: ".implode(",",$arrCampos)."<hr><br><pre>";
        // To display array data
        //write_csv_rows('teste.csv',$arrRows);
        print_r($arrRows);
        echo "</pre><br><hr><br>";
    }
    else {
        echo "Arquivo não existe";
    }
}

function parse_csv_rows($path){
    // Parse the rows
    $rows = [];

    $tabela_split = explode(".",$path);
    $tabela_nome = "tbl_".$tabela_split[0];
    
    $handle = fopen($path, "r");
    while (($row = fgetcsv($handle)) !== false) {
        //$linha = array_shift($row);
        //$rows[] = array_slice($row, 1);
        if($row[0] == "") {
            $rows[] = array_slice($row, 1);
        }
        else {
            $rows[] = $row;
        }
        //print_r($row[0]);
        //exit();
    }
    fclose($handle);
    // Remove the first one that contains headers
    $headers = array_shift($rows);
    // Combine the headers with each following row
    $array = [];
    foreach ($rows as $row) {
        $array[] = array_combine($headers, $row);
    }
    echo "<b>Parse Rows:</b><hr>";
    echo "<table id='$tabela_nome'><thead><tr>";
    
    foreach($headers as $item) {
        echo "<th>$item</th>";
    }
    echo "</tr></thead><tbody>";

    foreach($array as $campos) {
        echo "<tr>";
        foreach($campos as $campo) {
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }


    echo "</tbody></table>";
   
    echo "<hr><pre>";
    var_dump($array);
    echo "</pre>";
}

function datatable_from_read_csv($path){
    // Parse the rows
    $rows = [];

    $tabela_split = explode(".",$path);
    $tabela_nome = "tbl_".$tabela_split[0];
    
    $handle = fopen($path, "r");
    while (($row = fgetcsv($handle)) !== false) {
        //$linha = array_shift($row);
        if($row[0] == "") {
            $rows[] = array_slice($row, 1);
        }
        else {
            $rows[] = $row;
        }
        
        //print_r($row[0]);
        //exit();
    }
    fclose($handle);
    // Remove the first one that contains headers
    $headers = array_shift($rows);
    // Combine the headers with each following row
    $array = [];
    foreach ($rows as $linha) {
        $array[] = array_combine($headers, $linha);
    }
    echo "<b>Table: $tabela_nome</b><hr>";
    echo "<table id='$tabela_nome'><thead><tr>";
    
    foreach($headers as $item) {
        echo "<th>$item</th>";
    }
    echo "</tr></thead><tbody>";

    foreach($array as $campos) {
        echo "<tr>";
        foreach($campos as $campo) {
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }


    echo "</tbody></table>";
   
    //echo "<hr><pre>";
    //var_dump($array);
    //echo "</pre>";
}

function parse_csv_to_array($path){
    
    $arrayRows = [];
    // Parse the rows
    $rows = [];

    $tabela_split = explode(".",$path);
    $tabela_nome = "tbl_".$tabela_split[0];
    
    $handle = fopen($path, "r");
    while (($row = fgetcsv($handle)) !== false) {
        //$linha = array_shift($row);
        //$rows[] = array_slice($row, 1);
        if($row[0] == "") {
            $rows[] = array_slice($row, 1);
        }
        else {
            $rows[] = $row;
        }
        //print_r($row[0]);
        //exit();
    }
    fclose($handle);
    // Remove the first one that contains headers
    $headers = array_shift($rows);
    // Combine the headers with each following row
    $array = [];
    foreach ($rows as $row) {
        $array[] = array_combine($headers, $row);
    }
    echo "<b>Parse Array</b><hr>";
    echo "<table id='$tabela_nome'><thead><tr>";

    $arrayRows[] = $headers;
    
    foreach($headers as $item) {
        echo "<th>$item</th>";
    }
    echo "</tr></thead><tbody>";

    foreach($array as $campos) {
        echo "<tr>";
        foreach($campos as $campo) {
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }


    echo "</tbody></table>";
   
    echo "<hr><pre>";
    var_dump($array);
    echo "</pre>";
}


/**
 * write_csv_rows
 *
 * @param  mixed $filepath //'data/new-file.csv'
 * @param  mixed $rows
 * @return void
 */
    /* $rows = [
        ['id', 'title', 'poster', 'overview', 'release_date', 'genres'],
        [181808, "Star Wars: The Last Jedi", "https://image.tmdb.org/t/p/w500/kOVEVeg59E0wsnXmF9nrh6OmWII.jpg", "Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares to do battle with the First Order.", 1513123200, "Documentary"],
        [383498, "Deadpool 2", "https://image.tmdb.org/t/p/w500/to0spRl1CMDvyUbOnbb4fTk3VAd.jpg", "Wisecracking mercenary Deadpool battles the evil and powerful Cable and other bad guys to save a boy's life.", 1526346000, "Action, Comedy, Adventure"],
        [157336, "Interstellar", "https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg", "Interstellar chronicles the adventures of a group of explorers who make use of a newly discovered wormhole to surpass the limitations on human space travel and conquer the vast distances involved in an interstellar voyage.",1415145600,"Adventure, Drama, Science Fiction"]
    ]; */

    function write_csv_rows($filepath, $rows) {
    
        $path = $filepath;
        $fp = fopen($path, 'w'); // open in write only mode (write at the start of the file)
        foreach ($rows as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
        
    }
    

    function read_csv_data_write($file) {

        echo "Lendo arquivo: $file <br>";
        echo "<b>Criando arquivo:</b> $file <hr>";

        $new_file = "new_".$file;
    
    
        if (($open = fopen($file, "r")) !== false) {
            $linhas = 0;
            $arrRows = [];
            
            while (($data = fgetcsv($open, 10000, ",")) !== false) {
                $array[] = $data;
                //echo print_r($data) . "<br><br>";
                $linhas++;

                $arrValores = [];
                $arrCampos = [];

                $cont_cols = 0;
                
                foreach($data as $coluna) {
                    $cont_cols++;

                    if ($coluna != "") {      
                        if ($linhas == 1) {
                            array_push($arrCampos,$coluna);
                        }
                        else {
                            array_push($arrValores,$coluna);
                        }                             
                        //echo $coluna . "<br>";
                    }
                    else {
                        if($cont_cols>1 && $linhas != 1) {
                            array_push($arrValores,$coluna);
                        }
                    }
                }
                if ($linhas == 1) {
                    $arrRows[] = $arrCampos;
                }
                else {
                    $arrRows[] = $arrValores;
                }
    
                //echo "<hr>";
            }
            fclose($open);
            echo "<br><b>Criado Arquivo:</b> $new_file<br>Linhas: $linhas. <br>Campos: ".implode(",",$arrCampos)."<hr><br><pre>";
            // To display array data
            write_csv_rows($new_file,$arrRows);
            print_r($arrRows);
            echo "</pre><br><hr><br>";
        }
        else {
            echo "Arquivo não existe";
        }
    }