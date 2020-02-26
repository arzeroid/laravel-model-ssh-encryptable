# Laravel Model SSH Encryptable

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
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Arzeroid\LaravelModelEncryptable\SSHEncryptable;

class UserSalary extends Model
{
    ...
    use SSHEncryptable;

    /**
     * The attributes that should be encrypted.
     *
     * @var array
     */
    protected $encryptable = [
        'payroll',
    ];
    ...
}
```
2. Set **PUBLIC_KEY** variable in .env file for public key
```
PUBLIC_KEY=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDL/6Kf7FxMR68WllFaKMfFLOmScFZFUOvjRaKuVOdOt6t+sqPUxqcXbPakvtqEY/RcavVs7Of8ae3qSIiwxgialtGVfMzTMU39GlmAkKZ97HCvZ+DX0lMHZ0EXghBqnn0gm7+5GsiHJZ/ImFiPJkeA74F/3y6cppkgpIgGQrH5wQIDAQAB
```

3. Set **private_key** key in cache for private key

```php
<?php

namespace App\Http\Controllers;

use Cache;
...

class UserSalaryController extends Controllers
{
    ...
    public function setKey()
    {
        Cache::forever('private_key', 'MIICXQIBAAKBgQDL/6Kf7FxMR68WllFaKMfFLOmScFZFUOvjRaKuVOdOt6t+sqPUxqcXbPakvtqEY/RcavVs7Of8ae3qSIiwxgialtGVfMzTMU39GlmAkKZ97HCvZ+DX0lMHZ0EXghBqnn0gm7+5GsiHJZ/ImFiPJkeA74F/3y6cppkgpIgGQrH5wQIDAQABAoGBAJDEPPgYl/dZ95qj2d+NiRcYJDlTlyVho8SJKkVk4zEtjno+85yPzQwGu5F2D0RcWpErJjfCd27dDYVxK++m2Xr1URVhaG9Y7NRIso2gRayG8AbwIRUu1WrRt6Kyll/Dnveoxbw/WyccmS/CicBG52G+egDubgaTcvFiaRRaABRBAkEA+l+bSevcsDNtsPEBwrdQhzr5wR82JTuGO7/HIb2s0GpPR8KnoLtHChhiBHMxINTCkHwi7AN4iUTfUK4y7d1npQJBANCVPCDKzxXJ1isVGfhBldJvyDB/xPLwkXIf3Hwaig1nSBfUFnJe8dBb2QFcF+QoyFXAvLPZ7ydiAvzpT492Du0CQQCEfzf0xKcDcBPqgYBHBS/OgL1PIC9NQNTmpbTB/FiJ6tiNx0tiWflcNE8av8MN9soIIEly0Ntm+VWcorM9AeApAkBsRkukKiM9iDyouJd2i3Uee/BLXMf75G1b9LYbphsrwgVmeS39yNN1+Xe4gPnV8mWsPhS2t9axduteJi6qpfoxAkBXBkgvBnWFaNs6fZVANE2GKdI9F5pF3Cm2eUy+90pmrwM5o2Jfiy6aRXQ9689XKNV2LSXXuP7yjQFj8mqiCD7q');
        ...
    }
}
```
