<?php

namespace Arzeroid\LaravelModelEncryptable\Exceptions;

use Exception;

class NoPrivateKeyException extends Exception
{
    protected $message = 'No Private Key is set.';
}
