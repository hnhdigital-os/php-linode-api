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
 * This is the TfaDisable class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Profile-TfaDisable
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class TfaDisable extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'profile/tfa-disable';


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
     * Disables Two Factor Authentication for your User. Once successful, login attempts from untrusted computers will only
     * require a password before being successful. This is less secure, and is discouraged.
     *
     * @link https://developers.linode.com/api/v4#operation/tfaDisable
     *
     * @return mixed
     */
    public function tfaDisable()
    {
        return $this->apiCall('post', '');
    }
}
