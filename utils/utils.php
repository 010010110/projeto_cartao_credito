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
            if (!array_key_exists($key, $object)) {
                Utils::json(['message' => "Parâmetro '$key' não informado", 'error' => true]);

                exit();
            }
        }
    }

}