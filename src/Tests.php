<?php

class Tests
{
    protected static $iterations = 5000;

    public static function undefinedIndex()
    {
        return function() {
            $emptyArr = [];
            for($i = self::$iterations; $i > 0; --$i) {
                $emptyArr['jim'];
            }
        };
    }

    public static function errorTriggered()
    {
        return function() {
            for($i = self::$iterations; $i > 0; --$i) {
                trigger_error('E_USER_NOTICE error triggered', E_USER_NOTICE);
            }
        };
    }

    public static function reportExceptionOld()
    {
        return function() {
            for($i = self::$iterations; $i > 0; --$i) {
                Rollbar::report_exception(new Exception("Exception Thrown"));
            }
        };
    }

    public static function reportExceptionNew()
    {
        return function() {
            for($i = self::$iterations; $i > 0; --$i) {
                Rollbar\Rollbar::log(Level::ERROR, new Exception("Exception Thrown"), array(\Rollbar\Utilities::IS_UNCAUGHT_KEY => true));
            }
        };
    }
}
