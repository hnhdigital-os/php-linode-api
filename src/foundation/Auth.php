<?php

namespace HnhDigital\LinodeApi\Foundation;

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
    /**
     * Using the token method.
     *
     * @var int
     */
    const METHOD_TOKEN = 1;

    /**
     * Base endpoint URI.
     *
     * @var string
     */
    private static $base_endpoint = 'https://api.linode.com/v4/';

    /**
     * Method that is being used.
     *
     * @var int
     */
    private static $method;

    /**
     * Token being used for authorization.
     *
     * @var string
     */
    private static $token;

    /**
     * Set the base endpoint.
     *
     * @param string $base_endpoint
     *
     * @return void
     */
    public static function setBaseEndpoint($base_endpoint)
    {
        self::$base_endpoint = $base_endpoint;
    }

    /**
     * Get the base endpoint.
     *
     * @param string $token
     *
     * @return void
     */
    public static function getBaseEndpoint()
    {
        return self::$base_endpoint;
    }

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
    public static function getToken()
    {
        return self::$token;
    }

    /**
     * Attach the right header to the request.
     *
     * @param arra &$headers
     *
     * @return void
     */
    public static function getHeader(&$headers)
    {
        $headers['Authorization'] = 'Bearer '.self::getToken();
    }
}
