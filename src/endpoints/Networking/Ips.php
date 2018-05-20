<?php

namespace HnhDigital\LinodeApi\Networking;

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
 * This is the Ips class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Networking-Ips
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Ips extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'networking/ips';

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
     * Returns a paginated list of IP Addresses on your Account, excluding private addresses.
     *
     * @link https://developers.linode.com/api/v4#operation/getIPs
     *
     * @return array
     */
    public function get()
    {
        return $this->apiSearch($this->endpoint, ['class' => 'Networking\Ip', 'parameters' => ['id']]);
    }

    /**
     * Allocates a new IPv4 Address on your Account. The Linode must be configured to support additional addresses - please
     * [open a support ticket](/#operation/createTicket) requesting additional addresses before attempting allocation.
     *
     * @link https://developers.linode.com/api/v4#operation/allocateIP
     *
     * @return mixed
     */
    public function allocateIP($optional = [])
    {
        return $this->apiCall('post', '', ['json' => array_merge([
        ], $optional)]);
    }
}
