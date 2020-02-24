<?php

namespace Arzeroid\LaravelModelEncryptable\Exceptions;

use Exception;

class NoPublicKeyException extends Exception
{
    protected $message = 'No Public Key is set.';
}
