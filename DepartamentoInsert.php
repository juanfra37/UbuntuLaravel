<?php
    
       function addx($departamento) {
        
        $data = array("nombredepartamento" => $departamento);
        $data_string = json_encode($data);                                                                                   
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.30:5000/api/Departamentos");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                       
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                                                                                                                            
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    };
    
    function add() {
        return $_GET["w1"];
      };
    
?>