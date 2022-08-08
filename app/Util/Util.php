<?php

namespace App\Util;

use Error;
use Exception;

class Util
{
    public static function formatException(Exception | Error $ex): array {
        return [
            "message" => str_replace("\"", "'", $ex->getMessage()),
            "code" => $ex->getCode(),
            "file" => str_replace("/var/www/html/", "", $ex->getFile()),
            "line" => $ex->getLine()
        ];
    }
}
