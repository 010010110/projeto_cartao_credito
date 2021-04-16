<?php

class Utils
{

    public static function json(array $object)
    {
        header('Content-Type: application/json');
        echo json_encode($object, JSON_PRETTY_PRINT);
    }

    public static function validar(array $keys, $object)
    {
        foreach ($keys as &$key) {
            if (is_null($object) || !array_key_exists($key, $object) || is_null($object[$key])) {
                Utils::json(['message' => "Parâmetro '$key' não informado", 'error' => true]);
                http_response_code(400);

                exit();
            }
        }
    }

    public static function randomNum(int $qnt)
    {
        $text = '';
        for ($i = 0; $i < $qnt; $i++) {
            $num = mt_rand(0, 9999);
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);
            $text = $text . $num;

        }
        return $text;
    }

}