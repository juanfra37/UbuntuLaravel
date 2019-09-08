<!doctype html>

<?php
$val = "";
$myData = file_get_contents("http://192.168.0.30:5000/api/Departamentos");
$myObject = json_decode($myData);

function insert($nombredepartamento){   
    
    
    $data = array("nombredepartamento" => $nombredepartamento);
    $data_string = json_encode($data);                                                                                   
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.30:5000/api/Departamentos");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                       
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                                                                                                        
    $result = curl_exec($ch);
    curl_close($ch);
    echo $nombredepartamento;
    
    /*echo $nombredepartamento;*/
}
?>


<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: black;
                /*font-family: 'Raleway', sans-serif;*/
                /*font-weight: 100;*/
                /*height: 100vh;*/
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        
    </head>

    <body>
        <div class="flex-top position-ref full-height" style="padding:25px;">
                <div class="top-right links">
                    <a href="{{ url('/') }}">Inicio</a>
                </div>
            
            <div class="content">
            <h2>Administración de Departamentos</h2>
            <hr/>
              <table>
                <tr>
                    <td>Departamento:</td>
                    <td><input  id="txtDepartamento" /></td>
                    <td><button name="button" class="btn btn-primary" onclick="funcion(document.getElementById('txtDepartamento').value);">Agregar</button></td>
                    <script>            
                        <?php 
                                $val = isset($_GET['v']) ? $_GET["v"] : '';
                            ?>
                            if('<?php echo $val?>'!=''){
                                alert('El nuevo departamento ['+'<?php insert($val);?>'+'] ha sido ingresado.');  
                            }          
                        function funcion(valor){
                            window.location.href = window.location.href+"?v="+valor;
                        }
                    </script>
                </tr>
              </table>
            <hr />
            <br/>
              <b>Registrados:</b>
            <br/><br/>
            <table class="table table-bordered">
                    <thead style="background-color:black;color:white;">
                        <tr>
                            <td style="display:none;">Id Departamento</td>  
                            <td>Departamento</td>                         
                        </tr>                        
                    </thead>
                    <?php foreach($myObject as $key=>$item): ?>
                    <tr>
                        <td style="display:none;"><?PHP echo $item->iddepartamento; ?></td>
                        <td><?PHP echo $item->nombredepartamento; ?></td>                    
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>

    
</html>
