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
 * This is the Config class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Linode-Instances-Configs
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Config extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'linode/instances/%s/configs/%s';
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
     * Returns information about a specific Configuration profile.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeConfig
     *
     * @return array
     */
    public function get($config_id)
    {
        return $this->apiCall('get', '');
    }

    /**
     * Updates a Configuration profile.
     *
     * @param int $linode_id The ID of the Linode whose Configuration profile to look up.
     * @param int $config_id The ID of the Configuration profile to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/updateLinodeConfig
     *
     * @return void
     */
    public function update($config_id)
    {
        return $this->apiCall('put', '', ['json' => [
            'linode_id' => $linode_id,
            'config_id' => $config_id,
        ]]);
    }

    /**
     * Deletes the specified Configuration profile from the specified Linode.
     *
     * @param int $linode_id The ID of the Linode whose Configuration profile to look up.
     * @param int $config_id The ID of the Configuration profile to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/deleteLinodeConfig
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}