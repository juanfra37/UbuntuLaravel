<!doctype html>

<?php
$val = "";
$myData = file_get_contents("http://192.168.0.30:5000/api/Marcaciones");
$myObject = json_decode($myData);

function insert(){   
    
    
    $data = array(
        "idpersonal" => 1,
        "ip" => $_SERVER['REMOTE_ADDR'],
        "fecha" => date('d-m-Y'),
        "tipo" => "Salida"
    );
    $data_string = json_encode($data);                                                                                   
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.30:5000/api/Marcaciones");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                       
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                                                                                                        
    $result = curl_exec($ch);
    curl_close($ch);
    echo "Transaccion realizada!";
    
    /*echo $nombredepartamento;*/
}
?>

<?php
function obtenerFechaEnLetra(){
    $fecha = date('d-m-Y');
    $dia= conocerDiaSemanaFecha($fecha);

    $num = date("j", strtotime($fecha));

    $anno = date("Y", strtotime($fecha));

    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

    $mes = $mes[(date('m', strtotime($fecha))*1)-1];

    return $dia.', '.$num.' de '.$mes.' del '.$anno;

} 

function conocerDiaSemanaFecha($fecha) {

    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

    $dia = $dias[date('w', strtotime($fecha))];

    return $dia;

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

            .usuarioStyle{
                background-color:#218838;
                color:white;
                padding:5px;
            }
            .fechaStyle{
                background-color: #0062CC;
                color:white;
                padding:5px;
            }
        </style>

        <!-- reloj -->
        <script language="JavaScript" type="text/JavaScript">
            var Hoy = new Date();

        function Reloj(){ 
            Hora = Hoy.getHours();
            Minutos = Hoy.getMinutes() ;
            Segundos = Hoy.getSeconds() ;
            if (Hora<=9) Hora = "0" + Hora ;
            if (Minutos<=9) Minutos = "0" + Minutos ;
            if (Segundos<=9) Segundos = "0" + Segundos ;
            var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"); 
            var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
            var Anio = Hoy.getFullYear(); 
            var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + ", a las "; 
            
            var Inicio, Script, Final, Total ;
            Inicio = "<font size=3 color=black>" ;
            Hora=Hora;
            Script =  Fecha + " " + Hora + ":" + Minutos + ":" + Segundos ;
            Final = "</font>" ;
            Total = Inicio + Script + Final ;
            document.getElementById('Fecha_Reloj').innerHTML = Total ;
            Hoy.setSeconds(Hoy.getSeconds() +1);
            setTimeout("Reloj()",1000) ;
        } 
</script>

    </head>

    <body onLoad="Reloj()">
        <div class="flex-top position-ref full-height" style="padding:25px;">
                <div class="top-right links">
                    <a href="{{ url('/') }}">Inicio</a>
                </div>
            
            <div class="content">
            <h2>Marcación de Salida</h2>
            <hr/>
              <table width="100%">
                <tr>
                    <td>
                         <input   value="Bienvenido Usuario" style="width:400px;" class="usuarioStyle" readonly/>
                    </td>
                </tr>
               
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td class="fechaStyle">
                        La fecha y hora es:                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="font-size: large;" id="Fecha_Reloj" ></div>
                    </td>
                </tr>
                <tr>
                    <td class="fechaStyle">
                        Su IP es:                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $_SERVER['REMOTE_ADDR']; ?> 
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>                    
                    <td>
                        <button name="button" class="btn btn-warning" onclick="funcion();">Agregar marcación de salida
                        </button>

                        <script>            
                           
                            function funcion(valor){
                                alert('<?php insert();?>');
                            };
                        </script>
                    </td>
                    
                </tr>
              </table>
            <hr />
            <br/>
            </div>
        </div>
    </body>

    
</html>
