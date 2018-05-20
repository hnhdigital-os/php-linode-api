<?php

namespace HnhDigital\LinodeApi\Managed;

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
 * This is the LinodeSetting class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Managed-LinodeSettings
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class LinodeSetting extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'managed/linode-settings/%s';

    /**
     * Linode Id.
     *
     * @var int
     */
    protected $linode_id;

    /**
     * This model is fillable.
     *
     * @var bool
     */
    protected $fillable = true;

    /**
     * This model's method that provides the data to fill it.
     *
     * @var string
     */
    protected $fill_method = 'get';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($linode_id, $fill = [])
    {
        $this->linode_id = $linode_id;
        parent::__construct($linode_id, $fill);
    }

    /**
     * Returns a single Linode's Managed settings.
     *
     * @link https://developers.linode.com/api/v4#operation/getManagedLinodeSetting
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Updates a single Linode's Managed settings.
     *
     * @param int $linode_id The Linode ID whose settings we are accessing.
     *
     * @link https://developers.linode.com/api/v4#operation/updateManagedLinodeSetting
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '', ['json' => $this->getDirty($optional)]);
    }
}
