<?php
namespace Lib;

use Dotenv\Dotenv;

class SlimDotEnv extends Dotenv
{
    public function __construct($path, $file)
    {
        parent::__construct($path, $file);
    }

    function env($key, $default = null)
    {
        $val = getenv($key);
        if($val ===false)
        {
            return value($default);
        }

        return strtolower($value);
    }
}