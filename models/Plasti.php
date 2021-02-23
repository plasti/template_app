<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Plastimedia extends Model
{
    public static function sendmail($data, $html)
    {
        $payload = [
            'api_key' => 'apikey_b62468ba7fdtt78f8h4t2f15s54at5hb1fr',
            'email_from' => 'marinillaemprende@gmail.com',
            'name_from' => 'Marinilla City',
            'email_to' => $data['email'],
            'name_to' => $data['name'],
            'subject' => $data['asunto'],
            'type' => 'html',
            'message' => $html
        ];
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://api.plastimedia.com/api/mail/send");
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($c, CURLOPT_RETURNTRANSFER , 1);
        $result = curl_exec($c);
        $result = json_decode($result);
        return $result; 
    }

    public static function oscurece_color($color,$cant){
        //voy a extraer las tres partes del color
        $rojo = substr($color,1,2);
        $verd = substr($color,3,2);
        $azul = substr($color,5,2);

        //voy a convertir a enteros los string, que tengo en hexadecimal
        $introjo = hexdec($rojo);
        $intverd = hexdec($verd);
        $intazul = hexdec($azul);

        //ahora verifico que no quede como negativo y resto
        if($introjo-$cant>=0) $introjo = $introjo-$cant;
        if($intverd-$cant>=0) $intverd = $intverd-$cant;
        if($intazul-$cant>=0) $intazul = $intazul-$cant;

        //voy a convertir a hexadecimal, lo que tengo en enteros
        $rojo = dechex($introjo);
        $verd = dechex($intverd);
        $azul = dechex($intazul);

        //voy a validar que los string hexadecimales tengan dos caracteres
        if(strlen($rojo)<2) $rojo = "0".$rojo;
        if(strlen($verd)<2) $verd = "0".$verd;
        if(strlen($azul)<2) $azul = "0".$azul;

        //voy a construir el color hexadecimal
        $oscuridad = "#".$rojo.$verd.$azul;

        //la función devuelve el valor del color hexadecimal resultante
        return $oscuridad;
    }

    public function parse_fecha($f)
    {   
        $mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return $mes[date_format(date_create($f), 'm') - 1].' '.date_format(date_create($f), 'd').' de '.date_format(date_create($f), 'Y').' a las '. date_format(date_create($f), 'H:i');
    }

    public static function parse_fecha2($f)
    {   
        return date_format(date_create($f), 'Y/m/d');
    }

    public static function parse_hora($f)
    {   
        return date_format(date_create($f), 'H:i');
    }
}
