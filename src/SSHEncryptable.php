<?php

namespace Arzeroid\LaravelModelEncryptable;

use phpseclib\Crypt\RSA;
use Arzeroid\LaravelModelEncryptable\Exceptions\NoPublicKeyException;
use Arzeroid\LaravelModelEncryptable\Exceptions\NoPrivateKeyException;

trait SSHEncryptable
{
    /**
     * If the attribute is in the encryptable array
     * then decrypt it.
     *
     * @param $key
     *
     * @return $value
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (isset($this->encryptable) && in_array($key, $this->encryptable) && $value !== '') {
            $value = $this->decrypt($value);
        }
        return $value;
    }

    /**
     * If the attribute is in the encryptable array
     * then encrypt it.
     *
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        if (isset($this->encryptable) && in_array($key, $this->encryptable)) {
            $value = $this->encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * When need to make sure that we iterate through
     * all the keys.
     *
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        if (isset($this->encryptable)) {
            foreach ($this->encryptable as $key) {
                if (isset($attributes[$key])) {
                    $attributes[$key] = $this->decrypt($attributes[$key]);
                }
            }
            return $attributes;
        }
    }

    private function encrypt($value)
    {

        $publicKey = env('PUBLIC_KEY');
        if (isset($publicKey)) {
            $rsa = new RSA();
            $rsa->loadKey($publicKey);
            return $rsa->encrypt($value);
        }

        throw new NoPublicKeyException();
    }

    private function decrypt($value)
    {
        $privateKey = Cache::get('private_key');
        if (isset($privateKey)) {
            $rsa = new RSA();
            $rsa->loadKey($privateKey);
            return $rsa->decrypt($value);
        }

        throw new NoPrivateKeyException();
    }
}
