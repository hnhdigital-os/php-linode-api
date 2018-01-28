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
 * This is the Base class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */

class Api
{
    /**
     * Make an api request.
     *
     * @param string $method 
     * @param string $endpoint
     * @param string $payload
     *
     * @return mixed
     */
    protected function call($method, $endpoint, $payload)
    {

    }
}