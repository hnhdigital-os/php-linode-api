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
 * This is the Nodebalancers class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Nodebalancers
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Nodebalancers extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'nodebalancers';

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
     * Returns a paginated list of NodeBalancers you have access to.
     *
     * @link https://developers.linode.com/api/v4#operation/getNodeBalancers
     *
     * @return array
     */
    public function get()
    {
        return $this->apiSearch($this->endpoint, ['class' => 'Nodebalancer', 'parameters' => ['id']]);
    }

    /**
     * Creates a NodeBalancer in the requested Region. This NodeBalancer will not start serving requests until it is
     * configured.
     *
     * @link https://developers.linode.com/api/v4#operation/createNodeBalancer
     *
     * @return mixed
     */
    public function createNodeBalancer($optional = [])
    {
        return $this->apiCall('post', '', ['json' => array_merge([
        ], $optional)]);
    }
}
