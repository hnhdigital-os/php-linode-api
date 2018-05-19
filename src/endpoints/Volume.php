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
 * This is the Volume class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Volumes
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Volume extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'volumes/%s';
    /**
     * Volume Id.
     *
     * @var 
     */
    protected $volume_id;
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($volume_id)
    {
        $this->volume_id = $volume_id;
        parent::__construct($volume_id);
    }

    /**
     * Get information about a single Volume.

     *
     * @link https://developers.linode.com/api/v4#operation/getVolume
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }

    /**
     * Updates a Volume that you have permission to `read_write`.

     *
     * @param integer $volume_id ID of the Volume to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/updateVolume
     *
     * @return void
     */
    public function update()
    {
        return $this->apiCall('put', '', ['json' => [
            'volume_id' => $volume_id,
        ]]);
    }

    /**
     * Attaches a Volume on your Account to an existing Linode on your Account. In order for this request to complete successfully, your User must have `read_only` or `read_write` permission to the Volume and `read_write` permission to the Linode. Additionally, the Volume and Linode must be located in the same Region.

     *
     * @param integer $volume_id ID of the Volume to attach.
     *
     * @link https://developers.linode.com/api/v4#operation/attachVolume
     *
     * @return mixed
     */
    public function attach()
    {
        return $this->apiCall('post', '/attach', ['json' => [
            'volume_id' => $volume_id,
        ]]);
    }

    /**
     * Creates a Volume on your Account. In order for this request to complete successfully, your User must have the `add_volumes` grant. The new Volume will have the same size and data as the source Volume. Creating a new Volume will incur a charge on your Account.

     *
     * @param integer $volume_id ID of the Volume to clone.
     *
     * @link https://developers.linode.com/api/v4#operation/cloneVolume
     *
     * @return mixed
     */
    public function clone()
    {
        return $this->apiCall('post', '/clone', ['json' => [
            'volume_id' => $volume_id,
        ]]);
    }

    /**
     * Detaches a Volume on your Account from a Linode on your Account. In order for this request to complete successfully, your User must have `read_write` access to the Volume and `read_write` access to the Linode.

     *
     * @param integer $volume_id ID of the Volume to detach.
     *
     * @link https://developers.linode.com/api/v4#operation/detachVolume
     *
     * @return mixed
     */
    public function detach()
    {
        return $this->apiCall('post', '/detach', ['json' => [
            'volume_id' => $volume_id,
        ]]);
    }

    /**
     * Resize an existing Volume on your Account. In order for this request to complete successfully, your User must have the `read_write` permissions to the Volume.
* Volumes can only be resized up.

     *
     * @param integer $volume_id ID of the Volume to resize.
     *
     * @link https://developers.linode.com/api/v4#operation/resizeVolume
     *
     * @return mixed
     */
    public function resize()
    {
        return $this->apiCall('post', '/resize', ['json' => [
            'volume_id' => $volume_id,
        ]]);
    }

    /**
     * Deletes a Volume you have permission to `read_write`.

**Deleting a Volume is a destructive action and cannot be undone.**

Deleting stops billing for the Volume. You will be billed for time used within
the billing period the Volume was active.

     *
     * @param integer $volume_id ID of the Volume to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/deleteVolume
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}
