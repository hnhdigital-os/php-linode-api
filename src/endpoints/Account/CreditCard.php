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
 * This is the CreditCard class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account-CreditCard
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class CreditCard extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account/credit-card';

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
     * Adds/edit credit card information to your Account.
     * Only one credit card can be associated with your Account, so using this endpoint will overwrite your currently active
     * card information with the new credit card.
     *
     * @link https://developers.linode.com/api/v4#operation/createCreditCard
     *
     * @return mixed
     */
    public function createCreditCard($optional = [])
    {
        return $this->apiCall('post', '', ['json' => array_merge([
        ], $optional)]);
    }
}
