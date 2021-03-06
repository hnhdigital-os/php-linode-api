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

use HnhDigital\LinodeApi\Foundation\Base;

/**
 * This is the Account class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Account extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account';

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
     * Returns the contact and billing information related to your Account.
     *
     * @link https://developers.linode.com/api/v4#operation/getAccount
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Updates contact and billing information related to your Account.
     *
     * @link https://developers.linode.com/api/v4#operation/updateAccount
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '', ['json' => $this->getDirty($optional)]);
    }
}
