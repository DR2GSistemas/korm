<?php

declare(strict_types=1);

namespace DR2GSistemas\korm\classes;


class Loggin
{
    public const LEVEL_DEBUG = 'DEBUG';
    public const LEVEL_INFO = 'INFO';
    public const LEVEL_WARNING = 'WWARNING';
    public const LEVEL_ERROR = 'ERROR';
    private static $base_folder = "logs/";
    private static $base_filename = "errors";

    public static function debug($message)
    {
        self::log($message, self::LEVEL_DEBUG);
    }

    public static function log($message, $level = self::LEVEL_INFO)
    {
        $filename = join(DIRECTORY_SEPARATOR, [dirname(__FILE__, 2), self::$base_folder . self::$base_filename . date("Y-m-d") . ".log"]);
        $message = date("Y-m-d H:i:s") . " " . $level . " " . $message . "\n";
        file_put_contents($filename, $message, FILE_APPEND);
    }

    public static function info($message)
    {
        self::log($message);
    }

    public static function warning($message)
    {
        self::log($message, self::LEVEL_WARNING);
    }

    public static function error($message)
    {
        self::log($message, self::LEVEL_ERROR);
    }


}
