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
 * This is the Payment class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account-Payments
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Payment extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account/payments/%s';
    /**
     * Payment Id.
     *
     * @var 
     */
    protected $payment_id;
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($payment_id)
    {
        $this->payment_id = $payment_id;
        parent::__construct($payment_id);
    }

    /**
     * Returns information about a specific Payment.

     *
     * @link https://developers.linode.com/api/v4#operation/getPayment
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }
}
