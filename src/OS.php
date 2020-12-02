<?php

namespace lantongxue\nohup;

class OS
{
    public static function isWin()
    {
        return substr(strtoupper(PHP_OS), 0, 3) === 'WIN';
    }
}
