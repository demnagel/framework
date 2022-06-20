<?php

namespace App\Core\Interfaces;

interface Logging
{
    /**
     * @param string $msg
     * @return void
     */
    public function write(string $msg);
}