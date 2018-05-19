<?php

namespace HnhDigital\LinodeApi\Profile;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use HnhDigital\LinodeApi\Foundation\Base;

/**
 * This is the TfaEnable class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Profile-TfaEnable
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class TfaEnable extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'profile/tfa-enable';


    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generates a Two Factor secret for your User. TFA will not be enabled until you have successfully confirmed the code you
     * were given with [tfa-enable-confirm](/#operation/tfaConfirm) (see below). Once enabled, logins from untrusted computers
     * will be required to provide a TFA code before they are successful.
     *
     * @link https://developers.linode.com/api/v4#operation/tfaEnable
     *
     * @return mixed
     */
    public function tfaEnable()
    {
        return $this->apiCall('post', '');
    }
}
