# Laravel Model Encryptable

A simple trait to encrypt attributes using public key before saving to the database and to decrypt attributes using private key before using their values

# Installation

Simply add the following line to your `composer.json` and run `composer update`

```
"arzeroid/laravel-model-ssh-encryptable": "^1.0",
```

Or use composer to add it with the following command

```
composer require "arzeroid/laravel-model-ssh-encryptable"
```

# Usage

1. Add the trait to your model and set your attributes to be encrypted in **encryptable** array
2. Setup **publicKey** and **privateKey** variables;

```php
<?php

namespace App\Models;

use Arzeroid\LaravelModelEncryptable\SSHEncryptable;

class ActualPersonalCost extends BaseModel
{
    ...
    use SSHEncryptable;

    protected $publicKey = "this_is_public_key";
    protected $privateKey = "this_is_private_key";

    /**
     * The attributes that should be encrypted.
     *
     * @var array
     */
    protected $encryptable = [
        'cost',
    ];

    ...
}
```
