<?php

class Utils
{

    public static function json(array $object)
    {
        header('Content-Type: application/json');
        echo json_encode($object, JSON_PRETTY_PRINT);
    }

    public static function validar(array $keys, array $object)
    {
        foreach ($keys as &$key) {
            if (!array_key_exists($key, $object) || is_null($object[$key])) {
                Utils::json(['message' => "Parâmetro '$key' não informado", 'error' => true]);

                exit();
            }
        }
    }

    public static function cors()
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 0');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
    }

    public static function randomNum(int $qnt){
        $text = '';
        for($i = 0; $i < $qnt; $i++){
            $num = mt_rand(0, 9999);
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);
            $text = $text.$num;
            
        }
        return $text;
    }

}