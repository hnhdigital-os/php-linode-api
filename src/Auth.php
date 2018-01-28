<?php

namespace HnhDigital\LinodeApi;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This is the Auth class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */

class Auth
{
    const METHOD_TOKEN = 1;

    /**
     * Method
     */
    private $method;

    /**
     * Token.
     *
     * @var string
     */
    private $token;

    /**
     * Set the token.
     *
     * @param string $token
     *
     * @return void
     */
    public static function setToken($token)
    {
        self::$token = $token;
        self::$method = self::METHOD_TOKEN;
    }

    /**
     * Get the token.
     *
     * @param string $token
     *
     * @return void
     */
    public static function getToken($token)
    {
        return self::$token;
    }
}