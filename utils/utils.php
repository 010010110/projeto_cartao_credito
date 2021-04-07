<?php

class Utils
{

    public static function json(array $object)
    {
        header('Content-Type: application/json');
        echo json_encode($object, JSON_PRETTY_PRINT);
    }

}