<?php

namespace HnhDigital\LinodeApi\Linode\Instances;

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
 * This is the Ip class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Linode-Instances-Ips
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Ip extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'linode/instances/%s/ips/%s';
    /**
     * Linode Id.
     *
     * @var 
     */
    protected $linode_id;
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($linode_id)
    {
        $this->linode_id = $linode_id;
        parent::__construct($linode_id);
    }

    /**
     * View information about the specified IP address associated with the specified Linode.

     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeIP
     *
     * @return array
     */
    public function get($address)
    {
        return $this->apiCall('get', '');
    }

    /**
     * Updates a particular IP Address associated with this Linode. Only allows setting/resetting reverse DNS.

     *
     * @param integer $linode_id The ID of the Linode to look up.
     * @param string  $address   The IP address to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/updateLinodeIP
     *
     * @return void
     */
    public function update($address)
    {
        return $this->apiCall('put', '', ['json' => [
            'linode_id' => $linode_id,
            'address'   => $address,
        ]]);
    }

    /**
     * Deletes a public IPv4 address associated with this Linode. This will fail if it is the Linode's last remaining public IPv4 address. Private IPv4 addresses cannot be removed via this endpoint.

     *
     * @param integer $linode_id The ID of the Linode to look up.
     * @param string  $address   The IP address to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/removeLinodeIP
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}
