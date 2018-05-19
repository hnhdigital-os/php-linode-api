<?php

namespace HnhDigital\LinodeApi\Account;

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
 * This is the Payments class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account-Payments
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Payments extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account/payments';

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
     * Returns a paginated list of Payments made on this Account.
     *
     * @link https://developers.linode.com/api/v4#operation/getPayments
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }

    /**
     * Makes a Payment to your Account via credit card. This will charge your credit card the requested amount.
     *
     * @link https://developers.linode.com/api/v4#operation/createPayment
     *
     * @return mixed
     */
    public function createPayment()
    {
        return $this->apiCall('post', '');
    }
}