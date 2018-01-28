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
 * This is the Linode API Exception class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class LinodeApiException extends \Exception
{
    /**
     * Exception constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message = null, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
