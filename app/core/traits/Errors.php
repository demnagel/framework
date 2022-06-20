<?php

namespace App\Core\Traits;

trait Errors
{
    private $errors = [];

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $msg
     * @return void
     */
    public function addError($msg): void
    {
        $this->errors[] = $msg;
    }

    /**
     * @return array
     */
    public function unsuccessJson(): array
    {
        return ['status' => false, 'errors' => $this->getErrors()];
    }
}