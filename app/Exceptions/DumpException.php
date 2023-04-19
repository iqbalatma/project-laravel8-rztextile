<?php

namespace App\Exceptions;

use Exception;

class DumpException extends Exception
{
    public $data;
    public function __construct($data) {
        $this->data = $data;
    }

    public function render()
    {
        return response()->json([$this->data]);
    }
}
