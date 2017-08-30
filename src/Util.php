<?php

class Util
{
    public static function printNl($echo = '')
    {
        echo "$echo \n";
    }

    public static function timedRun(Closure $closure)
    {
        $startTime = microtime(true);
        call_user_func($closure);
        return microtime(true) - $startTime;
    }
}
