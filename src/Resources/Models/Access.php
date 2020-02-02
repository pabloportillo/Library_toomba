<?php


namespace Resources\Models;
use \RedBeanPHP\SimpleModel;
use \RedBeanPHP\R as R;
use Slim\Http\Request;
use Slim\http\Response;
use Interop\Container\ContainerInterface;


class Access
{
    /**
     * Generamos un token, lo almacenamos en bbdd y lo mostramos
     */
    public static function token($request){

        $new_token = openssl_random_pseudo_bytes(16);
        //Convert the binary data into hexadecimal representation.
        $new_token = bin2hex($new_token);

        $token_table = R::load('token',1);
        $token_table->token = $new_token;
        $token_table->fecha_creacion_token = date('Y-m-d H:i:s');
        
        if(R::store($token_table)){
            $result = [
                'accessToken' => $new_token
            ];
        }else{
            $result = [
                'status' => 400,
                'body' => [
                    'estado' => '400',
                    'error' => 'Ha habido un fallo con su solicitud. Intentelo de nuevo o contacte con el administrador.',
                ]
            ];
        }
        return $result;
    }

    /**
     * Obtenemos Token de la bbdd y comprobamos si ese token se ha generado hace menos de 8 horas. Si es así devuelve true.
     */
    public static function getToken($token)
    {
        $tiempo_fin = date('Y-m-d H:i:s');
        $tiempo_inicio = date('Y-m-d H:i:s',(strtotime('-8 hour',strtotime($tiempo_fin))));

        $q = "SELECT * FROM token WHERE token = '$token' AND (fecha_creacion_token BETWEEN '$tiempo_inicio' AND '$tiempo_fin') limit 1";
        $result = R::getRow($q);
        return $result; 
    }
}