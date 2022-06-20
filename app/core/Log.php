<?php

namespace App\Core;

use App\Core\Traits\ValidationTools;

class Log implements Interfaces\Logging
{
    use ValidationTools;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Log constructor.
     * @param array $params
     */
    function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    protected function getCurFile(): string
    {
        return Storage::get('request')->root() . $this->params['path'] . '/log_' . date('Y-m-d') . 'txt';
    }

    /**
     * @param string $msg
     * @return void
     */
    public function write(string $msg): void
    {
        if ($this->params['write']) {
            file_put_contents($this->getCurFile(), $msg . PHP_EOL, FILE_APPEND);
        }
    }
}