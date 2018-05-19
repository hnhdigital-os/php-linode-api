<?php

namespace HnhDigital\LinodeApi\Networking\Ipv6;

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
 * This is the Ranges class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Networking-Ipv6-Ranges
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Ranges extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'networking/ipv6/ranges';


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
     * Displays the IPv6 ranges on your Account.
     *
     * @link https://developers.linode.com/api/v4#operation/getIPv6Ranges
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }
}
