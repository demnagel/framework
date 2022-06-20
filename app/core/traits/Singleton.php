<?php

namespace App\Core\Traits;

trait Singleton
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }


    private function __wakeup()
    {
    }

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (empty (self:: $instance)) {
            self:: $instance = new self ();
            return self:: $instance;
        }
        return self:: $instance;
    }
}