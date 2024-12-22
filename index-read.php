<html>

<head>
    <link href="style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">




</head>

<body>

    <header>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h2>Import CSV file into Mysql using PHP</h2>
                <div class="row">
                    <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport"
                        enctype="multipart/form-data" onsubmit="return validateFile()">
                        <div Class="input-row">
                            <label>Choose your file. <a href="./import-template.csv" download>Download
                                    template</a></label><input type="file" name="file" id="file" class="file"
                                accept=".csv,.xls,.xlsx">
                            <div class="import">
                                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12" style="padding-bottom:20px;">
                        <div class="btn-group float-right">

                            <a class="btn btn-primary btn-sm" type="button" href="#" data-toggle="tooltip"
                                id="export_all" title="Export All"><i class="icon-add"></i>
                                Export All </a>

                            <a class="btn btn-danger btn-sm" type="button" href="#" data-toggle="tooltip"
                                title="Export Visible" id="export_visible"><i class="icon-trash"></i> Export Visible</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="outer-scontainer">


        <div class="container-fluid">
            <?php

            include "FunctionsCsv.php";

            
            
            if(isset($_GET['file'])){
                $file = $_GET['file'];

                if(isset($_GET['function']) && $_GET['function'] != '') {

                    $funcao =  $_GET['function'];

                    $tabela_split = explode(".",$file);
                    $tabela_nome = "tbl_".$tabela_split[0];
                    echo "<input type='hidden' name='tabela_nome' id='tabela_nome' value='$tabela_nome'>";

                    switch ($funcao) {
                        case "table":
                            datatable_from_read_csv($file);
                            break;
                            
                        case "parse":
                            parse_csv_rows($file);
                            break;
                    
                        case "array":
                            parse_csv_to_array($file);
                            break;

                        case "write":
                            read_csv_data_write($file);
                            break;

                        default:
                            read_csv_data($file);
                            break;
                    }
                }
                else{
                    read_csv_data($file);
                }
            }
            else {
                $footer = "Variável file= NÃO CONFIGURADA! ";
            }

            ?>
        </div>
    </main>
    <footer>
        <div>
            <?php if(isset($footer)) echo $footer; ?>
        </div>
    </footer>




    <!-- 

    <div class="container">
		<h2>Import CSV file into Mysql using PHP</h2>
		<div class="outer-scontainer">
			<div class="row">
				<form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport"
					enctype="multipart/form-data" onsubmit="return validateFile()">
					<div Class="input-row">
						<label>Choose your file. <a href="./import-template.csv" download>Download
								template</a></label><input type="file" name="file" id="file" class="file"
							accept=".csv,.xls,.xlsx">
						<div class="import">
							<button type="submit" id="submit" name="import" class="btn-submit">Import</button>
						</div>
					</div>
				</form>
			</div>
			<div class="row clearfix">
				<div class="col-sm-12" style="padding-bottom:20px;">
					<div class="btn-group float-right">

						<a class="btn btn-primary btn-sm" type="button" href="#" data-toggle="tooltip" id="export_all" title="Export All"><i class="icon-add"></i>
							Export All </a> 

						<a class="btn btn-danger btn-sm" type="button" href="#" data-toggle="tooltip" title="Export Visible" id="export_visible"><i class="icon-trash"></i> Export Visible</a>
					</div>
				</div>
			</div>
			<div id="response" class="<?php //if(!empty($response["type"])) { echo $response["type"] ; } ?>">
				<?php //if(!empty($response["message"])) { echo $response["message"]; } ?>
			</div><?php  //require_once __DIR__ . '/list.php';?>
		</div>
	</div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>





    <script>
    $(document).ready(function() {
        var tabela_nome = "#" + $("#tabela_nome").val();

        var tabela_parse = $(tabela_nome).dataTable({
            dom: '<"top"l>Bfrtip',
            buttons: [
                'copy',
                'csv',
                'excel',
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                'print'
            ]
        });
    });
    </script>








    <script>
    function table2csv(oTable, exportmode, tableElm) {
        var csv = '';
        var headers = [];
        var rows = [];

        // Get header names
        $(tableElm + ' thead').find('th').each(function() {
            var $th = $(this);
            var text = $th.text();
            var header = '"' + text + '"';
            // headers.push(header); // original code
            if (text != "") headers.push(
                header
            ); // actually datatables seems to copy my original headers so there ist an amount of TH cells which are empty
        });
        csv += headers.join(',') + "\n";

        // get table data
        if (exportmode == "full") { // total data
            var total = oTable.fnSettings().fnRecordsTotal()
            for (i = 0; i < total; i++) {
                var row = oTable.fnGetData(i);
                row = strip_tags(row);
                rows.push(row);
            }
        } else { // visible rows only
            $(tableElm + ' tbody tr:visible').each(function(index) {
                var row = oTable.fnGetData(this);
                row = strip_tags(row);
                rows.push(row);
            })
        }
        csv += rows.join("\n");

        // if a csv div is already open, delete it
        if ($('.csv-data').length) $('.csv-data').remove();
        // open a div with a download link
        $('body').append('' + csv + '');

    }

    function strip_tags(html) {
        var tmp = document.createElement("div");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText;
    }


    $(document).ready(function() {
        var asInitVals = new Array();
        var oTable = $('table.display').dataTable({
            dom: '<"top"l>Bfrtip',
            buttons: [
                'copy',
                'csv',
                'excel',
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                'print'
            ]
        });
        /* $('#userTable').DataTable({
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        }); */

        // exporta apenas o que está visível agora (filtros e paginação aplicada)
        $('#export_visible').click(function(event) {
            event.preventDefault();
            table2csv(oTable, 'visible', 'table.display');
        })

        // exportar todos os dados da tabela
        $('#export_all').click(function(event) {
            event.preventDefault();
            table2csv(oTable, 'full', 'table.display');
        })

    });
    </script>
</body>

</html>