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
 * This is the Region class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Regions
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Region extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'regions/%s';
    /**
     * Region Id.
     *
     * @var 
     */
    protected $region_id;
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($region_id)
    {
        $this->region_id = $region_id;
        parent::__construct($region_id);
    }

    /**
     * Returns a single Region.

     *
     * @link https://developers.linode.com/api/v4#operation/getRegion
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }
}
